<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use App\Models\Social;
use App\Models\Project;
use App\Models\Portfolio;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Notifications\DeleteAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AccountActivation;
use App\Notifications\DeactivateAccount;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view user', only: ['index']),
            new Middleware('permission:create user', only: ['create', 'store']),
            new Middleware('permission:update user', only: ['update', 'edit']),
            new Middleware('permission:delete user', only: ['destroy', 'trash', 'restore', 'forceDelete']),
            new Middleware('permission:deactivate user', only: ['deactivateAccount']),
        ];
    }
    
    public function index()
    {
        $users = User::get();
        $alumniUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'alumni');
        })->get();
        
        return view('role-permission.user.index', [
            'users' => $users,
            'alumniUsers' => $alumniUsers,
        ]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('role-permission.user.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'activation_token' => Str::random(60),
        ]);

        $user->notify(new AccountActivation($user));

        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', 'User Created Successfully with Roles');
    }
    
    public function activateAccount($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid Activation Token.');
        }

        // Show a form to set the password
        return view('auth.activate', ['token' => $token]);
    }

    public function setPassword(Request $request, $token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid Activation Token.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->activation_token = null;
        $user->email_verified_at = now();

        // Check if user is a super-admin or admin
        $roles = ['super-admin', 'admin'];
        $userRoles = $user->getRoleNames();

        if ($userRoles->intersect($roles)->isNotEmpty()) {
            $user->profile_setup = 1;
        }
        
        $user->save();

        return redirect('/login')->with('status', 'Account has been activated! You can login.');
    }

    public function createProfile(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to set up your profile.');
        }
    
        // Check if the user has already set up their profile
        if ($user->profile_setup) {
            return redirect('/');
        }
    
        $skills = Skill::all();
    
        return view('auth.profile', ['user' => $user, 'skills' => $skills]);
    }
    
    public function saveProfile(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to set up your profile.');
        }
    
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'nullable|numeric|digits_between:10,15',
            'location' => 'nullable|string|max:255',
        ]);
    
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
    
        $user->phone_number = $request->input('phone_number');
        $user->location = $request->input('location');
    
        // Check if user is an employee
        $roles = ['employee'];
        $userRoles = $user->getRoleNames();

        if ($userRoles->intersect($roles)->isNotEmpty()) {
            $user->profile_setup = 1;
        }
        
        $user->save();
    
        // Store the selected skills
        $user->skills()->sync($request->input('skills'));
    
        return redirect('create-portfolio')->with('status', 'Profile updated. Please add your portfolio.');
    }    

    public function createPortfolio(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to add your portfolio.');
        }

        // Check if the user has already set up their profile
        if ($user->profile_setup) {
            return redirect('/');
        }

        // Check if the user already has a portfolio
        if ($user->portfolio) {
            return redirect('confirm-project')->with('status', 'Portfolio already added. Please add your project.');
        }

        return view('portfolio.create');
    }

    public function savePortfolio(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to add your portfolio.');
        }

        $request->validate([
            'description' => 'required|string',
            'skills' => 'nullable|string',
            'achievements' => 'nullable|string',
            'work_experience' => 'nullable|string',
            'education' => 'nullable|string',
        ]);

        $portfolio = new Portfolio($request->all());
        $portfolio->user_id = $user->id;
        $portfolio->save();

        return redirect('confirm-project')->with('status', 'Portfolio added. Please add your project.');
    }

    public function confirmProject(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to add your project.');
        }

        // Check if the user has already set up their profile
        if ($user->profile_setup) {
            return redirect('/');
        }

        return view('projects.confirm');
    }

    public function saveConfirmProject(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to add your project.');
        }
    
        return redirect('create-project');
    }    

    public function createProject(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to add your project.');
        }

        // Check if the user has already set up their profile
        if ($user->profile_setup) {
            return redirect('/');
        }

        return view('projects.profile');
    }

    public function saveProject(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to add your project.');
        }
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'nullable|url',
            'video_url' => 'nullable|url',
            'github_repo_url' => 'nullable|url',
            'tools_used' => 'nullable|string',
            'programming_language_used' => 'nullable|string',
            'is_private' => 'required|boolean',
        ]);
    
        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $user->id,
            'posted_by' => $user->name,
            'posted_on' => now(),
            'is_private' => $request->is_private,
            'url' => $request->url,
            'video_url' => $request->video_url,
            'github_repo_url' => $request->github_repo_url,
            'tools_used' => $request->tools_used,
            'programming_language_used' => $request->programming_language_used,
        ]);
    
        return redirect('social')->with('status', 'Project added. Profile setup complete!');
    }    

    public function social(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to add your social media links.');
        }

        // Check if the user has already set up their profile
        if ($user->profile_setup) {
            return redirect('/');
        }

        return view('social.create');
    }

    public function saveSocial(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to add your social media links.');
        }

        $request->validate([
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'twitter' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);
    
        $social = Social::updateOrCreate(
            ['user_id' => $user->id],
            [
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
                'twitter' => $request->twitter,
                'tiktok' => $request->tiktok,
                'linkedin' => $request->linkedin,
            ]
        );

        // Mark profile setup as complete
        $user->profile_setup = 1;
        $user->save();

        return redirect('/dashboard')->with('status', 'Profile Setup Complete.');
    }

    public function editSocial()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to edit your social media links.');
        }

        $socials = Social::where('user_id', $user->id)->firstOrFail();

        return view('social.edit', ['socials' => $socials]);
    }

    public function updateSocial(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to edit your social media links.');
        }

        $request->validate([
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'twitter' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        $social = Social::where('user_id', $user->id)->firstOrFail();
        $social->update([
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'twitter' => $request->twitter,
            'tiktok' => $request->tiktok,
            'linkedin' => $request->linkedin,
        ]);

        return redirect('/profile')->with('status', 'Social Media Links Updated Successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        $skills = Skill::all();
        $userSkills = $user->skills->pluck('name', 'name')->all();
    
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
            'skills' => $skills,
            'userSkills' => $userSkills
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required',
            'skills' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);
        $user->syncSkills($request->skills);

        return redirect('/users')->with('status', 'User Updated Successfully');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);

        // If the user is activated, user cannot be deleted
        if ($user->activation_token === null) {
            return redirect('/users')->with('status', 'User Cannot be Deleted');
        }

        $user->delete();
        $user->notify(new DeleteAccount($user));

        return redirect('/users')->with('status', 'User Deleted Successfully');
    }

    public function trash()
    {
        $trashedUsers = User::onlyTrashed()->get();

        return view('role-permission.user.trash', ['trashedUsers' => $trashedUsers]);
    }

    public function restore($userId)
    {
        $user = User::withTrashed()->findOrFail($userId);
        $user->restore();

        return redirect('/users/trash')->with('status', 'User Restored Successfully');
    }

    public function forceDelete($userId)
    {
        $user = User::withTrashed()->findOrFail($userId);
        $user->forceDelete();

        return redirect('/users/trash')->with('status', 'User Deleted Permanently');
    }

    public function deactivateAccount($userId)
    {
        $user = User::findOrFail($userId);

        // Checks if the user is already deactivated
        if ($user->activation_token !== null) {
            return redirect('/users')->with('status', 'Account is already deactivated');
        }

        $user->activation_token = Str::random(60);
        $user->email_verified_at = null;
        $user->save();

        $user->notify(new DeactivateAccount($user));

        return redirect('/users')->with('status', 'User Deactivated');
    }
    
    public function reactivateAccount($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid activation token.');
        }

        return view('auth.reactivate', ['token' => $token]);
    }

    public function reactivate(Request $request, $token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid activation token.');
        }

        $user->activation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return redirect('/login')->with('status', 'Account has been activated! You can login.');
    }
}
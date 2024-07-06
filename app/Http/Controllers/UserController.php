<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Skill;

use App\Notifications\AccountActivation;
use Illuminate\Support\Str;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view user', only: ['index']),
            new Middleware('permission:create user', only: ['create', 'store']),
            new Middleware('permission:update user', only: ['update', 'edit']),
            new Middleware('permission:delete user', only: ['destroy', 'trash', 'restore', 'forceDelete']),
        ];
    }
    
    public function index()
    {
        $users = User::get();
        return view('role-permission.user.index', ['users' => $users]);
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

        return redirect('/users')->with('status', 'User created successfully with roles');
    }
    
    public function activateAccount($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid activation token.');
        }

        // Show a form to set the password
        return view('auth.activate', ['token' => $token]);
    }

    public function setPassword(Request $request, $token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid activation token.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('create-profile', ['token' => $token]))->with('success', 'Account activated. Setup your profile.');
    }

    public function createProfile(Request $request, $token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid activation token.');
        }

        // Check if the user has already set up their profile
        if ($user->profile_setup) {
            return redirect('/');
        }

        $skills = Skill::all();

        return view('auth.profile', ['token' => $token, 'user' => $user, 'skills' => $skills]);
    }

    public function saveProfile(Request $request, $token)
    {
        $user = User::where('activation_token', $token)->first();
    
        if (!$user) {
            return redirect('/')->with('error', 'Invalid activation token.');
        }
    
        // Update the user
        $user->profile_setup = 1;
        $user->activation_token = null;
        $user->save();
    
        // Store the selected skills
        $user->skills()->sync($request->input('skills'));
    
        return redirect('/login')->with('success', 'Profile set up successfully!');
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
        $user->delete();

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
}
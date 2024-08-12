<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Jobs\Notify;

use App\Models\User;
use App\Models\Skill;
use App\Events\JobCreated;
use App\Models\Application;
use App\Models\JobFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;
    
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view job', only: ['index']),
            new Middleware('permission:create job', only: ['create', 'store']),
            new Middleware('permission:update job', only: ['update', 'edit']),
            new Middleware('permission:delete job', only: ['destroy', 'trash', 'restore', 'forceDelete']),
        ];
    }
    
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $query = Job::query();
    
        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }
    
        if ($request->has('filter_skills')) {
            $userSkills = Auth::user()->skills()->pluck('skills.id')->toArray();
    
            $query->whereHas('skills', function ($query) use ($userSkills) {
                $query->whereIn('skills.id', $userSkills);
            });
        }

        $jobs = $query->paginate(10);
    
        if ($jobs->isEmpty()) {
            return redirect()->route('jobs.index')->with('status', 'No Results Found');
        }
    
        return view('jobs.index', ['jobs' => $jobs]);
    }    
    

    public function create(Job $job)
    {
        $skills = Skill::all();
        $jobSkills = $job->skills->pluck('name', 'name')->all();

        return view('jobs.create', [
            'job' => $job,
            'skills' => $skills,
            'jobSkills' => $jobSkills
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'qualifications' => 'required|string',
            'aboutus' => 'required|string',
            'skills' => 'required|array|min:1',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }
    
        $job = Job::create([
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'qualifications' => $request->qualifications,
            'aboutus' => $request->aboutus,
            'logo' => $logoPath,
        ]);

        $skillId = $request->skills;
        $job->syncSkills($skillId);

        event(new JobCreated($job));

        return redirect('/jobs')->with('status', 'Job Created Successfully');
    }

    public function edit(Job $job)
    {
        $skills = Skill::all();
        $jobSkills = $job->skills->pluck('name', 'name')->all();

        return view('jobs.edit', [
            'job' => $job,
            'skills' => $skills,
            'jobSkills' => $jobSkills
        ]);
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string',
            'location' => 'required|string',
            'responsibilities' => 'required|string',
            'qualifications' => 'required|string',
            'aboutus' => 'required|string',
            'skills' => 'required|array|min:1',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('logo')) {
            if ($job->logo) {
                Storage::delete($job->logo);
            }
            
            $logoPath = $request->file('logo')->store('logos', 'public');
        } else {
            $logoPath = $job->logo;
        }
    
        $data = [
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'qualifications' => $request->qualifications,
            'aboutus' => $request->aboutus,
            'logo' => $logoPath,
        ];

        $job->update($data);
        $job->syncSkills($request->skills);

        return redirect('/jobs')->with('status', 'Job Updated Successfully');
    }
    
    public function destroy($jobId)
    {
        $job = Job::findOrFail($jobId);
        $job->delete();

        return redirect('/jobs')->with('status', 'Jobs Deleted Successfully');
    }

    public function trash()
    {
        $trashedJobs = Job::onlyTrashed()->get();

        return view('jobs.trash', ['trashedJobs' => $trashedJobs]);
    }

    public function restore($jobId)
    {
        $job = Job::withTrashed()->findOrFail($jobId);
        $job->restore();

        return redirect('/jobs/trash')->with('status', 'Job Restored Successfully');
    }

    public function forceDelete($jobId)
    {
        $job = Job::withTrashed()->findOrFail($jobId);
        $job->forceDelete();

        return redirect('/jobs/trash')->with('status', 'Job Deleted Permanently');
    }

    public function show(Job $job)
    {
        $cacheKey = 'job_view_count_' . $job->id;
    
        // Increment the view count only if not cached for this job and within the cache duration
        if (!Cache::has($cacheKey)) {
            // Store the view count in cache for 1 minute
            Cache::put($cacheKey, true, now()->addMinutes(1));
    
            $job->increment('views_count');
        }
    
        $job->refresh();
    
        return view('jobs.show', ['job' => $job]);
    }

    public function apply(Job $job)
    {
        $user = Auth::user();

        return view('jobs.apply', [
            'job' => $job,
            'user' => $user,
        ]);
    }

    public function storeApplication(Request $request, Job $job)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'resume' => 'required|mimes:pdf,docx|max:2048',
            'cover_letter' => 'required|string',
        ]);

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        } else {
            return redirect()->back()->withErrors(['resume' => 'Resume is required.']);
        }

        $application = new Application();
        $application->job_id = $job->id;
        $application->user_id = Auth::id();
        $application->name = $request->name;
        $application->email = $request->email;
        $application->resume = $resumePath;
        $application->cover_letter = $request->cover_letter;
        $application->save();

        return redirect('/jobs')->with('status', 'Application Submitted Successfully.');
    }

    public function showApplications()
    {
        $applications = Application::all();
        return view('reports.applicants', ['applications' => $applications]);
    }

    public function showApplication(Application $application)
    {
        $this->authorize('view', $application);

        return view('reports.show', ['application' => $application]);
    }

    public function deleteApplication($id)
    {
        $application = Application::findOrFail($id);

        if ($application->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $application->delete();

        return redirect()->route('my-applications')->with('status', 'Application Deleted Successfully.');
    }

    public function feedback(Job $job)
    {
        return view('jobs.feedback', ['job' => $job]);
    }

    public function submitFeedback(Request $request, Job $job)
    {
        $request->validate([
            'feedback_text' => 'required|string',
        ]);

        JobFeedback::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
            'feedback_text' => $request->feedback_text,
        ]);

        return redirect('/jobs')->with('status', 'Feedback Submitted Successfully.');
    }

    public function indexFeedback()
    {
        $feedbacks = JobFeedback::all();
        return view('feedback.index', ['feedbacks' => $feedbacks]);
    }

    public function showFeedback($id)
    {
        $feedback = JobFeedback::with('job', 'user')->findOrFail($id);
        return view('feedback.show', ['feedback' => $feedback]);
    }
}

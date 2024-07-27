<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Jobs\Notify;

use App\Models\User;
use App\Models\Skill;
use App\Events\JobCreated;
use App\Models\JobFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class JobController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:create job', only: ['create', 'store']),
            new Middleware('permission:update job', only: ['update', 'edit']),
            new Middleware('permission:delete job', only: ['destroy', 'trash', 'restore', 'forceDelete']),
        ];
    }
    
    public function index(Request $request)
    {
        // Get search input from request
        $search = $request->input('search');
    
        // Initialize query builder for jobs
        $query = Job::query();
    
        // Apply search filter if provided
        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }
    
        // Apply skills filter if requested
        if ($request->has('filter_skills')) {
            // Get authenticated user's skills
            $userSkills = Auth::user()->skills()->pluck('skills.id')->toArray();
    
            $query->whereHas('skills', function ($query) use ($userSkills) {
                $query->whereIn('skills.id', $userSkills);
            });
        }
    
        // Get paginated jobs based on the constructed query
        $jobs = $query->paginate(10);
    
        // Check if jobs are empty after filtering
        if ($jobs->isEmpty()) {
            return redirect()->route('jobs.index')->with('status', 'No Results Found');
        }
    
        // Return the view with jobs data
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
            'skills' => 'required|array|min:1'
        ]);

        $job = Job::create([
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'qualifications' => $request->qualifications,
            'aboutus' => $request->aboutus,
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
            'skills' => 'required'
        ]);

        $data = [
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'qualifications' => $request->qualifications,
            'aboutus' => $request->aboutus,
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
        return view('jobs.apply', ['job' => $job]);
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
}

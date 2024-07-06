<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Skill;

use Illuminate\Http\Request;
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
        $search = $request->input('search');

        $jobs = Job::when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->paginate(10);

        if ($jobs->isEmpty()) {
            return redirect('/jobs')->with('status', 'No Results Found');
        } else {
            $message = '';
        }

        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        $skills = Skill::pluck('name', 'name')->all();
        return view('jobs.create', ['skills' => $skills]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'qualifications' => 'required|string',
            'aboutus' => 'required|string',
            'skills' => 'required'
        ]);

        $job = Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'qualifications' => $request->qualifications,
            'aboutus' => $request->aboutus,
        ]);

        $skillId = Skill::whereIn('name', $request->skills)->pluck('id')->all();
        $job->syncSkills($skillId);

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
            'responsibilities' => 'required|string',
            'qualifications' => 'required|string',
            'aboutus' => 'required|string',
            'skills' => 'required'
        ]);

        $data = [
            'title' => $request->title,
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
        return view('jobs.show', ['job' => $job]);
    }

    public function apply(Job $job)
    {
        return view('jobs.apply', ['job' => $job]);
    }

    public function admin(Request $request)
    {
        $search = $request->input('search');

        $jobs = Job::when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->paginate(10);

        if ($jobs->isEmpty()) {
            return redirect('/jobs/admin')->with('status', 'No Results Found');
        } else {
            $message = '';
        }

        return view('jobs.admin', ['jobs' => $jobs]);
    }
}

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
        $jobs = Job::pluck('title', 'title')->all();
        return view('jobs.create', ['jobs' => $jobs]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'qualifications' => 'required|string',
            'aboutus' => 'required|string'
        ]);

        $job = Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'qualifications' => $request->qualifications,
            'aboutus' => $request->aboutus,
        ]);

        return redirect('/jobs')->with('status', 'Job Created Successfully');
    }

    public function edit(Job $job)
    {
        $skills = Skill::pluck('name', 'name')->all();
        $skillsArray = explode(',', $job->skills);
        $skillNames = array_map('trim', $skillsArray);
        $jobSkills = array_combine($skillNames, $skillNames);

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
}

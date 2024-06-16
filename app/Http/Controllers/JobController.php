<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

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

    public function index()
    {
        $jobs = Job::get();
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
            'description' => 'required|string'
        ]);

        $job = Job::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect('/jobs')->with('status', 'Job Created Successfully');
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        $job->update($data);

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

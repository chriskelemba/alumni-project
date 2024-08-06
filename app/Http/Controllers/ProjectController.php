<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('is_published', true)->get();
        return view('projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'posted_by' => auth()->user()->name,
            'posted_on' => now(),
            'is_private' => $request->is_private,
        ]);

        return redirect('/projects')->with('status', 'Project Created Successfully');
    }

    public function show($projectId)
    {
        $project = Project::with('user')->findOrFail($projectId);

        return view('projects.show', [
            'project' => $project,
        ]);
    }

    public function edit($projectId)
    {
        $project = Project::find($projectId);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $projectId)
    {
        $project = Project::find($projectId);
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->save();

        return redirect()->route('projects.index');
    }

    public function destroy($projectId)
    {
        $project = Project::find($projectId);

        $project->delete();

        return redirect()->route('projects.index');
    }

    public function trash()
    {
        $trashedProjects = Project::onlyTrashed()->get();

        return view('projects.trash', ['trashedProjects' => $trashedProjects]);
    }

    public function restore($projectId)
    {
        $project = Project::withTrashed()->findOrFail($projectId);
        $project->restore();

        return redirect('/projects/trash')->with('status', 'Project Restored Successfully');
    }

    public function forceDelete($projectId)
    {
        $project = Project::withTrashed()->findOrFail($projectId);
        $project->forceDelete();

        return redirect('/projects/trash')->with('status', 'Project Deleted Permanently');
    }

    public function publish($projectId)
    {
        $project = Project::findOrFail($projectId);

        if (auth()->user()->id !== $project->user_id) {
            abort(403, 'Unauthorized Action.');
        }

        $project->is_published = true;
        $project->save();

        return redirect()->back()->with('status', 'Project Published Successfully!');
    }
}
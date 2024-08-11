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
            'video_url' => 'nullable|url',
            'github_repo_url' => 'nullable|url',
            'tools_used' => 'nullable|string',
            'programming_language_used' => 'nullable|string',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'posted_by' => auth()->user()->name,
            'posted_on' => now(),
            'is_private' => $request->is_private,
            'video_url' => $request->video_url,
            'github_repo_url' => $request->github_repo_url,
            'tools_used' => $request->tools_used,
            'programming_language_used' => $request->programming_language_used,
        ]);

        return redirect('/projects')->with('status', 'Project Created Successfully');
    }

    public function show($projectId)
    {
        $project = Project::with('user')->findOrFail($projectId);
        $user = $project->user;

        return view('projects.show', [
            'project' => $project,
            'user' => $user
        ]);
    }

    public function edit($projectId)
    {
        $project = Project::find($projectId);

        if ($project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('projects.edit', ['project' => $project]);
    }

    public function update(Request $request, $projectId)
    {
        $project = Project::find($projectId);

        if ($project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_url' => 'nullable|url',
            'github_repo_url' => 'nullable|url',
            'tools_used' => 'nullable|string',
            'programming_language_used' => 'nullable|string',
        ]);

        $project = Project::find($projectId);
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->video_url = $request->input('video_url');
        $project->github_repo_url = $request->input('github_repo_url');
        $project->tools_used = $request->input('tools_used');
        $project->programming_language_used = $request->input('programming_language_used');
        $project->save();

        return redirect()->route('projects.index');
    }

    public function destroy($projectId)
    {
        $project = Project::find($projectId);

        if ($project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
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
    
        if ($project->is_private) {
            return redirect()->back()->withErrors(['status' => 'Cannot publish a private project.']);
        }
    
        $project->is_published = true;
        $project->save();
    
        return redirect()->back()->with('status', 'Project Published Successfully!');
    }

    public function unpublish($projectId)
    {
        $project = Project::findOrFail($projectId);

        if (auth()->user()->id !== $project->user_id) {
            abort(403, 'Unauthorized Action.');
        }
    
        $project->is_published = false;
        $project->save();
    
        return redirect()->back()->with('status', 'Project Published Successfully!');
    }
}
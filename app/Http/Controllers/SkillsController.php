<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class SkillsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view skill', only: ['index']),
            new Middleware('permission:create skill', only: ['create', 'store']),
            new Middleware('permission:update skill', only: ['update', 'edit']),
            new Middleware('permission:delete skill', only: ['destroy', 'trash', 'restore', 'forceDelete']),
        ];
    }

    public function index()
    {
        $skills = Skill::get();

        return view('skills.index', ['skills' => $skills]);
    }

    public function create()
    {
        return view('skills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:skills',
        ]);

        Skill::create($request->all());

        return redirect('/skills')->with('status', 'Skill Created Successfully!');

    }
    public function edit(Skill $skill)
    {
        return view('skills.edit', ['skill' => $skill]);
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|unique:skills',
        ]);

        $skill->update(['name'=> $request->name]);

        return redirect('/skills')->with('status', 'Skill Updated Successfully');
    }

    public function destroy($skillId)
    {
        $skill = Skill::findOrFail($skillId);

        $skill->delete();

        return redirect('/skills')->with('status', 'Skill Deleted Successfully');
    }

    public function trash()
    {
        $trashedSkills = Skill::onlyTrashed()->get();

        return view('skills.trash', ['trashedSkills' => $trashedSkills]);
    }

    public function restore($skillId)
    {
        $skill = Skill::withTrashed()->findOrFail($skillId);
        $skill->restore();

        return redirect('/skills/trash')->with('status', 'Skill Restored Successfully');
    }

    public function forceDelete($skillId)
    {
        $skill = Skill::withTrashed()->findOrFail($skillId);
        $skill->forceDelete();

        return redirect('/skills/trash')->with('status', 'Skill Deleted Permanently');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;


class SkillsController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return view('skills.index', ['skills' => $skills]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:skills',
        ]);

        Skill::create($request->all());

        return redirect('/skills')->with('status', 'Skill created successfully!');
    }
}

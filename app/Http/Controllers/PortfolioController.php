<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if (Auth::id() !== $portfolio->user_id) {
            return redirect()->route('profile.show', Auth::id())->with('error', 'Unauthorized action.');
        }

        return view('portfolio.edit', ['portfolio' => $portfolio]);
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if (Auth::id() !== $portfolio->user_id) {
            return redirect()->route('profile.show', Auth::id())->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'description' => 'nullable|string',
            'skills' => 'nullable|string',
            'achievements' => 'nullable|string',
            'work_experience' => 'nullable|string',
            'education' => 'nullable|string',
        ]);

        $portfolio->update([
            'description' => $request->input('description'),
            'skills' => $request->input('skills'),
            'achievements' => $request->input('achievements'),
            'work_experience' => $request->input('work_experience'),
            'education' => $request->input('education'),
        ]);

        return redirect()->route('profile.show', Auth::id())->with('status', 'Portfolio updated successfully!');
    }
}
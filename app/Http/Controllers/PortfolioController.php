<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function show($userId)
    {
        $user = User::findOrFail($userId);

        $portfolio = $user->portfolio;

        return view('portfolio.show', [
            'user' => $user,
            'portfolio' => $portfolio,
        ]);
    }
}
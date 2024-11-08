<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Notifications\ApplicationDenied;
use App\Notifications\ApplicationApproved;

class ApplicationController extends Controller
{
    public function showApplications()
    {
        $applications = Application::where('user_id', auth()->id())->get();

        return view('application.index', [
            'applications' => $applications,
        ]);
    }
    
    public function review($applicationId)
    {
        $application = Application::findOrFail($applicationId);
        $application->status = 'reviewed';
        $application->save();
    
        return redirect()->back()->with('status', 'Application reviewed and email sent.');
    }
    
    public function approve($applicationId)
    {
        $application = Application::findOrFail($applicationId);

        $application->status = 'approved';
        $application->save();

        $user = $application->user;
        $user->notify(new ApplicationApproved($application));

        return redirect()->route('show-applications')->with('status', 'Application approved and user notified.');
    }

    public function deny($applicationId)
    {
        $application = Application::findOrFail($applicationId);

        $application->status = 'denied';
        $application->save();

        $user = $application->user;
        $user->notify(new ApplicationDenied($application));

        return redirect()->route('show-applications')->with('status', 'Application denied and user notified.');
    }
}

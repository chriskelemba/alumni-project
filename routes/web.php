<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\NotificationController;

Route::get('activate-account/{token}', [UserController::class, 'activateAccount'])->name('activate-account');
Route::post('activate-account/{token}', [UserController::class, 'setPassword'])->name('set-password');

Route::get('reactivate-account/{token}', [UserController::class, 'reactivateAccount'])->name('reactivate-account');
Route::post('reactivate-account/{token}', [UserController::class, 'reactivate'])->name('reactivate');

Route::get('create-profile', [UserController::class, 'createProfile'])->name('create-profile');
Route::post('save-profile', [UserController::class, 'saveProfile'])->name('save-profile');

Route::get('create-portfolio', [UserController::class, 'createPortfolio'])->name('create-portfolio');
Route::post('save-portfolio', [UserController::class, 'savePortfolio'])->name('save-portfolio');

Route::get('confirm-project', [UserController::class, 'confirmProject'])->name('confirm-project');
Route::post('saveConfirm-project', [UserController::class, 'saveConfirmProject'])->name('saveConfirm-project');

Route::get('create-project', [UserController::class, 'createProject'])->name('create-project');
Route::post('save-project', [UserController::class, 'saveProject'])->name('save-project');

Route::get('social', [UserController::class, 'social'])->name('social');
Route::post('save-social', [UserController::class, 'saveSocial'])->name('save-social');

Route::patch('/notifications/{notificationId}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::delete('notifications/clear', [NotificationController::class, 'clearAll']);

Route::group(['middleware' => ['role:super-admin|admin|employee']], function() {

    Route::get('users', [UserController::class, 'index']);

});

Route::group(['middleware' => ['role:super-admin|admin']], function() {
    
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::get('users/trash', [UserController::class, 'trash']);
    Route::resource('users', UserController::class)->except(['index']);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);
    Route::get('users/{userId}/restore', [UserController::class, 'restore']);
    Route::get('users/{userId}/forceDelete', [UserController::class, 'forceDelete']);
    Route::get('users/{userId}/deactivateAccount', [UserController::class, 'deactivateAccount']);

    Route::get('jobs/trash', [JobController::class, 'trash']);
    Route::resource('jobs', JobController::class)->except(['index']);
    Route::get('jobs/{jobId}/delete', [JobController::class, 'destroy']);
    Route::get('jobs/{jobId}/restore', [JobController::class, 'restore']);
    Route::get('jobs/{jobId}/forceDelete', [JobController::class, 'forceDelete']);
    
    Route::get('skills/trash', [SkillsController::class, 'trash']);
    Route::resource('skills', SkillsController::class);
    Route::get('skills/{skillId}/delete', [SkillsController::class, 'destroy']);
    Route::get('skills/{skillId}/restore', [SkillsController::class, 'restore']);
    Route::get('skills/{skillId}/forceDelete', [SkillsController::class, 'forceDelete']);

    Route::get('projects/trash', [ProjectController::class, 'trash']);
    Route::get('projects/{projectId}/restore', [ProjectController::class, 'restore']);
    Route::get('projects/{projectId}/forceDelete', [ProjectController::class, 'forceDelete']);

    Route::get('/applications', [JobController::class, 'showApplications'])->name('show-applications');
    Route::get('applications/{application}', [JobController::class, 'showApplication'])->name('applications.show');
    Route::get('applications/{applicationId}/review', [ApplicationController::class, 'review'])->name('application.review');
    Route::get('applications/{applicationId}/approve', [ApplicationController::class, 'approve'])->name('application.approve');
    Route::get('applications/{applicationId}/deny', [ApplicationController::class, 'deny'])->name('application.deny');

});

Route::group(['middleware' => ['auth', 'checkProfileSetup']], function() {

    Route::get('jobs', [JobController::class, 'index']);
    Route::get('jobs/{job}/show', [JobController::class, 'show']);
    Route::get('jobs/{job}/apply', [JobController::class, 'apply']);
    Route::post('jobs/{job}', [JobController::class, 'storeApplication'])->name('jobs.storeApplication');

    Route::get('/jobs/{job}/feedback', [JobController::class, 'feedback']);
    Route::post('/jobs/{job}/submit-feedback', [JobController::class, 'submitFeedback']);
    
    Route::resource('projects', ProjectController::class);
    Route::get('projects/{projectId}/show', [ProjectController::class, 'show']);
    Route::get('projects/{projectId}/delete', [ProjectController::class, 'destroy']);
    Route::post('/projects/{project}/publish', [ProjectController::class, 'publish'])->name('projects.publish');
    Route::post('/projects/{project}/unpublish', [ProjectController::class, 'unpublish'])->name('projects.unpublish');

    Route::get('portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('edit-portfolio');
    Route::put('portfolio/{id}', [PortfolioController::class, 'update'])->name('update-portfolio');

    Route::get('/social/edit', [UserController::class, 'editSocial'])->name('social.edit');
    Route::post('/social/update', [UserController::class, 'updateSocial'])->name('social.update');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/send/{user}', [MessageController::class, 'send'])->name('messages.send');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('messages/{user}', [MessageController::class, 'showMessages'])->name('messages.show');
    Route::delete('messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('/my-applications', [ApplicationController::class, 'showApplications'])->name('my-applications');

});

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'checkProfileSetup'])->name('dashboard');

Route::middleware('auth', 'checkProfileSetup')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/view', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
});

require __DIR__.'/auth.php';

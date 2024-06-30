<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillsController;

Route::group(['middleware' => ['role:super-admin|admin']], function() {
    
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::get('users/trash', [UserController::class, 'trash']);
    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);
    Route::get('users/{userId}/restore', [UserController::class, 'restore']);
    Route::get('users/{userId}/forceDelete', [UserController::class, 'forceDelete']);

    
    Route::resource('skills', SkillsController::class);

});

Route::get('activate-account/{token}', [UserController::class, 'activateAccount'])->name('activate-account');
Route::post('activate-account/{token}', [UserController::class, 'setPassword'])->name('set-password');

Route::get('create-profile/{token}', [UserController::class, 'createProfile'])->name('create-profile');
Route::post('save-profile/{token}', [UserController::class, 'saveProfile'])->name('save-profile');

Route::get('jobs', [JobController::class, 'index']);
Route::get('jobs/{job}/show', [JobController::class, 'show']);
Route::get('jobs/{job}/apply', [JobController::class, 'apply']);

Route::group(['middleware' => ['role:super-admin|admin']], function() {

    Route::get('jobs/trash', [JobController::class, 'trash']);
    Route::resource('jobs', JobController::class)->except(['index']);
    Route::get('jobs/{jobId}/delete', [JobController::class, 'destroy']);
    Route::get('jobs/{jobId}/restore', [JobController::class, 'restore']);
    Route::get('jobs/{jobId}/forceDelete', [JobController::class, 'forceDelete']);

});

Route::resource('projects', ProjectController::class);
Route::get('projects/{projectId}/delete', [ProjectController::class, 'destroy']);

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/view', [ProfileController::class, 'view'])->name('profile.view');
});

require __DIR__.'/auth.php';

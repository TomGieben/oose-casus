<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\EducationElementController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ExecutionController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LearningObjectiveController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('courses', CourseController::class);
    Route::patch('courses/{course}/complete', [CourseController::class, 'complete'])->name('courses.complete');
    Route::resource('criteria', CriteriaController::class);
    Route::resource('education-elements', EducationElementController::class);
    Route::resource('evaluations', EvaluationController::class);
    Route::resource('executions', ExecutionController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('learning-objectives', LearningObjectiveController::class);
    Route::resource('plannings', PlanningController::class);
    Route::resource('resources', ResourceController::class);
    Route::resource('users', UserController::class);
    Route::get('resources/export/{resource}/{type}', [ResourceController::class, 'export'])->name('resources.export');
});
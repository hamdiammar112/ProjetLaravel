<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccueilController;

use App\Http\Controllers\ClientController;

use App\Http\Controllers\CoachController;

use App\Http\Controllers\PlanController;

use App\Http\Controllers\AbonnementController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', [AccueilController::class, 'getDashboard'])->middleware(['auth'])->name('dashboard');




// View Liste Clients
Route::name('clients')->group(function () {
    Route::get('/liste-clients', [ClientController::class, 'getListeClients'])->middleware(['auth']);
});


// View
Route::get('/create-client', [ClientController::class, 'createClient'])->middleware(['auth']);

// View Info Client
Route::get('/show-client/{id}', [ClientController::class, 'showClient'])->middleware(['auth']);


// Form POST REQ
Route::post('/save-client', [ClientController::class, 'saveClient'])->middleware(['auth']);

// View
Route::get('/update-client/{id}', [ClientController::class, 'updateClient'])->middleware(['auth']);

// Form POST REQ
Route::post('/edit-client', [ClientController::class, 'editClient'])->middleware(['auth']);

// DELETE REQ
Route::get('/delete-client', [ClientController::class, 'deleteClient'])->middleware(['auth']);

// View Liste Coaches
Route::name('coaches')->group(function () {
    Route::get('/liste-coaches', [CoachController::class, 'getListeCoaches'])->middleware(['auth']);
});

// View Info Coach
Route::get('/show-coach/{id}', [CoachController::class, 'showCoach'])->middleware(['auth']);

// DELETE Coache
Route::get('/delete-coach', [CoachController::class, 'deleteCoach'])->middleware(['auth']);

Route::get('/create-coach', [CoachController::class, 'createCoach'])->middleware(['auth']);

Route::post('/save-coach', [CoachController::class, 'saveCoach'])->middleware(['auth']);

Route::get('/update-coach/{id}', [CoachController::class, 'updateCoach'])->middleware(['auth']);

Route::post('/edit-coach', [CoachController::class, 'editCoach'])->middleware(['auth']);


// View Liste Plans
Route::name('plans')->group(function () {
    Route::get('/liste-plans', [PlanController::class, 'getAllPlans'])->middleware(['auth']);
});

Route::get('/update-plan-status', [PlanController::class, 'updatePlanStatus'])->middleware(['auth']);

Route::get('/delete-plan', [PlanController::class, 'deletePlan'])->middleware(['auth']);

Route::get('/show-plan/{id}', [PlanController::class, 'showPlan'])->middleware(['auth']);

Route::get('/create-plan', [PlanController::class, 'createPlan'])->middleware(['auth']);

Route::post('/save-plan', [PlanController::class, 'savePlan'])->middleware(['auth']);

Route::get('/update-plan/{id}', [PlanController::class, 'updatePlan'])->middleware(['auth']);

Route::post('/edit-plan', [PlanController::class, 'editPlan'])->middleware(['auth']);

// View Liste Abonnements
Route::name('subscriptions')->group(function () {
    Route::get('/liste-subs', [AbonnementController::class, 'getSubs'])->middleware(['auth']);
});

Route::get('/create-sub/{id}', [AbonnementController::class, 'createSub'])->middleware(['auth']);
Route::post('/save-subscription', [AbonnementController::class, 'saveSub'])->middleware(['auth']);

Route::get('/update-pay-status', [AbonnementController::class, 'updatePayStatus'])->middleware(['auth']);

Route::get('/delete-abon', [AbonnementController::class, 'deleteAbonnement'])->middleware(['auth']);

require __DIR__ . '/auth.php';

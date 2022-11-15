<?php
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DicomController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DicomSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/create', [PatientController::class, 'create']);
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'patient'
], function ($router) {
    Route::post('/create', [PatientController::class, 'create']);
    Route::get('/getpatient', [PatientController::class, 'getpatient']);
    Route::delete('destroy/{id}', [PatientController::class, 'destroy']);
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'dicom'
], function ($router) {
    Route::post('/', [DicomController::class, 'upload']);
    Route::get('/{id}', [DicomController::class, 'get']);
    Route::delete('destroy/{id}', [DicomController::class, 'destroy']);
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'role'
], function ($router) {
    Route::post('/', [RoleController::class, 'create']);
    Route::get('/', [RoleController::class, 'get']);
    Route::get('/{id}', [RoleController::class, 'getbyId']);
    Route::delete('destroy/{id}', [RoleController::class, 'destroy']);
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'doctor'
], function ($router) {
    Route::post('/', [DoctorController::class, 'create']);
    Route::get('/', [DoctorController::class, 'get']);
    Route::get('/{id}', [DoctorController::class, 'getbyId']);
    Route::delete('destroy/{id}', [DoctorController::class, 'destroy']);
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'dicomsession'
], function ($router) {
    Route::post('/', [DicomSessionController::class, 'upload']);
    Route::get('/{id}', [DicomSessionController::class, 'get']);
    Route::delete('destroy/{id}', [DicomSessionController::class, 'destroy']);
});

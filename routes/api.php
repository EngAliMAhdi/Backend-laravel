<?php

use App\Http\Controllers\api\DeliveryController;
use App\Http\Controllers\api\ExpenseController;
use App\Http\Controllers\api\FoodController;
use App\Http\Controllers\api\MaintenanceController;
use App\Http\Controllers\api\PlacementController;
use App\Http\Controllers\api\PositionController;
use App\Http\Controllers\api\QuranController;
use App\Http\Controllers\api\SeasonController;
use App\Http\Controllers\api\SessionTypeController;
use App\Http\Controllers\api\SettingController;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    $token = $user->createToken('auth-token')->plainTextToken;
    return response()->json(['token' => $token, 'user' => $user]);
})->name('login');

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();
    return response()->json(['message' => 'Logged out']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('sessions', SessionTypeController::class);
    Route::get('sessions/{id}/showall', [SessionTypeController::class, 'showall']);

    Route::apiResource('setting', SettingController::class);
    Route::apiResource('delivery', DeliveryController::class);
    Route::apiResource('placement', PlacementController::class);
    Route::apiResource('food', FoodController::class);
    Route::apiResource('position', PositionController::class);
    Route::apiResource('season', SeasonController::class);
    Route::apiResource('maintenance', MaintenanceController::class);
});
Route::get('/quran/{chapter}', [QuranController::class, 'getSurah']);
Route::get('/quran/{chapter}/{verse}', [QuranController::class, 'getVerse']);
Route::get('/quran/{chapter}/{start}/{end}/char-count', [QuranController::class, 'countCharsBetweenVerses']);
Route::apiResource('/expenses', ExpenseController::class);

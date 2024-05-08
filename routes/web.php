<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/cekObject', [MahasiswaController::class,'cekObject']);
Route::get('/insert', [MahasiswaController::class,'insert']);
Route::get('/massAssignment', [MahasiswaController::class,'massAssignment']);
 Route::get('/massAssignment2',[MahasiswaController::class,'massAssignment2']);

Route::get('/update', [MahasiswaController::class,'update']);
Route::get('/updateWhere', [MahasiswaController::class,'updateWhere']);
Route::get('/massUpdate', [MahasiswaController::class,'massUpdate']);
Route::get('/delete', [MahasiswaController::class,'delete']);
Route::get('/destroy', [MahasiswaController::class,'destroy']);
Route::get('/massDelete', [MahasiswaController::class,'massDelete']);
Route::get('/all', [MahasiswaController::class,'all']);
Route::get('/allView', [MahasiswaController::class,'allView']);
Route::get('/getWhere', [MahasiswaController::class,'getWhere']);
Route::get('/testWhere', [MahasiswaController::class,'testWhere']);
Route::get('/first', [MahasiswaController::class,'first']);
Route::get('/find', [MahasiswaController::class,'find']);
Route::get('/latest', [MahasiswaController::class,'latest']);
Route::get('/limit', [MahasiswaController::class,'limit']);
Route::get('/skipTake', [MahasiswaController::class,'skipTake']);
Route::get('/softDelete', [MahasiswaController::class,'softDelete']);
Route::get('/withTrashed', [MahasiswaController::class,'withTrashed']);
Route::get('/restore', [MahasiswaController::class,'restore']);
Route::get('/forceDelete', [MahasiswaController::class,'forceDelete']);

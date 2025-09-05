<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BbsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('boards')->group(function () {
    Route::get('/', [BbsController::class, 'index']);         // 전체 게시글 조회
    Route::post('/', [BbsController::class, 'store']);        // 게시글 생성
    Route::put('/{id}', [BbsController::class, 'update']);    // 게시글 수정
    Route::delete('/{id}', [BbsController::class, 'destroy']);    // 게시글 삭제
});
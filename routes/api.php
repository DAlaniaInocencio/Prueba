<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\UserControllers;
use App\Http\Controllers\PostsControllers;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'create']);

   //Inicialmente
Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('users')->group(function () {
        Route::get('/', [UserControllers::class, 'getall']);
        Route::post('/', [UserControllers::class, 'create']);
        Route::get('/{id}', [UserControllers::class, 'getid']);
        Route::put('/{id}', [UserControllers::class, 'update']);
        Route::delete('/{id}', [UserControllers::class, 'delete']);
 });

    Route::prefix('posts')->group(function () {
        Route::get('/', [PostsControllers::class, 'getAll']);
        Route::post('/', [PostsControllers::class, 'create']);
        Route::get('/{id}', [PostsControllers::class, 'getid']);
        Route::put('/{id}', [PostsControllers::class, 'update']);
        Route::delete('/{id}', [PostsControllers::class, 'delete']);    
    });

});


//SSegundo

// Route::middleware(['auth:sanctum'])->group(function () {
//     // Route::prefix('users')->group(function () {
//     //     Route::get('/', [UserControllers::class, 'getall'])->middleware('role:admin');
//     //     Route::post('/', [UserControllers::class, 'create'])->middleware('role:admin');
//     //     Route::get('/{id}', [UserControllers::class, 'getid'])->middleware('role:admin');
//     //     Route::put('/{id}', [UserControllers::class, 'update'])->middleware('role:admin');
//     //     Route::delete('/{id}', [UserControllers::class, 'delete'])->middleware('role:admin');
//     // });

//     Route::prefix('posts')->group(function () {
//          Route::get('/', [PostsControllers::class, 'getAll'])->middleware('role:user,admin,guest');
//         // Route::post('/', [PostsControllers::class, 'create'])->middleware('role:user,admin');
//         // Route::get('/{id}', [PostsControllers::class, 'getid'])->middleware('role:user,admin,guest');
//         Route::put('/{id}', [PostsControllers::class, 'update'])->middleware('role:user,admin');
//         // Route::delete('/{id}', [PostsControllers::class, 'delete'])->middleware('role:admin');
//     });
// });

// Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
//     Route::resource('posts', PostsControllers::class);
// });

// Route::middleware(['auth:sanctum', 'role:guest'])->group(function () {
//     Route::resource('posts', PostsControllers::class)->except(['create', 'getid','update','delete']);
// });

//oPCION 3
// // Rutas para admin
// Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
//      Route::resource('posts', PostsControllers::class);
//      Route::resource('users', UserControllers::class);
// });


// // Rutas para usuario estándar
// Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
//     Route::get('posts', [PostsControllers::class, 'getall']);
//     Route::post('posts', [PostsControllers::class, 'store']);
//     Route::put('posts/{id}', [PostsControllers::class, 'update']);
//     Route::delete('posts/{id}', [PostsControllers::class, 'destroy']);
// });

// // Rutas para guest (visitantes o usuarios no autenticados)
// Route::middleware(['auth:sanctum', 'role:guest'])->group(function () {
//     Route::get('posts', [PostsControllers::class, 'getall']);
// });

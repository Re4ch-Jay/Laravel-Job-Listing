<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use PhpParser\Node\Expr\List_;

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

// get all listing
Route::get('/', [ListingController::class, "index"]);

// show create page
Route::get('/listings/create', [ListingController::class, "create"]);

// store single listing
Route::post('/listings', [ListingController::class, "store"]);

// get single listing
Route::get('/listings/{id}', [ListingController::class, "show"]);

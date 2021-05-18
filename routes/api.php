<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\FanArt;
use App\Models\Category;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/', function () {
    $fanarts = FanArt::all()->sortByDesc("create_at");
    foreach ($fanarts as $key => $value) {
        $fanarts[$key]->category = Category::findOrFail($fanarts[$key]->id_category);

    }
    return view('public/index',['fanarts'=>$fanarts]);
});

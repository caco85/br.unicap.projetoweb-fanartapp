<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FanArt;
use App\Models\Category;
use Illuminate\Http\Request;

class FanartApiController extends Controller
{

    public function index()
    {
        $fanarts = FanArt::all()->sortByDesc("create_at");

        foreach ($fanarts as $key => $value) {
          $fanarts[$key]->category = Category::findOrFail($fanarts[$key]->id_category);

         }
        return response()->json($fanarts);
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

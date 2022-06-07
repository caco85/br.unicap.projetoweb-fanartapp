<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\User;
use App\Models\FanArt;
use App\Models\Category;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Storage;
use Auth;

class FanArtController extends Controller
{
    public $pageTitle = "FanArt's";
    public $titleButton = "Cadastrar ";
    public $route = "/fanart/new";

    public function index(){
        $users =Auth::user();

        if ($users->type == 'admin'){
            $fanarts = FanArt::all()->sortByDesc("create_at");

        }
        else{
            $use_id = $users->id;
            $fanarts = FanArt::where('id_user', $use_id)->get();
//            $fanarts = User::find( $use_id)->fanart;
        }

        foreach ($fanarts as $key => $value) {
            $fanarts[$key]->user = User::findOrFail($fanarts[$key]->id_user);
            $fanarts[$key]->category = Category::findOrFail($fanarts[$key]->id_category);

        }

        return view('fanart/fanarts',['pageTitle' => $this->pageTitle,'titleButton' => $this->titleButton, 'route' => $this->route],compact('fanarts'));

    }

    public function create(){
        $categories = Category::all();
        return view('fanart/create',['categories' => $categories]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'image|nullable',
            'id_scheduleCategory' => 'numeric',
        ]);
        if ($request->file('image')) {
            $image = $request->file('image');
            $fanartsPath = $image->store('imagens/fanarts','public');
        }else {
            $fanartsPath = '';
        }

        $user = Auth::user();
        $user_id  = $user->id;

        $fanart = new FanArt;
        $fanart->title = $request->title;
        $fanart->description = $request->description;
        $fanart->image = $fanartsPath;
        $fanart->id_user = $user_id;
        $fanart->id_category = $request->id_category;

        $inserted = $fanart->save();
        if ($inserted){
            return redirect('fanart/fanarts');
        }

    }
    public function show($id){
        $fanart = FanArt::findOrFail($id);
        $fanart->user = User::findOrFail($fanart->id_user);
        $fanart->category = Category::findOrFail($fanart->id_category);
        if(isset($fanart) && isset($fanart->id_category) ){
            $evaluations = Evaluation::where('id_fanArt', $id)->get();


            foreach ($evaluations as $key => $value)
            {
                $evaluations[$key]->fanArt = FanArt::find($evaluations[$key]->id_fanArt);

            }
            return view('fanart/show',['fanart' => $fanart,'evaluations'=>$evaluations]);
        }
        return Redirect::to('fanart/fanarts');
    }
    public function edit($id){
        $fanart = FanArt::findOrFail($id);
        $categories = Category::all();

        return view('fanart/edit',['fanart' => $fanart,'categories' => $categories]);

    }
    public function update($id,Request $request){

        $fanart = FanArt::findOrFail($id);
        $data = $request->all();

        if ($request->file('image')) {
            $image = $request->file('image');
            $fanartsPath = $image->store('imagens/fanarts','public');
            $data['image'] = $fanartsPath;
         }

        $fanart->update($data);

        return Redirect::to('fanart/fanarts');
    }



    public function destroy( $id )
    {
        $fanart = FanArt::findOrFail( $id );

        if($fanart->image && Storage::exists('fanartimages', $fanart->image)){

            Storage::delete("fanartimages/{$fanart->image}");
        }

        $fanart->delete();
        return Redirect::to('fanart/fanarts');
    }
}

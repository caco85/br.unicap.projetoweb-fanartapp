<?php

namespace App\Http\Controllers;

use App\Models\LoginRecord;
use App\Models\User;
use App\Models\FanArt;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public $pageTitle = "Usuários";
    public $titleButton = "Cadastrar";
    public $route = "/public/new";

    public function index()
    {
        $fanarts = FanArt::all()->sortByDesc("create_at");
        foreach ($fanarts as $key => $value) {
            $fanarts[$key]->user = User::findOrFail($fanarts[$key]->id_user);
            $fanarts[$key]->category = Category::findOrFail($fanarts[$key]->id_category);

        }
        return view('public/index',['pageTitle' => 'Bem vindo ao Fanart Online','fanarts'=> $fanarts]);

    }

    public function indexOn()
    {
        $user = Auth::user();

        if($user->type == 'admin') {
            $users = User::all()->sortByDesc("id");
            return view('user/users', ['pageTitle' => $this->pageTitle, 'titleButton' => $this->titleButton, 'route' => $this->route], compact('users'));
        }else{
            $use_id = $user->id;
            $users = User::where('id_user', $use_id)->get();

            return view('user/users', ['pageTitle' => $this->pageTitle, 'titleButton' => $this->titleButton], compact('users'));
        }
        return view('public/index');

    }
    public function login()
    {
        return view('public/login');
    }

    public function log_In(Request $request)
    {

        $user = $request->all();

        if(Auth::attempt(['email'=>$user['email'],'password'=>$user['password']])){
            $users = Auth::user();

            if (Auth::check()) {
                $user_id = $users->id;
                $login = new LoginRecord();
                $login->id_user = $user_id;
                $login->save();
            }
            return Redirect::to('public/index');
        }
        return redirect()->route('login', ['invalidCredentials' => true]);

    }
    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }

    public function create()
    {
        return view('public/create');
    }

    public function store(Request $request)
    {
        $users = Auth::user();
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:User',
            'password' => 'required|min:8|confirmed|',
            'type' => 'required',
            'birthday' => 'required',
            'photo' => 'image|nullable'
        ]);
        if ($request->file('photo')) {
        $image = $request->file('photo');
        $photoPath = $image->store('imagens/users','public');
      //  dd($data['photo']);
        }else {
            $photoPath = '';
        }
        $parseUrl = parse_url($request->instagram);
        if(!isset($parseUrl['scheme'])){
            $request->instagram = 'http://'.$request->instagram;
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->photo = $photoPath;
        $user->instagram = $request->instagram;
        $user->birthday= $request->birthday;
        $user->type =$request->type;
        $inserted = $user->save();
        if ($inserted && Auth::check()){
            return Redirect::to('user/users');
        }else{
            return Redirect::to('login');
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

      //  dd($user->photo);
        if($user){
           return view('user/show',['user' =>$user]);
        }
        return Redirect::to('user/users');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        if($user){
            return view('user/edit',['user' =>$user]);
        }
        return Redirect::to('user/users');

    }

    public function update( $id, Request $request ){
        $user = User::findOrFail($id);
        $data = $request->all();
        $validated = $request->validate([
            'password' => 'min:8|confirmed|',

        ]);

        if ($request->file('photo')) {
            Storage::disk('public')->delete($user->photo);
        }

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $photoPath = $image->store('imagens/users','public');
            $data['photo'] =  $photoPath ;
        }




        $parseUrl = parse_url($request->instagram);
        if(!isset($parseUrl['scheme'])){
            $data['instagram'] = 'http://'.$data['instagram'];
        }

        $data['password'] = bcrypt($request->password);


        $user->update( $data);
        $users = Auth::user();
        if($users->type !='admin'){
            return Redirect::to('public/index');
        }
        return Redirect::to('user/users');
    }

    public function destroy( $id )
    {
        $user = User::findOrFail( $id );

       if($user->photo && Storage::exists('imagens/users','public', $user->photo)){
           Storage::delete("imagens/users/{$user->photo}");
       }


        $user->delete();
        $users = Auth::user();




        if($users->type !='admin'){
            return Redirect::to('logout');
        }
        return Redirect::to('user/users');
    }

}

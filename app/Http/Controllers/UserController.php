<?php

namespace App\Http\Controllers;

use App\Models\LoginRecord;
use App\Models\User;
use App\Models\FanArt;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

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
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:User',
            'password' => 'required|min:8|confirmed|',
            'type' => 'required',
            'birthday' => 'required'
        ]);
        if($request->hasFile('photo')){

            $filenameWithExt = $request->file('photo')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('photo')->getClientOriginalExtension();

            $fileNameToStore= $filename.'_'.time().'.'.$extension;

            $path = $request->file('photo')->storeAs('users-images', $fileNameToStore);

            if(!$path)
                return redirect()
                    ->back()
                    ->with('error','erro ao anexar a foto!');
        } else {
            $fileNameToStore = '';
        }

        $parseUrl = parse_url($request->instagram);
        if(!isset($parseUrl['scheme'])){
            $request->instagram = 'http://'.$request->instagram;
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->photo = $fileNameToStore;
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

        if($request->hasFile('photo')){

            if($user->photo && Storage::exists('users-images', $user->photo)){
                Storage::delete("users-images/{$user->photo}");
            }


            $filenameWithExt = $request->file('photo')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('photo')->getClientOriginalExtension();

            $fileNameToStore= $filename.'_'.time().'.'.$extension;

            $path = $request->file('photo')->storeAs('users-images', $fileNameToStore);

            $data['photo'] = $fileNameToStore;
            if(!$path)
                return redirect()
                    ->back()
                    ->with('error','erro ao anexar a foto!');
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

//        if($user->photo && Storage::exists('users-images', $user->photo)){
//            Storage::delete("users-images/{$user->photo}");
//        }

        $user->delete();
        $users = Auth::user();
        if($users->type !='admin'){
            return Redirect::to('logout');
        }
        return Redirect::to('user/users');
    }

}
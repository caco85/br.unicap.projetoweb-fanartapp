<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FanArt;
use App\Models\User;
use App\Models\LoginRecord;
use Illuminate\Http\Request;


class LoginRecordController extends Controller
{
   public  function index(){
       $loginRecords = LoginRecord::all()->sortByDesc("id");
       foreach ($loginRecords as $key => $value) {
           $loginRecords[$key]->user = User::findOrFail($loginRecords[$key]->id_user);

       }
       return view('loginrecord/loginrecords',['pageTitle' => 'Bem vindo ao Fanart Online','loginRecords'=> $loginRecords]);
   }

}

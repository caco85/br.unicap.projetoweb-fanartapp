<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table ='Evaluation';

    protected $fillable =['id','description','star','status','id_user','id_fanArt'];

    public function user()
    {
        return $this->hasOne(User::class,'id_user');
    }


    public function fanArt()
    {
        return $this->hasOne(FanArt::class,'id_fanArt');
    }
}

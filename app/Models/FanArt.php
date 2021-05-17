<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FanArt extends Model
{
    use HasFactory;

    protected $table ='FanArt';

    protected $fillable =[ 'id','title','description','image','mediaRating','id_user','id_category'];

    public function user()
    {
        return $this->hasOne(User::class,'id_user');
    }


    public function category()
    {
        return $this->hasOne(Category::class,'id_category');
    }
}

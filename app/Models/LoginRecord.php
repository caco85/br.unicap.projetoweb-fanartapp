<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginRecord extends Model
{
    use HasFactory;

    protected $table ='LoginRecord';

    protected $fillable =[ 'id','id_user'];

    public function user()
    {
        return $this->hasOne(User::class,'id_user');
    }
}

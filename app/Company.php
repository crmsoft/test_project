<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo(\App\User::class);
    }

    public function employees(){
        return $this->hasMany(\App\Employee::class);
    }
}

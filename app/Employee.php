<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'phone',
        'email',
        'company_id'
    ];

    protected $appends = [
        'full_name'
    ];

    protected $with = [ 'company' ];

    public function getFullNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }

    public function company(){
        return $this->belongsTo(\App\Company::class);
    }
}

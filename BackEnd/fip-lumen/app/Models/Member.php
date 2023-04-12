<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model

{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fname','lname', 'email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}

 
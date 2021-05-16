<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    use HasFactory;
    public function song(){
        return $this->hasMany('App\Models\Song');
    }
    public function user(){
    	return $this->belongsTo('App\Models\User');
    }
}

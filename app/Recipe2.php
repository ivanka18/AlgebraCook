<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe2 extends Model
{
    public function ingredients()
	{
		return $this->hasMany('App\Ingredient');
	}
	
	public function creator()
	{
		return $this->belongsTo('App\User');
	}
}

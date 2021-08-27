<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Page extends Model
{

	function user(){
		return $this->belongsTo('App\User');
    								//foreign_key //local_key
	}

	protected $fillable = ['title', 'content', 'user_id', 'status'];
}

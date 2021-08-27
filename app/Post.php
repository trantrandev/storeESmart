<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    // protected $fillable = ['id', 'title', 'content', 'thumbnail', 'status'];
    
    function cat()
    {    	
    	return $this->belongsTo('App\CatPost');
    }

    /**
     * Post belongs to Users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function user()
    {
    	// belongsTo(RelatedModel, foreignKey = users_id, keyOnRelatedModel = id)
    	return $this->belongsTo('App\User');
    }


    
}

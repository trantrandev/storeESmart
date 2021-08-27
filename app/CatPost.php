<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatPost extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'parent_id', 'status'];


    public function posts()
    {
        return $this->hasMany('App\Post','cat_id','id');
    }


    public function user()
    {
        // belongsTo(RelatedModel, foreignKey = users_id, keyOnRelatedModel = id)
        return $this->belongsTo('App\User');
    }

    // childrent categories
    public function parent()
    {
        return $this->belongsTo('App\CatPost', 'parent_id')->where('parent_id',0);
    }
    public function children()
    {
        return $this->hasMany('App\CatPost', 'parent_id');
    }




}

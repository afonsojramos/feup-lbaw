<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag_post extends Model
{
    protected $fillable = ['reason', 'date', 'archived'];

    public $timestamps = false;

    /**
     * the post the flag is in
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    /**
     * the user who flagged this post
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'flagger_id');
    }
}
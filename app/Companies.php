<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $guarded = [];
    protected $table = 'companies';

    /**
     * Get all the tags for a specific company
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tags');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comments');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades()
    {
        return $this->hasMany('App\Grades');
    }
}


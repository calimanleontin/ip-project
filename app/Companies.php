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
        return $this->belongsToMany('App/Tags');
    }
}

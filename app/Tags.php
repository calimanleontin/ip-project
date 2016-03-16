<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $guarded = [];
    protected $table = 'tags';

    /**
     * Get all the companies for a specific tag
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany('App\Companies');
    }
}

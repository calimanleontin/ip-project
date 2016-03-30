<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    /**
     * @var string
     */
    protected $table = 'profiles';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


}

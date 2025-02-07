<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    public function topic()
    {
        return $this->hasMany(Series::class, 'topic_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Series extends Model
{
    //
    //

    public function instructor(): BelongsTo
    {

        return $this->belongsTo('App\Models\User', 'instructor_id');
    }

    public function topic(): HasOne
    {
        return $this->hasOne(Topic::class, 'topic_id');
    }
}

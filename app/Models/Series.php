<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Series extends Model
{
    //
    //

    public function instructor(): BelongsTo
    {

        return $this->belongsTo('App\Models\User', 'id');
    }

    //    public function category(): BelongsTo
    //    {
    //        return $this->belongsTo('App\Models\Category', 'category_id');
    //    }
}

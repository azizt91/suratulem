<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = ['id'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    //
}

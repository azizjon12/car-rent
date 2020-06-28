<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'email',
        'address',
        'postcode',
        'location',
        'phone',
    ];

    public function location() {
        return $this->belongsTo('App\Location');
    }
}

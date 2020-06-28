<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'type_id',
        'ac',
        'gearbox_id',
        'num_passengers',
        'num_doors',
        'bags_capacity',
        'additional_info',
        'daily_price',
        'satnav',
        'baby_seat',
        'child_seat',
        'is_available',
        'branch_id',
        'photo_id',
        'fuel_id'

    ];
    public function fuel() {
        return $this->belongsTo('App\CarFuel');
    }
    public function gearbox() {
        return $this->belongsTo('App\CarGearbox');
    }
    public function type() {
        return $this->belongsTo('App\CarType');
    }
    public function photo() {
        return $this->belongsTo('App\Photo');
    }
    public function branch() {
        return $this->belongsTo('App\Branch');
    }
}

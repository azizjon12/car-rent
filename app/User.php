<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'photo_id', 'address', 'postcode', 'city', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(){
        if($this->role != NULL) {
            if ($this->role->name == "administrator") {
                return true;
            }
        }
        return false;
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function rentalcars() {
        return $this->hasMany('App\RentalCar');
    }

    //Laravel mutator creates attributes that don't exist in your model
    public function getGravatarAttribute(){
        // Just in case the email does not exist, it will send a picture
        $hash = md5(strtolower(trim($this->attributes['email']))) . "?d=mm&s=";
        return "http://www.gravatar.com/avatar/$hash";
    }

}

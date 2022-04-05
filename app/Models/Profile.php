<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $guarded = [];

    public function profileImage()
    {
        //? Use the excisting path, otherwise use   \
        $imagePath = ($this->image) ? $this->image : 'profile/R77CT4sVryQoy4SOPfglGJHtz0NmMZreR4aQufbm.png';
        return $imagePath;
    }

    public function followers(){
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

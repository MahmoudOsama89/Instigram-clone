<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //use HasFac4tory;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo("App\Models\User");
    }

    public function followers(){
        return $this->belongsToMany("\App\Models\User");
    }

    public function profileImage(){
        return ($this->image) ? $this->image : "profile/3XB6TSe8Icw84zdqORfClE0ltmCl9Nt1TyxOFt5u.png";
    }
}

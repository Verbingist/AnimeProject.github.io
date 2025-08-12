<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Feedback;

class User extends Authenticatable
{
    public function feedback() {
        return $this->hasMany(Feedback::class);
    }
}
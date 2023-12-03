<?php

namespace App\Models;

use App\Models\User;
use App\Models\JobBank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
    public function jobBanks()
    {
        return $this->hasMany(JobBank::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

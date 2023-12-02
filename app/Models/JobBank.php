<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobBank extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'post',
        'closing_date',
        'location',
        'mobile_number',
    ];
}

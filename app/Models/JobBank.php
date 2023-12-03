<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

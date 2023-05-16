<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'program_title', 
        'type', 
        'activities',
        'featured_image', 
        'brief_intro'
    ];

}

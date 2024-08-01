<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaizeData extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'height', 'thickness', 'color', 'defective', 'deficiency', 'suggestion'
    ];
}

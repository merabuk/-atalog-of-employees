<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    public static function getPositionIdByName($name)
    {
        return self::where('name', $name)->first()->id;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_role_id',
        'post_id',
    ];
}

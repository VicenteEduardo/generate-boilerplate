<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasswordResets extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'password_resets';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
}

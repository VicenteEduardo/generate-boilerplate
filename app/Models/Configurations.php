<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configurations extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'configurations';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
}

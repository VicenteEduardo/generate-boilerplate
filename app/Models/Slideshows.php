<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slideshows extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'slideshows';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
}

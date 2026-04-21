<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreValue extends Model
{
    protected $table = 'corevalues';
    protected $fillable = [
        'title',
        'description',
        'icon'
    ];
}

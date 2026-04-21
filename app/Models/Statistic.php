<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = 'statics';

    protected $fillable = [
        'label',
        'value'
    ];
}

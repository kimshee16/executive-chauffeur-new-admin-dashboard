<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'driver_id';

    protected $fillable = [
        'driver_id',
        'name',
        'email',
        'phone',
        'photo',
        'date_added'
    ];
}

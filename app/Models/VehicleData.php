<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleData extends Model
{
    use HasFactory;

    protected $table = 'vehicle_data';

    protected $primaryKey = 'vreg_number';
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'vreg_number',
        'make',
        'model',
        'yearofmanufacture',
        'motexpiry',
        'roadtaxexpiry',
        'owner',
        'description',
        'passengers',
        'luggage',
        'ulezcompliant',
        'photo',
    ];
}

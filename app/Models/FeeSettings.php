<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeSettings extends Model
{
    use HasFactory;

    protected $table = 'feesettings';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'description',
        'cost',
        'generalurl',
        'accounturl',
        'datecreated',
        'isdeleted'
    ];
}
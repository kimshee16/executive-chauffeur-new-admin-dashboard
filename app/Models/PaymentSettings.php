<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSettings extends Model
{
    use HasFactory;

    protected $table = 'paymentsettings';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'paymenttype',
        'datecreated'
    ];

}
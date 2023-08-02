<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $table = 'quotes';

    public $timestamps = false;

    protected $fillable = [
        'date_added',
        'vehicle',
        'passengers',
        'journey_date',
        'return_date',
        'journey_hour',
        'journey_minutes',
        'journey_AMPM',
        'address',
        'going_to',
        'going1',
        'going2',
        'going3',
        'going4',
        'going5',
        'airport',
        'flight_no',
        'return_journey',
        'return_journey_hour', 
        'return_journey_minutes',
        'return_journey_AMPM',
        'special_requests',
        'book_source',
        'book_ref', 
        'book_payment_type',
        'book_subtotal',
        'book_waiting_time',
        'book_car_parking',
        'book_congestion', 
        'book_total',
        'payment_proccessed',
        'driver_name',
        'vehicle_info',
        'type',
        'status',
        'book_status',
        'book_acc',
        'book_service_charge',
        'driver_id',
        'arriving_from',
        'ulez'
    ];
}

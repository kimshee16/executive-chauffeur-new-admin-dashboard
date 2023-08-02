<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminders extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'from1',
        'subj',
        'body'
    ];
}
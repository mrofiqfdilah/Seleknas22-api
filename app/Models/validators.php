<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class validators extends Model
{
    use HasFactory;
    protected $table = 'validators';
    protected $guarded = ['id'];

    public $timetamps = false;
}

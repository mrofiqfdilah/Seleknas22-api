<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_apply_position extends Model
{
    use HasFactory;
    protected $table = 'job_apply_positions';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function available_position()
    {
        return $this->belongsTo(Available_position::class, 'position_id');
    }

}

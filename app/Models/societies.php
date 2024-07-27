<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class societies extends Model
{
    use HasFactory;
    protected $table = 'societies';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id');
    }

}

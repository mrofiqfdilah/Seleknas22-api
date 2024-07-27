<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class validations extends Model
{
    use HasFactory;
    protected $table = 'validations';
    protected $guarded = ['id'];

    public $timestamps = false; // Pastikan ini benar

    public function job_category()
    {
        return $this->belongsTo(Job_category::class, 'job_category_id');
    }

    public function societies()
    {
        return $this->belongsTo(Societies::class, 'society_id');
    }

    public function validators()
    {
        return $this->belongsTo(Validators::class, 'validator_id');
    }
}

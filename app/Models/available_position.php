<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class available_position extends Model
{
    use HasFactory;
     protected $table = 'available_positions';
     protected $guarded = ['id'];
     public $timestamps = false;

     public function job_vacancies()
     {
        return $this->belongsTo(Job_vacancies::class, 'job_vacancy_id');
     }

     public function job_apply_position()
     {
       return $this->belongsTo(Job_apply_position::class);
     }

     
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_apply_societies extends Model
{
    use HasFactory;
    protected $table = 'job_apply_societies';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function job_vacancies()
    {
        return $this->belongsTo(Job_vacancies::class, 'job_vacancy_id');
    }
}

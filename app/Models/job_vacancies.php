<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_vacancies extends Model
{
    use HasFactory;
    protected $table = 'job_vacancies';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function job_categories()
    {
        return $this->belongsTo(Job_category::class, 'job_category_id');
    }


}

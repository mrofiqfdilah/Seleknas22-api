<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Available_position;
use App\Models\Job_vacancies;
use App\Models\Societies;
use App\Models\Job_category;

class JobController extends Controller
{
    public function see_job(Request $request)
    {
        $value = Job_vacancies::all();

        $trappedata = $value->map(function ($value){
        $position = Available_position::where('job_vacancy_id', $value->id)->get(['position','capacity','apply_capacity']);
        return [
            'id' => $value->id,
            'category' => $value->job_categories->toArray(),
            'company' => $value->company,
            'address' => $value->address,
            'description' => $value->description,
            'available_position' =>  $position
        ];
        });

        return response()->json([
        'vacancies' => $trappedata
        ], 200);
    }

    public function detail_job(Request $request, $id)
    {
        $value = Job_vacancies::where('id', $id)->first();

        if(!$value)
        {
            return response()->json([
            'message' => 'Job not found'
            ], 404);
        }

        $position = Available_position::where('job_vacancy_id', $value->id)->get(['position','capacity','apply_capacity']);

        $trappedata = [
            'id' => $value->id,
            'category' => $value->job_categories->toArray(),
            'company' => $value->company,
            'address' => $value->address,
            'description' => $value->description,
            'available_position' =>  $position
        ];
    
            return response()->json([
            'vacancies' => $trappedata
            ], 200);

    }
}

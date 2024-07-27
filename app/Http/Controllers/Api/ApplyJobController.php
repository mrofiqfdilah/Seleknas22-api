<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\job_apply_position;
use Illuminate\Http\Request;
use App\Models\Available_position;
use App\Models\Job_apply_societies;
use App\Models\Job_category;
use App\Models\Job_vacancies;
use App\Models\societies;
use App\Models\Validators;
use App\Models\Validations;
use Illuminate\Support\Facades\Validator;


class ApplyJobController extends Controller
{
    public function apply_job(Request $request)
    {
        $validator = Validator::make($request->all(),[
        'vacancy_id' => 'required',
        'positions' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
            'message' => 'Invalid field',
            'errors' => $validator->errors()
            ]);
        }

        $checkstatus = Validations::where('society_id', $request->societies->id)->first();

        if($checkstatus->status != 'accepted'){
            return response()->json([
            'message' => 'Your data validator must be accepted by validator before'
            ]);
        }

        $checktwoapply = Job_apply_societies::where('society_id', $request->societies->id)
        ->first();

        if ($checktwoapply) {
        return response()->json([
        'message' => 'Application for this job can only be submitted once.'
        ], 400); 
    }
    
        $job = Job_apply_societies::create([
        'notes' => $request->notes,
        'date' => now(),
        'society_id' => $request->societies->id,
        'job_vacancy_id' => $request->vacancy_id
        ]);

    $positions = explode(',', $request->positions);

    foreach ($positions as $posid) {
        Job_apply_position::create([
            'date' => now(),
            'society_id' => $request->societies->id,
            'job_vacancy_id' => $request->vacancy_id,
            'position_id' => $posid,
            'job_apply_societies_id' => $job->id,
        ]);
    }


        return response()->json([
        'message' => 'Applying for job successful'
        ], 200);
    }

    public function see_job(Request $request)
{
    $vacancies = Job_vacancies::all();

    $trapped = $vacancies->map(function ($vacancy) {
        $positions = Available_position::where('job_vacancy_id', $vacancy->id)
            ->get()
            ->map(function ($position) use ($vacancy) {
                $jobApplyPosition = Job_apply_position::where('job_vacancy_id', $vacancy->id)
                    ->where('position_id', $position->id)
                    ->first();
                
                $jobApplySociety = Job_apply_societies::where('job_vacancy_id', $vacancy->id)
                    ->where('society_id', request()->societies->id)
                    ->first();

                return [
                    'position' => $position->position,
                    'apply_status' => $jobApplyPosition ? $jobApplyPosition->status : null,
                    'notes' => $jobApplySociety ? $jobApplySociety->notes : null,
                ];
            });

        return [
            'id' => $vacancy->id,
            'category' => $vacancy->job_categories->toArray(),
            'company' => $vacancy->company,
            'address' => $vacancy->address,
            'positions' => $positions 
        ];
    });

  
    return response()->json([
        'vacancies' => $trapped
    ], 200);
}

    
}

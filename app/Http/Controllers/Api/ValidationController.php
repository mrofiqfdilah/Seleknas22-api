<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job_category;
use App\Models\Validations;
use App\Models\Validators;
use Illuminate\Support\Facades\Validator;


class ValidationController extends Controller
{
    public function request_validation(Request $request)
    {
        Validations::create([
        'work_experience' => $request->work_experience,
        'job_category_id' => $request->job_category_id,
        'job_position' => $request->job_position,
        'reason_accepted' => $request->reason_accepted,
        'society_id' => $request->societies->id
        ]);

        return response()->json( ['message' => "Request data validation sent successful"]);
    }

    public function data_validation(Request $request)
    {
        $value = Validations::where('society_id', $request->societies->id)->first();
    
        if (!$value) {
            return response()->json([
                'message' => 'Validation not found'
            ], 404);
        }
    
        return response()->json([
            'validation' => [
                'id' => $value->id,
                'status' => $value->status,
                'work_experience' => $value->work_experience,
                'job_category_id' => $value->job_category_id,
                'job_position' => $value->job_position,
                'reason_accepted' => $value->reason_accepted,
                'validator_notes' => $value->validator_notes,
                'validator' => $value->validators ? $value->validators->toArray() : null, // Menampilkan data validator jika ada
            ]
        ], 200);
    }
    
}

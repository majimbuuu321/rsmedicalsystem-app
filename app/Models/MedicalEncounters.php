<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalEncounters extends Model
{
    //
    protected $table = 'medical_encounter';

    protected $fillable = [
        'patients_id',
        'date_medical_encounter',
        'weight',
        'chief_complaint',
        'physical_examination',
        'temperature',
        'blood_pressure',
        'heart_rate',
        'respiratory_rate',
        'assessment_diagnosis',
        'remarks',
        'treatment_medication',
        'progress_notes',
        'lab_results',
        'height',
        
    ];
}

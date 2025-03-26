<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    //

    protected $table = 'medical_history';

    protected $fillable = [
        'patients_id',
        'general_history',
        'family_history',
        'birth_term',
        'birth_weight',
        'birth_length',
        'allergies',
        'past_medications',
        'personal_social_history',
        'bmi',
        'temperature',
        'blood_pressure',
        'heart_rate',
        'respiratory_rate',
        'chief_complaint',
        'height',
        'weight',
        'physical_examination',
        'assessment',
        'treatment',
        'lab_results',
        'remarks',
        'progress_notes'
    ];
}

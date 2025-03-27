<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MedicalEncounters;
use App\Models\Vaccines;
use App\Models\MedicalHistory;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Patients extends Model
{
    //
    protected $table = 'patients';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'gender_id',
        'birthday',
        'contact_no',
        'height',
        'weight',
        'fathers_first_name',
        'fathers_middle_name',
        'fathers_last_name',
        'fathers_occupation',
        'fathers_contact_no',
        'mothers_first_name',
        'mothers_middle_name',
        'mothers_last_name',
        'mothers_occupation',
        'mothers_contact_no',

    ];

    public function medicalEncounter(): HasMany
    {
        return $this->hasMany(MedicalEncounters::class);
    }

    public function vaccine(): HasMany
    {
        return $this->hasMany(Vaccines::class);
    }

    public function medicalHistory(): HasMany
    {
        return $this->hasMany(MedicalHistory::class);
    }
}

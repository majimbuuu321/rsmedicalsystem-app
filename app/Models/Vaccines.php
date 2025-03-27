<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccines extends Model
{
    //

    protected $table = 'vaccine';

    protected $fillable = [
        'patients_id',
        'vaccine_name',
        'vaccine_type',
        'vaccine_reaction',
        'date_administered',
    ];

}

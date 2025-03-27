<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Patients;
use App\Models\Vaccines;
use App\Models\MedicalEncounters;
use Illuminate\Support\Facades\DB;
class PatientStatsOverview extends BaseWidget
{

    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Patients', Patients::count())
            ->description('Total Number of Patients')
            ->color('success'),

            Stat::make('Vaccines', Vaccines::distinct('patients_id')->count('patients_id'))
            ->description('Total Number of Vaccined Patients')
            ->color('info'),

            Stat::make('Medical Encounters', MedicalEncounters::distinct('patients_id')->count('patients_id'))
            ->description('Total Number of Checked-up Patients')
            ->color('warning'),
        ];
    }
}

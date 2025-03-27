<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\MedicalEncounters;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class MedicalEncountersChart extends ChartWidget
{
    protected static ?string $heading = 'Check-ups per Month for this Year ';
    protected static ?int $sort = 4;
    protected function getData(): array
    {

        $medicalEncounter = MedicalEncounters::select(
            DB::raw("count(*) as total_patients"),
            DB::raw("DATE_FORMAT(date_medical_encounter, '%M') as month"),
            DB::raw("MONTH(date_medical_encounter) as numMonth")
        )
        ->whereYear('date_medical_encounter', Carbon::now()->year)
        ->groupBy('month', 'numMonth')
        ->orderBy('numMonth')
        ->get();
        $labels = $medicalEncounter->pluck('month')->toArray();
        $data = $medicalEncounter->pluck('total_patients')->toArray();
        return [
            //
            'datasets' => [
                [
                    'label' => 'Number of Check-ups',
                    'data' => $data,
                    'backgroundColor' => 'rgba(26, 172, 46, 0.5)', // Red
                    'borderColor' => 'rgb(36, 185, 86)',
                    'borderWidth' => 1,
                    'yAxisID' => 'y', 
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

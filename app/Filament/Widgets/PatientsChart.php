<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Patients;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class PatientsChart extends ChartWidget
{
    protected static ?string $heading = 'Patients per Month for this Year';
    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 2;
    protected function getData(): array
    {
        $patients = Patients::select(
            DB::raw("count(*) as total_patients"),
            DB::raw("DATE_FORMAT(created_at, '%M') as month")
        )
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $labels = $patients->pluck('month')->toArray();
        $data = $patients->pluck('total_patients')->toArray();
        return [
            //
            
            'datasets' => [
                [
                    'label' => 'Number of Patients',
                    'data' => $data,
                    'backgroundColor' => 'rgba(23, 46, 177, 0.5)', // Red
                    'borderColor' => 'rgb(63, 54, 196)',
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

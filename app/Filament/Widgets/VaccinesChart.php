<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Vaccines;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class VaccinesChart extends ChartWidget
{
    protected static ?string $heading = 'Vaccines per Month for this Year';
    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 3;
    protected function getData(): array
    {
        $vaccines = Vaccines::select(
            DB::raw("count(*) as total_patients"),
            DB::raw("DATE_FORMAT(date_administered, '%M') as month"),
            DB::raw("MONTH(date_administered) as numMonth")
        )
        ->whereYear('date_administered', Carbon::now()->year)
        ->groupBy('month', 'numMonth')
        ->orderBy('numMonth')
        ->get();

        $labels = $vaccines->pluck('month')->toArray();
        $data = $vaccines->pluck('total_patients')->toArray();

        return [
            //
            'datasets' => [
                [
                    'label' => 'Number of Vaccines',
                    'data' => $data,
                    'backgroundColor' => 'rgba(196, 32, 32, 0.5)', // Red
                    'borderColor' => 'rgb(219, 31, 31)',
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

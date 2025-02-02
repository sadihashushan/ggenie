<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;
use Carbon\Carbon;

class UsersJoinedChart extends ChartWidget
{
    protected static ?string $heading = 'Users Joined Per Month';

    protected static ?int $sort = 2; // After Stats

    protected array|string|int $columnSpan = 2;
    
    protected function getData(): array
    {
        $usersPerMonth = User::selectRaw('COUNT(id) as count, MONTH(created_at) as month')
            ->whereYear('created_at', Carbon::now()->year) 
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $months = [];
        $counts = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('F'); 
            $counts[] = $usersPerMonth[$i] ?? 0; 
        }

        return [
            'datasets' => [
                [
                    'label' => 'Users Joined',
                    'data' => $counts,
                    'borderColor' => 'rgba(75, 192, 192, 1)', 
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'last_6_months' => 'Last 6 Months',
            'this_year' => 'This Year',
        ];
    }

    protected function applyFilters(array $data): array
    {
        $filter = $this->filter;
        
        if ($filter === 'last_6_months') {
            $months = array_slice($data['labels'], -6);
            $counts = array_slice($data['datasets'][0]['data'], -6);
            
            return [
                'datasets' => [['label' => 'Users Joined', 'data' => $counts]],
                'labels' => $months,
            ];
        }

        return $data; 
    }

    protected function getType(): string
    {
        return 'line';
    }
}

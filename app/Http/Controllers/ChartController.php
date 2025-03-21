<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function chartData(Request $request)
    {
        $requestedAffiliate = $request->affiliate;
        $requestedDate = $request->date_range;

        $trackingStats = Tracking::query();
        if ($requestedAffiliate>0) {
            $trackingStats->where('user_id', $requestedAffiliate);
        }
        
        if ($requestedDate) {
            [$startDate, $endDate] = explode(' - ', $requestedDate);
            $startDate = \Carbon\Carbon::parse(trim($startDate))->startOfDay();
            $endDate = \Carbon\Carbon::parse(trim($endDate))->endOfDay();
            $trackingStats->whereBetween('click_time', [$startDate, $endDate]);
        }

        // Define labels and default data for both conversions and clicks
        $labelKey = [
            'Jan' => 0, 'Feb' => 1, 'Mar' => 2, 'Apr' => 3, 'May' => 4, 'Jun' => 5,
            'Jul' => 6, 'Aug' => 7, 'Sep' => 8, 'Oct' => 9, 'Nov' => 10, 'Dec' => 11
        ];
        $labels = array_keys($labelKey);
        
        // Initialize both datasets with zero values
        $conversionData = array_fill(0, 12, 0);
        $clickData = array_fill(0, 12, 0);

        $trackingStats = $trackingStats->get();
        if ($trackingStats->isNotEmpty()) {
            foreach ($trackingStats as $tracking) {
                $monthName = Carbon::parse($tracking->click_time)->format('M');
                $monthKey = $labelKey[$monthName];

                // Count conversions
                if (!is_null($tracking->conversion_id)) {
                    $conversionData[$monthKey] += 1;
                }

                // Count clicks
                $clickData[$monthKey] += 1; 
            }
        }

        // Response data with both datasets
        $responseData = [
            'labels' => $labels,
            'conversionData' => $conversionData, // Line 1: Conversions
            'clickData' => $clickData, // Line 2: Clicks
        ];

        return response()->json($responseData);
    }

    public function chartDataProfit(Request $request)
    {
        $requestedAffiliate = $request->affiliate;
        $requestedDate = $request->date_range;

        $trackingStats = Tracking::query();
        if ($requestedAffiliate>0) {
            $trackingStats->where('user_id', $requestedAffiliate);
        }
        
        if ($requestedDate) {
            [$startDate, $endDate] = explode(' - ', $requestedDate);
            $startDate = \Carbon\Carbon::parse(trim($startDate))->startOfDay();
            $endDate = \Carbon\Carbon::parse(trim($endDate))->endOfDay();
            $trackingStats->whereBetween('click_time', [$startDate, $endDate]);
        }

        // Define labels and default data
        $labelKey = [
            'Jan' => 0, 'Feb' => 1, 'Mar' => 2, 'Apr' => 3, 'May' => 4, 'Jun' => 5,
            'Jul' => 6, 'Aug' => 7, 'Sep' => 8, 'Oct' => 9, 'Nov' => 10, 'Dec' => 11
        ];
        $labels = array_keys($labelKey);
        
        // Initialize both datasets with zero values
        $totalProfit = array_fill(0, 12, 0);
        $trackingStats = $trackingStats->get();
        if ($trackingStats->isNotEmpty()) {
            foreach ($trackingStats as $tracking) {
                $monthName = Carbon::parse($tracking->click_time)->format('M');
                $monthKey = $labelKey[$monthName];
                $totalProfit[$monthKey] += $tracking->revenue-$tracking->payout; 
            }
        }

        // Response data with both datasets
        $responseData = [
            'labels' => $labels,
            'totalProfit' => $totalProfit
        ];

        return response()->json($responseData);
    }
}

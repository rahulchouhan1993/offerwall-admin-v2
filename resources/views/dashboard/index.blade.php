@extends('layouts.default')
@section('content') 
<div class="px-[15px] py-[15px]  md:px-[20px] md:py-[20px] xl:px-[30px] xl:py-[30px]">
    <form method="get">
        <div x-data="select" class="flex flex-wrap md-flex-nowrap items-start gap-[15px] justify-end mb-[25px]" @click.outside="open = false">
            <div class="relative w-[100%] sm:w-[200px]">
                <input name="range" class="date-range-profit w-[100%] lg:w-[100%] bg-[#F6F6F6] px-[15px] py-[12px] text-[13px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none" type="text" value="{{ request('range') }}">
            </div>
            <div class="relative w-[100%] sm:w-[220px]">
                <select name="affiliate_id" class=" select-affiliate-dash  affiliate-profit z-2 absolute mt-1 w-[100%] rounded bg-[#F6F6F6] border-[1px] border-[#E6E6E6] rounded-[5px] text-[13px] font-[600] text-[#4D4D4D]" x-show="open">
                    <option value="">Select Affiliate</option>
                    @foreach ($affiliateOptions as $affiliateData)
                        <option value="{{ $affiliateData->id }}" @if(request('affiliate_id')==$affiliateData->id) selected  @endif>{{ $affiliateData->name.' '.$affiliateData->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative">
                <button type="submit" class="w-[100px] md:w-[110px] lg:w-[140px] bg-[#49FB53] px-[20px] py-[10px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#000] text-center">Filter</button>
            </div>
        </div>
    </form>
    <div class=" flex flex-wrap md:flex-nowrap items-center gap-[15px] mb-[30px]">
        <div
            class="drakblbg flex flex-col justify-center bg-[#88E528] items-start gap-[5px]  w-[100%] sm:w-[200px] md:w-[265px] lg:w-[365px]  rounded-[7px] lg:rounded-[10px]  px-[15px] py-[15px] md:px-[20px] md:py-[20px] xl:px-[15px] xl:py-[15px] activeApps">
            <h2 class="text-[18px] font-[500] text-[#fff]">Affiliates</h2>
            <h3 class="text-[25px] lg:text-[25px] xl:text-[24px] font-[700] text-[#fff]">{{ $allAffiliatesCount }}</h3>
        </div>
        <div
            class="orangebg flex flex-col justify-center bg-[#EF7947] items-start gap-[5px]  w-[100%] sm:w-[200px] md:w-[265px] lg:w-[365px]  rounded-[7px] lg:rounded-[10px]   px-[15px] py-[15px] md:px-[20px] md:py-[20px] xl:px-[15px] xl:py-[15px] activeApps">
            <h2 class="text-[18px] font-[500] text-[#01000B]">Active Apps</h2>
            <h3 class="text-[25px] lg:text-[25px] xl:text-[24px] font-[700] text-[#01000B]">{{ $activeApps }}</h3>
        </div>
        
        
        <div
            class="bluebg flex flex-col justify-center bg-[#7850C0] items-start gap-[5px]  w-[100%] sm:w-[200px] md:w-[265px] lg:w-[365px]  rounded-[7px] lg:rounded-[10px]  px-[15px] py-[15px] md:px-[20px] md:py-[20px] xl:px-[15px] xl:py-[15px] activeApps">
            <h2 class="text-[18px] font-[500] text-[#fff]">Revenue</h2>
            <h3 class="text-[24px] font-[700] text-[#fff]">$ {{ number_format($totalRevenue,2) }}</h3>
        </div>
        
        <div class="graybg flex flex-col justify-center bg-[#C855C8] items-start gap-[5px] w-[100%] sm:w-[200px] md:w-[265px] lg:w-[365px]  rounded-[7px] lg:rounded-[10px]  px-[15px] py-[15px] md:px-[20px] md:py-[20px] xl:px-[15px] xl:py-[15px] activeApps">
            <h2 class="text-[18px] font-[500] text-[#080C0F]">Payouts</h2>
            <h3 class="text-[25px] lg:text-[25px] xl:text-[24px] lg:text-[25px] xl:text-[24px] font-[700] text-[#080C0F]">$ {{ number_format($totalPayouts,2) }}</h3>
        </div>
        <div
            class="pinkbg flex flex-col justify-center bg-[#4EF953] items-start gap-[5px] w-[100%] sm:w-[200px] md:w-[265px] lg:w-[365px]  rounded-[7px] lg:rounded-[10px]  px-[15px] py-[15px] md:px-[20px] md:py-[20px] xl:px-[15px] xl:py-[15px] activeApps">
            <h2 class="text-[18px] font-[500] text-[#000]">Profit</h2>
            <h3 class="text-[25px] lg:text-[25px] xl:text-[24px] font-[700] text-[#000]">$ {{ number_format($totalRevenue-$totalPayouts,2) }}</h3>
        </div>
        
    </div>
    <div class="bg-[#fff] px-[15px] py-[15px] xl:px-[30px] xl:py-[30px] rounded-[8px] lg:rounded-[10px]">
        <div class="flex justify-between gap-[10px] items-center flex-wrap md-flex-nowrap mb-[25px]">
            <h2 class="text-[20px] text-[#1A1A1A] font-[600]">Profit Overview</h2>
        </div>
        <div class="w-full">
            <canvas class="w-full" id="roundedLineChartProfit"></canvas>
        </div>
       
    </div>
    <div class="mt-[20px]">
        <div class="bg-[#fff] px-[15px] py-[15px] xl:px-[30px] xl:py-[30px] rounded-[8px] lg:rounded-[10px]">
            <div class="flex justify-between gap-[10px] items-center flex-wrap md-flex-nowrap mb-[25px]">
                <h2 class="text-[20px] text-[#1A1A1A] font-[600]">Conversion Matrix</h2>
                
            </div>
            <div class="w-full">
                <canvas class="w-full" id="roundedLineChart"></canvas>
            </div>
        </div>
    </div>

    <div class="mt-[20px]">
        <div class="flex items-start flex-wrap gap-[10px] xl:flex-nowrap gap-[15px] justify-between">

            <div class="flex flex-col items-start w-[100%] xl:w-[32%] gap-[10px] bg-[#fff] p-[15px] rounded-[10px] min-h-[340px]">
                <h2 class="mb-[5px] text-[17px] text-[#1A1A1A] font-[600] ">
                    Affiliate Leaderboard By Revenue
                </h2>
                <div class="w-[100%] overflow-x-scroll tableScroll">
                    <table
                        class="w-[100%] border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                        <tr>
                            <th
                                class="bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] rounded-tl-[10px] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap ">
                                Affiliate Name</th>
                            <th
                                class="bg-[#7FB5CB]  rounded-tr-[10px] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Amount</th>

                        </tr>
                        @if($affiliateByRevenue->isNotEmpty())
                        @foreach ($affiliateByRevenue as $detailedStats)
                        <tr>
                            <th
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal border-b-[1px] border-b-[#E6E6E6]">
                                {{ $detailedStats->name.' '.$detailedStats->last_name }}</th>
                            <th
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal  border-b-[1px] border-b-[#E6E6E6]">
                               $ {{ number_format($detailedStats->trackings_sum_revenue,2) }}</th>
                            </th>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>


            <div class="flex flex-col items-start  w-[100%] xl:w-[32%]  gap-[10px] bg-[#fff] p-[15px] rounded-[10px] min-h-[340px]">
                <h2 class="mb-[5px] text-[17px] text-[#1A1A1A] font-[600] ">
                    Affiliate Leaderboard Payout
                </h2>
                <div class="w-[100%] overflow-x-scroll tableScroll">
                    <table
                        class="w-[100%] border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                        <tr>
                            <th
                                class="bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] rounded-tl-[10px] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Affiliate Name</th>
                            <th
                                class="bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] rounded-tr-[10px] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Amount</th>

                        </tr>
                        @if($affiliateByRevenue->isNotEmpty())
                        @foreach ($affiliateByRevenue as $detailedStats)
                        <tr>
                            <td
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal border-b-[1px] border-b-[#E6E6E6] ">
                                {{ $detailedStats->name.' '.$detailedStats->last_name }}</td>
                            <td
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal  border-b-[1px] border-b-[#E6E6E6]">
                               $ {{ number_format($detailedStats->trackings_sum_payout,2) }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>

            <div class="flex flex-col items-start  w-[100%] xl:w-[32%]  gap-[10px] bg-[#fff] p-[15px] rounded-[10px] min-h-[340px]">
                <h2 class="mb-[5px] text-[17px] text-[#1A1A1A] font-[600] ">
                    Affiliate Leaderboard By Profit
                </h2>
                <div class="w-[100%] overflow-x-scroll tableScroll">
                    <table
                        class="w-[100%] border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                        <tr>
                            <th
                                class="bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] rounded-tl-[10px] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap ">
                                Affiliate Name</th>
                            <th
                                class="bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] rounded-tr-[10px] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Revenue</th>

                        </tr>
                        @if($affiliateByRevenue->isNotEmpty())
                        @foreach ($affiliateByRevenue as $detailedStats)
                        <tr>
                            <td
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal border-b-[1px] border-b-[#E6E6E6] ">
                                {{ $detailedStats->name.' '.$detailedStats->last_name }}</td>
                            <td
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal  border-b-[1px] border-b-[#E6E6E6]">
                                $ {{ number_format($detailedStats->trackings_sum_profit,2) }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
$(function () {
    var startDate = "{{ $requestedParams['strd'] }}"
    var endDate = "{{ $requestedParams['endd'] }}"
    $('.date-range-profit').daterangepicker({
        ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        autoUpdateInput: true, 
        startDate: startDate, 
        endDate: endDate,
        opens: 'right'
    }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('roundedLineChart').getContext('2d');
    const ctx2 = document.getElementById('roundedLineChartProfit').getContext('2d');
    let myChart; // Store chart instance globally
    let myChart2;
    function fetchChartData() {
        const dateRange = $('.date-range-profit').val();
        const affiliate = $('.affiliate-profit').val();

        fetch(`{{ route('chart.data') }}?date_range=${encodeURIComponent(dateRange)}&affiliate=${encodeURIComponent(affiliate)}`)
            .then(response => response.json())
            .then(data => {
                // ✅ Destroy previous chart if it exists
                if (myChart) {
                    myChart.destroy();
                }

                // ✅ Create new chart
                myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.labels, // Months
                        datasets: [
                            {
                                label: 'Conversions',
                                data: data.conversionData, // Conversion Data
                                borderColor: '#3BDC40', // Deep Purple Border
                                backgroundColor: '#75FF76', // Soft Purple Fill
                                borderWidth: 2,
                                tension: 0.4, // Smooth line effect
                                fill: true,
                                pointRadius: 5,
                                pointBackgroundColor: '#75FF76'
                            },
                            {
                                label: 'Clicks',
                                data: data.clickData, // Clicks Data
                                borderColor: '#8CCEE2', // Red Border
                                backgroundColor: '#7BB7C9',
                                borderWidth: 2,
                                tension: 0.4,
                                fill: true,
                                pointRadius: 5,
                                pointBackgroundColor: '#7BB7C9'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                enabled: true
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Months'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Count'
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching chart data:', error));
    }

    function fetchChartDataProfit() {
        const dateRange = $('.date-range-profit').val();
        const affiliate = $('.affiliate-profit').val();

        fetch(`{{ route('chart.profit') }}?date_range=${encodeURIComponent(dateRange)}&affiliate=${encodeURIComponent(affiliate)}`)
            .then(response => response.json())
            .then(data => {
                // ✅ Destroy previous chart if it exists
                if (myChart2) {
                    myChart2.destroy();
                }

                // ✅ Create new chart
                myChart2 = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: data.labels, // Months
                        datasets: [
                            {
                                label: 'Profit',
                                data: data.totalProfit, // Conversion Data


                                borderColor: '#3BDC40', // Deep Purple Border
                                backgroundColor: '#75FF76', // Soft Purple Fill

                                borderWidth: 2,
                                tension: 0.4, // Smooth line effect
                                fill: true,
                                pointRadius: 5,
                                pointBackgroundColor: '#75FF76'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                enabled: true
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Months'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Profit'
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching chart data:', error));
    }

    // Fetch chart data initially
    fetchChartData();
    fetchChartDataProfit();

    // ✅ Re-fetch chart data when filters (date range or affiliate) change
    $('.date-range-profit, .affiliate-profit').on('change', function () {
        //fetchChartDataProfit();
    });
    $('.date-range-matrix, .affiliate-matrix').on('change', function () {
        //fetchChartData();
    });
});

</script>
@stop
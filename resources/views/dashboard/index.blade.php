@extends('layouts.default')
@section('content') 
<div class="px-[15px] py-[15px]  md:px-[20px] md:py-[20px] lg:px-[30px] lg:py-[30px]">
    <div class=" flex flex-wrap md:flex-nowrap items-center gap-[15px] mb-[30px]">
        <div
            class="pinkbg flex flex-col justify-center bg-[#C855C8] items-start gap-[5px] w-[100%] sm:w-[200px] md:w-[265px] lg:w-[365px] h-[130px]  rounded-[7px] lg:rounded-[10px] px-[15px] py-[15px] md:px-[20px] md:py-[20px] lg:px-[30px] lg:py-[30px] activeApps">
            <h2 class="text-[18px] font-[500] text-[#fff]">Active Apps</h2>
            <h3 class="text-[38px] font-[700] text-[#fff]">{{ $activeApps }}</h3>
        </div>

        <div
            class="bluebg flex flex-col justify-center bg-[#7850C0] items-start gap-[5px]  w-[100%] sm:w-[200px] md:w-[265px] lg:w-[365px] h-[130px]  rounded-[7px] lg:rounded-[10px] px-[30px] py-[30px] activeApps">
            <h2 class="text-[18px] font-[500] text-[#fff]">Affiliates</h2>
            <h3 class="text-[38px] font-[700] text-[#fff]">{{ $allAffiliatesCount }}</h3>
        </div>
        <div
            class="orangebg flex flex-col justify-center bg-[#EF7947] items-start gap-[5px]  w-[100%] sm:w-[200px] md:w-[265px] lg:w-[365px] h-[130px]  rounded-[7px] lg:rounded-[10px] px-[30px] py-[30px] activeApps">
            <h2 class="text-[18px] font-[500] text-[#fff]">Profit</h2>
            <h3 class="text-[38px] font-[700] text-[#fff]">$ {{ $totalRevenue-$totalPayouts }}</h3>
        </div>
        <div
            class="pinkbg flex flex-col justify-center bg-[#C855C8] items-start gap-[5px] w-[100%] sm:w-[200px] md:w-[265px] lg:w-[365px] h-[130px]  rounded-[7px] lg:rounded-[10px] px-[15px] py-[15px] md:px-[20px] md:py-[20px] lg:px-[30px] lg:py-[30px] activeApps">
            <h2 class="text-[18px] font-[500] text-[#fff]">Revenue</h2>
            <h3 class="text-[38px] font-[700] text-[#fff]">$ {{ $totalRevenue }}</h3>
        </div>

        <div
            class="greenbg flex flex-col justify-center bg-[#88E528] items-start gap-[5px]  w-[100%] sm:w-[200px] md:w-[265px] lg:w-[365px] h-[130px]  rounded-[7px] lg:rounded-[10px] px-[30px] py-[30px] activeApps">
            <h2 class="text-[18px] font-[500] text-[#fff]">Payouts</h2>
            <h3 class="text-[38px] font-[700] text-[#fff]">$ {{ $totalPayouts }}</h3>
        </div>
    </div>
    <div class="bg-[#fff] px-[15px] py-[15px] lg:px-[30px] lg:py-[30px] rounded-[8px] lg:rounded-[10px]">
        <div class="flex justify-between gap-[10px] items-center flex-wrap md-flex-nowrap mb-[25px]">
            <h2 class="text-[20px] text-[#1A1A1A] font-[600]">Profit Overview</h2>
            <div x-data="select" class="flex flex-wrap md-flex-nowrap items-start gap-[15px] " @click.outside="open = false">
                <div class="relative w-[100%] sm:w-[200px]">
                    <input name="range" class="dateRange date-range-profit w-[100%] lg:w-[100%] bg-[#F6F6F6] px-[15px] py-[12px] text-[13px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none" type="text" value="">
                </div>
                <div class="relative w-[100%] sm:w-[220px]">
                    <select class=" select-affiliate-dash  affiliate-profit z-2 absolute mt-1 w-[100%] rounded bg-[#F6F6F6] border-[1px] border-[#E6E6E6] rounded-[5px] text-[13px] font-[600] text-[#4D4D4D]" x-show="open">
                        <option value="">Select Affiliate</option>
                        @foreach ($affiliateOptions as $affiliateData)
                            <option value="{{ $affiliateData->id }}">{{ $affiliateData->name.' '.$affiliateData->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="w-full">
            <canvas class="w-full" id="roundedLineChartProfit"></canvas>
        </div>
       
    </div>
    <div class="mt-[20px]">
    <div class="bg-[#fff] px-[15px] py-[15px] lg:px-[30px] lg:py-[30px] rounded-[8px] lg:rounded-[10px]">
        <div class="flex justify-between gap-[10px] items-center flex-wrap md-flex-nowrap mb-[25px]">
            <h2 class="text-[20px] text-[#1A1A1A] font-[600]">Conversion Matrix</h2>
            <div x-data="select" class="flex flex-wrap md-flex-nowrap items-start gap-[15px] " @click.outside="open = false">
                <div class="relative w-[100%] sm:w-[200px]">
                    {{-- <label for="" class="w-full text-[14] text-[#898989]">Date</label> --}}
                    <input name="range" class="dateRange  date-range-matrix w-[100%] lg:w-[100%] bg-[#F6F6F6] px-[15px] py-[12px] text-[13px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none" type="text" value="">
                </div>
                <div class="relative w-[100%] sm:w-[220px]">
                    {{-- <label for="" class="w-full text-[14] text-[#898989]">Affiliate</label> --}}
                    <select class=" select-affiliate-dash affiliate-matrix z-2 absolute mt-1 w-[100%] rounded bg-[#F6F6F6] border-[1px] border-[#E6E6E6] rounded-[5px] text-[13px] font-[600] text-[#4D4D4D]" x-show="open">
                        <option value="">Select Affiliate</option>
                        @foreach ($affiliateOptions as $affiliateData)
                            <option value="{{ $affiliateData->id }}">{{ $affiliateData->name.' '.$affiliateData->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
                    Affiliate Leaderboard By App
                </h2>
                <div class="w-[100%] overflow-x-scroll tableScroll">
                    <table
                        class="w-[100%] border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                        <tr>
                            <th
                                class="bg-[#F6F6F6] rounded-tl-[10px] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">
                                Affiliate Name</th>
                            <th
                                class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Apps</th>

                        </tr>
                        @if($affiliateByApp->isNotEmpty())
                        @foreach ($affiliateByApp as $affiliateApp)
                        <tr>
                            <th
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal border-b-[1px] border-b-[#E6E6E6]">
                                {{ $affiliateApp->name.' '.$affiliateApp->last_name }}</th>
                            <th
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal  border-b-[1px] border-b-[#E6E6E6]">
                                {{ $affiliateApp->apps_count }}</th>
                            </th>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <th colspan="2"
                                class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">
                               No Stats Found</th>
                            </th>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>


            <div class="flex flex-col items-start  w-[100%] xl:w-[32%]  gap-[10px] bg-[#fff] p-[15px] rounded-[10px] min-h-[340px]">
                <h2 class="mb-[5px] text-[17px] text-[#1A1A1A] font-[600] ">
                    Affiliate Leaderboard By Conversions
                </h2>
                <div class="w-[100%] overflow-x-scroll tableScroll">
                    <table
                        class="w-[100%] border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                        <tr>
                            <th
                                class="bg-[#F6F6F6] rounded-tl-[10px] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">
                                Affiliate Name</th>
                            <th
                                class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Conversions</th>

                        </tr>
                        @if($affiliateByRevenue->isNotEmpty())
                        @foreach ($affiliateByRevenue as $detailedStats)
                        <tr>
                            <td
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal border-b-[1px] border-b-[#E6E6E6] ">
                                {{ $detailedStats->name.' '.$detailedStats->name }}</td>
                            <td
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal  border-b-[1px] border-b-[#E6E6E6]">
                                {{ $detailedStats->trackings_count }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>

            <div class="flex flex-col items-start  w-[100%] xl:w-[32%]  gap-[10px] bg-[#fff] p-[15px] rounded-[10px] min-h-[340px]">
                <h2 class="mb-[5px] text-[17px] text-[#1A1A1A] font-[600] ">
                    Affiliate Leaderboard By Revenue
                </h2>
                <div class="w-[100%] overflow-x-scroll tableScroll">
                    <table
                        class="w-[100%] border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                        <tr>
                            <th
                                class="bg-[#F6F6F6] rounded-tl-[10px] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">
                                Affiliate Name</th>
                            <th
                                class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Revenue</th>

                        </tr>
                        @if($affiliateByRevenue->isNotEmpty())
                        @foreach ($affiliateByRevenue as $detailedStats)
                        <tr>
                            <td
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal border-b-[1px] border-b-[#E6E6E6] ">
                                {{ $detailedStats->name.' '.$detailedStats->name }}</td>
                            <td
                                class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal  border-b-[1px] border-b-[#E6E6E6]">
                                $ {{ $detailedStats->trackings_sum_revenue }}</td>
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
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('roundedLineChart').getContext('2d');
    const ctx2 = document.getElementById('roundedLineChartProfit').getContext('2d');
    let myChart; // Store chart instance globally
    let myChart2;
    function fetchChartData() {
        const dateRange = $('.date-range-matrix').val();
        const affiliate = $('.affiliate-matrix').val();

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
                                borderColor: '#d272d2', // Deep Purple Border
                                backgroundColor: 'rgba(210, 114, 210, 0.2)', // Soft Purple Fill
                                borderWidth: 2,
                                tension: 0.4, // Smooth line effect
                                fill: true,
                                pointRadius: 5,
                                pointBackgroundColor: '#d272d2'
                            },
                            {
                                label: 'Clicks',
                                data: data.clickData, // Clicks Data
                                borderColor: '#ff6384', // Red Border
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderWidth: 2,
                                tension: 0.4,
                                fill: true,
                                pointRadius: 5,
                                pointBackgroundColor: '#ff6384'
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
                                borderColor: '#d272d2', // Deep Purple Border
                                backgroundColor: 'rgba(210, 114, 210, 0.2)', // Soft Purple Fill
                                borderWidth: 2,
                                tension: 0.4, // Smooth line effect
                                fill: true,
                                pointRadius: 5,
                                pointBackgroundColor: '#d272d2'
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
        fetchChartDataProfit();
    });
    $('.date-range-matrix, .affiliate-matrix').on('change', function () {
        fetchChartData();
    });
});

</script>
@stop
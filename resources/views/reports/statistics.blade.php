@extends('layouts.default')
@section('content')
<div class="bg-[#f2f2f2] p-[15px] md:p-[35px]">
    <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[10px] mb-[20px]">
       <div class="flex items-center justify-between gap-[25px] w-[100%]  mb-[15px]">
          <h2 class="text-[20px] text-[#1A1A1A] font-[600]">Graph & Statistics</h2>
          <button class="w-[100px] md:w-[110px] lg:w-[140px] bg-[#D272D2] px-[20px] py-[10px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#fff] text-center" id="exportCsvBtn">Export</button>
       </div>
       <form method="get" id="filterStats" >
       <div class="flex flex-col items-center justify-center gap-[15px]">
          <div class="w-full flex flex-col gap-[10px]">
            <div class="w-[100%] flex flex-col lg:flex-row items-start lg:items-center justify-start gap-[10px]">
               <label class="min-w-[160px] w-[100%] md:w-[10%] text-[14px] font-[500] text-[#898989] ">Affiliates:</label>
               <select name="affiliate" class="getAppsOfAffiliate w-[100%] lg:w-[90%] bg-[#F6F6F6] px-[15px] py-[12px] text-[14px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none">
                  <option value="" >Select</option>
                  @if($allRegisteredAffiliates && $allRegisteredAffiliates->isNotEmpty())
                     @foreach ($allRegisteredAffiliates as $registeredAffiliate)
                        <option value="{{ $registeredAffiliate->id }}" @if(isset($requestedParams['affiliate']) && $requestedParams['affiliate']==$registeredAffiliate->id) selected @endif>{{ $registeredAffiliate->name }} {{ $registeredAffiliate->last_name }}</option>
                     @endforeach
                  @endif
               </select>
            </div>
            <div class="w-[100%] flex flex-col lg:flex-row items-start lg:items-center justify-start gap-[10px]">
               <label class="min-w-[160px] w-[100%] md:w-[10%] text-[14px] font-[500] text-[#898989] ">Apps:</label>
               <select name="appid" class="appendAffiliateApps w-[100%] lg:w-[90%] bg-[#F6F6F6] px-[15px] py-[12px] text-[14px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none">
                  <option value="" >Select</option>
                  @if($allAffiliatesApp && $allAffiliatesApp->isNotEmpty())
                     @foreach ($allAffiliatesApp as $affiliateApp)
                        <option value="{{ $affiliateApp->id }}" @if($requestedParams['appid']==$affiliateApp->id) selected @endif>{{ $affiliateApp->appName }} </option>
                     @endforeach
                  @endif
               </select>
            </div>
             <div class="w-[100%] flex flex-col lg:flex-row items-start lg:items-center justify-start gap-[10px]">
                <label
                   class="min-w-[160px] w-[100%] md:w-[10%] text-[14px] font-[500] text-[#898989] ">Group by:</label>
                <select name="groupBy" class="groupby-fltr w-[100%] lg:w-[90%] bg-[#F6F6F6] px-[15px] py-[12px] text-[14px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none">
                   <option value="hour" @if(isset($requestedParams['groupBy']) && $requestedParams['groupBy']=='hour') selected @endif>Hour</option>
                   <option value="day" @if(isset($requestedParams['groupBy']) && $requestedParams['groupBy']=='day') selected @endif>Date</option>
                   <option value="month" @if(isset($requestedParams['groupBy']) && $requestedParams['groupBy']=='month') selected @endif>Month</option>
                   <option value="country" @if(isset($requestedParams['groupBy']) && $requestedParams['groupBy']=='country') selected @endif>Country</option>
                   <option value="browser" @if(isset($requestedParams['groupBy']) && $requestedParams['groupBy']=='browser') selected @endif>Browser</option>
                   <option value="device" @if(isset($requestedParams['groupBy']) && $requestedParams['groupBy']=='device') selected @endif>Device Brand</option>
                   {{-- <option value="device_model" @if(isset($requestedParams['groupBy']) && $requestedParams['groupBy']=='device_model') selected @endif>Device Model</option> --}}
                   <option value="os" @if(isset($requestedParams['groupBy']) && $requestedParams['groupBy']=='os') selected @endif>Device OS</option>
                   <option value="offer" @if(isset($requestedParams['groupBy']) && $requestedParams['groupBy']=='offer') selected @endif>Offer</option>
                </select>
             </div>
             <div class="w-[100%] flex flex-col lg:flex-row items-start lg:items-center justify-start gap-[10px]">
                <label class="min-w-[160px] w-[10%] text-[14px] font-[500] text-[#898989] ">Range:</label>
                <input name="range" class="dateRange-report w-[100%] bg-[#F6F6F6] px-[15px] py-[12px] text-[12px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none" type="text" value="{{ $requestedParams['range'] ?? '' }}" />
             </div>
            
             <div class="w-[100%] flex flex-wrap lg:flex-nowrap items-start xl:items-center justify-between gap-[10px]">
                <label class="min-w-[160px] w-[100%] lg:w-[10%] text-[14px] font-[500] text-[#898989] ">Filter by:</label>
                <div class="w-[100%] xl:w-[85%] 2xl:w-[90%] flex justify-between flex-wrap xl:flex-nowrap  items-center gap-[5px] md:gap-[8px] lg:gap-[10px] xl:gap-[15px]">
                   <div class="w-[100%] lg:w-[100%] xl:w-[60.5%]  2xl:w-[70.7%] flex flex-wrap xl:flex-nowrap items-center gap-[10px]">
                      <select name="filterBy" class="filterByDrop w-[100%] bg-[#F6F6F6] px-[15px] py-[12px] text-[14px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none">
                        <option value="">Select</option>
                        <option value="country">Country</option>
                        <option value="devices">Device</option>
                        <option value="os" >Operating System</option>
                        <option value="offer" >Offer</option>
                      </select>
                      <select  class="search-input-filter w-[100%] bg-[#F6F6F6] px-[15px] py-[12px] text-[14px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none" name="filterByValue"></select>
                      
                      
                   </div>
                   <div class="w-[100%] lg:w-[100%] xl:w-[24%] 2xl:w-[24%] flex items-center justify-end  gap-[10px]">
                   <a href="javascript:void(0);" class="addCustomFilter w-[90px] xl:w-[120px] bg-[#D272D2] px-[20px] py-[11px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#fff] text-center" >Add</a>   
                   <button
                         class="w-[140px] bg-[#D272D2] px-[20px] py-[11px] w-[90px] xl:w-[120px] rounded-[4px] text-[14px] font-[500] text-[#fff] text-center" type="submit">Apply</button>
                      <a href="{{ route('admin.report.statistics') }}"
                         class="w-[140px] bg-[#F5EAF5] px-[20px] py-[11px] w-[90px] xl:w-[120px] border border-[#F5EAF5] rounded-[4px] text-[14px] font-[500] text-[#D272D2] text-center" >Clear</a>
                   </div>
                </div>
             </div>
             <div class="w-[100%] flex flex-col lg:flex-row items-start lg:items-center justify-start gap-[10px]">
               <label class="min-w-[160px] w-[10%] text-[14px] font-[500] text-[#898989] ">Active filters:</label>
                  <div class="w-[90%] flex flex-wrap items-center gap-[10px] allFilterInCommon">
                     @if(!empty($requestedParams['filterIn']))
                        @foreach ($requestedParams['filterIn'] as $k => $inValue)
                        <div class="filteravl-{{ $k }} flex items-center gap-[20px] bg-[#F6F6F6] pl-[15px] text-[14px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none"> <input type="hidden" name="filterIn[{{ $k }}][]" value="{{ $inValue[0] }}"><input type="hidden" name="filterInValue[{{$k }}][]" value="{{ $requestedParams['filterInValue'][$k][0] }}"> {{ $requestedParams['filterInValue'][$k][0] }} 
                        <button class="removeActiveOne w-[40px] h-[40px] flex items-center justify-center gap-[5px] bg-[#D272D2] text-[#fff] border-l-[1px] border-l-[#E6E6E6]"> <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.4033 1.29822L0.999773 10.7018" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M10.4033 10.7018L0.999772 1.29822" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </svg> </button> </div>
                        @endforeach
                     @endif
                  </div>
             </div>
          </div>
       </div>
       </form>
       <div class="my-[20px]">
          <canvas id="statisticsGraph"></canvas>
       </div> 
      @php 
         $headingArray = ['hour' => 'Hour','day' => 'Day','month' => 'Month','country' => 'Country','browser' => 'Browsers','device' => 'Devices','device_model' => 'Device Model','os' => 'Operating System','offer' => 'Offer'];
         $exportedData = [
            'heading' => [
               '0' => $headingArray[$requestedParams['groupBy'] ?? ''] ?? 'Hour',
               '1' => 'Clicks',
               '2' => 'Conversions',
               '3' => 'CVR',
               '4' => 'EPC',
               '5' => 'Payout',
            ],
            'data' => []
         ]; 
      @endphp
      <div class="flex flex-col justify-between items-center gap-[5px] w-[100%] mt-[30px] ">
          <div class="w-[100%] overflow-x-scroll tableScroll">
             <table
                class="w-[100%] border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                <tr>
                   <th
                      class="bg-[#F6F6F6] rounded-tl-[10px] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">
                      {{ $headingArray[$requestedParams['groupBy'] ?? ''] ?? 'Hour' }}
                   </th>
   
                   <th
                      class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap">
                      Clicks
                   </th>
                   <th
                      class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap">
                      Conversions
                   </th>
                   <th
                      class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap">
                      CVR
                   </th>
                   <th
                      class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap">
                      EPC
                   </th>
                   
                   <th
                      class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap">
                      Payout
                   </th>
                </tr>
                @if($allStatistics->isNotEmpty())
                @foreach ($allStatistics as $key => $stats)
                
                <tr>
                   <td
                      class="border-b-[1px] border-b-[#E6E6E6] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
                      {{ $stats->element }}
                   </td>
                   @php $exportedData['data'][$key]['element'] = $stats->element; @endphp
                   <td
                      class="border-b-[1px] border-b-[#E6E6E6] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
                      {{ $stats->total_click ?? '0' }}
                   </td>
                   @php $exportedData['data'][$key]['clicks'] = $stats->total_click ?? '0'; @endphp
                   <td
                      class="border-b-[1px] border-b-[#E6E6E6] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
                       {{ $stats->total_conversions ?? '0' }}
                   </td>
                   @php $exportedData['data'][$key]['conversions'] = $stats->total_conversions ?? '0'; @endphp
                   @php 
                     $confirmCount = $stats->total_conversions ?? 0; 
                     $trafficCount = $stats->total_click ?? 0;
                     $totalEarnings = $stats->total_payout ?? 0;
                     if($trafficCount>0){
                        $percentage = number_format(($confirmCount / $trafficCount) * 100, 2).' %';
                     }else{
                        $percentage = 'N/A';
                     }
                  @endphp
                   <td
                      class="border-b-[1px] border-b-[#E6E6E6] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
                      {{ rtrim(rtrim(sprintf("%.2f", ($percentage)), '0'), '.'); }} %
                   </td>
                   @php $exportedData['data'][$key]['cvr'] = rtrim(rtrim(sprintf("%.2f", ($percentage)), '0'), '.').' %' ?? 'N/A'; @endphp
                   <td
                      class="border-b-[1px] border-b-[#E6E6E6] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
                      $ {{ rtrim(rtrim(sprintf("%.4f", ($totalEarnings/$trafficCount)), '0'), '.');  }}
                   </td>
                   @php $exportedData['data'][$key]['epc'] = '$'.rtrim(rtrim(sprintf("%.4f", ($totalEarnings/$trafficCount)), '0'), '.'); @endphp
                   <td
                      class="border-b-[1px] border-b-[#E6E6E6] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
                      $ {{ rtrim(rtrim(sprintf("%.4f", ($totalEarnings)), '0'), '.');  }}
                   </td>
                   @php $exportedData['data'][$key]['earnings'] = '$'.rtrim(rtrim(sprintf("%.4f", ($totalEarnings)), '0'), '.'); @endphp
                </tr>
                @endforeach
                @endif
             </table>
          </div>
          
       </div>
    </div>
 </div>

<script>
   var chartData = @json($graphData); 
   var startDate = "{{ $requestedParams['strd'] }}"
   var endDate = "{{ $requestedParams['endd'] }}"
   var groupedBy = "{{ ucfirst($requestedParams['groupBy']) ?? '' }}";
   document.addEventListener('DOMContentLoaded', function () {
      const ctx = document.getElementById('statisticsGraph')?.getContext('2d');
      if (!ctx || !chartData || Object.keys(chartData).length === 0) {
         console.error('Chart data is missing or empty.');
         return; // ✅ Stops execution if data is missing
      }

      const labels = Object.keys(chartData); // Hours (17, 18, 19, 20)
      const conversionData = labels.map(hour => chartData[hour]?.conversion ?? 0); // Use 0 if null
      const clickData = labels.map(hour => chartData[hour]?.clicks ?? 0); // Use 0 if null

      new Chart(ctx, {
         type: 'line',
         data: {
            labels: labels, // X-axis (Hours)
            datasets: [
               {
                    label: 'Conversions',
                    data: conversionData,
                    borderColor: '#d272d2',
                    backgroundColor: 'rgba(210, 114, 210, 0.2)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointBackgroundColor: '#d272d2'
               },
               {
                    label: 'Clicks',
                    data: clickData,
                    borderColor: '#ff6384',
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
               legend: { display: true, position: 'top' },
               tooltip: { enabled: true }
            },
            scales: {
               x: { title: { display: true, text: groupedBy } },
               y: { beginAtZero: true, title: { display: true, text: 'Count' } }
            }
        }
    });
   });


   $('.getAppsOfAffiliate').select2({
      placeholder: "Select an affiliate",
      allowClear: true // Adds a clear (X) button
   });

   $('.appendAffiliateApps').select2({
      placeholder: "Select an app",
      allowClear: true // Adds a clear (X) button
   });

   $('.filterByDrop').select2({
      placeholder: "Select a filter by option",
      allowClear: true // Adds a clear (X) button
   });

   $('.search-input-filter').select2({
      placeholder: "Select a filter by option",
      allowClear: true // Adds a clear (X) button
   });

   $('.groupby-fltr').select2({
      placeholder: "Select group by option",
      allowClear: true 
   });

   $(document).on('change','.filterByDrop',function(){
      $('.loader-fcustm').show();
      if($(this).val()=='country'){
         var selectplace = 'Select country';
      }else if($(this).val()=='devices'){
         var selectplace = 'Select device';
      }else if($(this).val()=='os'){
         var selectplace = 'Select an operating system';
      }else if($(this).val()=='offer'){
         var selectplace = 'Select an offer';
      }

      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: '{{ route("filterGroup") }}/'+$(this).val(),
         type: 'GET', 
         success: function (response) {
            $('.loader-fcustm').hide();
            $('.search-input-filter').html(response).select2({
               placeholder: selectplace,
               allowClear: true
            });
         },
         error: function (xhr) {
            $('#response').html('<p>An error occurred. Please try again.</p>');
         }
      });
   });

   $(document).on('change','.getAppsOfAffiliate',function(){
      $('.loader-fcustm').show();
      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: '{{ route("getAffiliaetApp") }}/'+$(this).val(),
         type: 'GET',
         success: function (response) {
            $('.loader-fcustm').hide();
            $('.appendAffiliateApps').html(response).select2({
               placeholder: "Select an app",
               allowClear: true
            });
         },
         error: function (xhr) {
            $('#response').html('<p>An error occurred. Please try again.</p>');
         }
      });
   });

   $(document).on('click','.addCustomFilter',function(){
      if($('.search-input-filter').val()!='' && $('.filterByDrop').val()!=''){
         if($('.filteravl-'+$('.filterByDrop').val()).length>0){
            alert('Grouping filter is already added, please remove it to search by new one.'); return false;
         }
         $('.allFilterInCommon').append('<div class="filteravl-'+$('.filterByDrop').val()+' flex items-center gap-[20px] bg-[#F6F6F6] pl-[15px] text-[14px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none"><input type="hidden" name="filterIn['+$('.filterByDrop').val()+'][]" value="'+$('.search-input-filter').val()+'"><input type="hidden" name="filterInValue['+$('.filterByDrop').val()+'][]" value="'+$('.search-input-filter option:selected').text()+'"> '+$('.search-input-filter option:selected').text()+' <button class="w-[40px] h-[40px] flex items-center justify-center gap-[5px] bg-[#D272D2] text-[#fff] border-l-[1px] border-l-[#E6E6E6]"> <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.4033 1.29822L0.999773 10.7018" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /> <path d="M10.4033 10.7018L0.999772 1.29822" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /> </svg> </button> </div>');
         $('.search-input-filter').val('');
      }
   });

   $('#filterStats').on('submit',function(){
      $('.loader-fcustm').show();
   })

   $(document).on('click','.removeActiveOne',function(){
      $(this).parent().remove();
   });

   $(document).ready(function () {
      $('.dateRange-report').daterangepicker({
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

      $("#exportCsvBtn").click(function () {
         let exportData = @json($exportedData); 
         $.ajax({
               url: "{{ route('report.export') }}",
               type: "POST",
               data: {
                  exportData: exportData,
                  _token: "{{ csrf_token() }}"
               },
               xhrFields: {
                  responseType: 'blob' 
               },
               success: function (data) {
                  let blob = new Blob([data], { type: "text/csv" });
                  let link = document.createElement("a");
                  link.href = window.URL.createObjectURL(blob);
                  link.download = "report.csv";
                  document.body.appendChild(link);
                  link.click();
                  document.body.removeChild(link);
               },
               error: function () {
                  alert("Error exporting data!");
               }
         });
      });
    });
   
</script>

@stop
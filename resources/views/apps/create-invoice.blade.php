@extends('layouts.default')
@section('content')
<div class="bg-[#f2f2f2] p-[15px] lg:p-[35px]">
    <div class="flex flex-col lg:flex-row justify-between items-start gap-[15px] w-full">
        <div class="w-full bg-white p-[15px] md:p-[20px] rounded-[10px] custom_filter">
            <h2 class="w-full lg:w-auto text-[20px] text-[#1A1A1A] font-[600]">Create Invoice</h2>
            <form method="GET" action="{{ route('create.invoice') }}">
                <div class="flex flex-wrap md-flex-nowrap items-start gap-[7px] md:gap-[15px] justify-end mb-[15px]">
                    <div class="relative w-[100%] sm:w-[200px]">
                        <input name="range"
                            class="date-range-invoice w-[100%] lg:w-[100%] bg-[#F6F6F6] px-[15px] py-[10px] text-[13px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none"
                            type="text" value="{{ request('range') }}" required>
                    </div>
                    <div class="relative w-[100%] sm:w-[220px]">
                        <select required name="affiliate_id"
                            class="select-affiliate-invocie  z-2 absolute mt-1 w-[100%] rounded bg-[#F6F6F6] border-[1px] border-[#E6E6E6] rounded-[5px] text-[13px] font-[600] text-[#4D4D4D]"
                            x-show="open">
                            <option value="">Select Affiliate</option>
                            @if($allAffiliates->isNotEmpty())
                                @foreach ($allAffiliates as $affiliate)
                                    <option value="{{ $affiliate->id }}" @if(request('affiliate_id') == $affiliate->id) selected @endif>{{ $affiliate->name }} {{ $affiliate->last_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="relative w-full md:w-auto">
                        <button type="submit"
                            class="w-full md:w-[110px] lg:w-[140px] bg-[#4EF953] px-[20px] py-[10px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#000] text-center">Fetch</button>
                    </div>
                
                </div>
            </form>
            <div class="overflow-x-scroll tableScroll">
                <table
                    class="w-full border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6] min-w-[600px]">
                    <thead>
                        <tr>
                            <th
                                class="bg-[#7FB5CB] rounded-tl-[10px] text-[12px] font-medium text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Clicks</th>
                            <th
                                class="bg-[#7FB5CB] text-[12px] font-medium text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Conversions</th>
                            <th
                                class="max-w-[250px] bg-[#7FB5CB] text-[12px] font-medium text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Revenue</th>
                            <th
                                class="bg-[#7FB5CB] text-[12px] font-medium text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Payout</th>
                            <th
                                class="bg-[#7FB5CB] rounded-tr-[10px] text-[12px] font-medium text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($allStatistics->isNotEmpty())
                        @foreach ($allStatistics as $statistics )
                        <tr>
                            <td
                                class="text-[12px] font-medium text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b border-[#E6E6E6]">
                                {{ $statistics->total_click }}</td>
                            <td
                                class="text-[12px] font-medium text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b border-[#E6E6E6]">
                                {{ $statistics->total_conversions }}</td>
                            <td
                                class="max-w-[250px] text-[12px] font-medium text-[#808080] px-[10px] py-[10px] text-left whitespace-normal border-b border-[#E6E6E6]">
                               $ {{ $statistics->total_revenue }}
                            </td>
                            <td
                                class="text-[12px] font-medium text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b border-[#E6E6E6]">
                                $ {{ $statistics->total_payout }}
                            </td>
                            <td
                                class="text-[12px] font-medium text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b border-[#E6E6E6]">
                               <a 
                                    startdate="{{ request('range') }}" 
                                    userid="{{ request('affiliate_id') }}" 
                                    conversion="{{ $statistics->total_conversions }}" 
                                    payout="{{ $statistics->total_payout }}" 
                                class="create-invoice-now text-[14px] font-[500] text-[#000]" href="javascript:void(0);"> Create Invoice </a>
                            </td>
                            
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select-affiliate-invocie').select2({
            placeholder: "Select an affiliate",
            allowClear: true // Adds a clear (X) button
        });
    });

    $(function () {
        $('.date-range-invoice').daterangepicker({
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            autoUpdateInput: true, 
            opens: 'right'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
    
    $(document).on('click','.create-invoice-now',function(){
      $('.loader-fcustm').show();
      var daterange = $(this).attr('startdate')
      var userid = $(this).attr('userid')
      var conversion = $(this).attr('conversion')
      var payout = $(this).attr('payout')
      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: '{{ route("invoice.create") }}',
         type: 'POST',
         data: {daterange:daterange, userid:userid,conversion:conversion,payout:payout},
         success: function (response) {
            $('.loader-fcustm').hide();
            if(response>0){
                window.location.href="/invoice-preview/"+response
            }
         },
         error: function (xhr) {
            alert('<p>An error occurred. Please try again.</p>');
         }
      });
   });

</script>

@stop

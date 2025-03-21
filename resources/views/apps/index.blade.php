@extends('layouts.default')
@section('content')

<div class="bg-[#f2f2f2] p-[15px] lg:p-[35px]">
    <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[10px] mb-[20px]">
      <div class="flex flex-col justify-between gap-[25px] w-[100%]  mb-[15px]">
          <h2 class="text-[20px] text-[#1A1A1A] font-[600]">My Apps</h2>
          <form method="get">
          <div class="w-full flex flex-col gap-[10px]">
            <div class="w-[100%] flex flex-col lg:flex-row items-start lg:items-center justify-start gap-[10px]">
            <label class="min-w-[160px] w-[100%] md:w-[10%] text-[14px] font-[500] text-[#898989] "> Affiliate</label>
            <select name="affiliate" class="getAppsOfAffiliate w-[100%] lg:w-[90%] flex px-[15px] py-[15px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none">
               <option value="">Select status</option>
               @if($allAffiliates->isNotEmpty())
                  @foreach($allAffiliates as $affiliate)
                     <option value="{{ $affiliate['id'] }}" @if(isset($requestedParams['affiliate']) && $requestedParams['affiliate']==$affiliate['id']) selected @endif>{{ $affiliate['name'] }}</option>
                  @endforeach
               @endif
            </select>
            </div>
         
            <div class="w-[100%] flex flex-col lg:flex-row items-start lg:items-center justify-start gap-[10px]">
                  <label class="min-w-[160px] w-[100%] md:w-[10%] text-[14px] font-[500] text-[#898989] ">Apps</label>
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
               <label class="min-w-[160px] w-[100%] md:w-[10%] text-[14px] font-[500] text-[#898989] "> Admin Status</label>
            <select name="admin_status" class="admin_status  w-[100%] lg:w-[90%] flex px-[15px] py-[15px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none">
               <option value="">Select status</option>
               <option value="approved" @if(isset($requestedParams['admin_status']) && $requestedParams['admin_status']=='approved') selected @endif>Approved</option>
               <option value="not_approved" @if(isset($requestedParams['admin_status']) && $requestedParams['admin_status']=='not_approved') selected @endif>Not Approved</option>
            </select>
            </div>

            <div class="w-[100%] flex flex-col lg:flex-row items-start lg:items-center justify-start gap-[10px]">
               
               <label class="min-w-[160px] w-[100%] md:w-[10%] text-[14px] font-[500] text-[#898989] "> Affiliate Status</label>
               <select name="affiliate_status" class=" affiliate_status w-[100%] lg:w-[90%] flex px-[15px] py-[15px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none">
                  <option value="">Select status</option>
                  <option value="active" @if(isset($requestedParams['affiliate_status']) && $requestedParams['affiliate_status']=='active') selected @endif>Active</option>
                  <option value="archived" @if(isset($requestedParams['affiliate_status']) && $requestedParams['affiliate_status']=='archived') selected @endif>Archived</option>
               </select>
            </div>
       
         <div class="flex justify-end">
          <button type="submit" class="w-[90px] xl:w-[120px] bg-[#D272D2] px-[20px] py-[11px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#fff] text-center">Search</button>
      </div>
         </div>
          </form>
       </div>
       <div class="flex flex-col justify-between items-center gap-[5px] w-[100%] mt-[30px] ">
          <div class="w-[100%] overflow-x-scroll tableScroll">
             <table class="w-[100%] border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                <tr>
                   <th class="bg-[#F6F6F6] rounded-tl-[10px] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">Affiliate Name</th>
                   <th class="bg-[#F6F6F6] rounded-tl-[10px] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">App Name</th>
                   <th class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap">Admin Status</th>
                   <th class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap">Affiliate Status</th>
                   <th class="bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap">Created</th>
                   <th class="w-[130px] bg-[#F6F6F6] text-[14px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-right whitespace-nowrap">Actions</th>
                </tr>
                <tbody id="search-results">
                @if($allApps && $allApps->isNotEmpty())
                @foreach ($allApps as $apps)
                <tr>
                    <td class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal ">
                       <strong>{{ $apps->users->name.' '.$apps->users->last_name }}</strong>
                    </td>
                    <td class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal ">
                       <strong>{{ $apps->appName }}</strong>
                       <p class="whitespace-normal text-[12px] text-[#808080]">{{ $apps->appUrl }}</p>
                    </td>
                    @if( $apps->status==1)
                    <td class="text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
                        <a href="{{ route('apps.status',['id'=>$apps->id]) }}" class="inline-flex bg-[#F3FEE7] border border-[#BCEE89] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#6EBF1A] text-center uppercase">Aprroved</a>
                     </td>
                    @else
                    <td class="text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
                        <a href="{{ route('apps.status',['id'=>$apps->id]) }}" class="inline-flex bg-[#fee7e7] border border-[#ee8989] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#bf1a1a] text-center uppercase">Not Approved</a>
                     </td>
                    @endif

                    @if( $apps->affiliate_status==1)
                    <td class="text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
                        <a href="javascript:void(0);" class="inline-flex bg-[#F3FEE7] border border-[#BCEE89] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#6EBF1A] text-center uppercase">Active</a>
                     </td>
                    @else
                    <td class="text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
                        <a href="javascript:void(0);" class="inline-flex bg-[#fee7e7] border border-[#ee8989] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#bf1a1a] text-center uppercase"> Archived</a>
                     </td>
                    @endif
                    
                    <td class="text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">{{ date('d M Y',strtotime($apps->created_at)) }}</td>
                    <td class="w-[130px] text-[14px] font-[500] text-[#5E72E4] px-[10px] py-[10px] text-left whitespace-nowrap ">
                       <div class="flex items-center justify-end gap-[10px]">
                          <a title="Edit" href="{{ route('apps.add',['id'=>$apps->id]) }}" class="flex items-center justify-center w-[35px] bg-[#FFF3ED] py-[10px] w-[100px] border border-[#FED5C3] rounded-[4px] text-[14px] font-[500] text-[#D272D2] text-center">
                           <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="none">
                              <path d="M8.29289 3.70711L1 11V15H5L12.2929 7.70711L8.29289 3.70711Z" fill="#D272D2"/>
                              <path d="M9.70711 2.29289L13.7071 6.29289L15.1716 4.82843C15.702 4.29799 16 3.57857 16 2.82843C16 1.26633 14.7337 0 13.1716 0C12.4214 0 11.702 0.297995 11.1716 0.828428L9.70711 2.29289Z" fill="#D272D2"/>
                           </svg>   
                           </a>
                           @if( $apps->status==1 && $apps->affiliate_status==1)
                           <a title="Integration" href="{{ route('apps.integration',['id'=>$apps->id]) }}" class="flex items-center justify-center w-[35px] bg-[#FFF3ED] py-[10px] w-[100px] border border-[#FED5C3] rounded-[4px] text-[14px] font-[500] text-[#D272D2] text-center">
                             <svg xmlns="http://www.w3.org/2000/svg"  width="14" height="14" viewBox="0 0 16 16" fill="none">
                              <path d="M8.01005 0.858582L6.01005 14.8586L7.98995 15.1414L9.98995 1.14142L8.01005 0.858582Z" fill="#D272D2"/>
                              <path d="M12.5 11.5L11.0858 10.0858L13.1716 8L11.0858 5.91422L12.5 4.5L16 8L12.5 11.5Z" fill="#D272D2"/>
                              <path d="M2.82843 8L4.91421 10.0858L3.5 11.5L0 8L3.5 4.5L4.91421 5.91422L2.82843 8Z" fill="#D272D2"/>
                              </svg>
                           </a>
                            @endif
                       </div>
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
$(document).ready(function(){
   $('.search-app').on('keyup', function() {
      let query = $(this).val();
      $.ajax({
         url: "{{ route('apps.index') }}",
         type: "GET",
         data: { query: query, type: 'ajax' },
         dataType: "json",
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(data) {

            $('#search-results').html(data);
         }
      });
   });
});

   $('.admin_status').select2({
      placeholder: "Select status",
      allowClear: true
   });

   $('.affiliate_status').select2({
      placeholder: "Select status",
      allowClear: true // Adds a clear (X) button
   });

   $('.getAppsOfAffiliate').select2({
      placeholder: "Select affiliate",
      allowClear: true // Adds a clear (X) button
   });

   $('.appendAffiliateApps').select2({
      placeholder: "Select app",
      allowClear: true // Adds a clear (X) button
   });

   $(document).on('change','.getAppsOfAffiliate',function(){
      
      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: '{{ route("getAffiliaetApp") }}/'+$(this).val(),
         type: 'GET',
         success: function (response) {
            $('.appendAffiliateApps').html(response).select2();
         },
         error: function (xhr) {
            $('#response').html('<p>An error occurred. Please try again.</p>');
         }
      });
   });
</script>
@stop

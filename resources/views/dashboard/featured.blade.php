@extends('layouts.default')
@section('content')
@php
    use App\Models\Setting;
    use App\Models\User;
    use Illuminate\Support\Facades\Http;
@endphp
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        max-width: none;
    }
</style>
<div class="bg-[#f2f2f2] p-[15px] md:p-[35px] custom_form_design">
    <form method="POST">
        @csrf
        <input type="hidden" id="original_app_url" >
        <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[8px] md:rounded-[10px]">
            <h2 class="mb-[20px] text-[20px] text-[#1A1A1A] font-[600] ">
                Add Rule For Featured Offers
            </h2>  
            
            <div class="repeater">
                <div data-repeater-list="group-a" class="flex-wrap gap-x-[18px] lg:gap-x-[20px] gap-y-[30px] w-[100%] ">
                    @if($allFeatOffer->isNotEmpty())
                        @foreach ($allFeatOffer as $featOffer)
                        
                        @php
                            $offerSettings = Setting::find(1);
                            $offerId = $featOffer->offer_id;
                            $url = "https://api-makamobile.affise.com/3.1/offers/{$offerId}/privacy";
                            $response = HTTP::withHeaders([
                                'API-Key' => $offerSettings->affise_api_key,
                            ])->get($url);
                            $enabledUsers = [];
                            $disabledUsers = [];
                            $updatedEnabledUsers = [];
                            if ($response->successful()) {
                                $assignedAffiliates = $response->json();
                                if(isset($assignedAffiliates['affiliates_enabled']) && !empty($assignedAffiliates['affiliates_enabled'])){
                                    $enabledUsers = $assignedAffiliates['affiliates_enabled'];
                                }
                                if(isset($assignedAffiliates['affiliates_disabled']) && !empty($assignedAffiliates['affiliates_disabled'])){
                                    $disabledUsers = $assignedAffiliates['affiliates_disabled'];
                                }
                                $updatedEnabledUsers = array_values(array_diff($enabledUsers, $disabledUsers));
                                $allAffiliates = User::select('id', 'name', 'last_name', 'affise_api_key')
                                ->where('role', 'affiliate')
                                ->where('status', 1)
                                ->whereIn('affiseId', $updatedEnabledUsers)
                                ->groupBy('id', 'name', 'last_name', 'affise_api_key')
                                ->get()
                                ->mapWithKeys(function ($user) {
                                    return [$user->id => $user->name . ' ' . $user->last_name];
                                });
                            }
                            @endphp

                            <div data-repeater-item class="relative flex-wrap mb-[20px] md:mb-[50px] border-[1px] p-[15px] rounded-[10px] flex gap-[15px] w-full">
                                <input type="hidden" name="rec_id" value="{{ $featOffer->id }}">
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for="" class="flex items-center gap-[5px] text-[14px] text-[#898989]">Offer<div class="text-[#F23765] mt-[-2px]">*</div></label>
                                    <select name="offer_id" required class="flex px-[15px] py-[15px] rounded-[10px] bg-transparent text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none offer-option">
                                        
                                        
                                        @if($allOffers['pagination']['total_count']>0)
                                            @foreach ($allOffers['offers'] as $offerKey =>$offerVal )
                                                @if($offerVal['status']=='active') 
                            <option value="{{ $offerVal['offer_id'] }}" @if($featOffer->offer_id==$offerVal['offer_id']) selected @endif >{{ $offerVal['offer_id'] }} - {{ $offerVal['title'] }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for="" class="flex items-center gap-[5px] text-[14px] text-[#898989]">Country<div class="text-[#F23765] mt-[-2px]">*</div>
                                    <input type="checkbox" class="check-all"> Select All
                                    </label>
                                    <select name="countries" required class="country-select flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" multiple>
                                        
                                        @php $allSelectedCountries = explode(',',$featOffer->countries); @endphp
                                        @foreach ($allCountries as $country )
                                            <option value="{{ $country->iso }}" 
                                                @if(in_array($country->iso,$allSelectedCountries)) selected @endif >{{  $country->nicename }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for="" class="flex items-center gap-[5px] text-[14px] text-[#898989]">Devices<div class="text-[#F23765] mt-[-2px]">*</div> <input type="checkbox" class="check-all"> Select All</label>
                                    <select name="devices" required class="device-select flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" multiple>
                                        @php $allSelectedDevices = explode(',',$featOffer->devices); @endphp
                                       
                                         <option @if(in_array('desktop',$allSelectedDevices)) selected @endif  value="desktop">Desktop</option>
                                         <option @if(in_array('mobile',$allSelectedDevices)) selected @endif  value="mobile">Mobile</option>
                                         <option @if(in_array('tablet',$allSelectedDevices)) selected @endif  value="tablet">Tablet</option>
                                    </select>
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for="" class="flex items-center gap-[5px] text-[14px] text-[#898989]">Operating System<div class="text-[#F23765] mt-[-2px]">*</div> <input type="checkbox" class="check-all"> Select All</label>
                                    <select name="operating_system" required class="operating-select flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" multiple>
                                        @php $allSelectedOs = explode(',',$featOffer->operating_system); @endphp
                                       
                                         <option @if(in_array('Mac OS X',$allSelectedOs)) selected @endif  value="Mac OS X">Mac OS X</option>
                                         <option @if(in_array('macOS',$allSelectedOs)) selected @endif  value="macOS">macOS</option>
                                         <option @if(in_array('Windows',$allSelectedOs)) selected @endif  value="Windows">Windows</option>
                                         <option @if(in_array('Android',$allSelectedOs)) selected @endif  value="Android">Android</option>
                                         <option @if(in_array('iOS',$allSelectedOs)) selected @endif  value="iOS">iOS</option>
                                         <option @if(in_array('iPadOS',$allSelectedOs)) selected @endif  value="iPadOS">iPadOS</option>
                                    </select>
                                </div>
                                @php 
                                    $selectedAffiliaets = explode(',',$featOffer->affiliates); 
                                @endphp
                                <div class="md:flex-wrap affiliate-select-section flex flex-col gap-[5px] w-full md:w-[92%] xl:w-[48%] ">
                                    <label for="" class="flex items-center gap-[5px] text-[14px] text-[#898989]">Affiliates <div class="text-[#F23765] mt-[-2px]">*</div> <input type="checkbox" class="check-all"> Select All</label>
                                    <select name="webmasters" required class="affiliate-select flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" multiple>
                                        
                                        @if($allAffiliates->isNotEmpty())
                                        @foreach ($allAffiliates as $affKey =>$affVal)
                                            <option value="{{ $affKey }}" @if(in_array($affKey,$selectedAffiliaets)) selected @endif>{{ $affVal }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="absolute top-[10px] right-[10px]">
                                    <a href="javascript:void(0);" data-repeater-delete class="items-centre flex  rounded-[10px] text-[14px] font-[500] text-[#f00000] text-center" > <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 18C2.45 18 1.97933 17.8043 1.588 17.413C1.19667 17.0217 1.00067 16.5507 1 16V3H0V1H5V0H11V1H16V3H15V16C15 16.55 14.8043 17.021 14.413 17.413C14.0217 17.805 13.5507 18.0007 13 18H3ZM5 14H7V5H5V14ZM9 14H11V5H9V14Z" fill="#F24822"/>
                                        </svg> </a>
                                </div>  
                            </div> 
                        @endforeach
                    @else
                        <div data-repeater-item class="flex-wrap mb-[20px] md:mb-[50px] border-[1px] p-[15px] rounded-[10px] flex gap-[15px] w-full">
                            <input type="hidden" name="rec_id" value="0">
                            <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                <label for="" class="flex items-center gap-[5px] text-[14px] text-[#898989]">Offer<div class="text-[#F23765] mt-[-2px]">*</div></label>
                                <select name="offer_id" required class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none offer-option">
                                    @if($allOffers['pagination']['total_count']>0)
                                        @foreach ($allOffers['offers'] as $offerKey =>$offerVal )
                                            @if($offerVal['status']=='active') 
                        <option value="{{ $offerVal['offer_id'] }}" >{{ $offerVal['offer_id'] }} - {{ $offerVal['title'] }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                <label for="" class="flex items-center gap-[5px] text-[14px] text-[#898989]">Country<div class="text-[#F23765] mt-[-2px]">*</div>
                                <input type="checkbox" class="check-all"> Select All
                                </label>
                                <select name="countries" required class="country-select flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" multiple>
                                    @foreach ($allCountries as $country )
                                        <option value="{{ $country->iso }}" >{{  $country->nicename }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                <label for="" class="flex items-center gap-[5px] text-[14px] text-[#898989]">Devices<div class="text-[#F23765] mt-[-2px]">*</div> <input type="checkbox" class="check-all"> Select All</label>
                                <select name="devices" required class="device-select flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" multiple>
                                        <option value="desktop">Desktop</option>
                                        <option value="mobile">Mobile</option>
                                        <option value="tablet">Tablet</option>
                                </select>
                            </div>
                            <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                <label for="" class="flex items-center gap-[5px] text-[14px] text-[#898989]">Operating System<div class="text-[#F23765] mt-[-2px]">*</div> <input type="checkbox" class="check-all"> Select All</label>
                                <select name="operating_system" required class="operating-select flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" multiple>
                                        <option value="Mac OS X">Mac OS X</option>
                                        <option value="macOS">macOS</option>
                                        <option value="Windows">Windows</option>
                                        <option value="Android">Android</option>
                                        <option value="iOS">iOS</option>
                                        <option value="iPadOS">iPadOS</option>
                                </select>
                            </div>
                            <div class="md:flex-wrap affiliate-select-section flex flex-col gap-[5px] w-full md:w-[92%] xl:w-[48%] ">
                                <label for="" class="flex items-center gap-[5px] text-[14px] text-[#898989]">Affiliates <div class="text-[#F23765] mt-[-2px]">*</div> <input type="checkbox" class="check-all"> Select All</label>
                                <select name="webmasters" required class="affiliate-select flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" multiple>
                                </select>
                            </div>
                            <div class="absolute top-[10px] right-[10px]">
                                <a href="javascript:void(0);" data-repeater-delete class="items-centre flex  rounded-[10px] text-[14px] font-[500] text-[#f00000] text-center" > <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 18C2.45 18 1.97933 17.8043 1.588 17.413C1.19667 17.0217 1.00067 16.5507 1 16V3H0V1H5V0H11V1H16V3H15V16C15 16.55 14.8043 17.021 14.413 17.413C14.0217 17.805 13.5507 18.0007 13 18H3ZM5 14H7V5H5V14ZM9 14H11V5H9V14Z" fill="#F24822"/>
                                    </svg> </a>
                            </div>  
                        </div> 
                    @endif
                    
                </div>
                <div class="flex gap-[10px] md:gap-[20px] mt-[15px]">
                    <a href="javascript:void(0);" data-repeater-create class="w-[120px] bg-[#49fb53] px-[10px] py-[11px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#000] text-center" > Add </a>
                    <button type="submit" class="w-[120px] bg-[#49fb53] px-[10px] py-[11px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#000] text-center">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="js/jquery.repeater.min.js"></script>

<script src="js/form-repeater.int.js"></script>
<script>
    $(document).on('change','.offer-option',function(){
        var offer = $(this).val();
        var element = $(this);
        $.ajax({
            url: "{{ route('getOfferAffiliate') }}",
            type: "GET",
            data: { offer: offer },
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $(element).parent().parent().find('.affiliate-select').select2('destroy');
                // Assuming the response is an object like {1: 'John Doe', 2: 'Jane Smith'}
                var $select =  $(element).parent().parent().find('.affiliate-select');
                $select.empty(); // Clear previous options

                // Optional: add a default option
                $select.append('<option value="">Select Affiliate</option>');

                $.each(data.data, function (id, name) {
                    $select.append('<option value="' + id + '">' + name + '</option>');
                });

                $(element).parent().parent().find('.affiliate-select').select2({
                    placeholder: "Select an affiliate",
                    allowClear: true // Adds a clear (X) button
                });
            }
        });
    });
    $('.affiliate-select').select2({
      placeholder: "Select an affiliate",
      allowClear: true 
    });
    $('.country-select').select2({
      placeholder: "Select country",
      allowClear: true,
      width: '100%'
    });
    $('.device-select').select2({
      placeholder: "Select device",
      allowClear: true
    });
    $('.operating-select').select2({
      placeholder: "Select OS",
      allowClear: true
    });
    $('.offer-option').select2({
      placeholder: "Select offer"
    });

    $(document).on('change', '.check-all', function () {
        const isChecked = $(this).is(':checked');
        const $select = $(this).closest('div').find('select');

        if (isChecked) {
            // Select all options
            $select.find('option').prop('selected', true);
        } else {
            // Deselect all options
            $select.find('option').prop('selected', false);
        }

        // Refresh the Select2 UI
        $select.trigger('change.select2');
    });
</script>
@stop
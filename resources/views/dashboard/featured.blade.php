@extends('layouts.default')
@section('content')
@php
    use App\Models\Setting;
    use App\Models\User;
    use Illuminate\Support\Facades\Http;
@endphp
<div class="bg-[#f2f2f2] p-[15px] md:p-[35px]">
    <form method="POST">
        @csrf
        <input type="hidden" id="original_app_url" >
        <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[8px] md:rounded-[10px]">
            <h2 class="mb-[20px] text-[20px] text-[#1A1A1A] font-[600] ">
                Add Rule For Featured Offers
            </h2>  
            
            <div class="repeater">
                <div data-repeater-list="group-a" class="flex flex-wrap gap-x-[18px] lg:gap-x-[20px] gap-y-[30px] w-[100%] ">
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

                            <div data-repeater-item class="flex gap-[15px] w-full">
                                <input type="hidden" name="rec_id" value="{{ $featOffer->id }}">
                                <div class="flex flex-col gap-[10px] w-[100%] md:w-[20%] 2xl:md:w-[20%]">
                                    <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Offer<div class="text-[#F23765] mt-[-2px]">*</div></label>
                                    <select name="offer_id" required class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none offer-option">
                                        <option value="">Select Offer</option>
                                        
                                        @if($allOffers['pagination']['total_count']>0)
                                            @foreach ($allOffers['offers'] as $offerKey =>$offerVal )
                                                @if($offerVal['status']=='active') 
                            <option value="{{ $offerVal['offer_id'] }}" @if($featOffer->offer_id==$offerVal['offer_id']) selected @endif >{{ $offerVal['title'] }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="flex flex-col gap-[10px] w-[100%] md:w-[20%] 2xl:md:w-[20%]">
                                    <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Offer<div class="text-[#F23765] mt-[-2px]">*</div></label>
                                    <select name="offer_id" required class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none offer-option">
                                        <option value="">Select Offer</option>
                                        
                                        @if($allOffers['pagination']['total_count']>0)
                                            @foreach ($allOffers['offers'] as $offerKey =>$offerVal )
                                                @if($offerVal['status']=='active') 
                            <option value="{{ $offerVal['offer_id'] }}" @if($featOffer->offer_id==$offerVal['offer_id']) selected @endif >{{ $offerVal['title'] }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="flex flex-col gap-[10px] w-[100%] md:w-[20%] 2xl:md:w-[20%]">
                                    <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Offer<div class="text-[#F23765] mt-[-2px]">*</div></label>
                                    <select name="offer_id" required class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none offer-option">
                                        <option value="">Select Offer</option>
                                        
                                        @if($allOffers['pagination']['total_count']>0)
                                            @foreach ($allOffers['offers'] as $offerKey =>$offerVal )
                                                @if($offerVal['status']=='active') 
                            <option value="{{ $offerVal['offer_id'] }}" @if($featOffer->offer_id==$offerVal['offer_id']) selected @endif >{{ $offerVal['title'] }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @php 
                                    $selectedAffiliaets = explode(',',$featOffer->affiliates); 
                                @endphp
                                <div class="affiliate-select-section flex flex-col gap-[10px] w-[100%] md:w-[64%] 2xl:md:w-[64%]">
                                    <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Affiliates <div class="text-[#F23765] mt-[-2px]">*</div></label>
                                    <select name="webmasters" required class="affiliate-select flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" multiple>
                                        <option value="">Select Option</option>
                                        @if($allAffiliates->isNotEmpty())
                                        @foreach ($allAffiliates as $affKey =>$affVal)
                                            <option value="{{ $affKey }}" @if(in_array($affKey,$selectedAffiliaets)) selected @endif>{{ $affVal }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="flex items-centre">
                                    <a href="javascript:void(0);" data-repeater-delete class="items-centre mt-[40px] flex  rounded-[10px] text-[14px] font-[500] text-[#f00000] text-center" > <svg style="width:30px; height:30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z"></path></svg> </a>
                                </div>  
                            </div>
                        @endforeach
                    @else
                        <div data-repeater-item class="flex gap-[15px] w-full">
                             <input type="hidden" name="rec_id" value="0">
                            <div class="flex flex-col gap-[10px] w-[100%] md:w-[31%] 2xl:md:w-[32%]">
                                <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Offer<div class="text-[#F23765] mt-[-2px]">*</div></label>
                                <select name="offer_id" required class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none offer-option">
                                    <option value="">Select Offer</option>
                                    @if($allOffers['pagination']['total_count']>0)
                                        @foreach ($allOffers['offers'] as $offerKey =>$offerVal )
                                            @if($offerVal['status']=='active') 
                                                <option value="{{ $offerVal['offer_id'] }}">{{ $offerVal['title'] }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="affiliate-select-section flex flex-col gap-[10px] w-[100%] md:w-[64%] 2xl:md:w-[64%]">
                                <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Affiliates <div class="text-[#F23765] mt-[-2px]">*</div></label>
                                <select name="webmasters" required class="affiliate-select flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" multiple>
                                    <option value="">Select Option</option>
                                </select>
                            </div>
                            <div class="flex items-centre">
                                <a href="javascript:void(0);" data-repeater-delete class="items-centre mt-[40px] flex  rounded-[10px] text-[14px] font-[500] text-[#f00000] text-center" > <svg style="width:30px; height:30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z"></path></svg> </a>
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
      allowClear: true // Adds a clear (X) button
    });
</script>
@stop
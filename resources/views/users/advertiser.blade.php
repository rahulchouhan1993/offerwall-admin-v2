@extends('layouts.default')
@section('content')
<div class="bg-[#f2f2f2] p-[15px] lg:p-[35px]">
    <div class="flex flex-col lg:flex-row justify-between items-start gap-[15px] w-[100%] ">
        <div class="w-[100%] lg:w-[100%] bg-[#fff] p-[15px] md:p-[20px] rounded-[10px]">
            <div class="flex items-center justify-between gap-[10px] mb-[20px]">
                <h2 class="text-[20px] text-[#1A1A1A] font-[600]">Edit Details</h2>
            </div>
            <form method="POST">
                @csrf
            <div class="flex w-[100%] bg-[#fff] p-[15px] md:p-[20px] rounded-[10px]">
                <div class="flex flex-col gap-[15px] w-[100%] ">
                    <div class="flex flex-wrap xl:flex-nowrap gap-[20px] w-[100%">
                        <div class="flex flex-col gap-[5px] w-[100%] md:w-[100%]">
                            <label for="" class="text-[14] text-[#898989]">Name</label>
                            <input type="text" name="advertiser_name"  class="flex px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $advertiserDetails->advertiser_name }}">
                        </div>
                        
                        <div class="flex flex-col gap-[5px] w-[100%] md:w-[100%]">
                            <label for="" class="text-[14] text-[#898989]">Affise API Key</label>
                            <input type="text" name="affise_api_key"  class="flex px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $advertiserDetails->affise_api_key }}">
                        </div>
                    </div>
    
                    <div class="flex gap-[20px] w-[100%">
                        <div class="flex flex-col gap-[5px] w-[100%]">
                            <label for="" class="text-[14] text-[#898989]">URL Format</label>
                            <div class="relative">
                                <input type="text" name="affise_endpoint"  class="flex w-[100%] px-[15px] py-[12px] pr-[50px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none  focus:outline-none" value="{{ $advertiserDetails->affise_endpoint }}">
                                
                            </div>
                        </div>
                    </div>
    
                    <div class="flex gap-[5px] md:gap-[20px]">
                        <button class="flex items-center justify-center w-[110px] md:w-[120px] px-[4px] py-[12px] md:px-[15px] md:py-[12px] rounded-[5px] bg-[#49FB53]  text-[12px] md:text-[14px] font-[500] text-[#000]">Save</button>
    
                        <button class="flex items-center justify-center w-[110px] md:w-[120px] px-[4px] py-[12px] md:px-[15px] md:py-[12px] rounded-[5px] bg-[#ffe3e3]  text-[14px] font-[500] text-[#f00000]">Cancel</button>
                    </div>
                </div>
            </div>
            </form> 
        </div>

        
    </div>

    <br>
    
    <div class="flex flex-col lg:flex-row justify-between items-start gap-[15px] w-[100%] ">
        <div class="w-[100%] lg:w-[100%] bg-[#fff] p-[15px] md:p-[20px] rounded-[10px]">
            <div class="flex items-center justify-between gap-[10px] mb-[20px]">
                <h2 class="text-[20px] text-[#1A1A1A] font-[600]">Offers Parameters and values</h2>
            </div>
            <div class="flex w-[100%] bg-[#fff] p-[15px] md:p-[20px] rounded-[10px]">
                <div class="flex flex-col gap-[15px] w-[100%] ">
                    <div class="flex flex-wrap xl:flex-nowrap gap-[20px] w-[100%">
                        <div class="flex flex-col gap-[5px] w-[100%] md:w-[100%]">
                            <label for="" class="text-[14] text-[#898989]">Sub 1</label>
                            <input type="text" disabled class="flex px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{tracking_id}">
                        </div>
                        
                        <div class="flex flex-col gap-[5px] w-[100%] md:w-[100%]">
                            <label for="" class="text-[14] text-[#898989]">Sub 2</label>
                            <input type="text" disabled class="flex px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{platform_alias_name}">
                        </div>

                        <div class="flex flex-col gap-[5px] w-[100%] md:w-[100%]">
                            <label for="" class="text-[14] text-[#898989]">Sub 3</label>
                            <input type="text" disabled class="flex px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{app_id}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
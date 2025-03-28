@extends('layouts.default')
@section('content')
<div class="bg-[#f2f2f2] p-[15px] lg:p-[35px]">
    <div class="flex flex-col lg:flex-row justify-between items-start gap-[15px] w-[100%] ">
        <div class="w-[100%] lg:w-[100%] bg-[#fff] p-[15px] md:p-[20px] rounded-[10px]">
            <div class="flex items-center justify-between gap-[10px] mb-[10px]">
                <h2 class="text-[20px] text-[#1A1A1A] font-[600]">Site settings</h2>
            </div>
            <form method="POST" enctype="multipart/form-data">
            @csrf
                <div class="flex items-center justify-start flex-wrap md:flex-nowrap gap-[20px] mb-[15px]">
                    <h2 class="w-[160px] text-[16px] text-[#4D4D4D]  font-[600]">Conversion Report</h2>
                    <div class="switch">
                        <label class="switch">
                            <input type="checkbox" {{ $settingsData->conversion_report == 1 ? 'checked' : '' }} name="conversion">
                            <span class="slider round"></span>
                            </label>
                    </div>
                </div>
                <div class="flex items-center justify-start flex-wrap md:flex-nowrap gap-[20px] mb-[15px]">
                    <h2 class="w-[160px] text-[16px] text-[#4D4D4D] font-[600]">Postback Report</h2>
                    <div class="switch">
                        <label class="switch">
                            <input type="checkbox" name="postback" {{ $settingsData->postback_report == 1 ? 'checked' : '' }}>
                            <span class="slider round"></span>
                            </label>
                    </div>
                </div>
                <div class="flex items-center justify-start flex-wrap md:flex-nowrap gap-[20px] mb-[15px]">
                    <h2 class="w-[160px] text-[16px] text-[#4D4D4D] font-[600]">Privacy Policy</h2>
                    <div class="switch">
                        <label class="switch">
                            <input type="checkbox" name="privacy_policy" {{ $settingsData->privacy_policy == 1 ? 'checked' : '' }}>
                            <span class="slider round"></span>
                            </label>
                    </div>
                </div>
                <div class="flex flex-col justify-start items-start flex-wrap md:flex-nowrap gap-[20px] mb-[15px]">
                    <h2 class="w-[100%] md:w-[155px] text-[16px] text-[#4D4D4D] font-[600]">Support Email</h2>
                    <input type="text" name="support_email" class="flex w-full px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $settingsData->support_email }}">
                </div>
                <div class="flex flex-col justify-start items-start flex-wrap md:flex-nowrap gap-[20px] mb-[15px]">
                    <h2 class="w-[100%] md:w-[155px] text-[16px] text-[#4D4D4D] font-[600]">Telegram Link</h2>
                    <input type="text" name="twitter" class="flex w-full px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $settingsData->twitter }}">
                </div>
                {{-- <div class="flex flex-col justify-start items-start flex-wrap md:flex-nowrap gap-[20px] mb-[15px]">
                    <h2 class="w-[100%] md:w-[155px] text-[16px] text-[#4D4D4D] font-[600]">Facebook Link</h2>
                    <input type="text" name="facebook" class="w-full flex px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $settingsData->facebook }}">
                </div> --}}
                <div class="flex flex-col justify-start items-start flex-wrap md:flex-nowrap gap-[20px] mb-[15px]">
                    <h2 class="lg:w-[200px] md:w-[155px] text-[16px] text-[#4D4D4D] font-[600]">LinkedIn</h2>
                    <input type="text" name="linkedin" class="flex w-full px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $settingsData->linkedin }}">
                </div>
                <div class="flex flex-col justify-start items-start flex-wrap md:flex-nowrap gap-[20px] mb-[15px]">
                    <h2 class="w-full text-[16px] text-[#4D4D4D] font-[600]">Default Offer Image (100 * 100px)</h2>
                    <input type="file" name="default_image" class="flex w-full px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" >
                    <img height="100px" width="100px" src="{{  $settingsData->default_image }}">
                </div>
                <div class="flex flex-col gap-[10px] mt-[40px]">
                    <h2 class="text-[16px] text-[#4D4D4D] font-[600]">Default Offer Description</h2>
                    <textarea required name="default_description" class="flex px-[15px] py-[12px] min-h-[150px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" >{{ $settingsData->default_description }}</textarea>
                </div>
                {{-- <div class="flex flex-col gap-[10px] mt-[40px]">
                    <h2 class="text-[16px] text-[#4D4D4D] font-[600]">Default Offer Info Description</h2>
                    <textarea required name="default_info" class="flex px-[15px] py-[12px] min-h-[150px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" >{{ $settingsData->default_info }}</textarea>
                </div> --}}
                {{-- <div class="flex flex-col gap-[10px] mt-[40px]">
                    <h2 class="text-[16px] text-[#4D4D4D] font-[600]">Content</h2>
                    <textarea required name="content" class="flex px-[15px] py-[12px] min-h-[150px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" >{{ $settingsData->content }}</textarea>
                </div> --}}

                <div class="flex gap-[10px] md:gap-[20px] mt-[10px]">
                    <button type="submit" class="flex items-center justify-center w-[110px] md:w-[170px] px-[4px] py-[12px] md:px-[15px] md:py-[15px] rounded-[5px] bg-[#49FB53]  text-[12px] md:text-[14px] font-[500] text-[#000]">Save Changes</button>

                    <button class="flex items-center justify-center w-[110px] md:w-[170px] px-[4px] py-[12px] md:px-[15px] md:py-[15px] rounded-[5px] bg-[#ffe3e3]  text-[14px] font-[500] text-[#f00000]">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
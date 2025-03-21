@extends('layouts.default')
@section('content')

<div class="bg-[#f2f2f2] p-[15px] lg:p-[35px]">
    <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[10px] mb-[20px]">
        <div class="flex gap-[15px] items-start justify-between">
            <div class="w-[15%]" style="width:15%;">
                <h2 class="text-[30px] font-[600] text-[#000] mb-[25px]">Postback</h2>
                <ul class="w-full">
                    <li class="border-b-[1px] border-b-[#ccc]">
                    <button class="w-full block p-[8px] tab-button px-4 py-2 text-gray-600 border-b-2 border-transparent hover:border-blue-500 focus:border-blue-500 active-tab text-left" href="#">Post Back</button>
                    </li>

                    <li class="border-b-[1px] border-b-[#ccc]">
                    <button class="w-full block p-[8px] tab-button px-4 py-2 text-gray-600 border-b-2 border-transparent hover:border-blue-500 focus:border-blue-500 text-left"  href="#">Global Post</button>
                    </li>
                </ul>
            </div>

            <div class="w-[75%]" style="width:75%;">
                <div class="tab-content">
                    <h2 class="text-[35px] text-[#000] mb-[20px] font-[600]">Post Back</h2>
                    <p class="text-[15px] text-[#000] mb-[20px]">Efficiently syndicate flexible content via cost effective initiatives completely leverage vertical quality. 
        Turn your mobile visitors into your best customers.</p>
                        <div class="mt-[20px]">
                            <ul class="flex items-start flex-wrap">
                                <li class="flex items-start gap-[15px] border-b-[1px] border-b-[#ccc] px-[10px] py-[10px]">
                                    <label for=""  style="width:25%;" class="w-[20%] min-w-[200px] text-[15px] text-[#000] mb-[0]">User Name</label>
                                    <p  style="width:70%;" class="w-[70%] text-[15px] text-[#000] mb-[0]">Efficiently syndicate flexible content via cost effective initiatives completely leverage vertical quality.
        Turn your mobile visitors into your best customers.</p>
                                </li>
                                <li class="flex items-start gap-[15px] border-b-[1px] border-b-[#ccc] px-[10px] py-[10px]">
                                    <label for=""  style="width:25%;" class="w-[20%] min-w-[200px] text-[15px] text-[#000] mb-[0]">User Name</label>
                                    <p  style="width:70%;" class="w-[70%] text-[15px] text-[#000] mb-[0]">Efficiently syndicate flexible content via cost effective initiatives completely leverage vertical quality.
        Turn your mobile visitors into your best customers.</p>
                                </li>
                            </ul>
                    </div>
                </div>


                    <div class="tab-content hidden">
                    <h2 class="text-[35px] text-[#000] mb-[20px] font-[600]">Global Post</h2>
                    <p class="text-[15px] text-[#000] mb-[20px]">Efficiently syndicate flexible content via cost effective initiatives completely leverage vertical quality. Efficiently syndicate flexible content via cost effective initiatives completely leverage vertical quality. Turn your mobile visitors into your best customers.
        Turn your mobile visitors into your best customers.</p>
                        <div class="mt-[20px]">
                            <ul class="flex items-start flex-wrap">
                                <li class="flex items-start gap-[15px] border-b-[1px] border-b-[#ccc] px-[10px] py-[10px]">
                                    <label for=""  style="width:25%;" class="w-[20%] min-w-[200px] text-[15px] text-[#000] mb-[0]">User Name</label>
                                    <p  style="width:70%;" class="w-[70%] text-[15px] text-[#000] mb-[0]">Efficiently syndicate flexible content via cost effective initiatives completely leverage vertical quality.
        Turn your mobile visitors into your best customers.</p>
                                </li>
                               
                            </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@extends('layouts.default')
@section('content')
<div class="bg-[#f2f2f2] p-[15px] md:p-[35px]">
    <form method="POST" action={{ route('apps.add',['id'=>$id]) }} id="appForm">
        @csrf
        <input type="hidden" id="original_app_url" value="{{ $appData->appUrl }}">
        <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[8px] md:rounded-[10px]">
            <h2 class="mb-[20px] text-[20px] text-[#1A1A1A] font-[600] ">
                Basic Information 
            </h2>  
            <div class="flex flex-wrap gap-x-[18px] lg:gap-x-[20px] gap-y-[30px] w-[100%] ">
                <div class="flex flex-col gap-[10px] w-[100%] md:w-[31%] 2xl:md:w-[32%]">
                    <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">App Name <div class="text-[#F23765] mt-[-2px]">*</div></label>
                    <input type="text" name="appname" required class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $appData->appName }}">
                    <div class="text-[12px] text-[#A1A1A1] leading-[10px]">Your App/Game/site name.</div>
                </div>

                <div class="flex flex-col gap-[10px] w-[100%]  md:w-[31%] 2xl:md:w-[32%]">
                    <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">App URL <div class="text-[#F23765] mt-[-2px]">*</div></label>
                    <input type="url" name="appurl" id="app_url" required class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ old('url', $appData->appUrl) }}">
                    <div class="text-[12px] text-[#A1A1A1] leading-[10px]">Your website domain or AppStore link of your app.</div>
                </div>

                <div class="flex flex-col gap-[10px] w-[100%]  md:w-[31%] 2xl:md:w-[32%]">
                    <label class="flex items-center gap-[5px] text-[14] text-[#898989]">Currency Name Singular <div class="text-[#F23765] mt-[-2px]">*</div></label>
                    <input type="text" name="currencyname" required class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $appData->currencyName }}">
                    <div class="text-[12px] text-[#A1A1A1] leading-[10px]">Name your currency</div>
                </div>


                <div class="flex flex-col gap-[10px] w-[100%]  md:w-[31%] 2xl:md:w-[32%]">
                    <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Currency Name Plural <div class="text-[#F23765] mt-[-2px]">*</div></label>
                    <input type="text" required name="currencynamep" class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $appData->currencyNameP }}">
                    <div class="text-[12px] text-[#A1A1A1] leading-[10px]">Name of your currency as a plural.</div>
                </div>

                <div class="flex flex-col gap-[10px] w-[100%]  md:w-[31%] 2xl:md:w-[32%]">
                    <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Currency Value <div class="text-[#F23765] mt-[-2px]">*</div></label>
                    <input type="text" name="currencyvalue" required class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $appData->currencyValue }}">
                    <div class="text-[12px] text-[#A1A1A1] leading-[15px]">How many of your game/app currency units will a user earn for $1.00? </div>
                </div>

                <div class="flex flex-col gap-[10px] w-[100%]  md:w-[31%] 2xl:md:w-[32%]">
                    <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Rounding <div class="text-[#F23765] mt-[-2px]">*</div></label>
                    <select name="rounding" required class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none">
                        <option value="">Select Option</option>
                        <option value="0" @if($appData->rounding==null || $appData->rounding==0) selected @endif>No Decimals</option>
                        <option value="1" @if($appData->rounding==1) selected @endif>One Decimal</option>
                        <option value="2" @if($appData->rounding==2) selected @endif>Two Decimals</option>
                    </select>
                    
                    <div class="text-[12px] text-[#A1A1A1] leading-[15px]">How many decimals your currency has.. </div>
                </div>
            </div>
        </div>

        <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[8px] md:rounded-[10px] mt-[30px]">
            <h2 class="mb-[20px] text-[20px] text-[#1A1A1A] font-[600] ">
                Postback 
            </h2>  
            <div class="flex flex-wrap gap-x-[20px] gap-y-[30px] w-[100%] ">
                <div class="flex flex-col gap-[10px] w-[100%] ">
                    <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Postback URL <div class="text-[#F23765] mt-[-2px]">*</div></label>
                    <input type="url" name="postback" required class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $appData->postback }}" id="postbackInput" onkeyup="checkPostbackParams()">
                    <div id="paramCheckMessage" class="text-[12px] text-[#A1A1A1] leading-[15px]"></div>
                   
                </div>
            </div>
            <div class="flex gap-[10px] md:gap-[20px] mt-[15px]">
                <button type="submit" class="w-[120px] bg-[#49fb53] px-[10px] py-[11px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#000] text-center">Save</button>
            </div>
        </div>
    </form>
</div>
<script>
    function checkPostbackParams() {
        let input = document.getElementById("postbackInput").value;
        let message = document.getElementById("paramCheckMessage");
        
        // Define the parameters you want to check
        let params = ["{user_id}", "{reward}", "{status}", "{payout}", "{offer_id}", "{offer_name}", "{goal}", "{device_type}", "{geo}", "{ip}", "{os}", "{user_agent}", "{click_id}", "{app_id}", "{tracking_id}"];
        
        // Check if any parameter exists in the input value
        let foundParams = params.filter(param => input.includes(param));

        if (foundParams.length > 0) {
            message.innerText = "";
            message.style.color = "green";
        } else {
            message.innerText = "No tracking parameters found.";
            message.style.color = "red";
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('appForm'); // Replace with your form ID
        const originalUrl = document.getElementById('original_app_url').value;
        const appUrlInput = document.getElementById('app_url');

        form.addEventListener('submit', function (e) {
            if (originalUrl !== appUrlInput.value) {
                e.preventDefault(); // Stop the form for now

                if (confirm("⚠️ URL Change Detected\n\nYou are changing the app URL. The offerwall will be paused until the new URL is reviewed and approved by our team.\n\nPlease confirm to submit it for review.")) {
                    form.submit(); // Proceed if confirmed
                }else{
                    $('#app_url').val(originalUrl);
                }
            }
        });
    });
</script>
@stop
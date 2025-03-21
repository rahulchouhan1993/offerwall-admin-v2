@extends('layouts.default')
@section('content')
<div class="bg-[#f2f2f2] p-[15px] md:p-[35px]">
    <div class="flex items-start flex-wrap xl:flex-nowrap gap-[20px] justify-between">
        <div class="w-[100%] xl:w-[40%] bg-[#fff] p-[15px] md:p-[20px] rounded-[8px] md:rounded-[10px]">
            <h2 class="mb-[20px] text-[20px] text-[#1A1A1A] font-[600] ">
                The Cash Bag
            </h2>

            <div class="w-full flex flex-col flex-wrap  w-[100%] ">
                <div class="flex items-center justify-between py-[20px] gap-[15px] border-b-[1px] border-b-[#E6E6E6]">
                    <div class="flex flex-col md:flex-row flex-wrap md:flex-nowrap items-center justify-between gap-[10px]">
                        <div
                            class="flex items-center justify-between w-[46px] h-[46px] bg-[#F5EAF5] px-[2px] py-[1px] rounded-[4px] text-[14px] font-[500] text-[#D272D2] text-center">
                            <svg class="m-auto" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.25778 1.20259C5.25778 0.980636 5.16961 0.767776 5.01267 0.610834C4.85573 0.453892 4.64287 0.365723 4.42092 0.365723C4.19897 0.365723 3.98611 0.453892 3.82916 0.610834C3.67222 0.767776 3.58405 0.980636 3.58405 1.20259V3.22891C2.77002 3.34435 2.01612 3.72301 1.43748 4.3071C0.858835 4.89118 0.487238 5.64859 0.379424 6.46367L0.282347 7.1923C0.265982 7.31504 0.250361 7.43852 0.235483 7.56275C0.226485 7.64005 0.233991 7.71838 0.257506 7.79257C0.281021 7.86676 0.32001 7.93511 0.371897 7.99311C0.423784 8.05112 0.487388 8.09745 0.558507 8.12906C0.629626 8.16066 0.706642 8.17681 0.784466 8.17645H19.2167C19.2945 8.17681 19.3715 8.16066 19.4426 8.12906C19.5137 8.09745 19.5773 8.05112 19.6292 7.99311C19.6811 7.93511 19.7201 7.86676 19.7436 7.79257C19.7671 7.71838 19.7746 7.64005 19.7656 7.56275L19.7188 7.1923L19.6217 6.46367C19.5139 5.64859 19.1423 4.89118 18.5636 4.3071C17.985 3.72301 17.2311 3.34435 16.4171 3.22891V1.20259C16.4171 0.980636 16.3289 0.767776 16.172 0.610834C16.015 0.453892 15.8022 0.365723 15.5802 0.365723C15.3583 0.365723 15.1454 0.453892 14.9885 0.610834C14.8315 0.767776 14.7433 0.980636 14.7433 1.20259V3.06377C11.5881 2.7833 8.41416 2.7833 5.2589 3.06377L5.25778 1.20259ZM19.981 10.3813C19.9758 10.2382 19.9151 10.1028 19.8118 10.0037C19.7085 9.90455 19.5707 9.8495 19.4276 9.85017H0.57246C0.429298 9.8495 0.291489 9.90455 0.188196 10.0037C0.084903 10.1028 0.0242296 10.2382 0.0190147 10.3813C-0.0469646 12.4006 0.0763136 14.4216 0.387234 16.4179C0.501829 17.1533 0.857497 17.8299 1.39837 18.3413C1.93924 18.8527 2.63466 19.1699 3.3754 19.2431L4.70657 19.3748C8.22697 19.7207 11.773 19.7207 15.2934 19.3748L16.6246 19.2431C17.3654 19.1699 18.0608 18.8527 18.6016 18.3413C19.1425 17.8299 19.4982 17.1533 19.6128 16.4179C19.9237 14.4216 20.047 12.4006 19.981 10.3813Z"
                                    fill="#D272D2" />
                            </svg>
                        </div>
                        <h2 class="text-[#898989] text-[14px] font-[500]">Status</h2>
                    </div>
                    <div
                        class="inline-flex bg-[#F3FEE7] border border-[#BCEE89] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#6EBF1A] text-center uppercase">
                        Approved</div>
                </div>

                <div class="flex items-center justify-between py-[20px] gap-[15px] border-b-[1px] border-b-[#E6E6E6]">
                    <div class="flex flex-col md:flex-row flex-wrap md:flex-nowrap items-center justify-between gap-[10px]">
                        <div
                            class="flex items-center justify-between w-[46px] h-[46px] bg-[#F5EAF5] px-[2px] py-[1px] rounded-[4px] text-[14px] font-[500] text-[#D272D2] text-center">
                            <svg class="m-auto" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.25778 1.20259C5.25778 0.980636 5.16961 0.767776 5.01267 0.610834C4.85573 0.453892 4.64287 0.365723 4.42092 0.365723C4.19897 0.365723 3.98611 0.453892 3.82916 0.610834C3.67222 0.767776 3.58405 0.980636 3.58405 1.20259V3.22891C2.77002 3.34435 2.01612 3.72301 1.43748 4.3071C0.858835 4.89118 0.487238 5.64859 0.379424 6.46367L0.282347 7.1923C0.265982 7.31504 0.250361 7.43852 0.235483 7.56275C0.226485 7.64005 0.233991 7.71838 0.257506 7.79257C0.281021 7.86676 0.32001 7.93511 0.371897 7.99311C0.423784 8.05112 0.487388 8.09745 0.558507 8.12906C0.629626 8.16066 0.706642 8.17681 0.784466 8.17645H19.2167C19.2945 8.17681 19.3715 8.16066 19.4426 8.12906C19.5137 8.09745 19.5773 8.05112 19.6292 7.99311C19.6811 7.93511 19.7201 7.86676 19.7436 7.79257C19.7671 7.71838 19.7746 7.64005 19.7656 7.56275L19.7188 7.1923L19.6217 6.46367C19.5139 5.64859 19.1423 4.89118 18.5636 4.3071C17.985 3.72301 17.2311 3.34435 16.4171 3.22891V1.20259C16.4171 0.980636 16.3289 0.767776 16.172 0.610834C16.015 0.453892 15.8022 0.365723 15.5802 0.365723C15.3583 0.365723 15.1454 0.453892 14.9885 0.610834C14.8315 0.767776 14.7433 0.980636 14.7433 1.20259V3.06377C11.5881 2.7833 8.41416 2.7833 5.2589 3.06377L5.25778 1.20259ZM19.981 10.3813C19.9758 10.2382 19.9151 10.1028 19.8118 10.0037C19.7085 9.90455 19.5707 9.8495 19.4276 9.85017H0.57246C0.429298 9.8495 0.291489 9.90455 0.188196 10.0037C0.084903 10.1028 0.0242296 10.2382 0.0190147 10.3813C-0.0469646 12.4006 0.0763136 14.4216 0.387234 16.4179C0.501829 17.1533 0.857497 17.8299 1.39837 18.3413C1.93924 18.8527 2.63466 19.1699 3.3754 19.2431L4.70657 19.3748C8.22697 19.7207 11.773 19.7207 15.2934 19.3748L16.6246 19.2431C17.3654 19.1699 18.0608 18.8527 18.6016 18.3413C19.1425 17.8299 19.4982 17.1533 19.6128 16.4179C19.9237 14.4216 20.047 12.4006 19.981 10.3813Z"
                                    fill="#D272D2" />
                            </svg>
                        </div>
                        <h2 class="text-[#898989] text-[14px] font-[500]">API Key</h2>
                    </div>
                    <h3 class="text-[14px] text-[#4D4D4D] font-[500]">650acd8a5935b360681156</h3>
                </div>
            </div>
        </div>

        <div class="w-[100%] xl:w-[60%] bg-[#fff] p-[15px] md:p-[20px] rounded-[8px] md:rounded-[10px]">
            <h2 class="mb-[20px] text-[20px] text-[#1A1A1A] font-[600] ">
                Offerwall integration
            </h2>

            <h3 class="flex justify-start gap-[10px] text-[12px] text-[#808080] mb-[30px]"><span>Difficulty: Easy
                    Time</span> <span>Required: 15-30min</span></h3>
            <p class="text-[14px] text-[#808080]">Replace [USER_ID] with the ID of the user in your App. Optionally
                provide &gender= and &age= to improve demographic targeting. See the full list of optional offerwall
                parameters, here.</p>

            <div class="mt-[18px]">
                <h2 class="mb-[10px] text-[20px] text-[#1A1A1A] font-[600] uppercase ">
                    Offerwall
                </h2>

                <code
                    class="flex items-center justify-center bg-[#1E233B]  rounded-[8px] px-[8px] py-[8px] md:px-[15px] md:py-[15px] text-[12px] md:text-[14px] text-[#FFFFFF]"
                    data-lang="html">

                            &lt;iframe style="width:100%; height:800px; border:0; padding:0; margin:0;" scrolling="yes" "frameborder="0" src="https://earn.wannads.com/wall? apiKey=650acd8a5935b360681156&userId= (USER_ID]">&gt;&lt;/iframe&gt;
                   
                    </code>
            </div>

            <div class="mt-[18px] mb-[15px]">
                <h2 class="mb-[10px] text-[20px] text-[#1A1A1A] font-[600] uppercase ">
                    Surveywall
                </h2>

                <code
                    class="flex items-center justify-center bg-[#1E233B]  rounded-[8px] px-[8px] py-[8px] md:px-[15px] md:py-[15px] text-[12px] md:text-[14px] text-[#FFFFFF]"
                    data-lang="html">

                            &lt;iframe style="width:100%; height:800px; border:0; padding:0; margin:0;" scrolling="yes" "frameborder="0" src="https://earn.wannads.com/wall? apiKey=650acd8a5935b360681156&userId= (USER_ID]">&gt;&lt;/iframe&gt;
                   
                    </code>
            </div>

            <p class="text-[14px] text-[#808080]">This is the simplest integration method, if you would like to use our
                API or other integration options, please, check our documentation.</p>
        </div>
    </div>
</div>


@stop
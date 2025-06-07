@extends('layouts.default')
@section('content')
<div class="bg-[#f2f2f2] p-[15px] md:p-[35px] custom_form_design">
    <form>

        <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[8px] md:rounded-[10px]">

            <div
                class="my-[20px] p-[15px] rounded-[8px] md:rounded-[10px] flex flex-wrap items-center grid grid-cols-2 bg-[#f7f7f7]">
                <div class="">
                    <strong>Name:</strong> ahdouhiho
                </div>
                <div class="">
                    <strong>Email:</strong> admin@gmail.com
                </div>
            </div>

            <h2 class="mb-[20px] text-[20px] text-[#1A1A1A] font-[600] ">
                Payment Details
            </h2>

            <div class="space-y-4">

                <!-- Accordion Item: Bank -->
                <div class="border rounded-lg">
                    <button type="button" class="w-full text-left p-4 font-medium text-gray-800 flex justify-between items-center"
                        onclick="toggleAccordion('bank')">
                        <span class="inline-flex items-center gap-[5px]">
                            Bank Transfer
                            <svg class="w-[20px] h-[20px]" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.99733 4.66667H8.00333M2.66667 6.66667V12.3333M5.33333 6.66667V12.3333M10.6667 6.66667V12.3333M13.3333 6.66667V12.3333M1.33333 5.71333C1.33333 4.91533 1.65467 4.42667 2.32 4.056L5.06 2.53133C6.49533 1.73333 7.21333 1.33333 8 1.33333C8.78667 1.33333 9.50467 1.73333 10.94 2.53133L13.68 4.056C14.3447 4.42667 14.6667 4.91533 14.6667 5.71333C14.6667 5.92933 14.6667 6.038 14.6433 6.12667C14.5193 6.59333 14.096 6.66733 13.6873 6.66733H2.31267C1.904 6.66733 1.48133 6.594 1.35667 6.12667C1.33333 6.03733 1.33333 5.92933 1.33333 5.71333ZM12.6667 12.3333H3.33333C2.8029 12.3333 2.29419 12.544 1.91912 12.9191C1.54405 13.2942 1.33333 13.8029 1.33333 14.3333C1.33333 14.4217 1.36845 14.5065 1.43096 14.569C1.49348 14.6315 1.57826 14.6667 1.66667 14.6667H14.3333C14.4217 14.6667 14.5065 14.6315 14.569 14.569C14.6315 14.5065 14.6667 14.4217 14.6667 14.3333C14.6667 13.8029 14.456 13.2942 14.0809 12.9191C13.7058 12.544 13.1971 12.3333 12.6667 12.3333Z" stroke="#1F2937" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                
                        </span>
                        <span class="text-xl" id="icon-bank">−</span>
                    </button>
                    <div id="body-bank" class="p-4 pt-0 space-y-4 block">
                        <div class="accordion-body gap-y-[30px]">
                            <div
                                class="relative flex-wrap mb-[20px] border-[1px] p-[15px] rounded-[10px] flex gap-[15px] w-full">

                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Account Number
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">IFSC Code
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>

                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Account Holder
                                        Name
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Bank Nickname
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>

                            </div>
                            <div class="flex gap-[10px] md:gap-[20px] ">

                                <button type="submit"
                                    class="w-[120px] bg-[#4EF953] px-[10px] py-[11px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#fff] text-center">Proceed</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accordion Item: Credit Card -->
                <div class="border rounded-lg">
                    <button type="button" class="w-full text-left p-4 font-medium text-gray-800 flex justify-between items-center"
                        onclick="toggleAccordion('credit')">
                        <span class="inline-flex items-center gap-[5px]">
                            Credit Card
                            <svg class="w-[20px] h-[20px]" width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.33333 0.333332H11C11.5304 0.333332 12.0391 0.544046 12.4142 0.919119C12.7893 1.29419 13 1.8029 13 2.33333V8.33333C13 8.86377 12.7893 9.37247 12.4142 9.74755C12.0391 10.1226 11.5304 10.3333 11 10.3333H2.33333C1.8029 10.3333 1.29419 10.1226 0.91912 9.74755C0.544047 9.37247 0.333333 8.86377 0.333333 8.33333V2.33333C0.333333 1.8029 0.544047 1.29419 0.91912 0.919119C1.29419 0.544046 1.8029 0.333332 2.33333 0.333332ZM2.33333 0.999999C1.97971 0.999999 1.64057 1.14047 1.39052 1.39052C1.14048 1.64057 1 1.97971 1 2.33333V3H12.3333V2.33333C12.3333 1.97971 12.1929 1.64057 11.9428 1.39052C11.6928 1.14047 11.3536 0.999999 11 0.999999H2.33333ZM1 8.33333C1 8.68695 1.14048 9.02609 1.39052 9.27614C1.64057 9.52619 1.97971 9.66667 2.33333 9.66667H11C11.3536 9.66667 11.6928 9.52619 11.9428 9.27614C12.1929 9.02609 12.3333 8.68695 12.3333 8.33333V5H1V8.33333ZM2.33333 7.66667H5V8.33333H2.33333V7.66667ZM6.33333 7.66667H8.33333V8.33333H6.33333V7.66667ZM1 3.66667V4.33333H12.3333V3.66667H1Z" fill="#1F2937"/>
                                </svg>
                                
                        </span>
                        <span class="text-xl" id="icon-credit">+</span>
                    </button> 
                    <div id="body-credit" class="p-4 pt-0 space-y-4 hidden">
                        <div class="accordion-body gap-y-[30px]">

                            <div
                                class="relative flex-wrap mb-[20px] border-[1px] p-[15px] rounded-[10px] flex gap-[15px] w-full">

                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Card
                                        Number
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Valid
                                        Through (MM/YY)
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>

                                    <input type="text" placeholder="MM/YY" maxlength="5"
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] p-[10px] text-[14px] text-[#4D4D4D] !outline-none focus:!outline-none"
                                        oninput="formatExpiry(this)" />
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Name on
                                        Card
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Name
                                        Nickname(for easy identification)
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>

                            </div>
                            <div class="flex gap-[10px] md:gap-[20px] ">

                                <button type="submit"
                                    class="w-[120px] bg-[#4EF953] px-[10px] py-[11px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#fff] text-center">Proceed</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accordion Item: Debit Card -->
                <div class="border rounded-lg">
                    <button type="button" class="w-full text-left p-4 font-medium text-gray-800 flex justify-between items-center"
                        onclick="toggleAccordion('debit')">
                        <span class="inline-flex items-center gap-[5px]">
                            Debit Card
                            <svg class="w-[20px] h-[20px]" width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.33333 0.333332H11C11.5304 0.333332 12.0391 0.544046 12.4142 0.919119C12.7893 1.29419 13 1.8029 13 2.33333V8.33333C13 8.86377 12.7893 9.37247 12.4142 9.74755C12.0391 10.1226 11.5304 10.3333 11 10.3333H2.33333C1.8029 10.3333 1.29419 10.1226 0.91912 9.74755C0.544047 9.37247 0.333333 8.86377 0.333333 8.33333V2.33333C0.333333 1.8029 0.544047 1.29419 0.91912 0.919119C1.29419 0.544046 1.8029 0.333332 2.33333 0.333332ZM2.33333 0.999999C1.97971 0.999999 1.64057 1.14047 1.39052 1.39052C1.14048 1.64057 1 1.97971 1 2.33333V3H12.3333V2.33333C12.3333 1.97971 12.1929 1.64057 11.9428 1.39052C11.6928 1.14047 11.3536 0.999999 11 0.999999H2.33333ZM1 8.33333C1 8.68695 1.14048 9.02609 1.39052 9.27614C1.64057 9.52619 1.97971 9.66667 2.33333 9.66667H11C11.3536 9.66667 11.6928 9.52619 11.9428 9.27614C12.1929 9.02609 12.3333 8.68695 12.3333 8.33333V5H1V8.33333ZM2.33333 7.66667H5V8.33333H2.33333V7.66667ZM6.33333 7.66667H8.33333V8.33333H6.33333V7.66667ZM1 3.66667V4.33333H12.3333V3.66667H1Z" fill="#1F2937"/>
                                </svg>
                        </span>
                        <span class="text-xl" id="icon-debit">+</span>
                    </button>
                    <div id="body-debit" class="p-4 pt-0 space-y-4 hidden">
                        <div class="accordion-body gap-y-[30px]">

                            <div
                                class="relative flex-wrap mb-[20px] border-[1px] p-[15px] rounded-[10px] flex gap-[15px] w-full">

                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Card
                                        Number
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Valid
                                        Through (MM/YY)
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>

                                    <input type="text" placeholder="MM/YY" maxlength="5"
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] p-[10px] text-[14px] text-[#4D4D4D] !outline-none focus:!outline-none"
                                        oninput="formatExpiry(this)" />
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Name on
                                        Card
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Name
                                        Nickname(for easy identification)
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>

                            </div>
                            <div class="flex gap-[10px] md:gap-[20px] ">
    
                                <button type="submit"
                                    class="w-[120px] bg-[#4EF953] px-[10px] py-[11px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#fff] text-center">Proceed</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accordion Item: UPI -->
                <div class="border rounded-lg">
                    <button type="button" class="w-full text-left p-4 font-medium text-gray-800 flex justify-between items-center"
                        onclick="toggleAccordion('upi')">
                        <span class="inline-flex items-center gap-[5px]">
                            UPI
                            <svg class="w-[20px] h-[20px]" width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.66667 6.79467H6.25667V5.41067H7.872C8.06933 5.41067 8.23822 5.34022 8.37867 5.19933C8.51911 5.05889 8.58933 4.89 8.58933 4.69267V3.92333C8.58933 3.726 8.51911 3.55689 8.37867 3.416C8.23822 3.27555 8.06933 3.20533 7.872 3.20533H5.66667V6.79467ZM9.51333 6.79467H10.1027V3.20533H9.51267L9.51333 6.79467ZM6.25667 4.82067V3.79467H7.79467C7.84622 3.79467 7.89333 3.81622 7.936 3.85933C7.97867 3.902 8 3.94889 8 4V4.61533C8 4.66689 7.97867 4.714 7.936 4.75667C7.89333 4.79933 7.84622 4.82067 7.79467 4.82067H6.25667ZM2.53867 6.79467H4.02533C4.22311 6.79467 4.39222 6.72444 4.53267 6.584C4.67356 6.44355 4.744 6.27467 4.744 6.07733V3.20533H4.15333V6C4.15333 6.05155 4.132 6.09867 4.08933 6.14133C4.04667 6.184 3.99956 6.20533 3.948 6.20533H2.61467C2.56356 6.20533 2.51667 6.184 2.474 6.14133C2.43133 6.09867 2.41 6.05155 2.41 6V3.20533H1.82V6.07733C1.82 6.27467 1.89022 6.44355 2.03067 6.584C2.17156 6.72444 2.34044 6.79467 2.53733 6.79467M1.07733 9.66667C0.770667 9.66667 0.514445 9.564 0.308667 9.35867C0.102889 9.15333 0 8.89689 0 8.58933V1.41067C0 1.10355 0.102889 0.847332 0.308667 0.641999C0.514445 0.436665 0.770444 0.333777 1.07667 0.333332H10.9233C11.23 0.333332 11.486 0.436221 11.6913 0.641999C11.8967 0.847776 11.9996 1.104 12 1.41067V8.59C12 8.89667 11.8971 9.15289 11.6913 9.35867C11.4856 9.56444 11.2296 9.66711 10.9233 9.66667H1.07733Z" fill="#1F2937"/>
                                </svg>
                                
                        </span>
                        <span class="text-xl" id="icon-upi">+</span>
                    </button>
                    <div id="body-upi" class="p-4 space-y-4 hidden">
                        <div class="accordion-body gap-y-[30px]">
                            <div
                                class="relative flex-wrap mb-[20px] border-[1px] p-[15px] rounded-[10px] flex gap-[15px] w-full">

                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">UPI ID (e.g.
                                        name@bank)
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>

                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Name on
                                        Card
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">UPI Nickname
                                        <div class="text-[#F23765] mt-[-2px]">*</div>
                                    </label>
                                    <input type="text" name="" id=""
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none">
                                </div>

                            </div>
                            <div class="flex gap-[10px] md:gap-[20px] ">
    
                                <button type="submit"
                                    class="w-[120px] bg-[#4EF953] px-[10px] py-[11px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#fff] text-center">Proceed</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
    function toggleAccordion(id) {
        // e.preventDefault();
        const ids = ['bank', 'credit', 'debit', 'upi'];
        ids.forEach(i => {
            const body = document.getElementById(`body-${i}`);
            const icon = document.getElementById(`icon-${i}`);
            if (i === id) {
                const isOpen = !body.classList.contains('hidden');
                body.classList.toggle('hidden');
                icon.textContent = isOpen ? '+' : '−';
            } else {
                document.getElementById(`body-${i}`).classList.add('hidden');
                document.getElementById(`icon-${i}`).textContent = '+';
            }
        });
    }

    function formatExpiry(input) {
        let value = input.value.replace(/\D/g, '').slice(0, 4);
        input.value = value.length >= 3 ? value.slice(0, 2) + '/' + value.slice(2) : value;
    }
</script>

<script>
    function formatExpiry(input) {
        let value = input.value.replace(/\D/g, '').slice(0, 4); // Only digits, max 4
        if (value.length >= 2) {
            input.value = value.slice(0, 2) + '/' + value.slice(2);
        } else {
            input.value = value;
        }
    }
</script>
@stop
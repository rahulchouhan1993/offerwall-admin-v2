@extends('layouts.default')
@section('content')
<div class="bg-[#f2f2f2] p-[15px] md:p-[35px] custom_form_design">
    <form>

        <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[8px] md:rounded-[10px]">

            <div
                class="my-[20px] p-[15px] rounded-[8px] md:rounded-[10px] grid grid-cols-1 md:grid-cols-2 bg-[#f7f7f7] text-[14px]">
                <div class="">
                    <strong>Name:</strong> {{ $userDetails->name }} {{ $userDetails->last_name }}
                </div>
                <div class="">
                    <strong>Email:</strong> {{ $userDetails->email }}
                </div>
            </div>

            <h2 class="mb-[10px] md:mb-[20px] text-[16px] md:text-[20px] text-[#1A1A1A] font-[600] ">
                Payment Details
            </h2>

            <div class="space-y-4">

               @if($paymentDetails->isNotEmpty())
               @foreach ($paymentDetails as $paymentDetail)
                   <div class="border rounded-lg">
                    <button type="button" class="w-full text-left p-4 font-medium text-gray-800 flex justify-between items-center"
                        onclick="toggleAccordion('bank')">
                        <span class="inline-flex items-center gap-[5px]">
                        @if($paymentDetail->payment_method == 'wise-payment')
                            Wise Payment
                        @else
                            Now Payment
                        @endif
                            <svg class="w-[20px] h-[20px]" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.99733 4.66667H8.00333M2.66667 6.66667V12.3333M5.33333 6.66667V12.3333M10.6667 6.66667V12.3333M13.3333 6.66667V12.3333M1.33333 5.71333C1.33333 4.91533 1.65467 4.42667 2.32 4.056L5.06 2.53133C6.49533 1.73333 7.21333 1.33333 8 1.33333C8.78667 1.33333 9.50467 1.73333 10.94 2.53133L13.68 4.056C14.3447 4.42667 14.6667 4.91533 14.6667 5.71333C14.6667 5.92933 14.6667 6.038 14.6433 6.12667C14.5193 6.59333 14.096 6.66733 13.6873 6.66733H2.31267C1.904 6.66733 1.48133 6.594 1.35667 6.12667C1.33333 6.03733 1.33333 5.92933 1.33333 5.71333ZM12.6667 12.3333H3.33333C2.8029 12.3333 2.29419 12.544 1.91912 12.9191C1.54405 13.2942 1.33333 13.8029 1.33333 14.3333C1.33333 14.4217 1.36845 14.5065 1.43096 14.569C1.49348 14.6315 1.57826 14.6667 1.66667 14.6667H14.3333C14.4217 14.6667 14.5065 14.6315 14.569 14.569C14.6315 14.5065 14.6667 14.4217 14.6667 14.3333C14.6667 13.8029 14.456 13.2942 14.0809 12.9191C13.7058 12.544 13.1971 12.3333 12.6667 12.3333Z" stroke="#1F2937" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                
                        </span>
                        {{-- <span class="text-xl" id="icon-bank">−</span> --}}
                    </button>
                    <div id="body-bank" class="p-4 pt-0 space-y-4 block">
                        <div class="accordion-body gap-y-[30px]">
                            <div
                                class="relative flex-wrap mb-[20px] border-[1px] p-[15px] rounded-[10px] flex gap-[15px] w-full">

                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">Name On Account
                                    </label>
                                    <input type="text" 
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none" value="{{ $paymentDetail->account_name }}" disabled>
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">IBAN
                                    </label>

                                    <input type="text" 
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none" value="{{ $paymentDetail->iban }}" disabled>
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">ABA Routing Number
                                    </label>
                                    <input type="text" 
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none" value="{{ $paymentDetail->routing_number }}" disabled>
                                </div>
                                <div class="md:flex-wrap flex flex-col gap-[5px] w-full md:w-[48%] xl:w-[48%] ">
                                    <label for=""
                                        class="flex items-center gap-[5px] text-[14px] text-[#898989]">SWIFT
                                    </label>
                                    <input type="text"
                                        class="bg-transparent border-[1px] border-[solid] border-[#e9e9e9] h-[45px] rounded-[5px] text-[14px] text-[#4D4D4D] p-[10px] !outline-none focus:!outline-none" value="{{ $paymentDetail->swift }}" disabled>
                                </div>

                            </div>
                            {{-- <div class="flex gap-[10px] md:gap-[20px] ">

                                <button type="submit"
                                    class="w-[120px] bg-[#4EF953] px-[10px] py-[11px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#fff] text-center">Proceed</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
               @endforeach
               @endif

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
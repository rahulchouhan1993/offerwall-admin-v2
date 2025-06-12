@extends('layouts.default')
@section('content')

    <div class="w-full bg-[#f7f7f7] px-4 py-6">
        <div class="mx-auto w-full max-w-[700px] bg-white p-6 md:p-10 rounded-[12px] text-sm text-[#333]">
            <!-- Header Section -->
            <div class="mb-[50px]">
                <!-- Logo -->
                <img src="/images/logo.png" alt="Company Logo" class="min-h-[26px] object-contain">
                {{-- <img
          src="https://modernsoftwaretechnologies.com/wp-content/uploads/2025/05/logo-1.png"
          alt="Company Logo"
          class="mb-4 max-w-[140px]"
        /> --}}
            </div>
            <div class="flex flex-col sm:flex-row justify-between items-start mb-10 gap-6">
                <!-- Left: Logo + Vendor Info -->
                <div class="w-full sm:w-[40%] md:w-1/2">
                    <h2 class="font-bold text-base mb-2">SELF-BILLED INVOICE</h2>
                    <div class="font-medium text-xs leading-[14px]">Sold by/Vendor</div>
                    <div class="mt-1 leading-6 text-xs leading-[14px]">
                        Simple MM d.o.o<br />
                        Nedeligka Merdovica b.b<br />
                        BEJILO POLJE<br />
                        MONTENEGRO<br />
                        VAT 03274233
                    </div>
                </div>

                <!-- Right: Invoice Info + Purchaser Info (stacked) -->
                <div class="w-full sm:w-[60%] md:w-1/2 grid grid-cols-2 text-start space-y-4 sm:space-y-0">
                    <!-- Invoice Details -->
                    <div class="space-y-2 text-xs leading-[15px]">
                        <div>
                            <div class="font-bold">Invoice Date</div>
                            <div>30 Apr 2025</div>
                        </div>
                        <div>
                            <div class="font-bold">Invoice Due Date</div>
                            <div>31 May 2025</div>
                        </div>
                        <div>
                            <div class="font-bold">Invoice Number</div>
                            <div>Self-Bill20250649</div>
                        </div>
                    </div>
                    <!-- Purchaser Info -->
                    <div class="space-y-1">
                        <div class="font-bold">Created by/Purchaser</div>
                        <div class="leading-6 text-xs leading-[14px]">
                            Maka Mobile<br />
                            Herengracht 420<br />
                            AMSTERDAM NOORD-HOLLAND 1017BZ<br />
                            NETHERLANDS<br />
                            VAT No. NL858589242B01<br />
                            Business Registration: 71125957
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm min-w-[600px]">
                    <thead>
                        <tr class="border-b border-gray-400">
                            <th class="text-left py-2">Description</th>
                            <th class="text-left py-2">Quantity</th>
                            <th class="text-left py-2">Unit Price</th>
                            <th class="text-end py-2">Tax</th>
                            <th class="text-end py-2">Amount USD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-300">
                            <td class="py-2">
                                <input type="text" name="" id=""
                                    class="h-[30px] w-[250px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                    value="Advertising Services April 2025 (84 Conversions)" />
                            </td>
                            <td class="py-2">
                                <input type="number" name="" id=""
                                    class="h-[30px] w-[80px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                    value="1" />
                            </td>
                            <td class="py-2">
                                <input type="text" name="" id=""
                                    class="h-[30px] w-[80px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                    value="$187.43" />
                            </td>
                            <td class="text-end py-2">—</td>
                            <td class="text-end py-2">
                                <input type="text" name="" id=""
                                    class="text-end h-[30px] w-[80px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                    value="$187.43" />
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <button class="rounded-sm bg-[#49FB53] px-4 py-1 text-black">
                                    + add
                                </button>
                            </td>
                            <td class="border-b border-gray-400 text-end font-medium py-2">
                                Subtotal
                            </td>
                            <td class="border-b border-gray-400 text-end py-2">$187.43</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td class="border-b border-gray-400 text-end font-bold py-2">
                                TOTAL USD
                            </td>
                            <td class="border-b border-gray-400 text-end py-2 font-bold">
                                $187.43
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Notes -->
            <div class="mt-[50px] text-sm text-[#000000] leading-relaxed">
                <p class="mb-3 font-bold">Terms and conditions of the Self-Billing</p>
                <p class="mb-2">
                    The Revenue and Conversions displayed in this self-billing invoice
                    are based on the numbers displayed in Affise's dashboard. The
                    currency, the amount and the due date for the payment are based on
                    the T&C and IO.
                </p>
                <p class="mb-2">
                    Do not hesitate to contact us should you require more
                    information:<br />
                    <a href="mailto:support@makamobile.com" class="text-[#49FB53]">support@makamobile.com</a>,
                    <a href="mailto:finance@makamobile.com" class="text-[#49FB53]">finance@makamobile.com</a>.
                </p>
                <p class="mt-4 uppercase">
                    <strong>NOTE: It is your responsibility that your bank account details
                        are updated. Please contact your account manager if you have to
                        report any changes.</strong>
                </p>
            </div>
        </div>
    </div>


    {{-- <div class="w-full bg-[#f7f7f7] px-4 py-4">
    <div class="mx-auto w-full max-w-[750px] rounded-[12px] bg-white px-[15px] py-[20px] md:px-[50px] md:py-[55px]">
        <div class="flex w-full flex-col-reverse flex-wrap justify-between gap-[20px] sm:flex-row md:items-center">
            <div class="">
                <div class="max-w-[180px]">
                    
                    <div class="mt-3 border-l-[1px] border-[#d272d2] px-3">
                        <span class="text-xs text-[#888]"> Rahul Chouhan <br /> A-38 Suraj Nagar <br /> West Civil Lines Jaipur
                        </span>
                    </div>
                </div>
            </div>
            <div>
                <ul class="space-y-1 text-xs">
                    <li>
                        <div><strong>Maka Mobile </strong></div>
                    </li>
                    <li>
                        <div>Amsterdam,<br /> North Holland</div>
                    </li>
                    <li class="!my-4">
                        <div>karlboer@makamobile.com</div>
                    </li>

                    <li>
                        <div><span>KVK: </span> ASD6AS7DD</div>
                    </li>
                    <li>
                        <div><span>Btw: </span>KJDSF797AD</div>
                    </li>
                    <li>
                        <div><span>Bank: </span>Holland Bank</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-[30px] md:mt-[70px]">
            <div class="flex w-full flex-wrap items-start gap-[10px] justify-between">
                <h3 class="text-xl font-medium">Invoice <span class="text-[#999]">Concept #1</span></h3>
                <div class="text-sm text-[#555]">
                    <div><b>Invoice date:</b> 09-06-2025</div>
                    <div><b>Expiry date:</b> 23-06-2025</div>
                </div>
            </div>
            <div class="mt-[30px] overflow-x-auto">
                <table class="document-details w-full min-w-[500px] border-collapse text-sm text-[#666]">
                    <thead>
                        <tr>
                            <th class="border-b-[1px] border-[#777] p-[.4em] text-left align-top text-[#555]">#</th>
                            <th class="border-b-[1px] border-[#777] p-[.4em] text-left align-top text-[#555]">Description</th>
                            <th class="border-b-[1px] border-[#777] p-[.4em] text-left align-top text-[#555]">Amount
                            </th>
                            <th class="border-b-[1px] border-[#777] p-[.4em] text-left align-top text-[#555]">Total
                            </th>
                            <th class="border-b-[1px] border-[#777] p-[.4em] text-left align-top text-[#555]">Btw</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-b-[1px] border-[#777] p-[.4em] text-left align-top"><input
                                    type="text" name="" id=""
                                    class="h-[30px] w-[50px] md:w-[80px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                    value="1x" /></td>
                            <td class="border-b-[1px] border-[#777] p-[.4em] text-left align-top"><input
                                    type="text" name="" id=""
                                    class="h-[30px] w-[150px] md:w-[250px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                    value="Je hebt nog geen regels toegevoegd" /></td>
                            <td class="border-b-[1px] border-[#777] p-[.4em] text-left align-top"><input
                                    type="text" name="" id=""
                                    class="h-[30px] w-[80px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                    value="€ 0,00" /></td>
                            <td class="border-b-[1px] border-[#777] p-[.4em] text-left align-top"><input
                                    type="text" name="" id=""
                                    class="h-[30px] w-[80px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                    value="€ 0,00" /></td>
                            <td class="border-b-[1px] border-[#777] p-[.4em] text-left align-top"><input
                                    type="text" name="" id=""
                                    class="h-[30px] w-[80px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                    value="21%" /></td>
                        </tr>
                        <tr class="tfoot subtotal">
                            <td class="p-[.4em] text-left align-top" colspan="2">
                                <button class="rounded-sm bg-[#d272d2] px-4 py-1 text-white">+ add</button>
                            </td>
                            <td class="border-b-[1px] border-[#777] p-[.4em] text-left align-top">Sub Total</td>
                            <td class="border-b-[1px] border-[#777] p-[.4em] text-left align-top">€ 0,00</td>
                            <td class="p-[.4em] text-left align-top"></td>
                        </tr>
                        <tr class="tfoot total">
                            <td colspan="2" class="p-[.4em] text-left align-top"></td>
                            <td class="border-b-[1px] border-[#777] p-[.4em] text-left align-top">Total</td>
                            <td class="border-b-[1px] border-[#777] p-[.4em] text-left align-top">€ 0,00</td>
                            <td class="p-[.4em] text-left align-top"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-[60px] border-t-[1px] pt-[20px] text-xs text-[#000000]">This invoice is system generated, if you have any question feel free to reach out to us.</div>
        </div>
    </div>
</div> --}}
@stop

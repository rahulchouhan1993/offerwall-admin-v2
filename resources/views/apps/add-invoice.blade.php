@extends('layouts.default')
@section('content')
<div class="w-full bg-[#f7f7f7] px-4 py-4">
        <div class="mx-auto w-full max-w-[750px] rounded-[12px] bg-white px-[15px] py-[20px] md:px-[50px] md:py-[55px]">
            <div class="flex w-full flex-col-reverse flex-wrap justify-between gap-[20px] sm:flex-row md:items-center">
                <div class="">
                    <div class="max-w-[180px]">
                        {{-- <select name="" id=""
                            class="w-full appearance-none bg-[#4EF953] px-[5px] text-sm text-white outline-none focus:outline-none">
                            <option value="">1. select contact</option>
                        </select> --}}
                        <div class="mt-3 border-l-[1px] border-[#4EF953] px-3">
                            <span class="text-xs text-[#888]"> Voornaam Achternaam <br /> Adres 123 <br /> 1234AB Plaats
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
                <div class="flex w-full flex-wrap gap-[10px] items-start justify-between">
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
                                <th class="border-b-[1px] border-[#777] p-[.4em] text-left align-top text-[#555]">
                                    Description</th>
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
                                    <button class="rounded-sm bg-[#4EF953] px-4 py-1 text-white">+ Add</button>
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
    </div>

@stop
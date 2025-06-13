@extends('layouts.default')
@section('content')

    <div class="w-full bg-[#f7f7f7] px-4 py-6">
        <form id="invoice-element-tems" method="POST" action="{{ route('invoice.update') }}"> @csrf
        <div class="mx-auto w-full max-w-[850px] bg-white p-6 md:p-10 rounded-[12px] text-sm text-[#333]">
            <!-- Header Section -->
            <div class="mb-[50px]">
                <!-- Logo -->
                <img src="/images/logo.png" alt="Company Logo" class="min-h-[26px] object-contain">
            </div>
            <div class="flex flex-col sm:flex-row justify-between items-start mb-10 gap-6">
                <!-- Left: Logo + Vendor Info -->
                <div class="w-full sm:w-[40%] md:w-1/2">
                    <h2 class="font-bold text-base mb-2">SELF-BILLED INVOICE</h2>
                    <div class="font-medium text-xs leading-[14px]">Sold by/Vendor</div>
                    <div class="mt-1 leading-6 text-xs leading-[14px]">
                        {{ $invoiceDetails->user->name }} {{ $invoiceDetails->user->last_name }}<br />
                        @if(!empty($invoiceDetails->user->address_1))
                            {{ $invoiceDetails->user->address_1 }}<br />
                        @endif

                        @if(!empty($invoiceDetails->user->address_2))
                            {{ $invoiceDetails->user->address_2 }}<br />
                        @endif

                        @if(!empty($invoiceDetails->user->city) || !empty($invoiceDetails->user->country))
                            {{ $invoiceDetails->user->city }}@if(!empty($invoiceDetails->user->city) && !empty($invoiceDetails->user->country)), @endif{{ $invoiceDetails->user->country }}<br />
                        @endif

                        @if(!empty($invoiceDetails->user->zip))
                            {{ $invoiceDetails->user->zip }}
                        @endif
                    </div>
                </div>

                <!-- Right: Invoice Info + Purchaser Info (stacked) -->
                <div class="w-full sm:w-[60%] md:w-1/2 grid grid-cols-2 text-start space-y-4 sm:space-y-0">
                    <!-- Invoice Details -->
                    <div class="space-y-2 text-xs leading-[15px]">
                        <div>
                            <div class="font-bold">Invoice Date</div>
                            <div>{{ date('d M Y',strtotime($invoiceDetails->invoice_date)) }}</div>
                        </div>
                        <div>
                            <div class="font-bold">Invoice Due Date</div>
                            <div>{{ date('d M Y',strtotime($invoiceDetails->due_date)) }}</div>
                        </div>
                        <div>
                            <div class="font-bold">Invoice Number</div>
                            <div>{{ env('INVOICE_ALIAS')}}{{ date('Y',strtotime($invoiceDetails->invoice_date)) }}{{ $invoiceDetails->invoice_number }}</div>
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
                            <th class="text-left py-2">Conversions</th>
                            <th class="text-left py-2">Payout</th>
                            <th class="text-left py-2">VAT</th>
                            <th class="text-left py-2">Total</th>
                            <th class="text-left py-2">&nbsp;</th>
                        </tr>
                    </thead>
                    
                    <tbody class="invoice-items-list">
                        @if(!empty($invoiceDetails->invoicedetails))
                        <input type="hidden" name="invoice_id" value="{{ $invoiceDetails->id}}">
                        @foreach ($invoiceDetails->invoicedetails as $key=> $items)
                            <tr class="clonning-tr border-b border-gray-300">
                                <input type="hidden" name="items[{{ $key }}][rec_id]" value="{{ $items->id}}">
                                <td class="py-2">
                                    <input type="text" name="items[{{ $key }}][description]"
                                        class="h-[30px] w-[250px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                        value="{{ $items->description }}" />
                                </td>
                                <td class="py-2">
                                    <input type="number" name="items[{{ $key }}][conversion]" readonly 
                                        class="h-[30px] w-[80px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                        value="{{ $items->conversion }}" />
                                </td>
                                <td class="py-2">
                                    <input type="text" name="items[{{ $key }}][payout]"
                                        class="change-numbers payout-amount h-[30px] w-[80px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                        value="{{ $items->payout }}" />
                                </td>
                                <td class="text-end py-2">
                                    <select class="change-numbers vat-amount h-[30px] w-[80px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none" name="items[{{ $key }}][vat]">
                                        <option value="no" @if($items->vat==0) selected @endif>0%</option>
                                        <option value="21" @if($items->vat==21) selected @endif>21%</option>
                                    </select></td>
                                @php 
                                    if($items->vat>0){
                                        $totalAmount = $items->payout+(($items->payout*$items->vat)/100);
                                    }else{
                                        $totalAmount = $items->payout;
                                    }
                                @endphp
                                <td class="text-end py-2">
                                    <input type="text" disabled
                                        class="final-amount text-end h-[30px] w-[80px] rounded-[5px] border-[1px] border-[#ccc] p-2 outline-none focus:outline-none"
                                        value="{{ $totalAmount }}" />
                                </td>
                                <td class="text-end py-2">
                                    <button type="button" class="delete-invice-item rounded-[5px] flex items-center text-[17px] text-red-500">
                                    <svg class="w-[17px] h-[17px]" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 284.011 284.011"><g><g><path d="M235.732,66.214l-28.006-13.301l1.452-3.057c6.354-13.379,0.639-29.434-12.74-35.789L172.316,2.611
                                        c-6.48-3.079-13.771-3.447-20.532-1.042c-6.76,2.406-12.178,7.301-15.256,13.782l-1.452,3.057L107.07,5.106
                                        c-14.653-6.958-32.239-0.698-39.2,13.955L60.7,34.155c-1.138,2.396-1.277,5.146-0.388,7.644c0.89,2.499,2.735,4.542,5.131,5.68
                                        l74.218,35.25h-98.18c-2.797,0-5.465,1.171-7.358,3.229c-1.894,2.059-2.839,4.815-2.607,7.602l13.143,157.706
                                        c1.53,18.362,17.162,32.745,35.588,32.745h73.54c18.425,0,34.057-14.383,35.587-32.745l11.618-139.408l28.205,13.396
                                        c1.385,0.658,2.845,0.969,4.283,0.969c3.74,0,7.328-2.108,9.04-5.712l7.169-15.093C256.646,90.761,250.386,73.175,235.732,66.214z
                                        M154.594,23.931c0.786-1.655,2.17-2.905,3.896-3.521c1.729-0.614,3.59-0.521,5.245,0.267l24.121,11.455
                                        c3.418,1.624,4.878,5.726,3.255,9.144l-1.452,3.057l-36.518-17.344L154.594,23.931z M169.441,249.604
                                        c-0.673,8.077-7.55,14.405-15.655,14.405h-73.54c-8.106,0-14.983-6.328-15.656-14.405L52.35,102.728h129.332L169.441,249.604z
                                        M231.62,96.835l-2.878,6.06L83.057,33.701l2.879-6.061c2.229-4.695,7.863-6.698,12.554-4.469l128.661,61.108
                                        C231.845,86.509,233.85,92.142,231.62,96.835z"></path></g></g></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="repeat-item-invoice rounded-sm bg-[#49FB53] px-4 py-1 text-black">
                                    + Add
                                </button>
                            </td>
                            <td class="border-b border-gray-400 text-end font-medium py-2">
                                Subtotal
                            </td>
                            <td class="border-b border-gray-400 text-end py-2 sub-total">$ 0.00</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td class="border-b border-gray-400 text-end font-medium py-2">
                                Vat
                            </td>
                            <td class="border-b border-gray-400 text-end py-2 sub-vat">$ 0.00</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td class="border-b border-gray-400 text-end font-bold py-2">
                                TOTAL
                            </td>
                            <td class="border-b border-gray-400 text-end py-2 font-bold grand-total">
                                $ 0.00
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
        <button  type="submit" class="px-[10px] py-[10px] w-[160px] flex justify-center text-center text-[15px] text-[#000] bg-[#49FB53] rounded-[8px]">Save</button>
    </form>
    </div>
<script>
    
    $(document).ready(function(){
        $('.vat-amount').trigger('change');;
    });
    $(document).on('click', '.repeat-item-invoice', function () {
        var $tableBody = $('table tbody');
        var $lastRow = $tableBody.find('tr:last');
        var $clonedRow = $lastRow.clone();

        // Clear input and select values
        $clonedRow.find('input').val('');
        $clonedRow.find('select').prop('selectedIndex', 0);

        // Append the cloned row at the end of the tbody
        $tableBody.append($clonedRow);

        // Re-index all inputs/selects
        $tableBody.find('tr').each(function (rowIndex) {
            $(this).find('input, select, textarea').each(function () {
                var name = $(this).attr('name');
                if (name) {
                    // Update name attribute like items[0][field], items[1][field]
                    var updatedName = name.replace(/\[\d+\]/, '[' + rowIndex + ']');
                    $(this).attr('name', updatedName);
                }
            });
        });
    });

    $(document).on('change', '.change-numbers', function () {
        var grandAmount = 0; var grandVat = 0; var grandATotal = 0;
        $('.invoice-items-list').find('tr').each(function(i,k){
            var vat = $(this).find('.vat-amount').val();
            var amount = $(this).find('.payout-amount').val();

            // Convert to float
            vat = vat === 'no' ? 0 : parseFloat(vat);
            amount = parseFloat(amount);

            if (isNaN(amount)) amount = 0;
            
            var vatAmount = (amount * vat) / 100;
            var finalAmount = amount + vatAmount;
            
            $(this).find('.final-amount').val(finalAmount.toFixed(2));

            grandAmount+=amount;
            grandVat+=vatAmount;
            grandATotal+=finalAmount;
        })
        

        $('.sub-total').html('$ '+grandAmount.toFixed(2));
        $('.sub-vat').html('$ '+grandVat.toFixed(2));
        $('.grand-total').html('$ '+grandATotal.toFixed(2));
    });

    $(document).on('click','.delete-invice-item',function(){
        if(confirm('Are you sure you want to delete this invoice item, this action cannot be reversed.')){
            var $tbody = $(this).closest('tbody');
            var rowCount = $tbody.find('tr').length;
            if (rowCount > 1) {
                $(this).closest('tr').remove();
            } else {
                alert("At least one row must remain.");
            }
        }
        
    })
</script>
@stop

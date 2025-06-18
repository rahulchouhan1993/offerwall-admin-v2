<table width="100%">
    <tr>
        <td>
            <table width="890" align="center" style="background: #ffffff; font-size: 14px; color: #333; border-collapse: collapse;">
                <tr>
                    <td style="padding: 40px 0px;">
                        <table width="100%">
                            <tr>
                                <td colspan="2" style="padding-bottom: 24px;">
                                    <img src="{{ public_path('/images/logo.png') }}" alt="Company Logo" style="width: 190px;" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="height: 20px;">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" valign="top" style="padding-right: 16px;">
                                    <div style="font-weight: bold; font-size: 15px;">
                                        SELF-BILLED INVOICE
                                    </div>
                                    <br>
                                    <div style="font-weight: 500;font-size: 12px;">Sold by/Vendor</div>
                                    <div style="font-size: 12px; margin-top: 6px; line-height: 1.6;">
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
                                </td>

                                <td width="50%" valign="top">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%" >
                                                <div style="font-size: 12px; line-height: 1.6;">
                                                    <strong>Invoice Date</strong> <br />
                                                            {{ date('d M Y',strtotime($invoiceDetails->invoice_date)) }} <br><br>
                                                    <strong>Invoice Due Date</strong> <br />
                                                            {{ date('d M Y',strtotime($invoiceDetails->due_date)) }} <br><br>
                                                    <strong>Invoice Number</strong> <br />
                                                            {{ env('INVOICE_ALIAS')}}-{{ date('Y',strtotime($invoiceDetails->invoice_date)) }}-{{ date('m',strtotime($invoiceDetails->invoice_date)) }}-{{ $invoiceDetails->invoice_number }}
                                                </div>
                                                
                                            </td>
                                            <td width="50%" >
                                                <div style="font-size: 12px;line-height: 1.6;">
                                                    <strong>Created by/Purchaser</strong> <br>
                                                    Maka Mobile<br />
                                                            Herengracht 420<br />
                                                            Amsterdam Noord-Holland 1017BZ<br />
                                                            Netherlands<br />
                                                            VAT No. NL858589242B01<br />
                                                            Business Registration: 71125957
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr><td colspan="2" style="height: 40px;"></td></tr>

                            <!-- Invoice Table -->
                            <tr>
                                <td colspan="2">
                                    <table width="100%" style="border-collapse: collapse; font-size: 12px;">
                                        <thead>
                                            <tr style="">
                                                <th align="left" style="padding: 10px; border-bottom: 1px solid #999;">Description</th>
                                                <th align="left" style="padding: 10px; border-bottom: 1px solid #999;">Conversions</th>
                                                <th align="left" style="padding: 10px; border-bottom: 1px solid #999;">Payout</th>
                                                <th align="right" style="padding: 10px; border-bottom: 1px solid #999;">VAT</th>
                                                <th align="right" style="padding: 10px; border-bottom: 1px solid #999;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $subTotal = 0; $vatTotal = 0; @endphp
                                            @if(!empty($invoiceDetails->invoicedetails))
                                            @foreach ($invoiceDetails->invoicedetails as $key=> $items)
                                            <tr style="border-bottom: 1px solid #ddd;">
                                                <td style="padding: 10px; border-bottom: 1px solid #999;">{{ $items->description }}
                                                </td>
                                                <td style="padding: 10px; border-bottom: 1px solid #999;">{{ $items->conversion }}</td>
                                                <td style="padding: 10px; border-bottom: 1px solid #999;">$ {{ number_format($items->payout,2) }} @php $subTotal+=$items->payout; @endphp</td>
                                                <td style="padding: 10px; border-bottom: 1px solid #999;" align="right">{{ $items->vat }}%</td>
                                        @php 
                                            if($items->vat>0){
                                                $totalAmount = $items->payout+(($items->payout*$items->vat)/100);
                                                $vatTotal+=($items->payout*$items->vat)/100; 
                                            }else{
                                                $totalAmount = $items->payout;
                                            }
                                        @endphp
                                                <td style="padding: 10px; border-bottom: 1px solid #999;" align="right">$ {{ number_format($totalAmount,2) }}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" style="padding: 10px; font-style: italic; color: #666;"></td>
                                                <td style="padding: 10px; text-align: right; font-weight: 500; border-top: 1px solid #ccc;">
                                                    Sub Total
                                                </td>
                                                <td style="padding: 10px; text-align: right; border-top: 1px solid #ccc;">
                                                    $ {{ number_format($subTotal,2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="padding: 10px; font-style: italic; color: #666;"></td>
                                                <td style="padding: 10px; text-align: right; font-weight: 500; border-top: 1px solid #ccc;">
                                                    VAT
                                                </td>
                                                <td style="padding: 10px; text-align: right; border-top: 1px solid #ccc;">
                                                    $ {{ number_format($vatTotal,2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td style="padding: 10px; text-align: right; font-weight: bold; border-top: 1px solid #ccc;">
                                                    TOTAL 
                                                </td>
                                                <td style="padding: 10px; text-align: right; font-weight: bold; border-top: 1px solid #ccc;">
                                                    $ {{ number_format(($subTotal+$vatTotal),2) }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </td>
                            </tr>

                            
                            <tr><td colspan="2" style="height: 10px;"></td></tr>
                            <tr>
                                <td colspan="2">
                                    <p style="font-size: 12px; text-transform: uppercase;">
                                        <strong>NOTE: It is your responsibility that your bank account details are updated. Please contact your account manager if you have to report any changes.</strong>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
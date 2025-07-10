
@extends('layouts.default')
@section('content')
@php $data = json_decode($invoiceDetails->payment_method, true); @endphp
<div class="bg-[#f2f2f2] p-[15px] md:p-[35px]">
    
        <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[8px] md:rounded-[10px] mt-[30px]">
            <h2 class="mb-[20px] text-[20px] text-[#1A1A1A] font-[600] ">
                 Preferred Payment Method
            </h2>  
            <div class="flex flex-wrap gap-x-[20px] gap-y-[30px] w-[100%] ">
                <div class="flex flex-col gap-[10px] w-[100%] ">
                    <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Payment Method <div class="text-[#F23765] mt-[-2px]">*</div></label>
                    <select name="method" required class="payment-method flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" disabled>
                        <option value="">Select Option</option>
                        <option value="1" @if($data['payment_method']==1) selected @endif>ACH/SWIFT (Wise)</option>
                        <option value="2" @if($data['payment_method']==2) selected @endif>Crypto</option>
                        <option value="3" @if($data['payment_method']==3) selected @endif>Paypal</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[8px] md:rounded-[10px] mt-[30px] main-sec-payment" >
            <h2 class="mb-[20px] text-[20px] text-[#1A1A1A] font-[600] method-dy-heading">
                Selected Payment Method Details
            </h2>  
            <div class="section-1 common-section" style="display:none">
                <div class="flex flex-wrap gap-x-[20px] gap-y-[30px] w-[100%] ">
                    
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Account Type <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <select name="account_type"  class="account-type-sel flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" disabled>
                            <option value="">Select Option</option>
                            <option value="ACH" @if($data['account_type']=='ACH') selected @endif>ACH</option>
                            <option value="SWIFT" @if($data['account_type']=='SWIFT') selected @endif>SWIFT</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Name of business/organisation <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="org_name"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['account_name'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989] routing-label">Routing Number <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="routing_number"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['routing_number'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989] account-label">Account Number <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="account_number"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['iban'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Country <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <select name="country" class="select-country-met flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" disabled>
                            <option value="">Select</option>
                            @foreach ($allCountries as $country )
                                <option value="{{ $country->iso }}" @if($data['country']==$country->iso) selected @endif>{{ $country->nicename }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">City <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="city"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['city'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Recipient Address <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="address"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['address'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Post Code<div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="post_code"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['post_code'] }}" disabled>
                    </div>
                </div>
            </div>
            <div class="section-2 common-section" style="display:none">
                <div class="flex flex-wrap gap-x-[20px] gap-y-[30px] w-[100%] ">
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Wallet Address <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="wallet_address"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['wallet_address'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Name of business/organisation <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="org_name_wallet"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['account_name'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Country <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <select name="country_wallet" class="select-country-met flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" disabled>
                            <option value="">Select</option>
                            @foreach ($allCountries as $country )
                                <option value="{{ $country->iso }}" @if($data['country']==$country->iso) selected @endif>{{ $country->nicename }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">City <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="city_wallet"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['city'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Recipient Address <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="address_wallet"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['address'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Post Code<div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="post_code_wallet"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['post_code'] }}" disabled>
                    </div>
                </div>
            </div>
            <div class="section-3 common-section" style="display:none">
                <div class="flex flex-wrap gap-x-[20px] gap-y-[30px] w-[100%] ">
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Enter Email Address That You Use In Paypal <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="email" name="paypal_email"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['paypal_email'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Name of business/organisation <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="org_name_paypal"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['account_name'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Country <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <select name="country_paypal" class="select-country-met flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" disabled>
                            <option value="">Select</option>
                            @foreach ($allCountries as $country )
                                <option value="{{ $country->iso }}" @if($data['country']==$country->iso) selected @endif>{{ $country->nicename }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">City <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="city_paypal"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['city'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Recipient Address <div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="address_paypal"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['address'] }}" disabled>
                    </div>
                    <div class="flex flex-col gap-[10px] w-[100%] ">
                        <label for="" class="flex items-center gap-[5px] text-[14] text-[#898989]">Post Code<div class="text-[#F23765] mt-[-2px]">*</div></label>
                        <input type="text" name="post_code_paypal"  class="flex px-[15px] py-[15px] rounded-[10px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $data['post_code'] }}" disabled >
                    </div>
                </div>
            </div>
            
        </div>
    
</div>
<script>
    
    $(document).ready(function(){
        $('.payment-method').trigger('change');
    })
    $(document).on('change','.payment-method',function(){
        var method = $(this).val();
        if(method>0){
            $('.main-sec-payment').show();
        }else{
            $('.main-sec-payment').hide();
        }
        $('.common-section').hide();
        $('.common-section').find('input').prop('required',false);
        $('.common-section').find('select').prop('required',false);
        $('.section-'+method).show();
        $('.section-'+method).find('input').prop('required',true);
        $('.section-'+method).find('select').prop('required',true);
    })

    $(document).on('change','.account-type-sel',function(){
        var accounttype = $(this).val();
        if(accounttype=='ACH'){
            $('.routing-label').html('Routing Number <div class="text-[#F23765] mt-[-2px]">*</div>');
            $('.account-label').html('Account Number <div class="text-[#F23765] mt-[-2px]">*</div>');
        }else{
            $('.routing-label').html('SWIFT / BIC Code <div class="text-[#F23765] mt-[-2px]">*</div>');
            $('.account-label').html('IBAN / Account Number <div class="text-[#F23765] mt-[-2px]">*</div>');
        }
        
    })

    $('.select-country-met').select2({
      placeholder: "Select country",
      allowClear: true // Adds a clear (X) button
   });
</script>
@stop
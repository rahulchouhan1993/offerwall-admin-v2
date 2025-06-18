@extends('layouts.default')
@section('content')
<div class="bg-[#f2f2f2] p-[15px] md:p-[35px] text-[#1A1A1A]">
    @php $data = json_decode($invoiceDetails->payment_method, true); @endphp
    <pre>{{ json_encode($data, JSON_PRETTY_PRINT); }}</pre>
</div>

@stop
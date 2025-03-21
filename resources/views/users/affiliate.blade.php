@extends('layouts.default')
@section('content')
@php 
use App\Models\User;
@endphp
<div class="bg-[#f2f2f2] p-[15px] lg:p-[35px]">
    <div class="flex flex-col lg:flex-row justify-between items-start gap-[15px] w-[100%] ">
        <div class="w-[100%] lg:w-[100%] bg-[#fff] p-[15px] md:p-[20px] rounded-[10px]">
            <div class="flex flex-wrap md:flex-nowrap items-center justify-between gap-[10px] mb-[20px]">
                <h2 class="w-full lg:w-auto text-[20px] text-[#1A1A1A] font-[600]">Affiliates</h2>
                <select name="status" onchange="filterRecords(this)" class="w-[100%] w-[250px] xl:max-w-[300px]  bg-[#F6F6F6] px-[15px] py-[12px] text-[12px] font-[500] text-[#808080] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none">
                    <option value="" @if($userType == '') selected @endif>All</option>
                    <option value="active" @if($userType == 'active') selected @endif>Active</option>
                    <option value="banned" @if($userType == 'banned') selected @endif>Banned</option>
                    <option value="on moderation" @if($userType == 'on moderation') selected @endif>On Moderation</option>
                    <option value="not active" @if($userType == 'not active') selected @endif>Not Active</option>
                </select>
            </div>
            <div class=" overflow-x-scroll tableScroll">
                <table class="w-[100%] border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                    <tr>
                        <th class=" bg-[#F6F6F6] rounded-tl-[10px] text-[12px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">PID</th>
                        <th class=" bg-[#F6F6F6] rounded-tl-[10px] text-[12px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">Name</th>
                        <th class=" bg-[#F6F6F6] rounded-tl-[10px] text-[12px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">Email</th>
                        <th class=" bg-[#F6F6F6] rounded-tl-[10px] text-[12px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">Affise Status</th>
                        <th class=" bg-[#F6F6F6] rounded-tl-[10px] text-[12px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">Offerwall Status</th>
                        <th class=" bg-[#F6F6F6] rounded-tl-[10px] text-[12px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">API Key</th>
                        <th class=" bg-[#F6F6F6] rounded-tl-[10px] text-[12px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap  text-right">Action</th>
                    </tr>
                @if(!empty($allAffiliates['partners']))
                    @foreach ($allAffiliates['partners'] as $affiliate)
                    <tr>
                        <td class="text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">{{ $affiliate['id'] }}</td>
                        <td title="Wannads / Innovative Hall media" class=" text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">{{ $affiliate['login'] }}</td>
                        <td class="text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">{{ $affiliate['email'] }}</td>
                        @if($affiliate['status']=='active')
                            <td class="text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b-[1px]"><div class="text-[#6EBF1A] ">Active</div></td>
                        @elseif($affiliate['status']=='banned')
                            <td class="text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6] border-b-[1px] border-b-[#E6E6E6]"><div class="text-[#F23765]">Banned</div></td>
                        @elseif($affiliate['status']=='on moderation')
                            <td class="text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]"><div class="text-[#d4f23d]">On Moderation</div></td>
                        @elseif($affiliate['status']=='not active')
                            <td class="text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b-[1px] border-b-[#E6E6E6]"><div class="text-[#30c2ee]">Not Active</div></td>
                        @endif

                        @php
                            $validateUserCreation = User::where('affiseId',$affiliate['id'])->first();
                        @endphp

                        @if(is_null($validateUserCreation) || $validateUserCreation->status == 0)
                            <td class=" text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]"><div class="inline-flex bg-[#FFE7ED] border border-[#FFA6BC] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#F23765] text-center uppercase">Not Active</div></td>
                        @else
                            <td class=" text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b-[1px] border-b-[#BCEE89]"><div class="inline-flex bg-[#F3FEE7] border border-[#BCEE89] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#6EBF1A] text-center uppercase">Active</div></td>
                        @endif
                       
                        <td title="cebad6fc330de7124462cb182e9c2cd17991cbf2" class=" text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">{{ $affiliate['api_key'] }}</td>
                        <td class="w-[120px] text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-right whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6] text-center">
                        <div class="flex items-center justify-end gap-[10px]">
                            @if(!$validateUserCreation && $affiliate['status']=='active')
                                <a href="javascript:void(0);" onclick="addAffiliateUser(this,{{ $affiliate['id'] }},'{{ $affiliate['email'] }}','{{ $affiliate['login'] }}','{{ $affiliate['api_key'] }}')" class="w-[30px] h-[30px] bg-[#30c2ee] rounded-[5px] flex items-center justify-center text-[17px] text-[#fff]">
                                    <!-- Add User -->
                                    <i class="ri-add-line"></i>
                                </a>
                            @elseif(!empty($validateUserCreation))
                                <a href="{{ route('admin.affiliate.status',['id'=>$validateUserCreation->id]) }}" class="w-[30px] h-[30px] bg-[#6ebf1a] rounded-[5px] flex items-center justify-center text-[17px] text-[#fff]">
                                    <!-- Update Status -->
                                    <i class="ri-checkbox-circle-line"></i>
                                </a>
                            @endif
                            {{-- <a href="javascript:void(0);" class="w-[30px] h-[30px] bg-[#f23765] rounded-[5px] flex items-center justify-center text-[17px] text-[#fff]">
                                <i class="ri-delete-bin-line"></i>
                            </a> --}}
                        </div>
                            
                        <!-- Dropdown Action Button -->
                        <!-- <div class="relative">
                            <button class="flex items-center gap-[5px] dropdown-btn bg-[#F6F6F6] border-[1px] border-[#E6E6E6] text-[#808080] text-[12px] font-[600] uppercase px-[12px] py-[5px] rounded hover:bg-[#F6F6F6]">
                            Action <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L5 5L9 1" stroke="#A1A1A1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div> -->
                        </td>
                    </tr>
                    @endforeach
                @endif
                </table>
                    <!-- Dropdown Action Menu -->
                    <ul
                        id="dropdown-menu"
                        class="hidden absolute bg-white border border-gray-300 rounded shadow-lg z-50 w-[120px]"
                    >
                        <li class=" border-b-[1px] border-b-[#f2f2f2]">
                            <a href="#" class="block px-[12px] py-[6px] hover:bg-gray-100 cursor-pointer text-[13px]">Delte</a>
                        </li>
                        <li><a href="#" class="block px-[12px] py-[6px] hover:bg-gray-100 cursor-pointer text-[13px]">Edit</a></li>
                    </ul>
                    
                <div class="pagination mt-[20px] flex gap-[10px] items-center justify-end">
                    @if($prevPage)
                        <a href="{{ route('admin.users.affiliates', ['page' => $prevPage, 'status' => $userType]) }}"  class="btn group inline-flex gap-[8px] items-center bg-[#F5EAF5] border border-[#FED5C3] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#D272D2] text-center hover:bg-[#D272D2] hover:text-[#fff]"><svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 1L1 5L5 9" stroke="#D272D2" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="group-hover:stroke-[#fff] " />
                        </svg> Previous</a>
                    @endif
                
                    @for($i = 1; $i <= ceil($totalCount / $perPage); $i++)
                        <a href="{{ route('admin.users.affiliates', ['page' => $i, 'status' => $userType]) }}" class="{{ $i == $currentPage ? 'btn-active btn inline-flex gap-[8px] items-center bg-[#fff] border border-[#E6E6E6] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#808080] text-center hover:bg-[#D272D2] hover:text-[#fff]' : 'btn inline-flex gap-[8px] items-center bg-[#fff] border border-[#E6E6E6] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#808080] text-center hover:bg-[#D272D2] hover:text-[#fff]' }}">
                            {{ $i }}
                        </a>
                    @endfor
                
                    @if($nextPage)
                        <a href="{{ route('admin.users.affiliates', ['page' => $nextPage, 'status' => $userType]) }}" class="btn group inline-flex gap-[5px] items-center bg-[#F5EAF5] border border-[#FED5C3] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#D272D2] text-center hover:bg-[#D272D2] hover:text-[#fff]">Next <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5 5L1 9" stroke="#D272D2" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="group-hover:stroke-[#fff] " />
                        </svg></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<form id="affiliateAddForm" method="post" action="{{ route('admin.users.addaffiliates') }}">
    @csrf
    <input type="hidden" id="affiliateName" name="name" value="">
    <input type="hidden" id="affiliateEmail" name="email" value="">
    <input type="hidden" id="affiliateId" name="id" value="0">
    <input type="hidden" id="api_key" name="api_key" value="0">
</form>
<script>
    function filterRecords(element){
        $('.loader-fcustm').show();
        window.location.href="/affiliates?status="+$(element).val();
    }

    function addAffiliateUser(element,id,email,name,api_key){
        var conf = confirm('Are you sure you want to add affiliate to offerwall?');
        if(conf){
            $('#affiliateName').val(name);
            $('#affiliateEmail').val(email);
            $('#api_key').val(api_key);
            $('#affiliateId').val(id);
            $('.loader-fcustm').fadeIn(1000)
            $('#affiliateAddForm').submit();
        }
    }
</script>
@stop
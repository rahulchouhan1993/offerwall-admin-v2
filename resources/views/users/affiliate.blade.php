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
                <select name="status" onchange="filterRecords(this)" class="w-[100%] w-[250px] xl:max-w-[300px]  bg-[#F7F7F7] px-[15px] py-[12px] text-[13px] font-[600] text-[#000] 1border-[1px] 1border-[#ccc] rounded-[10px] hover:outline-none focus:outline-none hover:outline-none focus:outline-none">
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
                        <th class=" bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] rounded-tl-[10px] text-[12px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap  ">PID</th>
                        <th class=" bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] text-[12px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap  ">Name</th>
                        <th class=" bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] text-[12px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap  ">Email</th>
                        <th class=" bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] text-[12px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap  ">Affise Status</th>
                        <th class=" bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] text-[12px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap  ">Offerwall Status</th>
                        <th class=" bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] text-[12px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap  ">API Key</th>
                        <th class=" bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] text-[12px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap  ">Payment Details</th>
                        <th class=" bg-[#7FB5CB] 1border-b-[1px] 1border-b-[#E6E6E6] rounded-tr-[10px] text-[12px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap   text-right">Action</th>
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
                            <td class="text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b-[1px] border-b-[#E6E6E6]"><div class="text-[#ced3d6]">Not Active</div></td>
                        @endif

                        @php
                            $validateUserCreation = User::where('affiseId',$affiliate['id'])->first();
                        @endphp

                        @if(is_null($validateUserCreation) || $validateUserCreation->status == 0)
                            <td class=" text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]"><div class="inline-flex bg-[#FFE7ED] border border-[#FFA6BC] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#F23765] text-center uppercase">Not Active</div></td>
                        @else
                            <td class=" text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b-[1px] border-b-[#BCEE89]"><div class="inline-flex bg-[#F3FEE7] border border-[#BCEE89] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#6EBF1A] text-center uppercase">Active</div></td>
                        @endif
                       
                        <td  class=" text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">{{ $affiliate['api_key'] }}</td>
                        @if(is_null($validateUserCreation) || $validateUserCreation->status == 0)
                        <td  class="text-center text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]"> -- </td>
                        @else
                            <td  class="text-center text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]"><a href="{{ route('payment.details',['id'=>$validateUserCreation->id]) }}" class="inline-block">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12.5C11.0717 12.5 10.1815 12.8687 9.52513 13.5251C8.86875 14.1815 8.5 15.0717 8.5 16C8.5 16.9283 8.86875 17.8185 9.52513 18.4749C10.1815 19.1313 11.0717 19.5 12 19.5C12.9283 19.5 13.8185 19.1313 14.4749 18.4749C15.1313 17.8185 15.5 16.9283 15.5 16C15.5 15.0717 15.1313 14.1815 14.4749 13.5251C13.8185 12.8687 12.9283 12.5 12 12.5ZM10.5 16C10.5 15.6022 10.658 15.2206 10.9393 14.9393C11.2206 14.658 11.6022 14.5 12 14.5C12.3978 14.5 12.7794 14.658 13.0607 14.9393C13.342 15.2206 13.5 15.6022 13.5 16C13.5 16.3978 13.342 16.7794 13.0607 17.0607C12.7794 17.342 12.3978 17.5 12 17.5C11.6022 17.5 11.2206 17.342 10.9393 17.0607C10.658 16.7794 10.5 16.3978 10.5 16Z" fill="#4EF953"/>
                                <path d="M17.526 5.116L14.347 0.659L2.658 9.997L2.01 9.99V10H1.5V22H22.5V10H21.538L19.624 4.401L17.526 5.116ZM19.425 10H9.397L16.866 7.454L18.388 6.967L19.425 10ZM15.55 5.79L7.84 8.418L13.946 3.54L15.55 5.79ZM3.5 18.169V13.829C3.92218 13.68 4.30565 13.4384 4.62231 13.1219C4.93896 12.8054 5.18077 12.4221 5.33 12H18.67C18.8191 12.4223 19.0609 12.8058 19.3775 13.1225C19.6942 13.4391 20.0777 13.6809 20.5 13.83V18.17C20.0777 18.3191 19.6942 18.5609 19.3775 18.8775C19.0609 19.1942 18.8191 19.5777 18.67 20H5.332C5.18218 19.5777 4.93996 19.1941 4.62302 18.8774C4.30607 18.5606 3.9224 18.3186 3.5 18.169Z" fill="#4EF953"/>
                                </svg>
                                
                        </a></td>
                        @endif
                         
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
                        <a href="{{ route('admin.users.affiliates', ['page' => $prevPage, 'status' => $userType]) }}"  class="btn group inline-flex gap-[8px] items-center bg-[#4EF953] border border-[#FED5C3] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#000] text-center hover:bg-[#4EF953] hover:text-[#000]"><svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 1L1 5L5 9" stroke="#4EF953" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="group-hover:stroke-[#fff] " />
                        </svg> Previous</a>
                    @endif
                
                    @for($i = 1; $i <= ceil($totalCount / $perPage); $i++)
                        <a href="{{ route('admin.users.affiliates', ['page' => $i, 'status' => $userType]) }}" class="{{ $i == $currentPage ? 'btn-active btn inline-flex gap-[8px] items-center bg-[#fff] border border-[#E6E6E6] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#808080] text-center hover:bg-[#4EF953] hover:text-[#000]' : 'btn inline-flex gap-[8px] items-center bg-[#fff] border border-[#E6E6E6] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#808080] text-center hover:bg-[#4EF953] hover:text-[#000]' }}">
                            {{ $i }}
                        </a>
                    @endfor
                
                    @if($nextPage)
                        <a href="{{ route('admin.users.affiliates', ['page' => $nextPage, 'status' => $userType]) }}" class="btn group inline-flex gap-[5px] items-center bg-[#fff] border border-[#E6E6E6] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#000] text-center hover:bg-[#4EF953] hover:text-[#000]">Next <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5 5L1 9" stroke="#000" stroke-width="1.5" stroke-linecap="round"
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
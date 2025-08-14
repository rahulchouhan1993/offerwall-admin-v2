@extends('layouts.default')
@section('content')

<div class="bg-[#f2f2f2] p-[15px] lg:p-[35px]">
    <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[10px] mb-[20px]">
       <div class="flex flex-col justify-between items-center gap-[5px] w-[100%] mt-[30px] ">
          <div class="w-[100%] overflow-x-scroll tableScroll">
             <table class="w-[100%] border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                <tr>
                  <th class="bg-[#7FB5CB] rounded-tl-[10px] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">#ID</th>
                   <th class="bg-[#7FB5CB] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap ">User Name</th>
                   <th class="bg-[#7FB5CB] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap ">User Email</th>
                   <th class="bg-[#7FB5CB] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap ">Gender</th>
                   <th class="bg-[#7FB5CB] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap ">Age</th>
                   <th class="bg-[#7FB5CB] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">Email Verified At</th>
                   <th class="bg-[#7FB5CB] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">Created</th>
                </tr>
                <tbody id="search-results">
                @if($users && $users->isNotEmpty())
                @foreach ($users as $user)
                <tr>
                  <td class="text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
                       <strong>{{ base64_encode($user->id)  }}</strong>
                    </td>
                    <td class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal ">
                       <strong>{{ $user->name }}</strong>
                    </td>
                    <td class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal ">
                       <strong>{{ $user->email }}</strong>
                    </td>
                    <td class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal ">
                       <strong>{{ !empty($user->gender) ? $user->gender : "N/A" }}</strong>
                    </td>
                    <td class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal ">
                       <strong>{{ !empty($user->age) ? $user->age : "N/A" }}</strong>
                    </td>
                    <td class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal ">
                       <strong>{{ !empty($user->email_verified_at) ? \Carbon\Carbon::parse($user->email_verified_at)->format('d M Y h.i A') : "Not Verified" }}</strong>
                    </td>
                    <td class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal ">
                       <strong>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y h.i A') }}</strong>
                    </td>
                 </tr>
                @endforeach
                @endif
                </tbody>
             </table>
          </div>
       </div>
    </div>
 </div>
 
@stop

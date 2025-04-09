@extends('layouts.default')

@section('content')
<div class="bg-[#f2f2f2] p-[15px] lg:p-[35px]">
    <div class="flex flex-col lg:flex-row justify-between items-start gap-[15px] w-full">
        <div class="w-full bg-white p-[15px] md:p-[20px] rounded-[10px]">
            <div class="overflow-x-scroll tableScroll">
                <table class="w-full border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                    <thead>
                        <tr>
                            <th class="bg-[#7FB5CB] rounded-tl-[10px] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">Name</th>
                            <th class="bg-[#7FB5CB] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">Email</th>
                            <th class="max-w-[250px] bg-[#7FB5CB] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">Message</th>
                            <th class="bg-[#7FB5CB] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">Status</th>
                            <th class="bg-[#7FB5CB] rounded-tr-[10px] text-[12px] font-medium text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($allInquries->isNotEmpty())
                        @foreach ($allInquries as $inqury)
                        <tr>
                            <td class="text-[12px] font-medium text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b border-[#E6E6E6]">{{ $inqury->name }}</td>
                            <td class="text-[12px] font-medium text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b border-[#E6E6E6]">{{ $inqury->email }}</td>
                            <td class="max-w-[250px] text-[12px] font-medium text-[#808080] px-[10px] py-[10px] text-left whitespace-normal border-b border-[#E6E6E6]">
                                {{ $inqury->message }}
                            </td>
                            <td class="text-[12px] font-medium text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b border-[#E6E6E6]">
                                @if($inqury->status == 1)
                                    <a href="{{ route('contactstatus', ['id' => $inqury->id]) }}" class="w-[15px] h-[15px] rounded-[5px] flex items-center text-[17px] text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 16 16" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 8L3.07945 4.30466C4.29638 2.84434 6.09909 2 8 2C9.90091 2 11.7036 2.84434 12.9206 4.30466L16 8L12.9206 11.6953C11.7036 13.1557 9.90091 14 8 14C6.09909 14 4.29638 13.1557 3.07945 11.6953L0 8ZM8 11C9.65685 11 11 9.65685 11 8C11 6.34315 9.65685 5 8 5C6.34315 5 5 6.34315 5 8C5 9.65685 6.34315 11 8 11Z" fill="#000000"/>
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('contactstatus', ['id' => $inqury->id]) }}" class="w-[15px] h-[15px] rounded-[5px] flex items-center text-[17px] text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 16 16" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16 16H13L10.8368 13.3376C9.96488 13.7682 8.99592 14 8 14C6.09909 14 4.29638 13.1557 3.07945 11.6953L0 8L3.07945 4.30466C3.14989 4.22013 3.22229 4.13767 3.29656 4.05731L0 0H3L16 16ZM5.35254 6.58774C5.12755 7.00862 5 7.48941 5 8C5 9.65685 6.34315 11 8 11C8.29178 11 8.57383 10.9583 8.84053 10.8807L5.35254 6.58774Z" fill="#000000"/>
                                            <path d="M16 8L14.2278 10.1266L7.63351 2.01048C7.75518 2.00351 7.87739 2 8 2C9.90091 2 11.7036 2.84434 12.9206 4.30466L16 8Z" fill="#000000"/>
                                         </svg>
                                    </a>
                                @endif
                            </td>
                            <td class="text-[12px] font-medium text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b border-[#E6E6E6]">
                                {{ $inqury->created_at }}
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

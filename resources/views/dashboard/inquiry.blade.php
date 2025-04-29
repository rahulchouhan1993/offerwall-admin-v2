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
                            <th class="bg-[#7FB5CB] text-[14px] font-[500] text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">Created</th>
                            <th class="bg-[#7FB5CB] rounded-tr-[10px] text-[12px] font-medium text-[#fff] px-[10px] py-[13px] text-left whitespace-nowrap">Action</th>
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
                            <td class="text-[12px] font-medium text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap border-b border-[#E6E6E6]">
                                <a onclick="return confirm('Are you sure you want to delete this contact?');" href="{{ route('delete-contact', ['id' => $inqury->id]) }}" class="w-[15px] h-[15px] rounded-[5px] flex items-center text-[17px] text-red-500">
                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 284.011 284.011">
                                        <g>
                                            <g>
                                                <path d="M235.732,66.214l-28.006-13.301l1.452-3.057c6.354-13.379,0.639-29.434-12.74-35.789L172.316,2.611
                                    c-6.48-3.079-13.771-3.447-20.532-1.042c-6.76,2.406-12.178,7.301-15.256,13.782l-1.452,3.057L107.07,5.106
                                    c-14.653-6.958-32.239-0.698-39.2,13.955L60.7,34.155c-1.138,2.396-1.277,5.146-0.388,7.644c0.89,2.499,2.735,4.542,5.131,5.68
                                    l74.218,35.25h-98.18c-2.797,0-5.465,1.171-7.358,3.229c-1.894,2.059-2.839,4.815-2.607,7.602l13.143,157.706
                                    c1.53,18.362,17.162,32.745,35.588,32.745h73.54c18.425,0,34.057-14.383,35.587-32.745l11.618-139.408l28.205,13.396
                                    c1.385,0.658,2.845,0.969,4.283,0.969c3.74,0,7.328-2.108,9.04-5.712l7.169-15.093C256.646,90.761,250.386,73.175,235.732,66.214z
                                    M154.594,23.931c0.786-1.655,2.17-2.905,3.896-3.521c1.729-0.614,3.59-0.521,5.245,0.267l24.121,11.455
                                    c3.418,1.624,4.878,5.726,3.255,9.144l-1.452,3.057l-36.518-17.344L154.594,23.931z M169.441,249.604
                                    c-0.673,8.077-7.55,14.405-15.655,14.405h-73.54c-8.106,0-14.983-6.328-15.656-14.405L52.35,102.728h129.332L169.441,249.604z
                                    M231.62,96.835l-2.878,6.06L83.057,33.701l2.879-6.061c2.229-4.695,7.863-6.698,12.554-4.469l128.661,61.108
                                    C231.845,86.509,233.85,92.142,231.62,96.835z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                                
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

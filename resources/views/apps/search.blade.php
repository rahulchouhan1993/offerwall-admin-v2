@if($allApps && $allApps->isNotEmpty())
@foreach ($allApps as $apps)
<tr>
    <td class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal ">
        <strong>{{ $apps->users->name.' '.$apps->users->last_name }}</strong>
    </td>
    <td class="max-w-[500px] text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-normal ">
        <strong>{{ $apps->appName }}</strong>
        <p class="whitespace-normal text-[12px] text-[#808080]">{{ $apps->appUrl }}</p>
    </td>
    @if( $apps->status==1)
    <td class="text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
        <a href="{{ route('apps.status',['id'=>$apps->id]) }}" class="inline-flex bg-[#F3FEE7] border border-[#BCEE89] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#6EBF1A] text-center uppercase">Aprroved</a>
        </td>
    @else
    <td class="text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
        <a href="{{ route('apps.status',['id'=>$apps->id]) }}" class="inline-flex bg-[#fee7e7] border border-[#ee8989] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#bf1a1a] text-center uppercase">Not Approved</a>
        </td>
    @endif

    @if( $apps->status==1)
    <td class="text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
        <a href="{{ route('apps.status',['id'=>$apps->id]) }}" class="inline-flex bg-[#F3FEE7] border border-[#BCEE89] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#6EBF1A] text-center uppercase">Aprroved</a>
        </td>
    @else
    <td class="text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">
        <a href="{{ route('apps.status',['id'=>$apps->id]) }}" class="inline-flex bg-[#fee7e7] border border-[#ee8989] rounded-[5px] px-[10px] py-[4px] text-[12px] font-[600] text-[#bf1a1a] text-center uppercase">Not Approved</a>
        </td>
    @endif
    
    <td class="text-[14px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap ">{{ date('d M Y',strtotime($apps->created_at)) }}</td>
    <td class="w-[130px] text-[14px] font-[500] text-[#5E72E4] px-[10px] py-[10px] text-left whitespace-nowrap ">
        <div class="flex items-center justify-center gap-[10px]">
            <a title="Edit" href="{{ route('apps.add',['id'=>$apps->id]) }}" class="flex items-center justify-center w-[35px] bg-[#FFF3ED] py-[10px] w-[100px] border border-[#FED5C3] rounded-[4px] text-[14px] font-[500] text-[#D272D2] text-center">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.7436 11.5797C13.8252 11.661 13.8899 11.7576 13.9341 11.864C13.9783 11.9704 14.001 12.0844 14.001 12.1996C14.001 12.3147 13.9783 12.4288 13.9341 12.5351C13.8899 12.6415 13.8252 12.7381 13.7436 12.8194L12.8182 13.7426C12.7369 13.8242 12.6403 13.8889 12.534 13.9331C12.4276 13.9773 12.3135 14 12.1984 14C12.0832 14 11.9692 13.9773 11.8628 13.9331C11.7564 13.8889 11.6598 13.8242 11.5785 13.7426L7.45399 9.61736L6.05094 13.2759C6.05094 13.2832 6.04511 13.2912 6.04146 13.2992C5.95218 13.5074 5.80363 13.6847 5.61431 13.8091C5.425 13.9334 5.20328 13.9993 4.97678 13.9986H4.91917C4.68295 13.9886 4.4555 13.9063 4.26756 13.7628C4.07963 13.6194 3.94028 13.4217 3.86835 13.1964L0.0566518 1.52288C-0.00878299 1.31872 -0.0167032 1.10048 0.0337606 0.892115C0.0842245 0.683751 0.191121 0.493319 0.342716 0.341725C0.494311 0.19013 0.684743 0.0832327 0.893107 0.0327688C1.10147 -0.017695 1.31971 -0.00977481 1.52387 0.05566L13.1974 3.86736C13.4205 3.94199 13.6159 4.08233 13.7578 4.26995C13.8997 4.45757 13.9816 4.68372 13.9927 4.91872C14.0039 5.15371 13.9437 5.38658 13.8201 5.58677C13.6965 5.78695 13.5153 5.94511 13.3002 6.04047L13.2769 6.04995L9.61835 7.45518L13.7436 11.5797Z" fill="#D272D2"/>
                </svg>
            </a>
            @if( $apps->status==1)
            <a title="Integration" href="{{ route('apps.integration',['id'=>$apps->id]) }}" class="flex items-center justify-center w-[35px] bg-[#FFF3ED] py-[10px] w-[100px] border border-[#FED5C3] rounded-[4px] text-[14px] font-[500] text-[#D272D2] text-center">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.000976562 14V10.6944L10.2677 0.447208C10.4232 0.304615 10.5951 0.19443 10.7833 0.116652C10.9715 0.0388738 11.1691 -1.52588e-05 11.376 -1.52588e-05C11.5829 -1.52588e-05 11.7838 0.0388738 11.9788 0.116652C12.1737 0.19443 12.3423 0.311096 12.4843 0.466652L13.5538 1.55554C13.7093 1.69814 13.8229 1.86665 13.8944 2.0611C13.966 2.25554 14.0015 2.44999 14.001 2.64443C14.001 2.85184 13.9655 3.04966 13.8944 3.23788C13.8234 3.4261 13.7098 3.59773 13.5538 3.75277L3.30654 14H0.000976562ZM11.3565 3.73332L12.4454 2.64443L11.3565 1.55554L10.2677 2.64443L11.3565 3.73332Z" fill="#D272D2"/>
                </svg>
            </a>
            <a title="Template" href="{{ route('apps.template',['id'=>$apps->id]) }}" class="flex items-center justify-center w-[35px] bg-[#FFF3ED] py-[10px] w-[100px] border border-[#FED5C3] rounded-[4px] text-[14px] font-[500] text-[#D272D2] text-center">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" >
                <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2H0V14H16V2ZM3 6C3.55228 6 4 5.55228 4 5C4 4.44772 3.55228 4 3 4C2.44772 4 2 4.44772 2 5C2 5.55228 2.44772 6 3 6ZM7.5 5C7.5 5.55228 7.05228 6 6.5 6C5.94772 6 5.5 5.55228 5.5 5C5.5 4.44772 5.94772 4 6.5 4C7.05228 4 7.5 4.44772 7.5 5ZM10 6C10.5523 6 11 5.55228 11 5C11 4.44772 10.5523 4 10 4C9.44771 4 9 4.44772 9 5C9 5.55228 9.44771 6 10 6Z" fill="#D272D2"/>
                </svg>
            </a>
            @endif
        </div>
    </td>
    </tr>
@endforeach
@endif
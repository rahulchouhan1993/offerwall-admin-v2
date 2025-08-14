<ul class="m-[0] overflow-x-hidden relative">
    @if(!empty($tickets))
        @foreach($tickets as $ticket)
            @php
                $updatedAt = \Carbon\Carbon::parse($ticket['lastchat']['created_at']);
                if ($updatedAt->isToday()) {
                    $formattedTime = 'Today ' . $updatedAt->format('h:i A');
                } else {
                    $formattedTime = $updatedAt->format('D h:i A');
                }
            @endphp
            <li  id="ticket-{{ $ticket->id }}" data-id="{{ $ticket->id }}" onclick="loadConversation({{ $ticket->id }}, this);" class="group relative py-[10px] hover:bg-gray-100 border-b border-b-[#f2f2f2] flex items-center gap-[5px] md:gap-[8px] cursor-pointer">
                <img src="/images/user.webp" class="rounded-full w-[20px] h-[20px] xl:w-[30px] xl:h-[30px]" />
                <div class="chatmsgBx flex-1 w-[calc(100%-20px)] pr-[100px] md:pr-[98px] lg:pr-[94px] xl:pr-[104px]">
                    <div class="chatmsg w-full flex flex-col justify-between items-center ">
                        <span class="chatTitle w-full text-[12px] xl:text-[13px] text-black font-semibold leading-[15px] truncate ">
                            {{ Illuminate\Support\Str::limit($ticket['tracking']['offer_name'], 20) }}
                        </span>
                        <p class="chatDes w-full text-[11px] xl:text-[12px] text-gray-500 truncate m-[0] ">
                            {{ $ticket['user']['name'] }}
                        </p>
                        <div class="chatMeta flex flex-col items-end">
                            <span class="chatTime text-[11px] xl:text-[11px] font-bold text-green-800 absolute right-[10px] top-[10px]">
                                {{ $formattedTime }}
                            </span>
                           
                        </div>
                        @if($ticket->status == 2)
                                <span style="background-color: #dc2626; color: #fff; padding: 1px 5px; border-radius: 4px; font-size: 10px; display: inline-block; position: absolute; right: 8px; bottom: 2px; font-weight: 600;">
                                    Closed
                                </span>
                            @endif
                    </div>
                </div>
                @if($ticket['unread'] != 0)
                    <span class="chatCount absolute right-[10px] top-[28px] text-green-800 text-xs rounded-full flex items-center justify-center w-[17px] h-[17px] bg-green-100 font-[600]">
                        {{ $ticket['unread'] }}
                    </span>
                @endif
            </li>
        @endforeach
    @endif
</ul>
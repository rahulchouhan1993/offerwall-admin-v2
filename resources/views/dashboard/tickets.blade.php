@extends('layouts.default')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

<!-- Before </body> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



<div class="flex gap-[10px] md:gap-[15px] lg:gap-[20px] p-[20px] flex-col md:flex-row h-[85vh] bg-[#EEF0F8]">

    <!-- Sidebar -->
    <aside class="w-full md:w-1/3 lg:w-1/4 bg-white p-[10px] xl:p-[15px] rounded-[6px] flex flex-col shadow-md">
        <div class="border-b border-b-[#f2f2f2]">
            <div class="flex gap-[8px] items-center justify-between">
                <h2 class="text-lg text-black font-semibold mb-[0]">Chats</h2>
                <div class="relative">
                    <button onclick="toggleDropdown2(event)"
                        class="w-[35px] h-[35px] text-black hover:text-black focus:outline-none px-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 3C10.9 3 10 3.9 10 5C10 6.1 10.9 7 12 7C13.1 7 14 6.1 14 5C14 3.9 13.1 3 12 3ZM12 17C10.9 17 10 17.9 10 19C10 20.1 10.9 21 12 21C13.1 21 14 20.1 14 19C14 17.9 13.1 17 12 17ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z">
                            </path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu (initially hidden) -->
                    <!-- <div
                        class="dropdownNav absolute top-[24px] right-0 mt-2 w-32 bg-white border rounded shadow-lg hidden z-10">
                        <ul class="text-sm text-gray-700">
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Mute</li>
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Archive</li>
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-500">Delete</li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="flex items-center justify-between gap-[10px] relative mb-[10px]">
                <div class="relative w-[100%]">
                <input type="text" placeholder="Search or start new chat"
                    class="w-full pl-[40px] pr-[15px] py-[9px] border rounded-[60px] text-sm bg-[#f5f5f5] focus:outline-none" />
                <button class="w-[25px] text-[#4EF953] text-[10px] absolute top-[10px] start-[10px]">
                    <svg class="w-[20px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z">
                        </path>
                    </svg>
                </button>
                </div>
                <div>
                <button onclick="toggleDiv()" class=" md:hidden p-[0] w-[35px] h-[35px] flex items-center justify-center text-black rounded-[40px] bg-[#f2f2f2] focus:outline-none " > <svg class="w-[18px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.9999 13.1714L16.9497 8.22168L18.3639 9.63589L11.9999 15.9999L5.63599 9.63589L7.0502 8.22168L11.9999 13.1714Z"></path></svg> </button>
                </div>
            </div>

        </div>
        <div id="myDiv" class=" overflow-y-auto  max-h-[115px] md:max-h-[100vh] flex-grow">
            @include('dashboard.ticket-list', ['tickets' => $tickets])
        </div>

        <!-- <div id="myDiv" class=" overflow-y-auto  max-h-[115px] md:max-h-[100vh] flex-grow">
            <ul class="m-[0] overflow-x-hidden relative">
            @if(!empty($tickets))
            @foreach($tickets as $ticket)
                    @php

                        $updatedAt = \Carbon\Carbon::parse($ticket['lastchat']['created_at'])->timezone('Asia/Kolkata');;

                        if ($updatedAt->isToday()) {
                            $formattedTime = 'Today ' . $updatedAt->format('H:i');
                        } elseif ($updatedAt->isYesterday()) {
                            $formattedTime = 'Yesterday ' . $updatedAt->format('H:i');
                        } else {
                            $formattedTime = $updatedAt->format('l H:i');
                        }
                    @endphp

                <li onclick="loadConversation({{ $ticket->id }})" class="group relative py-[10px] hover:bg-gray-100 border-b border-b-[#f2f2f2] flex items-center gap-[5px] md:gap-[8px] cursor-pointer"> <img src="/images/user.webp" class="rounded-full w-[20px] h-[20px] xl:w-[30px] xl:h-[30px]" />
                    <div class="chatmsgBx flex-1 w-[calc(100%-20px)] pr-[60px] md:pr-[50px] lg:pr-[55px] xl:pr-[60px]">
                        <div class="chatmsg w-full flex flex-col justify-between items-center">
                            <span class="chatTitle text-black" title="{{ $ticket['tracking']['offer_name']}}">{{ Illuminate\Support\Str::limit($ticket['tracking']['offer_name'], 20) }}</span>
                                <p class="chatDes">{{ empty($ticket['lastchat']['media']) ? $ticket['lastchat']['message'] : $ticket['lastchat']['media'] }}</p>
                            <span class="chatTime">{{$formattedTime}}</span>
                        </div>
                    </div>
                    @if($ticket['unread'] != 0)
                    <span class="chatCount absolute right-[10px] top-[28px] text-green-800 text-xs rounded-full flex items-center justify-center w-[17px] h-[17px] bg-green-100 font-[600]">{{$ticket['unread']}}</span>
                    @endif
                </li>
            @endforeach
            @else
                    

            @endif
            </ul>
        </div> -->
    </aside>

     <!-- Global dropdown left Sidebar -->
        <div id="globalDropdown" class="custom-dropdown hidden bg-white border rounded shadow-lg z-10">
            <ul class="text-sm text-gray-700">
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Mute</li>
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Archive</li>
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-500">Delete</li>
            </ul>
        </div>


        <div id="globalDropdown2" class="custom-dropdown hidden bg-white border rounded shadow-lg z-10">
            <ul class="text-sm text-gray-700">
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer" onclick="filterTickets('opened')">Opened</li>
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer" onclick="filterTickets('in_process')">In Process</li>
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-500" onclick="filterTickets('closed')">Closed</li>
            </ul>
        </div>

        <div id="globalDropdown3" class="custom-dropdown hidden bg-white border rounded shadow-lg z-10">
            <ul class="text-sm text-gray-700">
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer" onclick="closeTicket()">Close Ticket</li>
                <!-- <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Archive</li>
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-500">Delete</li> -->
            </ul>
        </div>

    <!-- Chat Window -->
    <main class="chatwindowMain w-full md:w-2/3 lg:w-3/4 bg-gray-50 flex flex-col relative rounded-[10px] shadow-md">
        <div
            class="chatwindowLogo absolute top-[0] bottom-[0] left-[0] right-[0] m-auto flex items-center justify-center opacity-[25%]">
            <img src="/images/logo.png" alt="img">
        </div>
        <!-- Header -->
        <div class="chatwindowHeader px-[10px] py-[10px] border-b flex items-center justify-between gap-3 bg-white z-10">
            <div class="chatwindowUser flex items-center gap-[5px]">
                <img src="/images/user.webp" class="rounded-full w-10 h-10" />
                <div>
                    <p class="text-[12px] xl:text-[15px] text-black font-semibold m-[0]"></p>
                </div>
            </div>

            <div class="chatwindowDrop relative flex items-center">
                <button  onclick="toggleDropdown3(event)"
                    class="p-[0] w-[35px] h-[35px] flex items-center justify-center text-black rounded-[40px] bg-[#f2f2f2] focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[15px] h-[15px]" viewBox="0 0 24 24" fill="currentColor"><path d="M3 4H21V6H3V4ZM9 11H21V13H9V11ZM3 18H21V20H3V18Z"></path></svg>
                </button>

                
              



                <!-- Dropdown Menu (initially hidden) -->
                <div
                    class="dropdownNav absolute right-0 top-[30px] mt-2 w-32 bg-white border rounded shadow-lg hidden z-[99]">
                    <ul class="text-sm text-gray-700">
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Mute</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Archive</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-500">Delete</li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- Messages Area with Scroll Fix -->
        <div id="chatMessages"
            class="relative 1111h-[35vh] md:h-[100vh] overflow-y-auto pt-[40px] px-[10px] py-[10px] md:px-[20px] md:py-[20px] xl:px-[30px] xl:py-[30px] space-y-4 z-[1]">

            <div class="text-left">
                <div
                    class="chatwindowMsg relative inline-flex flex-col bg-gray-100 p-[12px] lg:text-[15px]  text-sm  shadow-md rounded-[10px] rounded-tl-[0]">
                    <div class="absolute top-2 left-[-15px] w-0 h-0 border-t-[15px] border-t-transparent border-b-[15px] border-b-transparent border-r-[15px] border-r-gray-100">
                    </div>

                    <p class="text-[12px] text-black xl:text-[13px]">
                    </p>

                    <div class="chatWindowDate w-full text-end text-black flex justify-end gap-[5px] items-center text-[12px] text-[#000]">
                       <div class="chatWindowTime text-[12px] text-black font-[600]"></div>
                    </div>
                </div>
            </div>


            <div class="text-right">
                <div
                    class="chatwindowMsg relative inline-block bg-green-100 text-green-800 text-sm p-[12px] lg:text-[15px] rounded-[10px] rounded-tl-[0] shadow-md">
                    <div
                        class="absolute top-2 right-[-15px] w-0 h-0 border-t-[15px] border-t-transparent border-b-[15px] border-b-transparent border-l-[15px] border-l-green-100">
                    </div>
                    <p class="text-[12px] xl:text-[13px]">
                    </p>

                    <div class="chatWindowDate w-full text-end flex justify-end gap-[5px] items-center text-[12px] text-[#000]">
                         <div class="text-[12px] text-black font-[600]"></div>
                    </div>
                </div>
            </div>



        </div>

        <!-- Input Box (Fixed on Mobile) -->
        <div id="chatInputBar"
            class="flex gap-[6px] md:gap-[10px] p-[10px] md:p-[13px] border-t  mobile-fixed md:relative w-full">
            <form onsubmit="event.preventDefault(); addMessage();" enctype="multipart/form-data" class="w-full flex items-center gap-2">
            <div class="relative flex items-center">
                <label for="fileInput" class="cursor-pointer flex items-center justify-center w-[35px] bg-[#49FB53] py-[10px] w-[100px] border border-[#33c33b] rounded-[4px] text-[14px] font-[500] text-[#000] text-center mb-[0]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.172 7l-6.586 6.586a2 2 0 002.828 2.828l6.586-6.586A4 4 0 1012 3.172l-6.586 6.586" />
                    </svg>
                    <!-- <span class="text-[0] md:text-[15px]">Attach</span> -->
                </label>
                <input id="fileInput" type="file" class="hidden" name="attachment"/>
            </div>

                <textarea id="msgInput" placeholder="Type a message..."
                    class="w-full flex-1 py-[15px] px-[30px] border-none bg-[#f2f2f2] rounded-[80px] text-[11px] md:text-[15px] text-black focus:outline-none"></textarea>
                <button type="submit"
                    class="w-[35px] h-[35px] min-h-[auto] flex items-center justify-center bg-[#49FB53] text-black p-[0] rounded-[100px] hover:bg-green-600"><svg
                        xmlns="http://www.w3.org/2000/svg" class="w-[15px] h-[15px]" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M1.94607 9.31543C1.42353 9.14125 1.4194 8.86022 1.95682 8.68108L21.043 2.31901C21.5715 2.14285 21.8746 2.43866 21.7265 2.95694L16.2733 22.0432C16.1223 22.5716 15.8177 22.59 15.5944 22.0876L11.9999 14L17.9999 6.00005L9.99992 12L1.94607 9.31543Z">
                        </path>
                    </svg></button>
            </form>
        </div>

        <div id="chatClosedMessage" class="chatwindowAreaBx hidden text-center text-sm text-gray-600 p-4 w-full border-t bg-gray-100 z-[999]">
            This ticket has been closed.
        </div>
    </main>
    
</div>

<div id="closeTicketModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 text-center">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Are you sure you want to close this ticket?</h2>
        <p class="text-sm text-gray-600 mb-6">You won't be able to send or receive messages once it's closed and this action can't be revert.</p>
        <div class="flex justify-center gap-4">
            <button onclick="confirmCloseTicket()" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                Yes, Close
            </button>
            <button onclick="hideCloseModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
                Cancel
            </button>
        </div>
    </div>
</div>
<script>
$('#msgInput').summernote({
    height: 50,
    placeholder: 'Write your message here...',
    toolbar: [],
})
</script>


<script>
    let currentTicketFilter = null;

    document.addEventListener("DOMContentLoaded", function () {
        var tickets = @json($tickets); // Correct way to pass PHP array to JS

        const dropdownButton = document.querySelector('button[onclick="toggleDropdown3(event)"]');


        if (tickets.length > 0) {
            var ticketId = tickets[0].id;
            loadConversation(ticketId);
        }
        else{
            if (dropdownButton) {
                dropdownButton.style.display = 'none'; // Hide the button
                // OR, if using Tailwind:
                // dropdownButton.classList.add('hidden');
            }
        }
    });

    function loadConversation(ticketId) {
        window.currentTicketId = ticketId;

        fetch(`/ticketMessages/${ticketId}`)
            .then(response => response.json())
            .then(data => {
                const chatWindow = document.getElementById('chatMessages');
                const headerUser = document.querySelector('.chatwindowUser p');
                const logo = document.querySelector('.chatwindowLogo img');
                const inputBar = document.getElementById('chatInputBar');
                const closedMessage = document.getElementById('chatClosedMessage');

                refreshTicketList();

                // Update chat header
                headerUser.textContent = data.ticket.tracking.offer_name;

                if (data.ticket.status == 2) {
                    inputBar.style.display = 'none';
                    closedMessage.style.display = 'block';
                } else {
                    inputBar.style.display = 'flex';
                    closedMessage.style.display = 'none';
                }

                // Clear chat area
                chatWindow.innerHTML = '';

                // Add each message
                data.messages.forEach(msg => {
                    const msgWrapper = document.createElement('div');
                    msgWrapper.classList.add(msg.from == "admin" ? 'text-right' : 'text-left');

                    const bubble = document.createElement('div');
                    bubble.className = msg.from == "admin"
                        ? 'chatwindowMsg relative inline-block bg-green-100 text-green-800 text-black text-sm p-[12px] lg:text-[15px] rounded-[10px] rounded-tl-[0] shadow-md'
                        : 'chatwindowMsg relative inline-flex flex-col bg-gray-100 p-[12px] text-black lg:text-[15px] text-sm shadow-md rounded-[10px] rounded-tl-[0]';

                    // Arrow div
                    const arrow = document.createElement('div');
                    arrow.className = msg.from == "admin"
                        ? 'absolute top-2 right-[-15px] w-0 h-0 border-t-[15px] border-t-transparent border-b-[15px] border-b-transparent border-l-[15px] border-l-green-100'
                        : 'absolute top-2 left-[-15px] w-0 h-0 border-t-[15px] border-t-transparent border-b-[15px] border-b-transparent border-r-[15px] border-r-gray-100';
                    bubble.appendChild(arrow);

                    // Message text
                    const msgText = document.createElement('p');
                    msgText.className = 'text-[12px] xl:text-[13px]';
                    msgText.innerHTML = msg.message || msg.media;
                    bubble.appendChild(msgText);

                    const timestamp = document.createElement('div');
                    timestamp.className = 'chatWindowDate w-full text-end text-black flex justify-end gap-[5px] items-center text-[12px] text-[#000]';

                    const time = new Date(msg.created_at);

                    const day = time.getDate();
                    const month = time.toLocaleString('default', { month: 'short' });
                    const year = time.getFullYear();
                    const formattedDate = `${day} ${month} ${year}`;
                    const formattedTime = time.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });

                    timestamp.innerHTML = `${formattedDate} <div class="text-[12px] text-black font-[600]">${formattedTime}</div>`;
                    bubble.appendChild(timestamp);

                    msgWrapper.appendChild(bubble);
                    chatWindow.appendChild(msgWrapper);
                });
                chatWindow.scrollTop = chatWindow.scrollHeight;
            });
    }

    function refreshTicketList() {
        var url = '/refresh-tickets';
        if(currentTicketFilter){
            url = '/refresh-tickets?status='+currentTicketFilter;
        }
        fetch(url)
            .then(response => response.text())
            .then(html => {
                document.getElementById('myDiv').innerHTML = html;
            });
    }

    function addMessage() {
        const ticketId = window.currentTicketId;

        // Get the HTML content from Summernote
        let content = $('#msgInput').summernote('code').trim();

        // Convert <img> tags to <a> download links
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = content;

        const images = tempDiv.querySelectorAll('img');
        images.forEach(img => {
            const src = img.getAttribute('src');
            if (src) {
                const a = document.createElement('a');
                a.setAttribute('href', src);
                a.innerHTML = '🖼️ Attachment';

                img.parentNode.replaceChild(a, img);
            }
        });

        const finalMessage = tempDiv.innerHTML.trim();

        if (finalMessage) {
            $.ajax({
                url: '{{ route("sendMessage") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    message: finalMessage,
                    ticket_id: ticketId
                },
                success: function (response) {
                    $('#msgInput').summernote('reset');
                    toastr.success(response.message || 'Message Sent');
                    loadConversation(ticketId);
                },
                error: function (xhr) {
                    alert('Message failed to send');
                    console.log(xhr.responseText);
                }
            });
        }
    }


    document.getElementById('fileInput').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('attachment', file);

        // CSRF token if using Laravel
        formData.append('_token', '{{ csrf_token() }}');

        fetch('/upload-attachment', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const imageUrl = data.url;
                const fileName = file.name;

                // Insert a downloadable link with an icon into the Summernote editor
                const icon = '<svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M3 3a1 1 0 011-1h3.586a1 1 0 01.707.293l8.414 8.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-3.586a1 1 0 01-.707-.293L3.293 5.707A1 1 0 013 5V3z"/></svg>';

                $('#msgInput').summernote('pasteHTML', `<img src="${imageUrl}" alt="${fileName}" style="max-width:50%; height:auto; margin-bottom:10px;" /><br/>`);    
            } else {
                alert('File upload failed');
            }
        })
        .catch(err => {
            console.error('Upload error:', err);
            alert('Upload failed.');
        });
    });


    function filterTickets(status) {
        currentTicketFilter = status;
        fetch(`/refresh-tickets?status=${status}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('myDiv').innerHTML = html;
            })
            .catch(err => {
                alert('Failed to load tickets.');
                console.error(err);
            });
    }

    function closeTicket() {
        document.getElementById('closeTicketModal').classList.remove('hidden');
        document.getElementById('closeTicketModal').classList.add('flex');
    }

    function hideCloseModal() {
        document.getElementById('closeTicketModal').classList.remove('flex');
        document.getElementById('closeTicketModal').classList.add('hidden');
    }

    function confirmCloseTicket() {
        hideCloseModal();

        // 👇 Put your real close logic here (e.g., AJAX or redirect)
        console.log('Ticket closed');

        $.ajax({
            url: '{{ route("closeTicket") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                ticket_id: window.currentTicketId // Laravel CSRF protection
            },
            success: function(response) {
                if (response.success) {
                   toastr.success(response.message || 'Ticket Closed');
                    // Optionally update UI (e.g., hide ticket, change label, etc.)
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                   toastr.error(response.message || 'Error');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Something went wrong.');
            }
        });
    }
</script>
@stop
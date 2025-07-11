@extends('layouts.default')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

<!-- Before </body> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>



<div class="bg-gray-100 h-[100vh] 1w-screen">
<div class="flex flex-col md:flex-row h-[] border-t-[1px] borde-t-[#f2f2f2]">

    <!-- Sidebar -->
    <aside class="w-full md:w-1/3 lg:w-1/4 bg-white border-r border-gray-300 flex flex-col">
      <div class="p-4 border-b border-b-[#f2f2f2]">
        <div class="flex gap-[8px] items-center justify-between">
          <h2 class="text-lg font-semibold">Chats</h2>
          <div class="relative">
              <button onclick="toggleDropdown(this)" class="w-[35px] h-[35px] text-black hover:text-black focus:outline-none px-2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3C10.9 3 10 3.9 10 5C10 6.1 10.9 7 12 7C13.1 7 14 6.1 14 5C14 3.9 13.1 3 12 3ZM12 17C10.9 17 10 17.9 10 19C10 20.1 10.9 21 12 21C13.1 21 14 20.1 14 19C14 17.9 13.1 17 12 17ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"></path></svg>
              </button>

              <!-- Dropdown Menu (initially hidden) -->
              <div class="dropdownNav absolute right-0 mt-2 w-32 bg-white border rounded shadow-lg hidden z-10">
                <ul class="text-sm text-gray-700">
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Mute</li>
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Archive</li>
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-500">Delete</li>
                </ul>
              </div>
            </div>
        </div>
        <div class="flex gap-[10px] relative">
          <input type="text" placeholder="Search or start new chat" class="mt-2 w-full pl-[50px] pr-[15px] py-[15px] border rounded-[60px] text-sm bg-[#f5f5f5] focus:outline-none" />
          <button class="w-[25px] text-[#4EF953] text-[10px] absolute top-[22px] start-[15px]">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z"></path></svg>
          </button>
        </div>
        
      </div>
      <div class="overflow-y-auto flex-grow">
        <ul>
          <li class="relative p-4 hover:bg-gray-100 border-b border-b-[#f2f2f2] flex items-center gap-3 cursor-pointer">

            <!-- Avatar -->
            <img src="/images/user.webp" class="rounded-full w-10 h-10" />

            <!-- Chat Info -->
            <div class="flex-1 w-[70%]">
              <div class="flex justify-between items-center">
                <span class="font-semibold truncate">Ipsum Lorem</span>
                <span class="text-xs font-bold text-[#49FB53]">14:56</span>
              </div>
              <p class="text-sm text-gray-500 truncate m-[0]">Hey, how’s it going?</p>
            </div>

            <!--  Unread Badge -->
            <span class="absolute right-[60px] top-[45px] text-black text-xs rounded-full flex items-center justify-center w-[22px] h-[22px] bg-[#49FB53]">
              2
            </span>

            <!-- ⋮ Dropdown Trigger -->
            <div class="relative">
              <button onclick="toggleDropdown(this)" class="text-gray-500 hover:text-black focus:outline-none px-2">
                ⋮
              </button>

              <!-- Dropdown Menu (initially hidden) -->
              <div class="dropdownNav absolute right-0 mt-2 w-32 bg-white border rounded shadow-lg hidden z-10">
                <ul class="text-sm text-gray-700">
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Mute</li>
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Archive</li>
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-500">Delete</li>
                </ul>
              </div>
            </div>

          </li>


          <li class="relative p-4 hover:bg-gray-100 border-b border-b-[#f2f2f2] flex items-center gap-3 cursor-pointer">

            <!-- Avatar -->
            <img src="/images/user.webp" class="rounded-full w-10 h-10" />

            <!-- Chat Info -->
            <div class="flex-1  w-[70%]">
              <div class="flex justify-between items-center">
                <span class="font-semibold truncate">Lorem Set</span>
                <span class="text-xs text-gray-500">14:56</span>
              </div>
              <p class="text-sm text-gray-500 truncate m-[0]">Hey, how’s it going?</p>
            </div>

            <!-- 🔴 Unread Badge -->
            <span class="absolute right-[60px] top-[45px] text-black text-xs rounded-full flex items-center justify-center w-[22px] h-[22px] bg-[#49FB53]">
              2
            </span>

            <!-- ⋮ Dropdown Trigger -->
            <div class="relative">
              <button onclick="toggleDropdown(this)" class="text-gray-500 hover:text-black focus:outline-none px-2">
                ⋮
              </button>

              <!-- Dropdown Menu (initially hidden) -->
              <div class="dropdownNav absolute right-0 mt-2 w-32 bg-white border rounded shadow-lg hidden z-10">
                <ul class="text-sm text-gray-700">
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Mute</li>
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Archive</li>
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-500">Delete</li>
                </ul>
              </div>
            </div>

          </li>


         <li class="relative p-4 hover:bg-gray-100 border-b border-b-[#f2f2f2] flex items-center gap-3 cursor-pointer">

            <!-- Avatar -->
            <img src="/images/user.webp" class="rounded-full w-10 h-10" />

            <!-- Chat Info -->
            <div class="flex-1 w-[70%]">
              <div class="flex justify-between items-center">
                <span class="font-semibold truncate truncate">Sit Destis</span>
                <span class="text-xs text-gray-500">14:56</span>
              </div>
              <p class="text-sm text-gray-500 truncate mb-[0] truncate     max-w-[80%]">Hey, how’s it going Hey, how’s it going Hey, how’s it going ?</p>
            </div>

            <!-- Unread Badge -->
            <span class="absolute right-[60px] top-[45px] text-black text-xs rounded-full flex items-center justify-center w-[22px] h-[22px] bg-[#49FB53]">
              2
            </span>

            <!-- ⋮ Dropdown Trigger -->
            <div class="relative">
              <button onclick="toggleDropdown(this)" class="text-gray-500 hover:text-black focus:outline-none px-2">
                ⋮
              </button>

              <!-- Dropdown Menu (initially hidden) -->
              <div class="dropdownNav absolute right-0 mt-2 w-32 bg-white border rounded shadow-lg hidden z-10">
                <ul class="text-sm text-gray-700">
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Mute</li>
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Archive</li>
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-500">Delete</li>
                </ul>
              </div>
            </div>

          </li>
        </ul>

      </div>
    </aside>

    <!-- Chat Window -->
    <main class="w-full md:w-2/3 lg:w-3/4 bg-gray-50 flex flex-col relative h-screen">
      <div class="absolute top-[0] bottom-[0] left-[0] right-[0] m-auto flex items-center justify-center opacity-[25%]"> <img src="/images/logo.png" alt="img"></div>
      <!-- Header -->
      <div class="p-4 border-b flex items-center justify-between gap-3 bg-white z-10">
        <div class="flex gap-[5px]">
          <img src="/images/user.webp" class="rounded-full w-10 h-10" />
          <div>
            <p class="font-semibold m-[0]">Alice Whitman</p>
            <p class="text-sm text-green-600 m-[0]">online</p>
          </div>
        </div>

        <div class="relative">
              <button onclick="toggleDropdown(this)" class="w-[35px] h-[35px] text-black  hover:text-black focus:outline-none px-2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3C10.9 3 10 3.9 10 5C10 6.1 10.9 7 12 7C13.1 7 14 6.1 14 5C14 3.9 13.1 3 12 3ZM12 17C10.9 17 10 17.9 10 19C10 20.1 10.9 21 12 21C13.1 21 14 20.1 14 19C14 17.9 13.1 17 12 17ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"></path></svg>
              </button>

             


              <!-- Dropdown Menu (initially hidden) -->
              <div class="dropdownNav absolute right-0 mt-2 w-32 bg-white border rounded shadow-lg hidden z-[99]">
                <ul class="text-sm text-gray-700">
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Mute</li>
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Archive</li>
                  <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-500">Delete</li>
                </ul>
              </div>
            </div>

      </div>

      <!-- Messages Area with Scroll Fix -->
      <div id="chatMessages" class="1flex-1 h-[70vh] overflow-y-auto px-4 py-2 space-y-4 z-[1]"> <!-- Adjust based on header/footer height -->
        <!-- Dummy Messages -->
         
        <div class="text-right">
          <div class="inline-block bg-green-100 text-green-800 text-sm p-2 rounded-lg max-w-xs">
            Here are all the files. Let me know once you’ve had a look.
          </div>
        </div>

        <!-- Add many messages to test scroll -->
        <script>
          for (let i = 1; i <= 25; i++) {
            document.write(`
              <div class="text-left">
                <div class="inline-block bg-white p-2 rounded-lg text-sm shadow max-w-xs">
                  Sample message #${i}
                </div>
              </div>
            `);
          }
        </script>
      </div>

      <!-- Input Box (Fixed on Mobile) -->
      <div class="p-3 border-t  mobile-fixed md:relative z-[999]">
        <form onsubmit="event.preventDefault(); addMessage();" class="flex items-center gap-2">
          <textarea id="msgInput" placeholder="Type a message..." class="flex-1 py-[15px] px-[30px] border-none bg-[#f2f2f2] rounded-[80px] text-[15px] text-black focus:outline-none" ></textarea>
          <button type="submit" class="w-[50px] h-[50px] flex items-center justify-center bg-[#49FB53] text-black p-[0] rounded-[100px] hover:bg-green-600"><svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px]" viewBox="0 0 24 24" fill="currentColor"><path d="M1.94607 9.31543C1.42353 9.14125 1.4194 8.86022 1.95682 8.68108L21.043 2.31901C21.5715 2.14285 21.8746 2.43866 21.7265 2.95694L16.2733 22.0432C16.1223 22.5716 15.8177 22.59 15.5944 22.0876L11.9999 14L17.9999 6.00005L9.99992 12L1.94607 9.31543Z"></path></svg></button>
        </form>
      </div>
    </main>

  </div>
  </div>

  <script>
    $('#msgInput').summernote({
      height: 50,
      placeholder: 'Write your message here...',
      toolbar:[],
    })
  </script>
@stop
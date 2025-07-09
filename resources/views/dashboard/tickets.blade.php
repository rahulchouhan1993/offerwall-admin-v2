@extends('layouts.default')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

<!-- Before </body> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>



<div class="bg-gray-100 h-[100vh] 1w-screen">
<div class="flex flex-col md:flex-row h-screen border-t-[1px] borde-t-[#f2f2f2]">

    <!-- Sidebar -->
    <aside class="w-full md:w-1/3 lg:w-1/4 bg-white border-r border-gray-300 flex flex-col">
      <div class="p-4 border-b">
        <h2 class="text-lg font-semibold">Chats</h2>
        <input type="text" placeholder="Search or start new chat" class="mt-2 w-full p-2 border rounded text-sm" />
      </div>
      <div class="overflow-y-auto flex-grow">
        <ul>
          <li class="relative p-4 hover:bg-gray-100 border-b flex items-center gap-3 cursor-pointer">

            <!-- Avatar -->
            <img src="/images/user.webp" class="rounded-full w-10 h-10" />

            <!-- Chat Info -->
            <div class="flex-1">
              <div class="flex justify-between items-center">
                <span class="font-semibold">Ipsum Lorem</span>
                <span class="text-xs text-gray-500">14:56</span>
              </div>
              <p class="text-sm text-gray-500 truncate m-[0]">Hey, how’s it going?</p>
            </div>

            <!--  Unread Badge -->
            <span class="absolute right-[60px] top-[45px] bg-red-500 text-white text-xs rounded-full px-2 py-0.5">
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


          <li class="relative p-4 hover:bg-gray-100 border-b flex items-center gap-3 cursor-pointer">

            <!-- Avatar -->
            <img src="/images/user.webp" class="rounded-full w-10 h-10" />

            <!-- Chat Info -->
            <div class="flex-1">
              <div class="flex justify-between items-center">
                <span class="font-semibold">Lorem Set</span>
                <span class="text-xs text-gray-500">14:56</span>
              </div>
              <p class="text-sm text-gray-500 truncate m-[0]">Hey, how’s it going?</p>
            </div>

            <!-- 🔴 Unread Badge -->
            <span class="absolute right-[60px] top-[45px] bg-red-500 text-white text-xs rounded-full px-2 py-0.5">
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


         <li class="relative p-4 hover:bg-gray-100 border-b flex items-center gap-3 cursor-pointer">

            <!-- Avatar -->
            <img src="/images/user.webp" class="rounded-full w-10 h-10" />

            <!-- Chat Info -->
            <div class="flex-1">
              <div class="flex justify-between items-center">
                <span class="font-semibold">Sit Destis</span>
                <span class="text-xs text-gray-500">14:56</span>
              </div>
              <p class="text-sm text-gray-500 truncate mb-[0]">Hey, how’s it going?</p>
            </div>

            <!-- Unread Badge -->
            <span class="absolute right-[60px] top-[45px] bg-red-500 text-white text-xs rounded-full px-2 py-0.5">
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
    <main class="w-full md:w-2/3 lg:w-3/4 bg-gray-50 flex flex-col relative">
      <div class="absolute top-[0] bottom-[0] left-[0] right-[0] m-auto flex items-center justify-center opacity-[25%]"> <img src="/images/logo.png" alt="img"></div>
      <!-- Header -->
      <div class="p-4 border-b flex items-center gap-3 bg-white z-10">
        <img src="/images/user.webp" class="rounded-full w-10 h-10" />
        <div>
          <p class="font-semibold m-[0]">Alice Whitman</p>
          <p class="text-sm text-green-600 m-[0]">online</p>
        </div>
      </div>

      <!-- Messages Area with Scroll Fix -->
      <div id="chatMessages" class="flex-1 overflow-y-auto px-4 py-2 space-y-4 z-10"
        style="height: calc(100vh - 64px - 64px);"> <!-- Adjust based on header/footer height -->
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
      <div class="p-3 border-t bg-white mobile-fixed md:relative z-50">
        <form onsubmit="event.preventDefault(); addMessage();" class="flex items-center gap-2">
          <input id="msgInput" type="text" placeholder="Type a message..." class="flex-1 p-2 border rounded text-sm" />
          <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Send</button>
        </form>
      </div>
    </main>

  </div>
  </div>
@stop
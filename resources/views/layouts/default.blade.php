<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="Googlebot-News" content="noindex, nnofollow">
	<meta name="googlebot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin | {{ $pageTitle }}</title>
    <!-- Fonts -->
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- For Select Box Js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="loader-fcustm fixed inset-0 flex flex-col items-center justify-center bg-white bg-opacity-75 backdrop-blur-md z-50">
        <div class="w-10 h-10 border-4 border-[#4FF956] border-t-transparent rounded-full animate-spin"></div>
        <p class="mt-4 text-lg font-semibold text-[#4FF956]">Loading...</p>
    </div>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    
        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
    @include('layouts.header')
    <div class="pt-[50px] md:pt-[80px] flex dashboardMain">
        @include('layouts.sidebar')
        <div class="dashboardContainer bg-[#F2F2F2]  pb-[70px]">
            @yield('content')
            @include('layouts.footer')
        </div>
    </div>
    <!-- For Select Box Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.onload = function() {
                $('.loader-fcustm').fadeOut(1000)
            };
        });

        $(document).ready(function() {
            $('.sel2fld').select2({
                placeholder: "Select an option",
                allowClear: true // Adds a clear (X) button
            });

            $('.select-affiliate-dash').select2({
                placeholder: "Select an affiliate",
                allowClear: true // Adds a clear (X) button
            });
        });
        
        $(function() {
            $('.dateRange').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(6, 'days'),  // Default start date (7 days ago)
                endDate: moment(),  
                opens: 'right'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('menuToggle');

            button.addEventListener('click', function() {
                document.body.classList.toggle('active');
            });
        });
        document.addEventListener("alpine:init", () => {
            Alpine.data("select", () => ({
                open: false,
                language: "",

                toggle() {
                    this.open = !this.open;
                },

                setLanguage(val) {
                    this.language = val;
                    this.open = false;
                },
            }));
        });
        const dropdownMenu = document.getElementById('dropdown-menu');

        // Add event listeners to all dropdown buttons
        document.querySelectorAll('.dropdown-btn').forEach((button) => {
          button.addEventListener('click', function (e) {
            e.stopPropagation(); // Prevent event bubbling

            // Get the position of the clicked button
            const buttonRect = button.getBoundingClientRect();

            // Position the dropdown menu below the button and aligned to the right
            dropdownMenu.style.top = `${buttonRect.bottom + window.scrollY}px`; // Below the button
            dropdownMenu.style.left = ''; // Clear left to avoid conflicts
            dropdownMenu.style.right = `${window.innerWidth - buttonRect.right}px`; // Align to the right edge

            // Toggle visibility
            if (dropdownMenu.classList.contains('hidden')) {
              dropdownMenu.classList.remove('hidden');
              dropdownMenu.classList.add('block');
            } else {
              dropdownMenu.classList.remove('block');
              dropdownMenu.classList.add('hidden');
            }
          });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function () {
          dropdownMenu.classList.remove('hidden');
          dropdownMenu.classList.add('hidden');
        });
        // Toggle the dropdown menu visibility
        document.getElementById("dropdownButton").addEventListener("click", function() {
          const menu = document.getElementById("dropdownMenu");
          menu.classList.toggle("hidden");
        });

        // Close the dropdown if clicked outside
        document.addEventListener("click", function(event) {
          const button = document.getElementById("dropdownButton");
          const menu = document.getElementById("dropdownMenu");
          if (!button.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add("hidden");
          }
        });
</script>

<!-- chat js -->
<script>
    let activeButton = null;
    function toggleDropdown(e) {
      e.stopPropagation();
      const button = e.currentTarget;
      const dropdown = document.getElementById("globalDropdown");
      if (activeButton === button && !dropdown.classList.contains("hidden")) {
        dropdown.classList.add("hidden");
        activeButton = null;
        return;
      }
      activeButton = button;
      const rect = button.getBoundingClientRect();
      dropdown.style.top = rect.bottom + window.scrollY + "px";
      dropdown.style.left = rect.right - 140 + "px";
      dropdown.classList.remove("hidden");
    }
    document.addEventListener("click", () => {
      document.getElementById("globalDropdown").classList.add("hidden");
      activeButton = null;
    });
  </script>



<script>
    let activeButton2 = null;
    function toggleDropdown2(e) {
      e.stopPropagation();
      const button = e.currentTarget;
      const dropdown = document.getElementById("globalDropdown2");
      if (activeButton2 === button && !dropdown.classList.contains("hidden")) {
        dropdown.classList.add("hidden");
        activeButton2 = null;
        return;
      }
      activeButton2 = button;
      const rect = button.getBoundingClientRect();
      dropdown.style.top = rect.bottom + window.scrollY + "px";
      dropdown.style.left = rect.right - 140 + "px";
      dropdown.classList.remove("hidden");
    }
    document.addEventListener("click", () => {
      document.getElementById("globalDropdown2").classList.add("hidden");
      activeButton2 = null;
    });
  </script>



<script>
    let activeButton3 = null;
    function toggleDropdown3(e) {
      e.stopPropagation();
      const button = e.currentTarget;
      const dropdown = document.getElementById("globalDropdown3");
      if (activeButton3 === button && !dropdown.classList.contains("hidden")) {
        dropdown.classList.add("hidden");
        activeButton3 = null;
        return;
      }
      activeButton3 = button;
      const rect = button.getBoundingClientRect();
      dropdown.style.top = rect.bottom + window.scrollY + "px";
      dropdown.style.left = rect.right - 140 + "px";
      dropdown.classList.remove("hidden");
    }
    document.addEventListener("click", () => {
      document.getElementById("globalDropdown3").classList.add("hidden");
      activeButton3 = null;
    });
  </script>


<script>
    function toggleDiv() {
      const div = document.getElementById("myDiv");
      div.classList.toggle("hidden");
    }
  </script>


</body>

</html>
@extends('layouts.login')
@section('content')
<!-- <p>You will find this file in resources/views/users/login.blade.php</p> -->
<div class="flex flex-wrap lg:flex-nowrap justify-center w-[100%] max-[1920px] items-stretch gap-[0]">
    <div class="loginBx flex items-center flex-wrap md:flex-nowrap justify-center w-[100%] px-[20px] py-[50px] md:px-[30px] md:py-[60px]  lg:px-[20px] lg:py-[65px]   ">
        <div class="max-w-[450px] w-[100%] px-[20px] py-[35px] md:px-[40px] md:py-[65px] bg-[#fff] rounded-[10px] md:rounded-[15px]">
        <div class=" flex items-center justify-center mb-[20px] md:mb-[50px]">
                <a href="#">
                    <img src="/images/logo.png?2343" alt="logo">
                </a>
            </div>
            <script>
                @if (session('success'))
                    toastr.success("{{ session('success') }}");
                @endif
            
                @if (session('error'))
                    toastr.error("{{ session('error') }}");
                @endif
            </script>
           <h2 class="text-[22px] text-center leading-[30px] md:text-[28px] md:leading-[30px] lg:text-[30px] lg:leading-[32px] font-[700] text-[#1A1A1A]"> Log in to get started!!</h2>
            <div class="mt-[30px] md:mt-[45px] lg:mt-[55px]">
                <form method="post">
                    @csrf
                    <div id="loginForm" class="flex flex-col gap-[25px]">
                        <div class="">
                            <div class="text-[16px] font-[600] text-[#1A1A1A] mb-[8px]">Username</div>
                            <div class="relative">
                                <input type="text" placeholder="username" name="email"
                                    class="block w-[100%] border-[1px] border-[#00000021] rounded-[7px] px-[15px] pr-[55px] py-[15px] bg-[#F6F6F6] hover:outline-none focus:outline-none">
                                <div class="absolute top-[16px] right-[22px]">
                                <svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.9984 14.0346C15.3548 14.0346 17.2651 12.1244 17.2651 9.76792C17.2651 7.41149 15.3548 5.50122 12.9984 5.50122C10.642 5.50122 8.73169 7.41149 8.73169 9.76792C8.73169 12.1244 10.642 14.0346 12.9984 14.0346Z" fill="#BFBFBF"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0004 15.0986C9.08567 15.0986 5.87498 17.6799 5.55924 20.9653C5.53151 21.2586 5.77258 21.4986 6.06698 21.4986H19.9338C20.0031 21.5005 20.0721 21.4877 20.1363 21.4612C20.2004 21.4347 20.2583 21.3951 20.3061 21.3448C20.354 21.2945 20.3908 21.2348 20.4141 21.1694C20.4374 21.104 20.4467 21.0345 20.4415 20.9653C20.1258 17.6799 16.9151 15.0986 13.0004 15.0986Z" fill="#BFBFBF"/>
                                    </svg>

                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="text-[16px] font-[600] text-[#1A1A1A] mb-[8px]">Password</div>
                            <div class="relative">
                                <input type="password" placeholder="************" name="password"
                                class="block w-[100%] border-[1px] border-[#00000021] rounded-[7px] px-[15px] pr-[55px] py-[15px] bg-[#F6F6F6] hover:outline-none focus:outline-none">
                                <div class="absolute top-[16px] right-[22px]">
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 16.5C8.83333 16.5 9.54167 16.2083 10.125 15.625C10.7083 15.0417 11 14.3333 11 13.5C11 12.6667 10.7083 11.9583 10.125 11.375C9.54167 10.7917 8.83333 10.5 8 10.5C7.16667 10.5 6.45833 10.7917 5.875 11.375C5.29167 11.9583 5 12.6667 5 13.5C5 14.3333 5.29167 15.0417 5.875 15.625C6.45833 16.2083 7.16667 16.5 8 16.5ZM8 19.5C6.33333 19.5 4.91667 18.9167 3.75 17.75C2.58333 16.5833 2 15.1667 2 13.5C2 11.8333 2.58333 10.4167 3.75 9.25C4.91667 8.08333 6.33333 7.5 8 7.5C9.35 7.5 10.5293 7.88333 11.538 8.65C12.5467 9.41667 13.2507 10.3667 13.65 11.5H22.025L24 13.475L20.5 17.475L18 15.5L16 17.5L14 15.5H13.65C13.2333 16.7 12.5083 17.6667 11.475 18.4C10.4417 19.1333 9.28333 19.5 8 19.5Z" fill="#BFBFBF"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Reset Password -->
                {{-- <div id="resetpassword" class="flex flex-col gap-[25px] hide  ">
                    <div class="">
                        <div class="text-[16px] font-[600] text-[#1A1A1A] mb-[8px]">Email</div>
                        <div class="relative">
                            <input type="email" placeholder="Email"
                                class="block w-[100%] border-[1px] border-[#00000021] rounded-[7px] px-[15px] pr-[55px] py-[15px] bg-[#F6F6F6] hover:outline-none focus:outline-none">
                            <div class="absolute top-[16px] right-[22px]">
                            <i class="ri-mail-fill text-[#BFBFBF]"></i>

                            </div>
                        </div>
                    </div>
                </div> 
                <div class="text-right mt-[8px]">
                    <a id="resetPass" href="#" class="text-[14px] text-[#D272D2] font-[500]" onclick="resetPass()">Reset password</a>
                </div>--}}
                    <div class="mt-[30px]">
                        <button type="submit" class="w-[100%] bg-[#4EF953] px-[10px] py-[15px] text-[18px] text-[#210D0F] font-[500] text-center rounded-[8px] hover:bg-[#000] hover:text-[#fff]">
                        Login
                        </button>
                    </div>
                </form>
                <div class="flex items-center justify-between gap-[15px] mt-[60px]">
                    <div class="w-[48%] h-[1px] bg-[#ccc]"></div>
                    <div class="text-[14px] font-[500] text-[#898989]">OR</div>
                    <div class="w-[48%] h-[1px] bg-[#ccc]"></div>
                </div>
                <div class="mt-[50px] text-[14px] font-[500] text-[#898989] text-center">
                Don’t have an account? 
                    <a href="#" class="text-[#4EF953] underline hover:text-[#000] hover:no-underline ">
                    Sign Up
                    </a>
                </div>
            </div>
        </div>
    </div>
   
</div>
<script>
    function resetPass() {
    var element = document.getElementById("loginForm");
    element.classList.add("hide");

    var element = document.getElementById("resetpassword");
    element.classList.remove("hide");
    }
</script> 
@stop
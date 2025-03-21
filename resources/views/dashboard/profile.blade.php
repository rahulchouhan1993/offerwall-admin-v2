@extends('layouts.default')
@section('content')
<div class="p-[15px] md:p-[35px] ">
    <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[10px]">
        <h2 class="mb-[15px] text-[20px] text-[#1A1A1A] font-[600] ">
            Settings    
        </h2>   
        <form method="post">
            @csrf
            <div class="flex flex-col gap-[15px] w-[100%] ">
                <div class="flex flex-wrap md:flex-nowrap gap-[20px] w-[100%">
                    <div class="flex flex-col gap-[5px] w-[100%] md:w-[50%]">
                        <label class="text-[14] text-[#898989]">First Name</label>
                        <input type="text" name="name" class="flex px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $user->name }}">
                        @error('name')
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col gap-[5px] w-[100%] md:w-[50%]">
                        <label class="text-[14] text-[#898989]">Last Name</label>
                        <input type="text" name="last_name" class="flex px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none"  value="{{ $user->last_name }}">
                        @error('last_name')
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-[20px] w-[100%">
                    <div class="flex flex-col gap-[5px] w-[100%]">
                        <label class="text-[14] text-[#898989]">Email</label>
                        <input type="email" name="email" class="flex px-[15px] py-[12px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none focus:outline-none" value="{{ $user->email }}">
                        @error('email')
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-[20px] w-[100%">
                    <div class="flex flex-col gap-[5px] w-[100%]">
                        <label class="text-[14] text-[#898989]">Current Password</label>
                        <div class="relative">
                            <input type="password" name="oldpassword" placeholder="**********" class="flex w-[100%] px-[15px] py-[12px] pr-[50px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none  focus:outline-none">
                            <button class="absolute top-[16px] right-[15px]"><svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.93336 3.8C8.34989 3.8 7.79031 4.03178 7.37773 4.44436C6.96515 4.85695 6.73337 5.41652 6.73337 6C6.73337 6.58348 6.96515 7.14306 7.37773 7.55564C7.79031 7.96822 8.34989 8.2 8.93336 8.2C9.51684 8.2 10.0764 7.96822 10.489 7.55564C10.9016 7.14306 11.1334 6.58348 11.1334 6C11.1334 5.41652 10.9016 4.85695 10.489 4.44436C10.0764 4.03178 9.51684 3.8 8.93336 3.8ZM8.93336 9.66667C7.9609 9.66667 7.02827 9.28036 6.34064 8.59272C5.65301 7.90509 5.2667 6.97246 5.2667 6C5.2667 5.02754 5.65301 4.09491 6.34064 3.40728C7.02827 2.71964 7.9609 2.33333 8.93336 2.33333C9.90583 2.33333 10.8385 2.71964 11.5261 3.40728C12.2137 4.09491 12.6 5.02754 12.6 6C12.6 6.97246 12.2137 7.90509 11.5261 8.59272C10.8385 9.28036 9.90583 9.66667 8.93336 9.66667ZM8.93336 0.5C5.2667 0.5 2.13537 2.78067 0.866699 6C2.13537 9.21933 5.2667 11.5 8.93336 11.5C12.6 11.5 15.7314 9.21933 17 6C15.7314 2.78067 12.6 0.5 8.93336 0.5Z" fill="#A1A1A1"/>
                                </svg>
                                </button>
                            @error('oldpassword')
                                <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex gap-[20px] w-[100%">
                    <div class="flex flex-col gap-[5px] w-[100%]">
                        <label class="text-[14] text-[#898989]">New Password</label>
                        <div class="relative">
                            <input type="password" name="newpassword" placeholder="************" class="flex w-[100%] px-[15px] py-[12px] pr-[50px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none  focus:outline-none">
                            <button class="absolute top-[16px] right-[15px]"><svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.93336 3.8C8.34989 3.8 7.79031 4.03178 7.37773 4.44436C6.96515 4.85695 6.73337 5.41652 6.73337 6C6.73337 6.58348 6.96515 7.14306 7.37773 7.55564C7.79031 7.96822 8.34989 8.2 8.93336 8.2C9.51684 8.2 10.0764 7.96822 10.489 7.55564C10.9016 7.14306 11.1334 6.58348 11.1334 6C11.1334 5.41652 10.9016 4.85695 10.489 4.44436C10.0764 4.03178 9.51684 3.8 8.93336 3.8ZM8.93336 9.66667C7.9609 9.66667 7.02827 9.28036 6.34064 8.59272C5.65301 7.90509 5.2667 6.97246 5.2667 6C5.2667 5.02754 5.65301 4.09491 6.34064 3.40728C7.02827 2.71964 7.9609 2.33333 8.93336 2.33333C9.90583 2.33333 10.8385 2.71964 11.5261 3.40728C12.2137 4.09491 12.6 5.02754 12.6 6C12.6 6.97246 12.2137 7.90509 11.5261 8.59272C10.8385 9.28036 9.90583 9.66667 8.93336 9.66667ZM8.93336 0.5C5.2667 0.5 2.13537 2.78067 0.866699 6C2.13537 9.21933 5.2667 11.5 8.93336 11.5C12.6 11.5 15.7314 9.21933 17 6C15.7314 2.78067 12.6 0.5 8.93336 0.5Z" fill="#A1A1A1"/>
                                </svg>
                                </button>
                            @error('newpassword')
                                <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex gap-[20px] w-[100%">
                    <div class="flex flex-col gap-[5px] w-[100%]">
                        <label class="text-[14] text-[#898989]">Confirm Password</label>
                        <div class="relative">
                            <input type="password" name="confirmpassword" placeholder="***********" class="flex w-[100%] px-[15px] py-[12px] pr-[50px] rounded-[5px] bg-[#F6F6F6] text-[14px] text-[#4D4D4D] font-[600] hover:outline-none  focus:outline-none">
                            <button class="absolute top-[16px] right-[15px]"><svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.93336 3.8C8.34989 3.8 7.79031 4.03178 7.37773 4.44436C6.96515 4.85695 6.73337 5.41652 6.73337 6C6.73337 6.58348 6.96515 7.14306 7.37773 7.55564C7.79031 7.96822 8.34989 8.2 8.93336 8.2C9.51684 8.2 10.0764 7.96822 10.489 7.55564C10.9016 7.14306 11.1334 6.58348 11.1334 6C11.1334 5.41652 10.9016 4.85695 10.489 4.44436C10.0764 4.03178 9.51684 3.8 8.93336 3.8ZM8.93336 9.66667C7.9609 9.66667 7.02827 9.28036 6.34064 8.59272C5.65301 7.90509 5.2667 6.97246 5.2667 6C5.2667 5.02754 5.65301 4.09491 6.34064 3.40728C7.02827 2.71964 7.9609 2.33333 8.93336 2.33333C9.90583 2.33333 10.8385 2.71964 11.5261 3.40728C12.2137 4.09491 12.6 5.02754 12.6 6C12.6 6.97246 12.2137 7.90509 11.5261 8.59272C10.8385 9.28036 9.90583 9.66667 8.93336 9.66667ZM8.93336 0.5C5.2667 0.5 2.13537 2.78067 0.866699 6C2.13537 9.21933 5.2667 11.5 8.93336 11.5C12.6 11.5 15.7314 9.21933 17 6C15.7314 2.78067 12.6 0.5 8.93336 0.5Z" fill="#A1A1A1"/>
                                </svg>
                                </button>
                            @error('password')
                                <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex gap-[10px] md:gap-[20px]">
                    <button type="submit" class="w-[120px] bg-[#D272D2] px-[10px] py-[11px] w-[100px] rounded-[4px] text-[14px] font-[500] text-[#fff] text-center">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
    </div>
  </div>
</div>




@stop
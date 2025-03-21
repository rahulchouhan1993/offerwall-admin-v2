@extends('layouts.default')
@section('content')
<div class="bg-[#f2f2f2] p-[15px] lg:p-[35px]">
<div class="flex flex-col lg:flex-row justify-between items-start gap-[15px] w-[100%] ">
        <div class="w-[100%] lg:w-[100%] bg-[#fff] p-[15px] md:p-[20px] rounded-[10px]">
            <div class="flex flex-wrap md:flex-nowrap items-center justify-between gap-[10px] mb-[20px]">
                <h2 class="w-full lg:w-auto text-[20px] text-[#1A1A1A] font-[600]">Postback</h2>
               
            </div>
            
            <div class="flex gap-[25px] flex-wrap md:flex-nowrap justify-between">
                <div class="w-full md-w-[45%]">
                    <div class="flex items-start justify-between gap-[10px] mb-[15px]">
                        <div class="w-[48%]">
                            <label class=" w-[100%] text-[14px] font-[500] text-[#898989] ">Name</label>
                            <input type="text" name="goal" class="goal-postback-filter w-[100%] bg-[#F6F6F6] px-[15px] py-[12px] text-[12px] font-[500] text-[#808080] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none" placeholder="Goal Name" value="">
                        </div>

                        <div class="w-[48%]">
                            <label class=" w-[100%] text-[14px] font-[500] text-[#898989] ">Email</label>
                            <input type="email" name="goal" class="goal-postback-filter w-[100%] bg-[#F6F6F6] px-[15px] py-[12px] text-[12px] font-[500] text-[#808080] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none" placeholder="Goal Name" value="">
                        </div>
                    </div>

                    <div class="flex items-start flex-wrap gap-[10px] w-full">
                       
                            <label class=" w-[100%] text-[14px] font-[500] text-[#898989] ">Select</label>
                            <div class="w-[100%] flex flex-wrap xl:flex-nowrap  items-center gap-[5px] md:gap-[8px] lg:gap-[10px] xl:gap-[15px]">
                                <div class="relative w-[100%] flex flex-wrap xl:flex-nowrap items-center gap-[10px]">
                                    <select name="offer"
                                        class="offerOption w-[100%] bg-[#F6F6F6] px-[15px] py-[12px] text-[14px] font-[600] text-[#4D4D4D] border-[1px] border-[#E6E6E6] rounded-[4px] hover:outline-none focus:outline-none">
                                        <option value="">Select</option>
                                       
                                        <option>Select 2</option>
                                       
                                    </select>
                                </div>
                  
                            </div>
                        
                    </div>
                </div>

                <div class="w-full md-w-[55%] mt-[20px]">
                <div class=" overflow-x-scroll tableScroll">
                <table class="w-[100%] border-collapse border-spacing-0 rounded-[10px] border-separate border border-[#E6E6E6]">
                    <tbody><tr>
                        <th class=" bg-[#F6F6F6] rounded-tl-[10px] text-[12px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">PID</th>
                        <th class=" bg-[#F6F6F6] rounded-tl-[10px] text-[12px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">Name</th>
                        <th class=" bg-[#F6F6F6] rounded-tl-[10px] text-[12px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap ">Email</th>
                        <th class=" bg-[#F6F6F6] rounded-tl-[10px] text-[12px] font-[500] text-[#1A1A1A] px-[10px] py-[13px] text-left whitespace-nowrap  text-right">Action</th>
                    </tr>
                   
                    <tr>
                        <td class="text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">2</td>

                        <td class=" text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">2fun2Me</td>

                        <td class="text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">2fun2me@makamobile.com</td>

                       <td class=" text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">Test</td>
                    </tr>  
                    <tr>
                        <td class="text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">2</td>

                        <td class=" text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">2fun2Me</td>

                        <td class="text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">2fun2me@makamobile.com</td>

                       <td class=" text-[12px] font-[500] text-[#808080] px-[10px] py-[10px] text-left whitespace-nowrap  border-b-[1px] border-b-[#E6E6E6]">Test</td>
                    </tr>  
                    </tbody>
                </table>
                    <!-- Dropdown Action Menu -->
                 
                    
                
            </div>
                </div>
            </div>



           
        </div>
        </div>
    </div>
@stop
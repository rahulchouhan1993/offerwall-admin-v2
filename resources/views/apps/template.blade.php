@extends('layouts.default')
@section('content')


<div
    class='flex flex-wrap lg:flex-nowrap gap-[20px] w-[100%] items-start px-[15px] py-[15px]  md:px-[20px] md:py-[20px] lg:px-[30px] lg:py-[30px] bg-[#F6F6F6]'>
    <div class='w-[100%] lg:w-[70%] bg-[#fff] p-[20px] rounded-[10px]'>
        <form method="post">
            @csrf
            <div class='flex flex-col gap-[15px] mb-[25px]'>
                <h2 class='mb-[15px] text-[20px] text-[#1A1A1A] font-[600] '>Header Settings</h2>
                <div class='grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4'>
                    <div class="relative flex flex-col gap-[5px]">
                        <label class='text-[14] text-[#898989] mb-[2px]'>BG</label>
                        <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                            cltype='bg'>
                            <input class='min-w-[30px] h-[30px] commonColourPicker' type="color" name="headerBg"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{ $templateColor->headerBg }}" />
                            <input class='w-[100%] commonColourNumber' type="text"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{ $templateColor->headerBg }}" />
                        </div>
                    </div>
                    <div class="relative flex flex-col gap-[5px]">
                        <label class='text-[14] text-[#898989] mb-[2px]'>Menu BG</label>
                        <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                            cltype='bg'>
                            <input class='min-w-[30px] h-[30px] commonColourPicker' type="color" name="headerMenuBg"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->headerMenuBg }}" />
                            <input class='w-[100%] commonColourNumber' type="text"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->headerMenuBg }}" />
                        </div>
                    </div>

                    <div class="relative flex flex-col gap-[5px]">
                        <label class='text-[14] text-[#898989] mb-[2px]'>Active Menu BG</label>
                        <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                            cltype='bg'>
                            <input class='min-w-[30px] h-[30px] commonColourPicker' type="color" name="headerActiveBg"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->headerActiveBg }}" />
                            <input class='w-[100%] commonColourNumber' type="text"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->headerActiveBg }}" />
                        </div>
                    </div>

                    <div class="relative flex flex-col gap-[5px]">
                        <label class='text-[14] text-[#898989] mb-[2px]'>Active Text Color</label>
                        <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                            cltype='text'>
                            <input class='min-w-[30px] h-[30px] commonColourPicker' type="color"
                                name="headerActiveTextColor" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->headerActiveTextColor }}" />
                            <input class='w-[100%] commonColourNumber' type="text"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->headerActiveTextColor }}" />
                        </div>
                    </div>

                    <div class="relative flex flex-col gap-[5px]">
                        <label class='text-[14] text-[#898989] mb-[2px]'>Non-Active Text Color</label>
                        <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                            cltype='text'>
                            <input class='min-w-[30px] h-[30px] commonColourPicker' type="color"
                                name="headerNonActiveTextColor" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->headerNonActiveTextColor }}" />
                            <input class='w-[100%] commonColourNumber' type="text"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->headerNonActiveTextColor }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class='flex flex-col gap-[15px] mb-[25px]'>
                <h2 class='mb-[15px] text-[20px] text-[#1A1A1A] font-[600] '>Body Settings</h2>
                <div class="relative flex flex-col gap-[5px]">
                    <label class='text-[14] text-[#898989] mb-[2px]'>Body BG</label>
                    <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                        cltype='bg'>
                        <input class='min-w-[30px] h-[30px] commonColourPicker' type="color" name="bodyBg"
                            pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{ $templateColor->bodyBg }}" />
                        <input class='w-[100%] commonColourNumber' type="text"
                            pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{ $templateColor->bodyBg }}" />
                    </div>
                </div>
            </div>

            <div class='flex flex-col gap-[15px] mb-[25px]'>
                <h2 class='mb-[15px] text-[20px] text-[#1A1A1A] font-[600] '>Offer Settings</h2>
                <div class='grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4'>
                    <div class="relative flex flex-col gap-[5px]">
                        <label class='text-[14] text-[#898989] mb-[2px]'>BG</label>
                        <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                            cltype='bg'>
                            <input class='min-w-[30px] h-[30px] commonColourPicker' type="color" name="offerBg"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{ $templateColor->offerBg }}" />
                            <input class='w-[100%] commonColourNumber' type="text"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{ $templateColor->offerBg }}" />
                        </div>
                    </div>

                    <div class="relative flex flex-col gap-[5px]">
                        <label class='text-[14] text-[#898989] mb-[2px]'>Text Color</label>
                        <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                            cltype='text'>
                            <input class='min-w-[30px] h-[30px] commonColourPicker' type="color" name="offerText"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{ $templateColor->offerText }}" />
                            <input class='w-[100%] commonColourNumber' type="text"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{ $templateColor->offerText }}" />
                        </div>
                    </div>

                    <div class="relative flex flex-col gap-[5px]">
                        <label class='text-[14] text-[#898989] mb-[2px]'>Button BG Color</label>
                        <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                            cltype='bg'>
                            <input class='min-w-[30px] h-[30px] commonColourPicker' type="color" name="offerButtonBg"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->offerButtonBg }}" />
                            <input class='w-[100%] commonColourNumber' type="text"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->offerButtonBg }}" />
                        </div>
                    </div>

                    <div class="relative flex flex-col gap-[5px]">
                        <label class='text-[14] text-[#898989] mb-[2px]'>Button Text Color</label>
                        <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                            cltype='text'>
                            <input class='min-w-[30px] h-[30px] commonColourPicker' type="color" name="offerButtonText"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->offerButtonText }}" />
                            <input class='w-[100%] commonColourNumber' type="text"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->offerButtonText }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class='flex flex-col gap-[15px] mb-[25px]'>
                <h2 class='mb-[15px] text-[20px] text-[#1A1A1A] font-[600] '>Footer Settings</h2>
                <div class='grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4'>
                    <div class="relative flex flex-col gap-[5px]">
                        <label class='text-[14] text-[#898989] mb-[2px]'>BG</label>
                        <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                            cltype='bg'>
                            <input class='min-w-[30px] h-[30px] commonColourPicker' type="color" name="footerBg"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{ $templateColor->footerBg }}" />
                            <input class='w-[100%] commonColourNumber' type="text"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{ $templateColor->footerBg }}" />
                        </div>
                    </div>
                    <div class="relative flex flex-col gap-[5px]">
                        <label class='text-[14] text-[#898989] mb-[2px]'>Text Color</label>
                        <div class='flex gap-[10px] bg-[#fff] p-[6px] rounded-[8px] border-[1px] border-[#e5e7eb] rounded-[4px]'
                            cltype='text'>
                            <input class='min-w-[30px] h-[30px] commonColourPicker' type="color" name="footerText"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->footerText }}" />
                            <input class='w-[100%] commonColourNumber' type="text"
                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                value="{{ $templateColor->footerText }}" />
                        </div>
                    </div>
                </div>
            </div>


            <div class='mt-[8px]'>
                <button
                    class='px-[10px] py-[10px] w-[160px] flex justify-center text-center text-[15px] text-[#000] bg-[#49FB53] rounded-[8px]'>Save
                    Template</button>
            </div>
        </form>
    </div>

    <div class='flex w-[100%] lg:w-[70%] sticky top-[100px]'>
        <!-- New HTML Sidebar -->
        <div style="width:100%; bg-[#e06060] p-[10px] rounded-[5px] bodyBg-colordy">
            <div style=" display:flex;flex-direction: column; align-items: start; width: 100%;">
                <div class="headerBg-colordy" style="display: flex ; flex-wrap: wrap; align-items: center; width: 100%; background: #d196f8; padding: 5px 5px; justify-content: space-between;">
                    <a href="#" style="margin: 0; font-size: 11px; font-weight: 600;">
                        <img style="max-width: 100px;" src="/images/logo.png">
                    </a>
                    <div class="headerMenuBg-colordy"
                        style="display: flex ; align-items: center; justify-content: space-between; padding: 3px 5px; background: #fff;">
                        <ul class="menuNav"
                            style="display: flex; align-items: center; justify-content: start; gap: 5px; padding: 0; margin: 0; list-style: none;">
                            <li>
                                <a class="active headerActiveBg-colordy headerActiveTextColor-colordy" href="#"
                                    style="display: block; padding: 4px 10px; font-size: 11px; color: #1e1f1f; border-bottom: 1px solid transparent; text-decoration: none; background: #7030a0;">
                                    Offers
                                </a>
                            </li>
                            <li>
                                <a class="headerNonActiveTextColor-colordy" href="#"
                                    style="display: block; padding: 4px 10px; font-size: 11px; color: #1e1f1f; border-bottom: 1px solid transparent; text-decoration: none;">
                                    My Rewards
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="cntmainbx bodyBg-colordy"
                    style="position:relative; width:100%; display: flex; flex-direction: column; align-items: flex-start; gap: 5px; padding: 8px; padding-bottom: 80px; background: #9a86ac;">
                    <div class="boxList trigger openPopupDetail offerBg-colordy"
                        style="display: flex; align-items: center; gap:5px; padding:5px;box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.2); border-radius:5px; background: #e8e0f5; border: 1px solid #e8e0f5; width: 100%;">

                        <div style="width: 80px;">
                            <img src="/images/default_offer.png"
                                alt="img" style="width: 100px; max-width: 100%; object-fit: cover;">
                        </div>

                        <div class="cntbxsize"
                            style="width: calc(100% - 90px); display: flex; align-items: center; justify-content: space-between;">
                            <div style="width: calc(100% - 90px);">
                                <h2 class="offerText-colordy" style="margin: 0 0 10px; font-weight: 600; font-size: 12px; color: #212121;">IN - Desktop</h2>
                                <!-- <p style="margin: 0; font-size: 13px; font-weight: 400; line-height: 21px; color: #212121;">Download and install IN&nbsp;- Desktop</p> -->
                                <!-- <div style="margin: 10px 0 0; padding: 11px; background: #d0bbe2; border-left: 2px solid #d59dfb;">
                            <p style="margin: 0; font-size: 13px; color: #2f2d2d;">IN - Desktop</p>
                            </div> -->
                            </div>

                            <div style="min-width: 50px;">
                                <a class="btnsm offerButtonBg-colordy offerButtonText-colordy" href="javascript:void(0);"
                                    style=" display: flex; align-items: center; gap: 2px; padding: 4px 10px; background: #e7f4bd;  font-size: 12px; width: 100%; text-align: center; justify-content: center; border: none; text-decoration:none; color:#505346; ">
                                    + 2.5 Points </a>
                            </div>
                        </div>
                    </div>

                    <div class="footerBg-colordy" style="position:absolute; bottom:0;left:0; right:0; padding: 5px 5px; display: flex ; justify-content: space-between; align-items: center; width: 100%; background-color: #d196f8;">
                        <h2 style="margin: 0; font-size: 11px; font-weight: 600; color: #ce68ce;">
                            <img style="max-width: 100px;" src="/images/logo.png">
                        </h2>
                        @if ($settingsData->privacy_policy==1)
                        <p class="footerText-colordy" style="margin: 0px; font-size: 12px; color: #9514eb;">Privacy policy</p>
                        @endif
                        
                    </div>
                </div>

                
                

                <div class="offerBg-colordy" style="margin-top:30px; padding:10px; border-radius:8px; display: flex ; flex-wrap:wrap; width:100%; align-items: center; justify-content: flex-start; gap: 10px;box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);">
                <h3 style="width:100%; font-size:18px; text-align:center; margin-bottom:5px;    border-bottom: 1px solid #ececec;">Offer detail design on popup</h3>
                <div style="display:flex; width:100%; gap:10px">
               <div style="display: flex ; align-items: center; width: 25%;">
                  <img id="offer-image-pop" src="/images/default_offer.png" alt="img" style="width: 100%; max-width: 100%; object-fit: cover;">
               </div>
               <div style="display: flex ;  align-items: center; justify-content: space-between; width: 100%;">
                   
                  <div style="margin: 0 0 5px;  font-weight: 600; font-size: 12px; color: #212121;">
                     <h2 style="margin: 0 0 5px;  font-weight: 600; font-size: 16px; color: #212121;" class="offerText-colordy">WW - Test</h2>
                     <h3 style="margin: 0 0 10px;  font-weight: 400; font-size: 14px; color: #212121;" class="offerText-colordy">Offer Requirments</h3>
                     
                     <div style="width:100%; margin-bottom:10px" class="cntbx">
                        <p style="margin: 0;  font-size: 12px; color: #212121;" id="offer-description-pop" class="offerText-colordy">Conversion event: Answer 1&nbsp;question&nbsp;with 100% score</p>
                     </div>
                     <a class="offerButtonBg-colordy offerButtonText-colordy" href="#" target="_blank" style="display: inline-block; padding: 4px 15px; border-radius: 60px; background: #e788dd;   font-size: 12px; color: #fff; text-decoration: none;" id="offer-price-pop">+ 2.5 Points</a>
                  </div>
               </div>
               </div>
            </div>
            </div>
        </div>
        <!-- End -->

    </div>
</div>
<script>
$(document).ready(function() {
    $('.commonColourPicker').each(function() {
        $(this).trigger('input').trigger('change');
    });
});
$(document).on('input', '.commonColourPicker', function() {
    $(this).parent().find('.commonColourNumber').val(this.value);
    if ($(this).parent().attr('cltype') == 'bg') {
        $('.' + $(this).attr('name') + '-colordy').css("background-color", this.value);
    } else {
        if ($(this).parent().attr('cltype') == 'leftborder') {
            $('.offerInfoBg-colordy').css("border-left", "2px solid " + this.value);
        } else {
            $('.' + $(this).attr('name') + '-colordy').css("color", this.value);
        }
    }

})
$(document).on('input', '.commonColourNumber', function() {
    $(this).parent().find('.commonColourPicker').val(this.value);
    if ($(this).parent().attr('cltype') == 'bg') {
        $('.' + $(this).parent().find('.commonColourPicker').attr('name') + '-colordy').css("background-color",
            this.value);
    } else {
        if ($(this).parent().attr('cltype') == 'leftborder') {
            $('.offerInfoBg-colordy').css("border-left", "2px solid " + this.value);
        } else {
            $('.' + $(this).parent().find('.commonColourPicker').attr('name') + '-colordy').css("color", this
                .value);
        }
    }
})
</script>
@stop
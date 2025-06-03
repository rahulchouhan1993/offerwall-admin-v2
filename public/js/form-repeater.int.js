$(document).ready(function() {
    "use strict";
    $(".repeater").repeater({ 
        defaultValues: {
            "textarea-input": "foo",
            "text-input": "bar",
            "select-input": "B",
            "checkbox-input": ["", "BA"],
            "radio-input": "B"
        },
        show: function() {
            $(this).find('.select2-container').remove(); 
            $(this).find('.affiliate-select').html(''); 
            $('.affiliate-select').select2({
                placeholder: "Select an affiliate",
                allowClear: true
            });
            $('.country-select').select2({
                placeholder: "Select country",
                allowClear: true 
            });
            $('.device-select').select2({
                placeholder: "Select device",
                allowClear: true
            });
            $('.operating-select').select2({
                placeholder: "Select OS",
                allowClear: true
            });
             $('.offer-option').select2({
                placeholder: "Select an offer",
                allowClear: true
            });
            $(this).slideDown()
        },
        hide: function(e) {
            confirm("Are you sure you want to delete this element?") && $(this).slideUp(e)
        },
        ready: function(e) {}
    }), window.outerRepeater = $(".outer-repeater").repeater({
        defaultValues: {
            "text-input": "outer-default"
        },
        show: function() {
            console.log("outer show"), $(this).slideDown()
        },
        hide: function(e) {
            console.log("outer delete"), $(this).slideUp(e)
        },
        repeaters: [{
            selector: ".inner-repeater",
            defaultValues: {
                "inner-text-input": "inner-default"
            },
            show: function() {
                console.log("inner show"), $(this).slideDown()
            },
            hide: function(e) {
                console.log("inner delete"), $(this).slideUp(e)
            }
        }]
    })
});
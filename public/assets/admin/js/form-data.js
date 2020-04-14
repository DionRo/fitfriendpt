(function ($) {
    'use strict';
    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false
    });
    //datedropper
    $('.datedropper').dateDropper();

    //jQueryUI Slider
    $(".input-slider").slider({
        range: "min",
    });
    $(".input-rangeslider").slider({
        range: true,
        min: 0,
        max: 500,
        values: [75, 300],
    });

})(window.jQuery);
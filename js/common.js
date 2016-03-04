jQuery(document).ready(function ($) {
    jQuery('#tabs')
        .tabs()
        .addClass('ui-tabs-vertical ui-helper-clearfix');
    jQuery(".colourPicker").spectrum({
        preferredFormat: "rgba",
        flat: true,
        showInput: true,
        allowEmpty:true
    });
});
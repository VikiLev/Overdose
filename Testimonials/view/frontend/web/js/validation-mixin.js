define([
    'jquery',
    'jquery/ui',
    'jquery/validate',
    'mage/translate'
], function($){
    'use strict';
    return function() {
        $.validator.addMethod(
            "validate-size",
            function(value, element) {
                if (jQuery('#image').val() === '') return true
                var size = jQuery('#image')[0].files[0].size;
                if (size > 1048576){
                    return false
                }
                else return true
            },
            $.mage.__("Your file should be no more than 1MB")
        );
    }
});

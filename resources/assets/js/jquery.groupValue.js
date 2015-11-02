(function($) {
    var $_val = $.fn.val;
    
    $.fn.extend({
        val: function() {
            var filtered,
                type = $(this).attr('type');
            if (['checkbox', 'radio'].indexOf(type) >= 0) {
                filtered = $(this).filter(':checked');
            } else {
                filtered = $(this);
            }
            
            return $_val.apply(filtered);
        }
    });
})(jQuery);

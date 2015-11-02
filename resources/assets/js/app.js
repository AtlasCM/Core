// @codekit-prepend "jquery.groupValue.js";
// @codekit-prepend "Classes/ActionResolver.js";
// @codekit-prepend "actions.js";

/* global jQuery */

var app = app || {};

(function(window, $, app) {
    $('[data-action]').click(function() {
        var ActionResolver = new app.ActionResolver(this);
        
        ActionResolver.resolve($(this).data('action'));
    });
})(window, jQuery, app);
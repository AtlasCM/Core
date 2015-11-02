/* global Promise, jQuery */

var app = app || {};

(function(window, Promise, $, app) {
    var install_details = function() {
        if ($("[name='DB_CONNECTION']").val() == 'sqlite') {
            $('#db_config_db_details_lite').removeClass('hidden');
            $('#db_config_db_details_full').addClass('hidden');
        }
    };
    
    var open_section = function(id, callback) {
        return new Promise(function(resolve, reject) {
            $('#' + id).hide().removeClass('hidden').animate({
                height: 'show',
                margin: 'show',
                opacity: 'show'
            }, 500, resolve);
        });
    };
    
    var close_section = function(id, callback) {
        return new Promise(function(resolve, reject) {
            $('#' + id).animate({
                height: 'hide',
                margin: 'hide',
                opacity: 'hide'
            }, 500, resolve);
        });
    };
    
    var toggle_section = function(id, callback) {
        return new Promise(function(resolve, reject) {
            $('#' + id).hide().removeClass('hidden').animate({
                height: 'toggle',
                margin: 'toggle',
                opacity: 'toggle'
            }, 500, resolve);
        });
    };
    
    app.install_details = install_details;
    app.open_section = open_section;
    app.close_section = close_section;
    app.toggle_section = toggle_section;
}(window, Promise, jQuery, app));

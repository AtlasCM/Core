/* global Promise, jQuery */

var app = app || {};

(function(window, Promise, $, app) {
    function ActionResolver(el) {
        var fn_separator = ';',
            callback_separator = '+',
            param_separator = ':';
        
        function resolve(actions) {
            actions = actions.split(fn_separator);
            
            for (var i = 0; i < actions.length; i++) {
                var action, fn, params, callbacks, call, param_separator_index;
                
                callbacks = actions[i].split(callback_separator);
                action = callbacks.shift();
                
                if ((param_separator_index = action.indexOf(param_separator)) != -1) {
                    fn = action.slice(0, param_separator_index);
                    params = action.slice(param_separator_index + 1).split(param_separator);
                } else {
                    fn = action;
                    params = [];
                }
                
                if (app[fn]) {
                    call = app[fn].apply(el, params);
                    
                    if (call instanceof Promise && callbacks.length) {
                        call.then(function() {
                            resolve(callbacks.join(callback_separator));
                        });
                    } else if (callbacks.length) {
                        resolve(callbacks.join(callback_separator));
                    }
                } else {
                    console.error('Function ' + fn + ' not found.');
                    
                    if (callbacks.length) {
                        resolve(callbacks.join(callback_separator));
                    }
                }
            }
        }
        
        this.resolve = resolve;
    };
    
    app.ActionResolver = ActionResolver;
})(window, Promise, jQuery, app);

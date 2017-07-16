 ;var message = function($){
    'use strict';
    var default_options = {
        modal_small:'#message-small',
    };

    var VERSION = 'xhr-Yooqin.com version 1.0.0';

    var msg = {
        _alert:function(content, callback){

            $(default_options.modal_small+" .modal-body").html(content);
            $(default_options.modal_small).modal();
            $(default_options.modal_small).on('hide.bs.modal', function(e){
                if (typeof(callback) == 'function') {
                    callback();
                }
            });

            return true;
        }

    };
    

    return {
        success:function(title, callback){
            title = '<div class="alert alert-success" role="alert" style="border:none; background:none; font-size:1em;"><strong>successfully !</strong> '+title+'</div>'; 
            msg._alert(title, callback);
            return true;
        },
        failed:function(title, callback){
            title = '<div class="alert alert-danger" role="alert" style="border:none;background:none; font-size:1.2em;"><strong>Oh snap !</strong> '+title+'</div>'; 
            msg._alert(title, callback);
            return true;
        },
        version:function(){
            console.log(VERSION);
        }
    }
}(jQuery);

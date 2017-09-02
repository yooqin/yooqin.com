 ;var message = function($){
    'use strict';
    var default_options = {
        modal_small:'#message-small',
    };

    var VERSION = 'xhr-Yooqin.com version 1.0.0';

    return {
        success:function(title, callback){
            swal({
                title:title,
                text:'',
                type:'success',
                closeOnConfirm:true
            },
            function(){
                if (typeof(callback) == 'function') {
                    callback();
                }
            });
            return true;
        },
        failed:function(title, callback){
            swal({
                title:'',
                text:title,
                type:'error',
                closeOnConfirm:true
            },
            function(){
                if (typeof(callback) == 'function') {
                    callback();
                }
            });
            return true;
        },
        version:function(){
            console.log(VERSION);
        }
    }
}(jQuery);

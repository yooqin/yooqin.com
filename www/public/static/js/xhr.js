 ;var xhr = function($){
    'use strict';
    var default_options = {
        url:'',
        type:'get',
        data:{},
        dataType:'json',
        is_csrf_token:'yes',
    };

    var VERSION = 'xhr-Yooqin.com version 1.0.0';

    var x = {

        ajax:function(opt){

            var dfd = $.Deferred();
            var options = $.extend(default_options, opt);

            if (!options.url) {
                dfd.reject('Ajax请求未发送: Ajax Url 不能为空');
                return dfd.promise();
            }

            if (options.is_csrf_token) {
                this.ajaxSetup();
            }

            $.ajax({
                url:options.url,
                type:options.type, 
                data:options.data,
                dataType:options.dataType
            }).then(function(res){
                dfd.resolve(res);
            }).fail(function(res){
              	dfd.reject('异步请求错误,请检查您的接口响应或网络状态');
            });

            return dfd.promise();
        },
        ajaxSetup:function(){
			$.ajaxSetup({
				headers: {'X-CSRF-TOKEN':window.window.YOOQIN.csrf_token}
			});
			return true;
        }
    };
    

    return {
       ajax:function(opt){
           return x.ajax(opt);   
       },
       version:function(){
           console.log(VERSION);
       }
    }
}(jQuery);

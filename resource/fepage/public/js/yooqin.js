;+function($){
    'use strict';

    $(function(){
        //绑定tooltip
        $('[data-toggle="tooltip"]').tooltip();

        $(".btn-click-about").click(function(event){
            $("#modal-about").modal();
            event.preventDefault();
            return true;
        });

        $(".btn-click-contact").click(function(event){

            $("#modal-contact").modal();
            event.preventDefault();
            return true;

        });

        $(".btn-click-share").click(function(event){
            $("#modal-share").modal();
            event.preventDefault();
            return true;
        });

    });
}(jQuery);

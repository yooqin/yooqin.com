;var bb = function($){

    var default_options = {
        btn:{
            tag:'.btn_tag', 
            comment:'.btn-click-post-comments'
        },
    };

    var b = {
        _bindEvent:function(){
            var _this = this;

            $(function(){
                //tag click
                $(default_options.btn.tag).click(function(){
                    var tag = $(this).attr('data-name');
                    _this._tagShow(tag);    
                    return false;
                });

                //comments
                $(default_options.btn.comment).click(function(){
                    _this._comment();    
                    return false;
                });
            });
        },
        _tagShow:function(tag){
            message.failed("标签["+tag+"]不见啦，被你点坏啦~"); 
            return true;
        },
        _comment:function(){
            message.failed("不让你留言就是那么🐂摆~"); 
            return true;
        }
    };

    return {
        bindEvent:function(){
            return b._bindEvent(); 
        },
    };
}(jQuery);

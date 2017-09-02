
var Comments = function($){

    var options = {
        flag:'.comments_wrap',
        type:'blog',
        document_id:1,
        api:'/comment',
        btns:{reply:'.reply_btn'}
    };

    var comment = {
        _create:function(fid){
            var data = {}, _this = this;
            data.name = $("input[name=name]").val();
            data.communication = $("input[name=contact]").val();
            data.content = $("textarea[name=content]").val();
            data.type = options.type;
            data.document_id = options.document_id;

            if (!data.name || !data.communication || !data.content) {
                message.failed('请填写所有表单项后点击提交');
                return false;
            }

            xhr.ajax({
                url:options.api,
                data:data,
                type:'post'
            }).then(function(res){
                if (res.status != 'success') {
                    message.failed(res.message);
                    return false;
                }

                $("input").val('');
                $("textarea").val('');
                _this._getList();
                message.success('操作成功~');

            }).fail(function(msg){
                message.failed(msg); 
            });

            return true;
        },
        _getList:function(){
            var data = {},
                _this = this;

            data.document_id = options.document_id;
            data.type = options.type;

            xhr.ajax({
                url:options.api,
                data:data,
                type:'get'
            }).then(function(res){
                if (res.status != 'success') {
                    _this._renderList(res.message); 
                    return false;
                }
                _this._renderList(res.data);
            }).fail(function(msg){
                _this._renderList(msg); 
            });
        },
        _renderList:function(data){
            var comment = '', _this = this;
            $(options.flag).html('');

            if (typeof(data.list) != 'object') {
                comment = this._getErrorCommentElement(data);
                $(options.flag).append(comment);
                return false;
            }    

            if (!data.list.length) {
                comment = this._getErrorCommentElement("* 没有评论数据");
                $(options.flag).append(comment);
                return false;
            }

            $.each(data.list, function(index, item){
                comment = _this._getCommentElement(item); 
                $(options.flag).append(comment);
            });

            return true;
        },
        _getCommentElement:function(item){
            var $comment = $("<div class='comment'></div>");
            var $p = $("<p class='comment-fe'></p>");
            $p.append('<span class="glyphicon glyphicon-user"></span> ');
            $p.append(item.show_name);
            $p.append('<span class="glyphicon glyphicon-phone l20"></span> ');
            $p.append(item.contact);
            $p.append('<span class="glyphicon glyphicon-globe l20" aria-hidden="true"></span> ');
            $p.append(item.local);
            $p.append('<span class="glyphicon glyphicon-time l20" aria-hidden="true"></span> ');
            $p.append(item.created_date);
            $comment.append($p);

            $p = $("<p class='comment-content'></p>");
            $p.html(item.content);
            $comment.append($p);
            return $comment;
        },
        _getErrorCommentElement:function(msg){
            var $comment = $("<div class='comment'></div>");
            $comment.html(msg);
            return $comment;
        },
        _bindEvent:function(){
            //create
            $(options.btns.reply).click(function(){
                var fid = $(this).attr('data-fid');
                var res = comment._create(fid); 
                return false;
            });
        }
    };

    return {
        bindEvent:function(opts){
            options = $.extend({}, options, opts);
            comment._bindEvent();
        },
        getList:function(){
            comment._getList();
        }
    };

}(jQuery); 

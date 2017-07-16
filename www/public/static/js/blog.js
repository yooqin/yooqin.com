/*
xhr.ajax({
	url:'http://dev.yooqin.com/adm/blog/create'
}).then(function(res){
	console.log(res);
}).fail(function(res){
    console.log(res);
});

message.success('您的博客创建成功了', function(){
    console.log('close');
});

console.log(yooqin_api.blog);
*/

;var blog = function($){

    var default_options = {
        editor_id:"editormd",
        btn_create_blog:".btn_create_blog", 
        btn_update_blog:".btn_update_blog", 
        btn_edit:".btn_edit", 
        btn_delete:".btn_delete", 
        btn_category_manage:"#btn_category_manage"  
    };

    var b = {
        _editor:'',
        _bindEvent:function(){
            var _this = this;
            $(function(){

                //创建
                $(default_options.btn_create_blog).click(function(){
                    _this._create();    
                    return false;
                });

                //修改
                $(default_options.btn_update_blog).click(function(){
                    var id = $(this).attr("data-id");
                    _this._update(id);    
                    return false;
                });


                //点击编辑
                $(default_options.btn_edit).click(function(){
                    var id = $(this).attr('data-id');
                    _this._edit(id);    
                    return false;
                });

                //删除
                $(default_options.btn_delete).click(function(){
                    var id = $(this).attr('data-id');
                    _this._delete(id);    
                    return false;
                });

            });
        },
        _createEditor:function(){
            this._editor = editormd({
                id:default_options.editor_id,
                width:"90%", 
                height:640,
                syncScrolling:"single",
                path:"/static/editor.md-master/lib/",
            }); 
            return true;
        },
        _getData:function(){
            var data = {}; 
            $("input[type=input], select").each(function(){
                var key = $(this).attr("name"),
                val = $(this).val();
                data[key] = val;
            });

            data.content = this._editor.getPreviewedHTML();
            data.md_content = this._editor.getMarkdown();
            return data;
        },
        _update:function(id){
            if (!id) {
                message.failed('缺少更新id');
            }

            var data = this._getData();
            if (!data.md_content) {
                message.failed('请编写内容..');
                return false;
            }

            data._method = 'put';

            xhr.ajax({
                url:yooqin_api.blog.update+id,
                type:'post',
                data:data
            }).then(function(res){
                if (res.status == 'success') {
                    message.success('修改成功', function(){
                        window.location.reload();
                    }); 
                } else {
                    message.failed(res.message);
                } 
            }).fail(function(msg){
                message.failed(msg);
            });

            return true;
        },
        _create:function(){
            var data = this._getData();
            if (!data.md_content) {
                message.failed('请编写内容..');
                return false;
            }

            xhr.ajax({
                url:yooqin_api.blog.create,
                type:'post',
                data:data
            }).then(function(res){
                if (res.status == 'success') {
                    message.success('创建成功', function(){
                        window.location.href=yooqin_api.blog.list_page;
                    }); 
                } else {
                    message.failed(res.message);
                } 
            }).fail(function(msg){
                message.failed(msg);
            });

            return true;
        },
        _edit:function(id){
            if (!id) {
                message.failed("缺少id参数");
                return false;
            }

            window.location.href='/adm/blog/'+id+'/edit';
            
            return true;
        },
        _delete:function(id){

            if (!id) {
                message.failed("缺少id参数");
                return false;
            }

            console.log(yooqin_api.blog.delete);

            xhr.ajax({
                url:yooqin_api.blog.delete+id,
                data:{
                    _method:'delete'
                },
                type:'post'
            }).then(function(res){
                if (res.status == 'success') {
                    message.success('删除成功', function(){
                        window.location.reload(); 
                    }); 
                } else {
                    message.failed(res.message);
                }  
            }).fail(function(msg){
                message.failed(msg);
            });

            return true;
        } 
    };

    return {
        bindEvent:function(){
            return b._bindEvent(); 
        },
        createEditor:function(){
            return b._createEditor();
        }
    };

}(jQuery);

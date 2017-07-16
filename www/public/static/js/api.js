 ;var yooqin_api = function($){
    'use strict';

    var api = {
        blog:{
            create:'/api/adm/blog', 
            update:'/api/adm/blog/',
            delete:'/api/adm/blog/',
            list_page:'/adm/blog',
        }, 
        article:{
            create:'/article/create',
            update:'/article/update',
        }
    };
    
    

    return {
        blog:api.blog,
        article:api.article
    }
}(jQuery);

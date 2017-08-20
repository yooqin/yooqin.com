# 功能点及说明（第一期项目）

## 博客模块

### 博客文章
#### 博客实体
- 发布
- 编辑
- 删除(软删除)
- 支持Markdown支持(扩展存储数据)
- 支持浏览数(字段存储)
- 支持作者(字段存储)
- 支持转载/原创(字段存储)
- 支持关键词、描述设置(字段)
- 支持自定义uri
- 支持博客根据类型显示(文章、相册)
- 支持标签(关系)
- 支持分类(关系)
- 支持星赞(关系)
- 支持分享(关系)
- 支持评论(关系)

#### 博客关联实体
- 博客内容
- 标签
- 分类
- 星赞
- 分享
- 评论

## 资讯模块
#### 资讯实体
- 发布
- 编辑
- 删除(软删除)
- 支持Markdown支持(扩展存储数据)
- 自动导入脚本(文章html标签重排)
- 支持浏览数(字段存储)
- 支持来源(字段存储)
- 支持来源链接(字段)
- 支持标签(关系)
- 支持分类(关系)
- 支持分享(关系)

#### 博客关联实体
- 内容
- 标签
- 分类
- 分享

## 分类模块
#### 分类实体
- 增加
- 删除
- 修改
- 支持多递归分类
- 支持多模块关联使用

#### 关联实体
- 博客
- 资讯

## 标签库模块
#### 标签实体
- 增加
- 删除
- 修改
- 支持多模块关联使用
- 标签数据量统计

#### 关联实体
- 博客
- 资讯

## 留言模块
#### 实体
- 增加
- 删除
- 修改
- 支持多模块关联使用
- 某类型留言总数统计

#### 关联实体
- 博客

# 数据表

## 博客
create table Blog(  
    `id` int(10) unsigned not null AUTO_INCREMENT,  
    `user_id` int(10) unsigned not null,  
    `title` varchar(512) not null comment '标题',  
    `keywords` varchar(512) not null comment '关键词',  
    `description` varchar(512) null default null comment '描述',  
    `uri` varchar(512) null default null comment '自定义uri',  
    `views` int(10) unsigned not null comment '浏览总数',  
    `source` tinyint(3) unsigned not null comment '1原创2转载',  
    `blog_type` tinyint(3) unsigned not null comment '1博客2相册博客',  
    `destroy_at` int(10) unsigned not null comment '是否删除',  
    `created_at` int(10) unsigned not null,  
    `updated_at` int(10) unsigned not null,  
    PRIMARY KEY(`id`),  
    key `user_id_idx`(`user_id`),  
    key `title_idx`(`title`, `keywords`),  
    key `uri_idx`(`uri`)  
)engine=innodb charset=latin1 comment '博客实体表';  

create table BlogContent(  
    `id` int(10) unsigned not null AUTO_INCRMENT,  
    `blog_id` int(10) unsigned not null,  
    `md_content` text not null,  
    `content` text not null,  
    `created_at` int(10) unsigned not null,  
    `updated_at` int(10) unsigned not null,  
    PRIMARY KEY(`id`),  
    key `blog_id_idx`(`blog_id`)  
)engine=innodb charset=latin1 comment '博客内容实体';  

## 资讯
create table Article(  
    `id` int(10) unsigned not null AUTO_INCREMENT,  
    `user_id` int(10) unsigned not null,  
    `title` varchar(512) not null comment '标题',  
    `keywords` varchar(512) not null comment '关键词',  
    `description` varchar(512) null default null comment '描述',  
    `uri` varchar(512) null default null comment '自定义uri',  
    `views` int(10) unsigned not null comment '浏览总数',  
    `source` varchar(256) unsigned not null comment '来自',  
    `destroy_at` int(10) unsigned not null comment '是否删除',  
    `created_at` int(10) unsigned not null,  
    `updated_at` int(10) unsigned not null,  
    PRIMARY KEY(`id`),  
    key `user_id_idx`(`user_id`),  
    key `title_idx`(`title`, `keywords`),  
    key `uri_idx`(`uri`)  
)engine=innodb charset=latin1 comment '文章实体表';  

create table ArticleContent(  
    `id` int(10) unsigned not null AUTO_INCRMENT,  
    `article_id` int(10) unsigned not null,  
    `md_content` text not null,  
    `content` text not null,  
    `created_at` int(10) unsigned not null,  
    `updated_at` int(10) unsigned not null,  
    PRIMARY KEY(`id`),  
    key `article_id_idx`(`article_id`)  
)engine=innodb charset=latin1 comment '资讯内容实体';  

## 标签
create table Tag(  
    `id` int(10) unsigned not null AUTO_INCREMENT,  
    `name` varchar(256) not null comment '标签名',  
    `uri` varchar(256) not null comment '标签自定义uri',  
    `content` varchar(512) not null comment 'json数据seo使用',  
    `destroy_at` int(10) unsigned not null,  
    `created_at` int(10) unsigned not null,  
    `updated_at` int(10) unsigned not null,  
    PRIMARY KEY(`id`),  
    key `uri_idx`(`uri`)  
)engine=innodb charset=latin1 commnet '标签库';  

create table TagTotal(  
    `id` int(10) unsigned not null AUTO_INCREMENT,  
    `tag_id` int(10) unsigned not null,  
    `type` tinyint(3) unsigned not null,  
    `total` int(10) unsigned not null,  
    `created_at` int(10) unsigned not null,  
    `updated_at` int(10) unsigned not null,  
    PRIMARY KEY(`id`),  
    key `tag_id_idx`(`tag_id`)  
)engine=innodb charset=latin1 comment '标签数据统计';  

create table TagRelation(  
    `id` int(10) unsigned not null AUTO_INCREMENT,  
    `tag_id` int(10) unsigned not null,  
    `type` tinyint(3) unsigned not null comment '关联类型',  
    `relation_id` int(10) unsigned not null comment '关联id',  
    `created_at` int(10) unsigned not null,  
    `updated_at` int(10) unsigned not null,  
    PRIMARY KEY(`id`),  
    key `tag_id_idx` (`tag_id`),  
    key `relation_id_idx` (`relation_id`)  
)engine=innodb charset=latin1 comment '标签数据统计';  


## 评论
create table Comments(
    `id` int(10) unsigned not null AUTO_INCREMENT,
    `user_id` int(10) unsigned not null,
    `document_id` int(10) unsigned not null comment '文档ID',
    `fid` int(10) unsigned not null,
    `comment_type` tinyint(3) unsigned not null,
    `name` char(32) default null,
    `communication` varchar(256) not null,
    `title` varchar(256) default null,
    `content` text not null,
    `destroy_at` int(10) unsigned not null,
    `created_at` int(10) unsigned not null,
    `updated_at` int(10) unsigned not null,
    PRIMARY KEY(`id`),
    key `user_id_idx` (`user_id`),
    key `document_id_idx` (`document_id`),
    key `fid_idx` (`fid`),
    key `comment_type_idx` (`comment_type`)
)engine=innodb charset=latin1 comment '评论';


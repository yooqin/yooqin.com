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
    `deleted_at` int(10) unsigned not null comment '是否删除',
    `created_at` int(10) unsigned not null,
    `updated_at` int(10) unsigned not null,
    PRIMARY KEY(`id`),
    key `user_id_idx`(`user_id`),
    key `title_idx`(`title`, `keywords`),
    key `uri_idx`(`uri`)
)engine=innodb charset=latin1 comment '博客实体表';

create table BlogContent(
    `id` int(10) unsigned not null AUTO_INCREMENT,
    `blog_id` int(10) unsigned not null,
    `md_content` text not null,
    `content` text not null,
    `created_at` int(10) unsigned not null,
    `updated_at` int(10) unsigned not null,
    PRIMARY KEY(`id`),
    key `blog_id_idx`(`blog_id`)
)engine=innodb charset=latin1 comment '博客内容实体';


create table Article(
    `id` int(10) unsigned not null AUTO_INCREMENT,
    `user_id` int(10) unsigned not null,
    `title` varchar(512) not null comment '标题',
    `keywords` varchar(512) not null comment '关键词',
    `description` varchar(512) null default null comment '描述',
    `uri` varchar(512) null default null comment '自定义uri',
    `views` int(10) unsigned not null comment '浏览总数',
    `source` varchar(256) unsigned not null comment '来自',
    `deleted_at` int(10) unsigned not null comment '是否删除',
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


create table Tag(
    `id` int(10) unsigned not null AUTO_INCREMENT,
    `name` varchar(256) not null comment '标签名',
    `uri` varchar(256) not null comment '标签自定义uri',
    `content` varchar(512) not null comment 'json数据seo使用',
    `deleted_at` int(10) unsigned not null,
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
-- 初期設定
SET NAMES utf8;

-- データベース設定
DROP DATABASE IF EXISTS `goemon`;
CREATE DATABASE IF NOT EXISTS `goemon` DEFAULT CHARSET utf8 COLLATE utf8_bin;
GRANT SELECT,INSERT,DELETE,UPDATE ON `goemon`.* TO 'goemon_user'@localhost IDENTIFIED BY 'goemon_pass';
FLUSH PRIVILEGES;
USE `goemon`;

-- 管理権限
CREATE TABLE IF NOT EXISTS `auth` (
    `id`         int(10) unsigned NOT NULL auto_increment COMMENT 'ID',
    `strong`     int(3) unsigned  NOT NULL                COMMENT '権限の強さ',
    `name`       varchar(30)      NOT NULL                COMMENT '権限名',
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 COLLATE utf8_bin COMMENT '管理権限';

-- 管理者
CREATE TABLE IF NOT EXISTS `admin` (
    `id`         int(10) unsigned NOT NULL auto_increment COMMENT 'ID',
    `name`       varchar(30)      NOT NULL                COMMENT '名前',
    `auth_id`    int(10) unsigned NOT NULL                COMMENT '権限ID',
    `login_id`   varchar(36)      NOT NULL                COMMENT 'ログインID'  ,
    `login_pass` varchar(36)      NOT NULL                COMMENT 'ログインPASS',
    `created_at` datetime         NOT NULL                COMMENT '作成日',
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_name` (name),
    UNIQUE KEY `uk_lodin_id` (login_id),
    CONSTRAINT `fk_admin_auth_id`
        FOREIGN KEY (`auth_id`) REFERENCES `auth` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 COLLATE utf8_bin COMMENT '管理者';

-- 役職
CREATE TABLE IF NOT EXISTS `grade` (
    `id`         int(10) unsigned NOT NULL auto_increment COMMENT 'ID',
    `strong`     int(3) unsigned  NOT NULL                COMMENT '役職の強さ',
    `name`       varchar(30)      NOT NULL                COMMENT '役職名',
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 COLLATE=utf8_bin COMMENT '役職';

-- 部署
CREATE TABLE IF NOT EXISTS `unit` (
    `id`         int(10) unsigned NOT NULL auto_increment COMMENT 'ID',
    `name`       varchar(30)      NOT NULL                COMMENT '部署名',
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 COLLATE utf8_bin COMMENT '部署';

-- ユーザー
CREATE TABLE IF NOT EXISTS `user` (
    `id`         int(10) unsigned NOT NULL auto_increment COMMENT 'ID',
    `grade_id`   int(10) unsigned NOT NULL                COMMENT '役職ID',
    `unit_id`    int(10) unsigned NOT NULL                COMMENT '部署ID',
    `login_id`   varchar(36)      NOT NULL                COMMENT 'ログインID'  ,
    `login_pass` varchar(36)      NOT NULL                COMMENT 'ログインPASS',
    `name`       varchar(30)      NOT NULL                COMMENT '名前',
    `mail`       varchar(255)     NOT NULL                COMMENT 'メール',
    `product`    text             NOT NULL DEFAULT ''     COMMENT '紹介文',
    `updated_at` timestamp        NOT NULL                COMMENT '更新日',
    `created_at` datetime         NOT NULL                COMMENT '作成日',
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_name` (`name`),
    CONSTRAINT `fk_user_grade_id`
        FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
    CONSTRAINT `fk_user_unit_id`
        FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 COLLATE utf8_bin COMMENT 'ユーザー';

-- お気に入り
CREATE TABLE IF NOT EXISTS `favorite` (
    `id`        int(10) unsigned NOT NULL auto_increment COMMENT 'ID',
    `name`      varchar(50)      NOT NULL                COMMENT '名前',
    `user_id`   int(10) unsigned NOT NULL                COMMENT 'ユーザーID',
    `created_at` datetime        NOT NULL                COMMENT '作成日',
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_favorite_user_id`
        FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 COLLATE utf8_bin COMMENT 'お気に入り';

-- お気に入りユーザー
CREATE TABLE IF NOT EXISTS `favorite_user` (
    `id`          int(10) unsigned NOT NULL auto_increment COMMENT 'ID',
    `favorite_id` int(10) unsigned NOT NULL                COMMENT 'お気に入りID',
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_favorite_user_favorite_id`
        FOREIGN KEY (`favorite_id`) REFERENCES `favorite` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 COLLATE utf8_bin COMMENT 'お気に入りユーザー';

-- レポート
CREATE TABLE IF NOT EXISTS `report` (
    `id`         int(10) unsigned NOT NULL auto_increment COMMENT 'ID',
    `user_id`    int(10) unsigned NOT NULL                COMMENT 'ユーザID',
    `title`      varchar(100)     NOT NULL                COMMENT 'タイトル',
    `content`    text             NOT NULL                COMMENT '内容',
    `created_at` datetime         NOT NULL                COMMENT '作成日',
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_report_user_id`
        FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 COLLATE utf8_bin COMMENT 'レポート';

-- テンプレート
CREATE TABLE IF NOT EXISTS `template` (
    `id`         int(10) unsigned NOT NULL auto_increment COMMENT 'ID',
    `user_id`    int(10) unsigned NOT NULL                COMMENT 'ユーザID',
    `title`      varchar(100)     NOT NULL                COMMENT 'タイトル',
    `content`    text             NOT NULL                COMMENT '内容',
    `created_at` datetime         NOT NULL                COMMENT '作成日',
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_template_user_id`
        FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 COLLATE utf8_bin COMMENT 'テンプレート';

-- コメント
CREATE TABLE IF NOT EXISTS `comment` (
    `id`         int(10) unsigned NOT NULL auto_increment COMMENT 'ID',
    `report_id`  int(10) unsigned NOT NULL                COMMENT 'レポートID',
    `user_id`    int(10) unsigned NOT NULL                COMMENT 'ユーザID',
    `content`    text             NOT NULL DEFAULT ''     COMMENT '内容',
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_comment_report_id`
        FOREIGN KEY (`report_id`) REFERENCES `report` (`id`),
    CONSTRAINT `fk_comment_user_id`
        FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 COLLATE utf8_bin COMMENT 'コメント';

-- 既読
CREATE TABLE IF NOT EXISTS `read` (
    `id`         int(10) unsigned NOT NULL auto_increment COMMENT 'ID',
    `report_id`  int(10) unsigned NOT NULL                COMMENT 'レポートID',
    `user_id`    int(10) unsigned NOT NULL                COMMENT 'ユーザID',
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_read` (`report_id`, `user_id`),
    CONSTRAINT `fk_read_report_id`
        FOREIGN KEY (`report_id`) REFERENCES `report` (`id`),
    CONSTRAINT `fk_read_user_id`
        FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET utf8 COLLATE utf8_bin COMMENT '既読';

INSERT INTO `auth` (`strong`, `name`)
VALUES
(0, 'すごい権限');

INSERT INTO `admin` (`auth_id`, `name`, `login_id`, `login_pass`, `created_at`)
VALUES
(1, 'テスト君', 'test', 'test', NOW());

INSERT INTO `grade` (`strong`, `name`)
VALUES
(0, '社長'),
(0, '幹部'),
(1, '部長'),
(2, '主任'),
(3, '平社員');

INSERT INTO `unit` (`name`)
VALUES
('えらい部署'),
('まあまあえらい部署'),
('まあまあな部署'),
('ふつうの部署');

INSERT INTO `user` (`grade_id`, `unit_id`, `login_id`, `login_pass`, `name`, `mail`, `product`, `created_at`)
VALUES
(1, 1, 'syatyo', 'syatyo', 'えらい太郎', 'test1@test.jp', '社長です', NOW()),
(3, 2, 'taro', 'taro', 'まあまあ太郎', 'test2@test.jp', '部長です', NOW());

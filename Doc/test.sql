CREATE TABLE `admin_user_list`
(
    `adminId`       int(11) NOT NULL AUTO_INCREMENT,
    `adminName`     varchar(32)  NOT NULL DEFAULT '' COMMENT '昵称',
    `adminAccount`  varchar(32)  NOT NULL DEFAULT '' COMMENT '账号',
    `adminPassword` varchar(32)  NOT NULL DEFAULT '' COMMENT '密码',
    `addTime`       int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
    `lastLoginTime` int(10) NOT NULL DEFAULT '0' COMMENT '上次登陆的时间',
    `lastLoginIp`   varchar(20)  NOT NULL DEFAULT '' COMMENT '上次登陆的Ip',
    `adminSession`  varchar(255) NOT NULL DEFAULT '' COMMENT '',
    PRIMARY KEY (`adminId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='后台管理员列表';

CREATE TABLE `user_list`
(
    `userId`   bigint(11) NOT NULL AUTO_INCREMENT,
    `account`  varchar(16)  NOT NULL DEFAULT '' COMMENT '账号',
    `nickname` varchar(50)  NOT NULL DEFAULT '' COMMENT '昵称',
    `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
    `phone`    varchar(16)  NOT NULL DEFAULT '' COMMENT '手机号',
    `avatar`   varchar(255) NOT NULL DEFAULT '' COMMENT '头像地址',
    `addTime`  int(11) NOT NULL DEFAULT '0' COMMENT '创建的时间',
    `session`  varchar(255) NOT NULL DEFAULT '' COMMENT 'session',
    `state`    tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态',
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户信息表';

CREATE TABLE `server_list`
(
    `serverId`        int(10) NOT NULL AUTO_INCREMENT,
    `serverName`      varchar(32)  NOT NULL DEFAULT '' COMMENT '服务器名',
    `isAllowRegister` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许注册',
    `serverHost`      varchar(255) NOT NULL DEFAULT '' COMMENT '服务器host',
    PRIMARY KEY (`serverId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='服务器列表';

CREATE TABLE `article_category_list`
(
    `categoryId`   int(10) NOT NULL AUTO_INCREMENT,
    `categoryName` varchar(64) NOT NULL DEFAULT '' COMMENT '分类名称',
    `pid`          int(10) NOT NULL DEFAULT '0' COMMENT '父级分类id',
    `note`         varchar(255)         DEFAULT NULL COMMENT '',
    PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章分类';

CREATE TABLE `article_list`
(
    `articleId`    int(10) NOT NULL AUTO_INCREMENT,
    `categoryId`   int(11) NOT NULL DEFAULT '0' COMMENT '分类id',
    `categoryName` varchar(64) NOT NULL DEFAULT '' COMMENT '分类名称',
    `title`        varchar(64) NOT NULL DEFAULT '' COMMENT '标题',
    `imgUrl`       varchar(255)         DEFAULT NULL COMMENT '',
    `description`  varchar(255)         DEFAULT NULL COMMENT '简介',
    `adminId`      int(11) NOT NULL DEFAULT '0' COMMENT '后台用户Id',
    `author`       varchar(32) NOT NULL DEFAULT '' COMMENT '作者',
    `content`      text        NOT NULL COMMENT '内容',
    `state`        tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态 1正常,0隐藏',
    `note`         varchar(255)         DEFAULT NULL COMMENT '',
    `articleCode`  varchar(255)         DEFAULT NULL COMMENT '文章code',
    `addTime`      int(10) NOT NULL DEFAULT '0' COMMENT '新增时间',
    `updateTime`   int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
    PRIMARY KEY (`articleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章表';

CREATE TABLE `user_backpack_list`
(
    `backpackId` int(11) NOT NULL AUTO_INCREMENT,
    `userId`     bigint(11) NOT NULL DEFAULT '0' COMMENT '用户id',
    `goodsId`    int(11) NOT NULL DEFAULT '0' COMMENT '物品id',
    `goodsCode`  varchar(255) DEFAULT NULL COMMENT '物品code',
    `num`        int(11) NOT NULL DEFAULT '0' COMMENT '数量',
    `goodsType`  tinyint(1) NOT NULL DEFAULT '0' COMMENT '物品类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备',
    PRIMARY KEY (`backpackId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏背包表';
CREATE TABLE `goods_list`
(
    `goodsId`     int(11) NOT NULL AUTO_INCREMENT,
    `name`        varchar(255) NOT NULL DEFAULT '' COMMENT '物品名称',
    `baseCode`    varchar(255) NOT NULL DEFAULT '' COMMENT '物品基础code',
    `code`        varchar(255) NOT NULL DEFAULT '' COMMENT '物品code值',
    `type`        tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型 1金币,2钻石,3道具,4礼包,5材料,6宠物蛋,7装备',
    `description` varchar(255) NOT NULL DEFAULT '' COMMENT '介绍',
    `gold`        int(11) NOT NULL DEFAULT '0' COMMENT '售出金币',
    `isSale`      tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否可售出',
    `level`       int(11) NOT NULL DEFAULT '0' COMMENT '等级',
    `rarityLevel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话',
    `extraData`   varchar(255) NOT NULL DEFAULT '' COMMENT '额外数据',
    PRIMARY KEY (`goodsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏物品表';

CREATE TABLE `goods_equipment_list`
(
    `goodsCode`                 varchar(255) NOT NULL DEFAULT '' COMMENT '物品code',
    `goodsName`                 varchar(255) NOT NULL DEFAULT '' COMMENT '物品名',
    `equipmentType`             tinyint(1) NOT NULL DEFAULT '0' COMMENT '装备类型 1武器 2帽子 3衣服 4裤子 5鞋子 6披风 7称号 8项链 9戒指',
    `description`               text         NOT NULL COMMENT '装备介绍',
    `attributeDescription`      text         NOT NULL COMMENT '属性介绍',
    `attributeEntryDescription` text         NOT NULL COMMENT '随机属性词条介绍',
    `extraAttributeDescription` text         NOT NULL COMMENT '额外属性词条介绍',
    `suitAttribute2Description` text         NOT NULL COMMENT '套装2属性词条介绍',
    `suitAttribute3Description` text         NOT NULL COMMENT '套装3属性词条介绍',
    `suitAttribute5Description` text         NOT NULL COMMENT '套装5属性词条介绍',
    `suitCode`                  varchar(255) NOT NULL DEFAULT '' COMMENT '套装Code',
    `strengthenLevel`           tinyint(1) NOT NULL DEFAULT '0' COMMENT '强化等级',
    `rarityLevel`               tinyint(1) NOT NULL DEFAULT '0' COMMENT '稀有度',
    `level`                     tinyint(1) NOT NULL DEFAULT '0' COMMENT '装备等级',
    `hp`                        int(11) NOT NULL DEFAULT '0' COMMENT '血量',
    `mp`                        int(11) NOT NULL DEFAULT '0' COMMENT '法力',
    `attack`                    int(11) NOT NULL DEFAULT '0' COMMENT '攻击力 att',
    `defense`                   int(11) NOT NULL DEFAULT '0' COMMENT '防御力 def',
    `endurance`                 int(11) NOT NULL DEFAULT '0' COMMENT '耐力 end',
    `intellect`                 int(11) NOT NULL DEFAULT '0' COMMENT '智力 int',
    `strength`                  int(11) NOT NULL DEFAULT '0' COMMENT '力量 str',
    `criticalRate`              float        NOT NULL DEFAULT '0' COMMENT '暴击率',
    `criticalStrikeDamage`      float        NOT NULL DEFAULT '0' COMMENT '暴击伤害',
    `hitRate`                   float        NOT NULL DEFAULT '0' COMMENT '命中率 hit',
    `dodgeRate`                 float        NOT NULL DEFAULT '0' COMMENT '闪避率',
    `penetrate`                 float        NOT NULL DEFAULT '0' COMMENT '穿透率',
    `attackSpeed`               float        NOT NULL DEFAULT '0' COMMENT '攻击速度',
    `attackElement`             varchar(255) NOT NULL DEFAULT '' COMMENT '攻击元素',
    `jin`                       int(11) NOT NULL DEFAULT '0' COMMENT '金',
    `mu`                        int(11) NOT NULL DEFAULT '0' COMMENT '木',
    `tu`                        int(11) NOT NULL DEFAULT '0' COMMENT '土',
    `sui`                       int(11) NOT NULL DEFAULT '0' COMMENT '水',
    `huo`                       int(11) NOT NULL DEFAULT '0' COMMENT '火',
    `light`                     int(11) NOT NULL DEFAULT '0' COMMENT '光',
    `dark`                      int(11) NOT NULL DEFAULT '0' COMMENT '暗',
    `luck`                      int(11) NOT NULL DEFAULT '0' COMMENT '幸运值',
    PRIMARY KEY (`goodsCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='物品装备基础信息表';
CREATE TABLE `user_equipment_backpack_list`
(
    `backpackId`                int(11) NOT NULL AUTO_INCREMENT COMMENT '背包id',
    `userId`                    int(11) NOT NULL COMMENT '用户id',
    `isUse`                     tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否使用',
    `strengthenLevel`           int(11) NOT NULL DEFAULT '0' COMMENT '强化等级',
    `description`               varchar(255) NOT NULL DEFAULT '' COMMENT '装备介绍',
    `attributeDescription`      varchar(255) NOT NULL DEFAULT '' COMMENT '属性介绍',
    `attributeEntryDescription` varchar(255) NOT NULL DEFAULT '' COMMENT '随机属性词条介绍',
    `extraAttributeDescription` varchar(255) NOT NULL DEFAULT '' COMMENT '额外属性词条介绍',
    `suitAttribute2Description` varchar(255) NOT NULL DEFAULT '' COMMENT '套装2属性词条介绍',
    `suitAttribute3Description` varchar(255) NOT NULL DEFAULT '' COMMENT '套装3属性词条介绍',
    `suitAttribute5Description` varchar(255) NOT NULL DEFAULT '' COMMENT '套装5属性词条介绍',
    `goodsCode`                 varchar(32)  NOT NULL DEFAULT '' COMMENT '物品code',
    `goodsName`                 varchar(32)  NOT NULL DEFAULT '' COMMENT '物品名',
    `equipmentType`             int(11) NOT NULL COMMENT '装备类型: 1武器 2帽子 3衣服 4裤子 5鞋子 6披风 7称号 8项链 9戒指',
    `suitCode`                  varchar(32)  NOT NULL DEFAULT '' COMMENT '套装Code',
    `rarityLevel`               int(11) NOT NULL DEFAULT '0' COMMENT '稀有度',
    `level`                     int(11) NOT NULL DEFAULT '0' COMMENT '装备等级',
    `hp`                        int(11) NOT NULL DEFAULT '0' COMMENT '血量',
    `mp`                        int(11) NOT NULL DEFAULT '0' COMMENT '法力',
    `attack`                    int(11) NOT NULL DEFAULT '0' COMMENT '攻击力',
    `defense`                   int(11) NOT NULL DEFAULT '0' COMMENT '防御力',
    `endurance`                 int(11) NOT NULL DEFAULT '0' COMMENT '耐力',
    `intellect`                 int(11) NOT NULL DEFAULT '0' COMMENT '智力',
    `strength`                  int(11) NOT NULL DEFAULT '0' COMMENT '力量',
    `criticalRate`              float        NOT NULL DEFAULT '0' COMMENT '暴击率',
    `criticalStrikeDamage`      float        NOT NULL DEFAULT '0' COMMENT '暴击伤害',
    `hitRate`                   float        NOT NULL DEFAULT '0' COMMENT '命中率',
    `dodgeRate`                 float        NOT NULL DEFAULT '0' COMMENT '闪避率',
    `penetrate`                 int(11) NOT NULL DEFAULT '0' COMMENT '穿透力',
    `attackSpeed`               float        NOT NULL DEFAULT '0' COMMENT '攻击速度',
    `attackElement`             varchar(32)  NOT NULL DEFAULT '' COMMENT '攻击元素',
    `jin`                       int(11) NOT NULL DEFAULT '0' COMMENT '金',
    `mu`                        int(11) NOT NULL DEFAULT '0' COMMENT '木',
    `tu`                        int(11) NOT NULL DEFAULT '0' COMMENT '土',
    `sui`                       int(11) NOT NULL DEFAULT '0' COMMENT '水',
    `huo`                       int(11) NOT NULL DEFAULT '0' COMMENT '火',
    `light`                     int(11) NOT NULL DEFAULT '0' COMMENT '光',
    `dark`                      int(11) NOT NULL DEFAULT '0' COMMENT '暗',
    `luck`                      int(11) NOT NULL DEFAULT '0' COMMENT '幸运值',
    PRIMARY KEY (`backpackId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户装备属性表';

-- 装备随机属性词条表
CREATE TABLE `goods_equipment_attribute_entry_list`
(
    `code`               int(11) NOT NULL COMMENT '词条code',
    `equipmentEntryType` int(11) NOT NULL COMMENT '装备词条类型 0通用 1防具 2武器 3首饰 4称号',
    `baseCode`           int(11) NOT NULL COMMENT '基础词条code',
    `name`               varchar(255)   NOT NULL COMMENT '词条名',
    `odds`               decimal(10, 2) NOT NULL COMMENT '随机概率',
    `level`              int(11) NOT NULL COMMENT '词条等级',
    `description`        varchar(255)   NOT NULL COMMENT '介绍',
    `param`              json           NOT NULL COMMENT '参数 json数组，例如词条为:"攻击力增加x"，那param就只有一个参数，参数为数字',
    PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='装备随机属性词条表';

-- 装备额外属性表
CREATE TABLE `goods_equipment_extra_attribute_list`
(
    `goodsEquipmentId` int(11) NOT NULL,
    `entryId`          int(11) NOT NULL COMMENT '词条id',
    `level`            int(11) NOT NULL COMMENT '词条等级',
    `entryType`        int(11) NOT NULL COMMENT '词条类型 1防御 2hp',
    `description`      varchar(255) NOT NULL COMMENT '介绍',
    `param`            json         NOT NULL COMMENT '参数 json数组，例如词条为:"攻击力增加x"，那param就只有一个参数，参数为数字',
    PRIMARY KEY (`goodsEquipmentId`, `entryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='装备额外属性表';

-- 用户装备随机属性词条表
CREATE TABLE `user_goods_equipment_attribute_entry_list`
(
    `id`          int(11) NOT NULL AUTO_INCREMENT,
    `backpackId`  int(11) NOT NULL,
    `code`        int(11) NOT NULL COMMENT '词条code',
    `baseCode`    int(11) NOT NULL COMMENT '基础词条code',
    `name`        varchar(255) NOT NULL COMMENT '词条名',
    `level`       int(11) NOT NULL COMMENT '词条等级',
    `description` varchar(255) NOT NULL COMMENT '介绍',
    `param`       json         NOT NULL COMMENT '参数 json数组，例如词条为:"攻击力增加x"，那param就只有一个参数，参数为数字',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户装备随机属性词条表';

-- 用户装备额外属性表
CREATE TABLE `user_goods_equipment_extra_attribute_list`
(
    `goodsEquipmentId` int(11) NOT NULL,
    `entryId`          int(11) NOT NULL COMMENT '词条id',
    `level`            int(11) NOT NULL COMMENT '词条等级',
    `description`      varchar(255) NOT NULL COMMENT '介绍',
    `param`            json         NOT NULL COMMENT '参数 json数组，例如词条为:"攻击力增加x"，那param就只有一个参数，参数为数字',
    PRIMARY KEY (`goodsEquipmentId`, `entryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户装备额外属性表';

-- 用户装备强化属性表(只强化攻击力,血量,防御力)
CREATE TABLE `user_goods_equipment_strengthen_attribute_list`
(
    `userEquipmentBackpackId` int(11) NOT NULL,
    `strengthenLevel`         int(11) NOT NULL COMMENT '强化等级',
    `hp`                      int(11) NOT NULL COMMENT '血量',
    `attack`                  int(11) NOT NULL COMMENT '攻击力 att',
    `defense`                 int(11) NOT NULL COMMENT '防御力 def',
    PRIMARY KEY (`userEquipmentBackpackId`, `strengthenLevel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户装备强化属性表(只强化攻击力,血量,防御力)';

-- 装备套装属性表
CREATE TABLE `goods_equipment_suit_attribute_list`
(
    `suitAttributeId` int(11) NOT NULL,
    `suitCode`        int(11) NOT NULL COMMENT '套装code',
    `entryCode2`      int(11) DEFAULT NULL,
    `description2`    varchar(255) DEFAULT NULL COMMENT '介绍',
    `param2`          json         DEFAULT NULL COMMENT '参数 json数组，例如词条为:"攻击力增加x"，那param就只有一个参数，参数为数字',
    `entryCode3`      int(11) DEFAULT NULL,
    `description3`    varchar(255) DEFAULT NULL COMMENT '介绍',
    `param3`          json         DEFAULT NULL COMMENT '参数 json数组，例如词条为:"攻击力增加x"，那param就只有一个参数，参数为数字',
    `entryCode5`      int(11) DEFAULT NULL,
    `description5`    varchar(255) DEFAULT NULL COMMENT '介绍',
    `param5`          json         DEFAULT NULL COMMENT '参数 json数组，例如词条为:"攻击力增加x"，那param就只有一个参数，参数为数字',
    PRIMARY KEY (`suitAttributeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='装备套装属性表';

-- 属性词条表
CREATE TABLE `attribute_entry_list`
(
    `entryCode`   int(11) NOT NULL COMMENT '词条id',
    `code`        int(11) NOT NULL COMMENT '词条code',
    `description` varchar(255) NOT NULL COMMENT '介绍',
    PRIMARY KEY (`entryCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='属性词条表';

-- 用户等级配置
CREATE TABLE `user_level_config`
(
    `level` int(11) NOT NULL COMMENT '等级',
    `exp`   int(11) NOT NULL COMMENT '经验',
    PRIMARY KEY (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户等级配置';

-- 游戏人物数据表
CREATE TABLE `user_attribute_list`
(
    `userId`                 int(11) NOT NULL,
    `level`                  int(11) NOT NULL COMMENT '等级',
    `name`                   varchar(255)  NOT NULL COMMENT '游戏名',
    `exp`                    int(11) NOT NULL COMMENT '经验',
    `hp`                     int(11) NOT NULL COMMENT '血量',
    `mp`                     int(11) NOT NULL COMMENT '法力',
    `attack`                 int(11) NOT NULL COMMENT '攻击力 att',
    `defense`                int(11) NOT NULL COMMENT '防御力 def',
    `endurance`              int(11) NOT NULL COMMENT '耐力 end',
    `intellect`              int(11) NOT NULL COMMENT '智力 int',
    `strength`               int(11) NOT NULL COMMENT '力量 str',
    `enduranceQualification` int(11) NOT NULL COMMENT '耐力资质，每级可以增加多少点',
    `intellectQualification` int(11) NOT NULL COMMENT '智力资质，每级可以增加多少点',
    `strengthQualification`  int(11) NOT NULL COMMENT '力量资质，每级可以增加多少点',
    `criticalRate`           decimal(5, 2) NOT NULL COMMENT '暴击率',
    `criticalStrikeDamage`   decimal(5, 2) NOT NULL COMMENT '暴击伤害',
    `hitRate`                decimal(5, 2) NOT NULL COMMENT '命中率 hit',
    `dodgeRate`              decimal(5, 2) NOT NULL COMMENT '闪避率',
    `penetrate`              int(11) NOT NULL COMMENT '穿透力',
    `attackSpeed`            int(11) NOT NULL COMMENT '攻击速度 attspd',
    `userElement`            int(11) NOT NULL COMMENT '角色元素',
    `attackElement`          int(11) NOT NULL COMMENT '攻击元素',
    `jin`                    int(11) NOT NULL COMMENT '金',
    `mu`                     int(11) NOT NULL COMMENT '木',
    `tu`                     int(11) NOT NULL COMMENT '土',
    `sui`                    int(11) NOT NULL COMMENT '水',
    `huo`                    int(11) NOT NULL COMMENT '火',
    `light`                  int(11) NOT NULL COMMENT '光',
    `dark`                   int(11) NOT NULL COMMENT '暗',
    `luck`                   int(11) NOT NULL COMMENT '幸运值',
    `physicalStrength`       int(11) NOT NULL COMMENT '体力',
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏人物数据表';


-- 游戏人物基础数据表
CREATE TABLE `user_base_attribute_list`
(
    `userId`                 int(11) NOT NULL,
    `name`                   varchar(255)  NOT NULL COMMENT '游戏名',
    `level`                  int(11) NOT NULL COMMENT '等级',
    `exp`                    int(11) NOT NULL COMMENT '经验',
    `hp`                     int(11) NOT NULL COMMENT '血量',
    `mp`                     int(11) NOT NULL COMMENT '法力',
    `attack`                 int(11) NOT NULL COMMENT '攻击力 att',
    `defense`                int(11) NOT NULL COMMENT '防御力 def',
    `endurance`              int(11) NOT NULL COMMENT '耐力 end',
    `intellect`              int(11) NOT NULL COMMENT '智力 int',
    `strength`               int(11) NOT NULL COMMENT '力量 str',
    `enduranceQualification` int(11) NOT NULL COMMENT '耐力资质，每级可以增加多少点',
    `intellectQualification` int(11) NOT NULL COMMENT '智力资质，每级可以增加多少点',
    `strengthQualification`  int(11) NOT NULL COMMENT '力量资质，每级可以增加多少点',
    `criticalRate`           decimal(5, 2) NOT NULL COMMENT '暴击率',
    `criticalStrikeDamage`   decimal(5, 2) NOT NULL COMMENT '暴击伤害',
    `hitRate`                decimal(5, 2) NOT NULL COMMENT '命中率 hit',
    `dodgeRate`              decimal(5, 2) NOT NULL COMMENT '闪避率',
    `penetrate`              int(11) NOT NULL COMMENT '穿透力',
    `attackSpeed`            int(11) NOT NULL COMMENT '攻击速度 attspd',
    `userElement`            int(11) NOT NULL COMMENT '角色元素',
    `attackElement`          int(11) NOT NULL COMMENT '攻击元素',
    `jin`                    int(11) NOT NULL COMMENT '金',
    `mu`                     int(11) NOT NULL COMMENT '木',
    `tu`                     int(11) NOT NULL COMMENT '土',
    `sui`                    int(11) NOT NULL COMMENT '水',
    `huo`                    int(11) NOT NULL COMMENT '火',
    `light`                  int(11) NOT NULL COMMENT '光',
    `dark`                   int(11) NOT NULL COMMENT '暗',
    `luck`                   int(11) NOT NULL COMMENT '幸运值',
    `physicalStrength`       int(11) NOT NULL COMMENT '体力',
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏人物基础数据表';
-- 创建地图环境表
CREATE TABLE `map_environment_list`
(
    `mapEnvironmentId`      int(11) NOT NULL AUTO_INCREMENT COMMENT '地图环境ID',
    `name`                  varchar(255) NOT NULL DEFAULT '' COMMENT '环境名',
    `description`           varchar(255) NOT NULL DEFAULT '' COMMENT '环境介绍',
    `recommendedLevelValue` varchar(2)   NOT NULL DEFAULT '' COMMENT '建议等级',
    `isInstanceZone`        tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为副本',
    PRIMARY KEY (`mapEnvironmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='地图环境表';

-- 创建游戏地图列表
CREATE TABLE `map_list`
(
    `mapId`            int(11) NOT NULL AUTO_INCREMENT COMMENT '地图ID',
    `name`             varchar(255) NOT NULL DEFAULT '' COMMENT '地图名',
    `mapEnvironmentId` int(11) NOT NULL COMMENT '所属环境ID',
    `difficultyLevel`  tinyint(1) NOT NULL DEFAULT '1' COMMENT '难度级别',
    `description`      varchar(255) NOT NULL DEFAULT '' COMMENT '地图介绍',
    `recommendedLevel` int(11) NOT NULL DEFAULT '0' COMMENT '建议等级',
    `isInstanceZone`   tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为副本',
    `maxLevel`         int(11) NOT NULL DEFAULT '0' COMMENT '最大层数',
    `monsterNum`       int(11) NOT NULL DEFAULT '0' COMMENT '每层怪物数量',
    `exp`              int(11) NOT NULL DEFAULT '0' COMMENT '经验基数',
    `gold`             int(11) NOT NULL DEFAULT '0' COMMENT '金币基数',
    `material`         int(11) NOT NULL DEFAULT '0' COMMENT '材料基数',
    `equipment`        int(11) NOT NULL DEFAULT '0' COMMENT '装备基数',
    `pet`              int(11) NOT NULL DEFAULT '0' COMMENT '宠物基数',
    `prop`             int(11) NOT NULL DEFAULT '0' COMMENT '道具基数',
    `order`            int(11) NOT NULL DEFAULT '0' COMMENT '排序',
    PRIMARY KEY (`mapId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏地图列表';

-- 创建用户游戏地图开放列表
CREATE TABLE `user_map_list`
(
    `userMapId` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户地图ID',
    `mapId`     int(11) NOT NULL COMMENT '地图ID',
    `userId`    int(11) NOT NULL COMMENT '用户ID',
    `addTime`   int(11) NOT NULL COMMENT '添加时间',
    PRIMARY KEY (`userMapId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户游戏地图开放列表';

-- 创建用户通过地图记录
CREATE TABLE `user_pass_map_list`
(
    `userPassMapId`    int(11) NOT NULL AUTO_INCREMENT COMMENT '用户通过地图记录ID',
    `userId`           int(11) NOT NULL COMMENT '用户ID',
    `mapId`            int(11) NOT NULL COMMENT '地图ID',
    `mapEnvironmentId` int(11) NOT NULL COMMENT '地图环境ID',
    `difficultyLevel`  tinyint(1) NOT NULL DEFAULT '1' COMMENT '难度级别',
    `addTime`          int(11) NOT NULL COMMENT '添加时间',
    PRIMARY KEY (`userPassMapId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户通过地图记录';

-- 创建游戏地图可爆稀有道具列表
CREATE TABLE `map_goods_list`
(
    `mapGoodsId` int(11) NOT NULL AUTO_INCREMENT COMMENT '地图物品ID',
    `mapId`      int(11) NOT NULL COMMENT '地图ID',
    `goodsCode`  varchar(255) NOT NULL DEFAULT '' COMMENT '物品code值',
    `goodsType`  tinyint(1) NOT NULL DEFAULT '1' COMMENT '物品类型',
    `odds`       int(11) NOT NULL DEFAULT '0' COMMENT '爆率',
    PRIMARY KEY (`mapGoodsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏地图可爆稀有道具列表';

-- 创建用户进入地图状态
CREATE TABLE `user_join_map_list`
(
    `userId`       int(11) NOT NULL COMMENT '用户ID',
    `mapId`        int(11) NOT NULL COMMENT '当前地图ID',
    `nowLevel`     int(11) NOT NULL DEFAULT '1' COMMENT '当前地图层数',
    `nowMonsterId` int(11) NOT NULL DEFAULT '0' COMMENT '当前怪物ID',
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户进入地图状态';

-- 创建游戏怪物数据
CREATE TABLE `monster_list`
(
    `monsterId`              int(11) NOT NULL AUTO_INCREMENT COMMENT '怪物ID',
    `name`                   varchar(255) NOT NULL DEFAULT '' COMMENT '怪物名称',
    `type`                   tinyint(1) NOT NULL DEFAULT '1' COMMENT '怪物类型',
    `description`            varchar(255) NOT NULL DEFAULT '' COMMENT '怪物介绍',
    `level`                  int(11) NOT NULL DEFAULT '0' COMMENT '怪物等级',
    `hp`                     int(11) NOT NULL DEFAULT '0' COMMENT '血量',
    `mp`                     int(11) NOT NULL DEFAULT '0' COMMENT '法力',
    `attack`                 int(11) NOT NULL DEFAULT '0' COMMENT '攻击力',
    `defense`                int(11) NOT NULL DEFAULT '0' COMMENT '防御力',
    `endurance`              int(11) NOT NULL DEFAULT '0' COMMENT '耐力',
    `intellect`              int(11) NOT NULL DEFAULT '0' COMMENT '智力',
    `strength`               int(11) NOT NULL DEFAULT '0' COMMENT '力量',
    `enduranceQualification` int(11) NOT NULL DEFAULT '0' COMMENT '耐力资质',
    `intellectQualification` int(11) NOT NULL DEFAULT '0' COMMENT '智力资质',
    `strengthQualification`  int(11) NOT NULL DEFAULT '0' COMMENT '力量资质',
    `criticalRate`           int(11) NOT NULL DEFAULT '0' COMMENT '暴击率',
    `criticalStrikeDamage`   int(11) NOT NULL DEFAULT '0' COMMENT '暴击伤害',
    `hitRate`                int(11) NOT NULL DEFAULT '0' COMMENT '命中率',
    `dodgeRate`              int(11) NOT NULL DEFAULT '0' COMMENT '闪避率',
    `penetrate`              int(11) NOT NULL DEFAULT '0' COMMENT '穿透力',
    `attackSpeed`            int(11) NOT NULL DEFAULT '0' COMMENT '攻击速度',
    `userElement`            tinyint(1) NOT NULL DEFAULT '0' COMMENT '角色元素',
    `attackElement`          varchar(255) NOT NULL DEFAULT '' COMMENT '攻击元素',
    `jin`                    int(11) NOT NULL DEFAULT '0' COMMENT '金',
    `mu`                     int(11) NOT NULL DEFAULT '0' COMMENT '木',
    `tu`                     int(11) NOT NULL DEFAULT '0' COMMENT '土',
    `sui`                    int(11) NOT NULL DEFAULT '0' COMMENT '水',
    `huo`                    int(11) NOT NULL DEFAULT '0' COMMENT '火',
    `light`                  int(11) NOT NULL DEFAULT '0' COMMENT '光',
    `dark`                   int(11) NOT NULL DEFAULT '0' COMMENT '暗',
    PRIMARY KEY (`monsterId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏怪物数据';
-- 游戏地图怪物数据表
CREATE TABLE `map_monster_list`
(
    `mapMonsterId`           int(11) NOT NULL AUTO_INCREMENT COMMENT '地图怪物ID',
    `monsterId`              int(11) NOT NULL COMMENT '怪物ID',
    `mapId`                  int(11) NOT NULL COMMENT '地图ID',
    `mapLevelMin`            int(11) NOT NULL COMMENT '地图关卡最小',
    `mapLevelMax`            int(11) NOT NULL COMMENT '地图关卡最大',
    `name`                   varchar(255) NOT NULL DEFAULT '' COMMENT '怪物名称',
    `type`                   int(11) NOT NULL COMMENT '怪物类型 1小怪,2精英,3boss',
    `description`            varchar(255) NOT NULL DEFAULT '' COMMENT '怪物介绍',
    `level`                  int(11) NOT NULL COMMENT '怪物等级',
    `hp`                     int(11) NOT NULL COMMENT '血量',
    `mp`                     int(11) NOT NULL COMMENT '法力',
    `attack`                 int(11) NOT NULL COMMENT '攻击力 att',
    `defense`                int(11) NOT NULL COMMENT '防御力 def',
    `endurance`              int(11) NOT NULL COMMENT '耐力 end',
    `intellect`              int(11) NOT NULL COMMENT '智力 int',
    `strength`               int(11) NOT NULL COMMENT '力量 str',
    `enduranceQualification` int(11) NOT NULL COMMENT '耐力资质,每级可以增加多少点',
    `intellectQualification` int(11) NOT NULL COMMENT '智力资质,每级可以增加多少点',
    `strengthQualification`  int(11) NOT NULL COMMENT '力量资质,每级可以增加多少点',
    `criticalRate`           int(11) NOT NULL COMMENT '暴击率',
    `criticalStrikeDamage`   int(11) NOT NULL COMMENT '暴击伤害',
    `hitRate`                int(11) NOT NULL COMMENT '命中率 hit',
    `dodgeRate`              int(11) NOT NULL COMMENT '闪避率',
    `penetrate`              int(11) NOT NULL COMMENT '穿透力',
    `attackSpeed`            int(11) NOT NULL COMMENT '攻击速度 attspd',
    `userElement`            varchar(255) NOT NULL DEFAULT '' COMMENT '角色元素',
    `attackElement`          varchar(255) NOT NULL DEFAULT '' COMMENT '攻击元素',
    `jin`                    int(11) NOT NULL COMMENT '金',
    `mu`                     int(11) NOT NULL COMMENT '木',
    `tu`                     int(11) NOT NULL COMMENT '土',
    `sui`                    int(11) NOT NULL COMMENT '水',
    `huo`                    int(11) NOT NULL COMMENT '火',
    `light`                  int(11) NOT NULL COMMENT '光',
    `dark`                   int(11) NOT NULL COMMENT '暗',
    PRIMARY KEY (`mapMonsterId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏地图怪物数据';

-- buff列表表
CREATE TABLE `buff_list`
(
    `buffId`      int(11) NOT NULL COMMENT 'buffID',
    `name`        varchar(255) NOT NULL DEFAULT '' COMMENT 'buff名称',
    `isDebuff`    tinyint(1) NOT NULL COMMENT '是否为debuff',
    `code`        varchar(255) NOT NULL COMMENT 'buffcode',
    `stackLayer`  int(11) NOT NULL COMMENT '最大叠加层数',
    `entryCode`   int(11) NOT NULL COMMENT '词条code',
    `param`       varchar(255) NOT NULL COMMENT '参数',
    `paramNum`    int(11) NOT NULL COMMENT '参数数量',
    `type`        int(11) NOT NULL COMMENT '类型   0主动触发 1战斗前buff,2攻击前触发,3攻击后触发,4被攻击前触发,5被攻击后触发,6扣血触发,7一秒触发一次,8战斗结束前触发,9战斗结束后触发,10释放技能前触发,11释放技能后触发',
    `description` varchar(255) NOT NULL DEFAULT '' COMMENT '介绍',
    `expireType`  int(11) NOT NULL COMMENT '过期类型 1正常倒计时过期(战斗完直接失效) 2正常倒计时过期(退出地图直接失效) 3正常倒计时过期(一直有效)',
    `expireTime`  int(11) NOT NULL COMMENT '倒计时(秒)',
    PRIMARY KEY (`buffId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='buff列表';

-- 邮件列表表
CREATE TABLE `mail_list`
(
    `id`        int(11) NOT NULL AUTO_INCREMENT,
    `userId`    int(11) NOT NULL COMMENT '用户ID',
    `name`      varchar(64)  NOT NULL DEFAULT '' COMMENT '名称',
    `msg`       varchar(255) NOT NULL DEFAULT '' COMMENT '消息',
    `addTime`   datetime     NOT NULL COMMENT '添加时间',
    `isRead`    tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否读取',
    `isReceive` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否领取',
    `isDelete`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='邮件列表';

-- 邮件附带物品表
CREATE TABLE `mail_goods_list`
(
    `id`        int(11) NOT NULL AUTO_INCREMENT,
    `mailId`    int(11) NOT NULL COMMENT '邮件ID',
    `goodsCode` varchar(255) NOT NULL COMMENT '物品code',
    `num`       int(11) NOT NULL COMMENT '数量',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='邮件附带物品表 (包括金币,物品)';

-- 技能词条表
CREATE TABLE `skill_list`
(
    `skillId`     int(11) NOT NULL COMMENT '技能ID',
    `name`        varchar(255) NOT NULL DEFAULT '' COMMENT '技能名',
    `level`       int(11) NOT NULL COMMENT '技能等级',
    `triggerType` int(11) NOT NULL COMMENT '触发类型',
    `triggerRate` int(11) NOT NULL COMMENT '触发概率计算',
    `rarityLevel` int(11) NOT NULL COMMENT '稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话',
    `maxLevel`    int(11) NOT NULL COMMENT '最大等级',
    `coolingTime` int(11) NOT NULL COMMENT '冷却时间计算',
    `manaCost`    int(11) NOT NULL COMMENT '耗蓝计算',
    `description` varchar(255) NOT NULL DEFAULT '' COMMENT '介绍',
    `effectParam` varchar(255) NOT NULL COMMENT '效果数组',
    PRIMARY KEY (`skillId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='技能词条表';

-- 玩家技能列表
CREATE TABLE `user_skill_list`
(
    `userSkillId` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户技能ID',
    `userId`      int(11) NOT NULL COMMENT '用户ID',
    `skillId`     int(11) NOT NULL COMMENT '技能ID',
    `skillName`   varchar(255) NOT NULL DEFAULT '' COMMENT '技能名',
    `triggerType` int(11) NOT NULL COMMENT '触发类型',
    `triggerRate` int(11) NOT NULL COMMENT '触发概率计算',
    `isUse`       tinyint(1) NOT NULL COMMENT '是否穿戴',
    `level`       int(11) NOT NULL COMMENT '技能等级',
    `rarityLevel` int(11) NOT NULL COMMENT '稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话',
    `maxLevel`    int(11) NOT NULL COMMENT '最大等级',
    `coolingTime` int(11) NOT NULL COMMENT '冷却时间计算',
    `manaCost`    int(11) NOT NULL COMMENT '耗蓝计算',
    `entryCode`   int(11) NOT NULL COMMENT '词条ID',
    `description` varchar(255) NOT NULL DEFAULT '' COMMENT '介绍',
    `effectParam` varchar(255) NOT NULL COMMENT '效果数组',
    PRIMARY KEY (`userSkillId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='玩家技能列表';
-- 实名认证表
CREATE TABLE `real_name_authentication_list`
(
    `userId`   int(11) NOT NULL,
    `idCard`   varchar(20) NOT NULL,
    `realName` varchar(32) NOT NULL,
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='实名认证表';

-- 宠物列表
CREATE TABLE `pet_list`
(
    `petId`                  int(11) NOT NULL,
    `name`                   varchar(32)  NOT NULL COMMENT '宠物名称',
    `type`                   int(11) NOT NULL COMMENT '宠物类型 1金2木3土4水5火6光7暗',
    `description`            varchar(255) NOT NULL COMMENT '怪物介绍',
    `level`                  int(11) NOT NULL COMMENT '怪物等级',
    `classLevel`             int(11) NOT NULL COMMENT '阶级',
    `awakeLevel`             int(11) NOT NULL COMMENT '觉醒等级',
    `hp`                     int(11) NOT NULL COMMENT '血量',
    `mp`                     int(11) NOT NULL COMMENT '法力',
    `attack`                 int(11) NOT NULL COMMENT '攻击力 att',
    `defense`                int(11) NOT NULL COMMENT '防御力 def',
    `endurance`              int(11) NOT NULL COMMENT '耐力 end',
    `intellect`              int(11) NOT NULL COMMENT '智力 int',
    `strength`               int(11) NOT NULL COMMENT '力量 str',
    `enduranceQualification` int(11) NOT NULL COMMENT '耐力资质，每级可以增加多少点',
    `intellectQualification` int(11) NOT NULL COMMENT '智力资质，每级可以增加多少点',
    `strengthQualification`  int(11) NOT NULL COMMENT '力量资质，每级可以增加多少点',
    `criticalRate`           float        NOT NULL COMMENT '暴击率',
    `criticalStrikeDamage`   float        NOT NULL COMMENT '暴击伤害',
    `hitRate`                float        NOT NULL COMMENT '命中率 hit',
    `dodgeRate`              float        NOT NULL COMMENT '闪避率',
    `penetrate`              int(11) NOT NULL COMMENT '穿透力',
    `attackSpeed`            int(11) NOT NULL COMMENT '攻击速度 attspd',
    `userElement`            varchar(10)  NOT NULL COMMENT '角色元素',
    `attackElement`          varchar(10)  NOT NULL COMMENT '攻击元素',
    `jin`                    int(11) NOT NULL COMMENT '金',
    `mu`                     int(11) NOT NULL COMMENT '木',
    `tu`                     int(11) NOT NULL COMMENT '土',
    `sui`                    int(11) NOT NULL COMMENT '水',
    `huo`                    int(11) NOT NULL COMMENT '火',
    `light`                  int(11) NOT NULL COMMENT '光',
    `dark`                   int(11) NOT NULL COMMENT '暗',
    PRIMARY KEY (`petId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='宠物列表';

-- 宠物技能列表
CREATE TABLE `pet_skill_list`
(
    `petSkillId`  int(11) NOT NULL,
    `userId`      int(11) NOT NULL COMMENT '用户id',
    `skillId`     int(11) NOT NULL COMMENT '技能id',
    `skillName`   varchar(32)  NOT NULL COMMENT '技能名',
    `triggerType` int(11) NOT NULL COMMENT '触发类型',
    `triggerRate` float        NOT NULL COMMENT '触发概率计算',
    `isUse`       tinyint(1) NOT NULL COMMENT '是否穿戴',
    `level`       int(11) NOT NULL COMMENT '技能等级',
    `rarityLevel` int(11) NOT NULL COMMENT '稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话',
    `maxLevel`    int(11) NOT NULL COMMENT '最大等级',
    `coolingTime` int(11) NOT NULL COMMENT '冷却时间计算',
    `manaCost`    int(11) NOT NULL COMMENT '耗蓝计算',
    `entryCode`   int(11) NOT NULL COMMENT '词条id',
    `description` varchar(255) NOT NULL COMMENT '介绍',
    `effectParam` varchar(255) NOT NULL COMMENT '效果数组',
    PRIMARY KEY (`petSkillId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='宠物技能列表';

-- 用户宠物列表
CREATE TABLE `user_pet_list`
(
    `userPetId`              int(11) NOT NULL,
    `userId`                 int(11) NOT NULL COMMENT '用户id',
    `petId`                  int(11) NOT NULL,
    `name`                   varchar(32)  NOT NULL COMMENT '宠物名称',
    `type`                   varchar(10)  NOT NULL COMMENT '宠物类型 jin mu tu sui huo light dark',
    `description`            varchar(255) NOT NULL COMMENT '怪物介绍',
    `level`                  int(11) NOT NULL COMMENT '宠物等级',
    `classLevel`             int(11) NOT NULL COMMENT '宠物阶级',
    `awakeLevel`             int(11) NOT NULL COMMENT '觉醒等级',
    `exp`                    int(11) NOT NULL COMMENT '宠物经验',
    `isBest`                 tinyint(1) NOT NULL COMMENT '是否为极品宠物',
    `isUse`                  tinyint(1) NOT NULL COMMENT '是否携带',
    `hp`                     int(11) NOT NULL COMMENT '血量',
    `mp`                     int(11) NOT NULL COMMENT '法力',
    `attack`                 int(11) NOT NULL COMMENT '攻击力 att',
    `defense`                int(11) NOT NULL COMMENT '防御力 def',
    `endurance`              int(11) NOT NULL COMMENT '耐力 end',
    `intellect`              int(11) NOT NULL COMMENT '智力 int',
    `strength`               int(11) NOT NULL COMMENT '力量 str',
    `enduranceQualification` int(11) NOT NULL COMMENT '耐力资质，每级可以增加多少点',
    `intellectQualification` int(11) NOT NULL COMMENT '智力资质，每级可以增加多少点',
    `strengthQualification`  int(11) NOT NULL COMMENT '力量资质，每级可以增加多少点',
    `criticalRate`           float        NOT NULL COMMENT '暴击率',
    `criticalStrikeDamage`   float        NOT NULL COMMENT '暴击伤害',
    `hitRate`                float        NOT NULL COMMENT '命中率 hit',
    `dodgeRate`              float        NOT NULL COMMENT '闪避率',
    `penetrate`              int(11) NOT NULL COMMENT '穿透力',
    `attackSpeed`            int(11) NOT NULL COMMENT '攻击速度 attspd',
    `userElement`            varchar(10)  NOT NULL COMMENT '角色元素',
    `attackElement`          varchar(10)  NOT NULL COMMENT '攻击元素',
    `jin`                    int(11) NOT NULL COMMENT '金',
    `mu`                     int(11) NOT NULL COMMENT '木',
    `tu`                     int(11) NOT NULL COMMENT '土',
    `sui`                    int(11) NOT NULL COMMENT '水',
    `huo`                    int(11) NOT NULL COMMENT '火',
    `light`                  int(11) NOT NULL COMMENT '光',
    `dark`                   int(11) NOT NULL COMMENT '暗',
    PRIMARY KEY (`userPetId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户宠物列表';
CREATE TABLE `user_pet_skill_list`
(
    `userPetSkillId` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户技能id',
    `userPetId`      int(11) NOT NULL COMMENT '用户宠物id',
    `userId`         int(11) NOT NULL COMMENT '用户id',
    `skillId`        int(11) NOT NULL COMMENT '技能id',
    `skillName`      varchar(255) NOT NULL DEFAULT '' COMMENT '技能名',
    `triggerType`    varchar(255) NOT NULL DEFAULT '' COMMENT '触发类型',
    `triggerRate`    varchar(255) NOT NULL DEFAULT '' COMMENT '触发概率计算',
    `isUse`          tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否穿戴',
    `level`          int(11) NOT NULL DEFAULT '0' COMMENT '技能等级',
    `rarityLevel`    int(11) NOT NULL DEFAULT '0' COMMENT '稀有度 1普通,2精致,3稀有,4罕见,5传说,6神话,7噩梦神话',
    `maxLevel`       int(11) NOT NULL DEFAULT '0' COMMENT '最大等级',
    `coolingTime`    varchar(255) NOT NULL DEFAULT '' COMMENT '冷却时间计算',
    `manaCost`       varchar(255) NOT NULL DEFAULT '' COMMENT '耗蓝计算',
    `entryCode`      int(11) NOT NULL DEFAULT '0' COMMENT '词条id',
    `description`    varchar(255) NOT NULL DEFAULT '' COMMENT '介绍',
    `effectParam`    varchar(255) NOT NULL DEFAULT '' COMMENT '效果数组',
    PRIMARY KEY (`userPetSkillId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户宠物技能表';

CREATE TABLE `sign_reward_list`
(
    `id`      int(11) NOT NULL AUTO_INCREMENT,
    `signNum` int(11) NOT NULL COMMENT '一周签到多少次',
    `money`   int(11) NOT NULL COMMENT '多少钻石奖励',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='签到钻石奖励列表';

CREATE TABLE `user_sign_list`
(
    `userId`         int(11) NOT NULL COMMENT '用户id',
    `signNum`        int(11) NOT NULL COMMENT '签到天数',
    `lastUpdateTime` int(11) NOT NULL COMMENT '上次更新时间',
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户签到天数表';

CREATE TABLE `shop_goods_list`
(
    `shopGoodsId` int(11) NOT NULL AUTO_INCREMENT,
    `goodsCode`   varchar(255) NOT NULL COMMENT '物品code',
    `goodsName`   varchar(255) NOT NULL COMMENT '物品名',
    `limit`       int(11) NOT NULL COMMENT '购买限制',
    `limitType`   int(11) NOT NULL COMMENT '限制类型 0永久,1每日,2每周,3每月',
    `price`       int(11) NOT NULL COMMENT '售价',
    `stock`       int(11) NOT NULL DEFAULT '0' COMMENT '库存,0表示没有库存',
    `priceType`   int(11) NOT NULL COMMENT '售价类型 1金币,2钻石',
    `addTime`     int(11) NOT NULL COMMENT '新增时间',
    PRIMARY KEY (`shopGoodsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商店商品列表';

CREATE TABLE `user_buy_shop_goods_order_list`
(
    `orderId`     int(11) NOT NULL AUTO_INCREMENT,
    `userId`      int(11) NOT NULL COMMENT '用户id',
    `shopGoodsId` int(11) NOT NULL COMMENT '商品id',
    `num`         int(11) NOT NULL COMMENT '购买数量',
    `date`        date NOT NULL COMMENT '购买日期',
    `addTime`     int(11) NOT NULL COMMENT '新增时间',
    PRIMARY KEY (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户购买商品列表';

CREATE TABLE `game_task_master_list`
(
    `taskMasterId` int(11) NOT NULL AUTO_INCREMENT COMMENT '主任务id',
    `type`         int(11) NOT NULL COMMENT '1主线任务',
    `name`         varchar(255) NOT NULL COMMENT '任务名',
    `description`  varchar(255) NOT NULL COMMENT '任务介绍',
    `order`        int(11) NOT NULL COMMENT '排序',
    PRIMARY KEY (`taskMasterId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏主线任务主配置表';

CREATE TABLE `game_task_list`
(
    `taskId`       int(11) NOT NULL AUTO_INCREMENT COMMENT '任务id',
    `taskMasterId` int(11) NOT NULL COMMENT '主任务id',
    `code`         varchar(255) NOT NULL COMMENT '任务编码',
    `order`        int(11) NOT NULL COMMENT '排序',
    `completeNum`  int(11) NOT NULL COMMENT '完成次数',
    `name`         varchar(255) NOT NULL COMMENT '任务名',
    `description`  varchar(255) NOT NULL COMMENT '任务介绍',
    `param`        varchar(255) NOT NULL COMMENT '任务参数 例如 获取1,5,7件10级橙装 参数为 [1,10,6(橙装)]',
    PRIMARY KEY (`taskId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏主线任务配置表';

CREATE TABLE `game_task_reward_list`
(
    `taskRewardId` int(11) NOT NULL AUTO_INCREMENT COMMENT '奖励id',
    `taskId`       int(11) NOT NULL COMMENT '任务id',
    `goodsCode`    varchar(255) NOT NULL COMMENT '物品code',
    `num`          int(11) NOT NULL COMMENT '数量',
    PRIMARY KEY (`taskRewardId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任务完成奖励列表';

CREATE TABLE `user_game_task_master_complete_list`
(
    `userId`       int(11) NOT NULL COMMENT '用户id',
    `taskMasterId` int(11) NOT NULL COMMENT '主线id',
    `nowTaskId`    int(11) NOT NULL COMMENT '完成id',
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='玩家主线任务完成表';

CREATE TABLE `user_game_task_complete_list`
(
    `userTaskCompleteId` int(11) NOT NULL AUTO_INCREMENT COMMENT '玩家任务完成id',
    `userId`             int(11) NOT NULL COMMENT '玩家id',
    `taskId`             int(11) NOT NULL COMMENT '任务id',
    `taskCode`           varchar(255) NOT NULL COMMENT '任务code',
    `nowNum`             int(11) NOT NULL COMMENT '当前数量',
    `completeNum`        int(11) NOT NULL COMMENT '完成进度',
    `state`              int(11) NOT NULL COMMENT '0未完成 1已完成 2已领取',
    PRIMARY KEY (`userTaskCompleteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='玩家游戏任务完成表';

CREATE TABLE `game_daily_task_list`
(
    `gameDailyTaskId` int(11) NOT NULL AUTO_INCREMENT COMMENT '游戏每日任务id',
    `name`            varchar(255) NOT NULL COMMENT '任务名',
    `code`            varchar(255) NOT NULL COMMENT '任务code',
    `description`     varchar(255) NOT NULL COMMENT '任务介绍',
    `rewardPoint`     int(11) NOT NULL COMMENT '奖励积分',
    `maxNum`          int(11) NOT NULL COMMENT '总奖励次数限制',
    PRIMARY KEY (`gameDailyTaskId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏每日任务表';

CREATE TABLE `game_daily_task_point_reward_list`
(
    `rewardId`  int(11) NOT NULL AUTO_INCREMENT,
    `type`      int(11) NOT NULL COMMENT '1每日奖励,2每周奖励',
    `pointNum`  int(11) NOT NULL COMMENT '积分数',
    `goodsCode` varchar(255) NOT NULL COMMENT '物品code',
    `goodsNum`  int(11) NOT NULL COMMENT '物品数量',
    PRIMARY KEY (`rewardId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏每日任务积分奖励表';

CREATE TABLE `user_daily_task_point_list`
(
    `userId`         int(11) NOT NULL COMMENT '用户id',
    `weekPointNum`   int(11) NOT NULL COMMENT '每周积分数',
    `dailyPointNum`  int(11) NOT NULL COMMENT '每日积分',
    `lastUpdateTime` int(11) NOT NULL COMMENT '上次更新时间',
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='玩家每日任务获得积分表';

CREATE TABLE `user_daily_task_complete_list`
(
    `userDailyTaskCompleteId` int(11) NOT NULL AUTO_INCREMENT COMMENT '玩家每日任务完成情况id',
    `userId`                  int(11) NOT NULL COMMENT '玩家id',
    `gameDailyTaskId`         int(11) NOT NULL COMMENT '每日任务id',
    `completeNum`             int(11) NOT NULL COMMENT '完成数',
    `date`                    date NOT NULL COMMENT '完成日期',
    `addTime`                 int(11) NOT NULL COMMENT '新增时间',
    PRIMARY KEY (`userDailyTaskCompleteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='玩家每日任务完成情况表';

CREATE TABLE `user_daily_task_receive_list`
(
    `userDailyTaskReceiveId` int(11) NOT NULL AUTO_INCREMENT COMMENT '玩家每日任务领取id',
    `userId`                 int(11) NOT NULL COMMENT '玩家id',
    `rewardId`               int(11) NOT NULL COMMENT '奖励id',
    `addTime`                int(11) NOT NULL COMMENT '新增时间',
    `date`                   date NOT NULL COMMENT '领取日期',
    PRIMARY KEY (`userDailyTaskReceiveId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='玩家每日任务领取详情表';

CREATE TABLE `user_extra_limit_list`
(
    `userId`      int(11) NOT NULL COMMENT '用户id',
    `petNum`      int(11) NOT NULL COMMENT '宠物数量',
    `backpackNum` int(11) NOT NULL COMMENT '装备数量',
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户数据额外上限表';

CREATE TABLE `game_version_list`
(
    `id`          int(11) NOT NULL AUTO_INCREMENT,
    `versionId`   int(11) NOT NULL COMMENT '游戏版本id',
    `description` varchar(512) NOT NULL COMMENT '版本介绍',
    `addTime`     int(11) NOT NULL COMMENT '新增 时间',
    `url`         varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏版本列表';

CREATE TABLE `game_cdk_list`
(
    `cdkId`   int(11) NOT NULL AUTO_INCREMENT,
    `cdk`     varchar(255) NOT NULL COMMENT 'cdk兑换码',
    `num`     int(11) NOT NULL COMMENT '数量',
    `addTime` int(11) NOT NULL,
    `endTime` int(11) NOT NULL,
    `status`  int(11) NOT NULL COMMENT '0正常 1已使用 -1已过期',
    PRIMARY KEY (`cdkId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='cdk兑换列表';

CREATE TABLE `game_cdk_goods_list`
(
    `cdkGoodsId` int(11) NOT NULL AUTO_INCREMENT,
    `cdkId`      int(11) NOT NULL COMMENT 'cdkid',
    `goodsCode`  varchar(255) NOT NULL COMMENT '商品code',
    `goodsNum`   int(11) NOT NULL COMMENT '商品数量',
    PRIMARY KEY (`cdkGoodsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='游戏cdk物品列表';

CREATE TABLE `user_cdk_receive_list`
(
    `receiveId` int(11) NOT NULL AUTO_INCREMENT,
    `userId`    int(11) NOT NULL COMMENT '用户id',
    `cdkId`     int(11) NOT NULL COMMENT 'cdkId',
    `addTime`   int(11) NOT NULL,
    PRIMARY KEY (`receiveId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户cdk领取记录';

CREATE TABLE `skill_shop_list`
(
    `skillShopId` int(11) NOT NULL AUTO_INCREMENT,
    `skillId`     int(11) NOT NULL COMMENT '技能id',
    `skillName`   varchar(32) NOT NULL COMMENT '技能名',
    PRIMARY KEY (`skillShopId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='技能商店';

CREATE TABLE `skill_level_up_need_goods_list`
(
    `id`        int(11) NOT NULL AUTO_INCREMENT,
    `skillId`   int(11) NOT NULL COMMENT '技能id',
    `level`     int(11) NOT NULL COMMENT '学习等级',
    `goodsCode` varchar(255) NOT NULL COMMENT '物品code',
    `goodsNum`  int(11) NOT NULL COMMENT '物品数量',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='学技能所需物品表';

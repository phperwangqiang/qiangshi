-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2020-04-26 08:57:53
-- 服务器版本： 5.6.44-log
-- PHP Version: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zzdianjing`
--

-- --------------------------------------------------------

--
-- 表的结构 `zx_adminuser`
--

CREATE TABLE IF NOT EXISTS `zx_adminuser` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `groupid` int(11) NOT NULL,
  `areaid` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `zx_adminuser`
--

INSERT INTO `zx_adminuser` (`id`, `username`, `password`, `groupid`, `areaid`) VALUES
(1, 'admin', '84e3c1d3e29fd2a84912fa21e03d1cef', 60, 0),
(6, 'wangqiang', 'b3da508ffba97c897da102cc86f5750d', 61, 3),
(5, 'lixing', 'b3da508ffba97c897da102cc86f5750d', 60, 12),
(8, 'yanhu', 'b3da508ffba97c897da102cc86f5750d', 63, 3),
(9, 'lulu', 'b3da508ffba97c897da102cc86f5750d', 63, 19);

-- --------------------------------------------------------

--
-- 表的结构 `zx_boss`
--

CREATE TABLE IF NOT EXISTS `zx_boss` (
  `id` int(11) NOT NULL,
  `companyid` int(11) NOT NULL COMMENT '公司id',
  `nickname` varchar(255) NOT NULL COMMENT '昵称',
  `openid` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL COMMENT '头像',
  `inputtime` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `zx_case`
--

CREATE TABLE IF NOT EXISTS `zx_case` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '标题',
  `companyid` int(11) NOT NULL COMMENT '公司id',
  `inputtime` varchar(15) NOT NULL COMMENT '添加时间',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `picurl` varchar(255) NOT NULL COMMENT '缩略图片',
  `createat` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='公告';

--
-- 转存表中的数据 `zx_case`
--

INSERT INTO `zx_case` (`id`, `name`, `companyid`, `inputtime`, `description`, `picurl`, `createat`, `mobile`) VALUES
(3, '狗拿HOUSE', 0, '1587705507', '狗拿house是一个为狗狗和狗狗主人服务的平台', '/uploads/20200424/521e141c29d4f623bbb9eb321ad712f3.jpg', '2020-04-24 13:18:27', '18395614415'),
(4, '社区饮水机', 0, '1587705645', '社区饮水机云安全解决方案', '/uploads/20200424/b9fe194156f38e3bb7eb06d156759e0c.jpg', '2020-04-24 13:20:45', '18395614415'),
(5, '德度科技商城', 0, '1587705750', '德度科技商城,医疗保健品商城', '/uploads/20200424/1cf0583e2cb0f1e813edf97e26fff508.png', '2020-04-24 13:22:30', '18395614415');

-- --------------------------------------------------------

--
-- 表的结构 `zx_company`
--

CREATE TABLE IF NOT EXISTS `zx_company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '名字',
  `picurl` varchar(255) NOT NULL COMMENT '头像',
  `inputtime` varchar(15) NOT NULL COMMENT '添加时间',
  `createat` varchar(100) NOT NULL,
  `updatetime` varchar(255) NOT NULL,
  `updateat` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='公司名字';

--
-- 转存表中的数据 `zx_company`
--

INSERT INTO `zx_company` (`id`, `name`, `picurl`, `inputtime`, `createat`, `updatetime`, `updateat`) VALUES
(1, '点睛网络', '/uploads/20200424/ba2462857a27d3217786742ddcefeba4.jpg', '1587540347', '2020-04-22 15:25:47', '1587716556', '2020-04-24 16:22:36');

-- --------------------------------------------------------

--
-- 表的结构 `zx_employee`
--

CREATE TABLE IF NOT EXISTS `zx_employee` (
  `id` int(11) NOT NULL,
  `companyid` int(11) NOT NULL COMMENT '公司id',
  `nickname` varchar(255) NOT NULL COMMENT '昵称',
  `openid` varchar(255) NOT NULL COMMENT 'openid',
  `avatar` varchar(255) NOT NULL COMMENT '头像',
  `money` float NOT NULL COMMENT '余额',
  `inputtime` varchar(15) NOT NULL COMMENT '添加时间',
  `name` varchar(255) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `md5passwd` varchar(255) NOT NULL,
  `createat` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='员工表';

--
-- 转存表中的数据 `zx_employee`
--

INSERT INTO `zx_employee` (`id`, `companyid`, `nickname`, `openid`, `avatar`, `money`, `inputtime`, `name`, `passwd`, `md5passwd`, `createat`, `mobile`) VALUES
(2, 0, '', '', '', 0, '1587538919', '王强', '123456', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-22 15:01:59', '18118181818'),
(3, 0, '', '', '', 0, '1587538929', '杜泽伟', '123456', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-22 15:02:09', '19119191919'),
(4, 0, '', '', '', 0, '1587689522', '李立兴', '123456', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-24 08:52:02', '18383838383'),
(6, 0, '', '', '', 0, '1587736844', '孟帅', '123456', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-24 22:00:44', '18132453262');

-- --------------------------------------------------------

--
-- 表的结构 `zx_employeelog`
--

CREATE TABLE IF NOT EXISTS `zx_employeelog` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1分享视频 2提现 ',
  `content` varchar(255) NOT NULL COMMENT '具体内容',
  `inputtime` varchar(15) NOT NULL COMMENT '添加时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `zx_fenrunlog`
--

CREATE TABLE IF NOT EXISTS `zx_fenrunlog` (
  `id` int(11) NOT NULL,
  `uuid` int(11) NOT NULL COMMENT '谁触发的',
  `reason` varchar(255) NOT NULL COMMENT '原因',
  `uid` int(11) NOT NULL COMMENT '谁受益'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分润日志';

-- --------------------------------------------------------

--
-- 表的结构 `zx_goods`
--

CREATE TABLE IF NOT EXISTS `zx_goods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '标题',
  `price` float NOT NULL COMMENT '价格',
  `content` text NOT NULL COMMENT '具体内容',
  `picurl` text NOT NULL COMMENT '缩略图json',
  `companyid` int(11) NOT NULL COMMENT '公司id',
  `kucun` int(11) NOT NULL COMMENT '库存',
  `xiaoliang` int(11) NOT NULL COMMENT '销量',
  `inputtime` varchar(15) NOT NULL COMMENT '添加时间',
  `createat` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `zx_goods`
--

INSERT INTO `zx_goods` (`id`, `name`, `price`, `content`, `picurl`, `companyid`, `kucun`, `xiaoliang`, `inputtime`, `createat`, `mobile`, `description`) VALUES
(3, '点睛网络科技网站开发', 3000, '', '/uploads/20200424/4d4d50bd99b4e90a439691bc80a69f77.jpg', 0, 0, 0, '1587705989', '2020-04-24 13:26:29', '18395614415', '点睛网络科技网站开发,平板手机PC全兼容,SEO友好'),
(4, '点睛科技APP开发', 20000, '', '/uploads/20200424/3fa6b5bd9811e136b481ec0b86bb2ae2.jpg', 0, 0, 0, '1587706091', '2020-04-24 13:28:11', '18395614415', '前后端独立自主开发,android、ios全兼容'),
(5, '点睛网络科技小程序开发', 10000, '', '/uploads/20200424/1314e6f95fd69765e3f081958c8323fc.jpg', 0, 0, 0, '1587706157', '2020-04-24 13:29:17', '18395614415', 'VUE内核，独立自主后台，生产更好用的小程序'),
(6, '点睛网络科技物联网解决方案', 20000, '', '/uploads/20200424/75a7afaa758ece43bcc8063a0be810db.jpg', 0, 0, 0, '1587706223', '2020-04-24 13:30:23', '18395614415', '物联网解决方案一站式解决，软硬件共同搭建安全云服务');

-- --------------------------------------------------------

--
-- 表的结构 `zx_notice`
--

CREATE TABLE IF NOT EXISTS `zx_notice` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `companyid` int(11) NOT NULL COMMENT '公司id',
  `keywords` varchar(255) NOT NULL COMMENT '关键字',
  `inputtime` varchar(15) NOT NULL COMMENT '添加时间',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图片',
  `content` text NOT NULL COMMENT '具体内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公告';

-- --------------------------------------------------------

--
-- 表的结构 `zx_order`
--

CREATE TABLE IF NOT EXISTS `zx_order` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `cid` int(11) NOT NULL COMMENT '商户id',
  `pid` int(11) NOT NULL COMMENT '父级id(推广分销用)',
  `orderno` varchar(20) NOT NULL COMMENT '订单号',
  `ordercontent` text NOT NULL COMMENT '订单内容',
  `price` float NOT NULL COMMENT '金额',
  `address` varchar(255) NOT NULL COMMENT '收货地址',
  `status` int(11) NOT NULL COMMENT '状态 0待付款 1待发货 2待收货 3已完成',
  `inputtime` varchar(15) NOT NULL COMMENT '添加时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `zx_user`
--

CREATE TABLE IF NOT EXISTS `zx_user` (
  `id` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `picurl` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `inputtime` varchar(15) NOT NULL COMMENT '添加时间',
  `createat` varchar(255) NOT NULL,
  `reson` varchar(255) NOT NULL,
  `fromid` int(11) NOT NULL DEFAULT '0',
  `token` varchar(32) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `session_key` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `zx_user`
--

INSERT INTO `zx_user` (`id`, `openid`, `picurl`, `nickname`, `phone`, `inputtime`, `createat`, `reson`, `fromid`, `token`, `province`, `country`, `city`, `session_key`) VALUES
(5, 'oN0qR4h93drqjUMUbylTtmO4XoEI', 'https://wx.qlogo.cn/mmopen/vi_32/uQlG4Xo3ya8hm9A6CiceVXLNTibTYNfebdMxrNMvs3LE1ibVKwQT69Gsy5eiaqTP5UxsDzwp1gdIH7YoBZM47mFT9Q/132', '%E6%B2%B3%E5%8C%97%E4%BC%9F%E6%B9%83-%E6%81%AF%E6%98%8A', '15731695873', '1587692434', '2020-04-24 09:40:34', '通过视频《点睛科技宣传片三》获取到', 2, '27714a0d04775a66a9f43d7f36137b3b', 'Hebei', 'China', 'Shijiazhuang', 'BEDYdPwW8kKEyCzmXUOmgQ=='),
(7, 'oN0qR4rZkkcu68aabEo87Diz8kvU', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIXBYkjaYE0NKiclDHTVMbdMAQRib9gyV84ib8U59DucCp71pW4pnSzibEFZxMagl66TpEblcj0IEUIMA/132', '%E5%AD%9F%E5%B8%85', '18132453262', '1587709699', '2020-04-24 14:28:19', '通过案例《狗拿HOUSE》获取到', 6, '26a3fee495535ee84021dbf32ed9c8ff', 'Hebei', 'China', 'Baoding', 'VDVWqDyyP/CRyjNQG9L/wQ=='),
(8, 'oN0qR4lv9tk9Ki0Tg1gB4kpr86EU', 'https://wx.qlogo.cn/mmopen/vi_32/4PLs10x1rSSG18bRFO8micmjEwBhUNdHPiaMMJME6gxiaic1wk8LwhHBSudA4jcboBX6ibhuR4zLpiauZQVE16V3ibWcA/132', '%E7%8E%8B%E5%BC%BA', '17733835916', '1587718245', '2020-04-24 16:50:45', '通过案例《社区饮水机》获取到', 0, '149dad1b7c80f1b49417c61eb0c1ed79', '', 'Albania', '', 'GQ/Bo5E5GdSLA0xH0V2z6w=='),
(9, 'oN0qR4hvprNLXgAZhPyZwE-FqRZM', '', '', '', '1587723184', '2020-04-24 18:13:04', '通过商品《点睛网络科技小程序开发》获取到', 0, 'b638992bd0dae42556d16b3f279b27b6', '', '', '', 'uU4asVgItPDhpd32dRX3+Q=='),
(10, 'oN0qR4obFRr61ZYn-1uzJrX_eZP8', '', '', '', '1587723184', '2020-04-24 18:13:04', '通过商品《点睛网络科技网站开发》获取到', 0, '414abe42b0121b66a3e7c827eb564da6', '', '', '', '/uDE8+gVnfgQU32jPqqzvA=='),
(11, 'oN0qR4jh1hpU1JOfw_BFdDmtK-FE', '', '', '', '1587726289', '2020-04-24 19:04:49', '', 0, 'b81460e09ba9cd86d0d1bf58ef3da989', '', '', '', 'uDg8mXSIKqOG3275lodVPg=='),
(12, 'oN0qR4nWiUKvB8863flWtac1DR0Q', '', '', '17333962989', '1587730234', '2020-04-24 20:10:34', '通过商品《点睛网络科技网站开发》获取到', 0, 'fc3e94f2220db7d25711b1380d0adff9', '', '', '', 'eZwrqjkZnVXfSK3IelMkPg=='),
(13, 'oN0qR4jHIfiQbooRwVF8EKz8_fjU', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJicicvKoFkwicxVkVTPpVTQwBt2HS3ibmAe7oS9fF1TIBzA2Gs8HEeEBsDY95KmUoTVSuwRPQjUI1fOw/132', '%E7%BA%A2', '', '1587730629', '2020-04-24 20:17:09', '', 0, '06c794c79b4502f5eff6ffe2c8ad487e', 'Hebei', 'China', 'Shijiazhuang', 'XmcduqraAaE1f1sf+OVL5A=='),
(14, 'oN0qR4j92FWtypcSO1nIPuez27s8', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erPqZ4v11qY2LQU7xsy2udMnKYNh1B8660tNQqibvtgDcP3leOomuhYvRrlTB9iaAiaL6pibWOU6oOyKw/132', '%E5%B8%9D%E5%BA%B7', '', '1587731198', '2020-04-24 20:26:38', '通过案例《德度科技商城》获取到', 0, '75c4c70f77558d53f700ae7c95df2afd', 'Hebei', 'China', 'Shijiazhuang', 'FLD2EyQvDl4z0CYgz8AIIw=='),
(15, 'oN0qR4in4kbvQ2B3agMaG_l2jk6k', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqPFicM8zUicMEp8gKWzCWt5eAGmlibpABxCoWg4ic0yBznnrW2YQ8stsmc8wmH7QaYgHibpiapIPdRax2Q/132', '%E6%95%A3%E8%90%BD%E7%9A%84%E9%9F%B6%E5%8D%8E', '', '1587731442', '2020-04-24 20:30:42', '', 0, 'b5cb19b7cd681f6192efaa1e9fdfdb9e', 'Paris', 'France', '', 'XfaBTfoZlyZbAaezPOX6bA=='),
(16, 'oN0qR4nI577a2A4o_xCdXrLdQ5mg', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTISicBCGjAVX3gRxkPegBUlxdkmk5kMC2fM3qmDtxVYA60wVd8wJsEVh8sa68wqa4JnOaHpdO8iamUA/132', 'A%E7%A7%A6%E6%98%AD%E7%84%B6cium', '', '1587731563', '2020-04-24 20:32:43', '', 0, 'b44c6968fc04356e11a3935fd9ebe6fd', 'Hebei', 'China', 'Shijiazhuang', 'vSGwDCfx8OlGiB/TRdvI/Q=='),
(17, 'oN0qR4u59tDyHGL_KWf1RWRgrBko', 'https://wx.qlogo.cn/mmopen/vi_32/UXHJn1yic5NdPkpjB8vIKgKrQKlPuj3K0Bx8ibJ6iajKEskvIohmicayjWCtkNbo4KSxFibYzRYoibUSCIEdN8Jh6X1Q/132', '%E7%8E%8B%E6%98%8C%E6%A0%8B', '', '1587732361', '2020-04-24 20:46:01', '通过视频《点睛科技宣传片三》获取到', 0, 'b0bb1d4f9f5af12dd2d28c2b9793f866', 'Guangdong', 'China', 'Guangzhou', 'YSzL9qIQWPCfehNDsrdvDw=='),
(18, 'oN0qR4npiCJijYJxw3hZt651_Vns', 'https://wx.qlogo.cn/mmopen/vi_32/OOKbn0Vb1CotMqwwDC44YzyBWFhjKnvibJXmGkKQI2UtrDaib1n3bdicj3kNOQ72w8bTfyKSstiaPsEupvvvQic9tJg/132', '%E9%AD%8F%E5%89%91%E5%B8%86', '', '1587732361', '2020-04-24 20:46:01', '通过视频《点睛科技宣传片三》获取到', 0, 'b2c137236c9946a3e05fc6e786eeaf2d', 'Guangdong', 'China', 'Guangzhou', 'wPhzJHex/y/uqbJXYEC5Gg=='),
(19, 'oN0qR4h9RI-JCfUxx-zlB-o35TM0', 'https://wx.qlogo.cn/mmhead/Lyv6thlqAYj8UW7zvvTrN9cN1ZBoEpqic0NmoqDnsb7A/132', '%E8%A2%81%E8%87%B4%E5%A3%AB', '', '1587733640', '2020-04-24 21:07:20', '', 0, '4aa3c09a7610ce883dc7cae7c2c9d2ff', '', '', '', '4x5PUeR6g5RQJLxQF6esRg=='),
(20, 'oN0qR4hUB31pNOAAue34xUUIHl3k', '', '', '', '1587734063', '2020-04-24 21:14:23', '', 0, 'dde358e67cc9686aadebc560bd71bddd', '', '', '', 'SKWbSQqxRdwGeA5MhNRd4Q=='),
(21, 'oN0qR4nERYARmx31juAodyW5Np2Y', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqibkH4049ibzZHQ1E3jkWJibwpeYdwGDSHLIbDlZxKBULrbwmnuTRUBrpIz8qIic6sSz0cdaEZe6C3oQ/132', '%E7%BD%91%E6%B5%B7%E6%8B%BE%E8%B4%9D', '', '1587734823', '2020-04-24 21:27:03', '', 0, 'c57e86d8dbf9c3af7046782d2619a3fd', 'Hebei', 'China', 'Shijiazhuang', 'OWhMFVGhFR5Crt16JqMPDw=='),
(22, 'oN0qR4liYBRWrX7dEJohIQHFMvOk', 'https://wx.qlogo.cn/mmhead/SdvAovicYia8G1fuYaFp8qUwNfVaMLPz7OZ3BULMsBibMw/132', '%E9%BB%84%E6%96%87%E7%8E%AB', '', '1587735125', '2020-04-24 21:32:05', '', 0, '04d9c6df82e828171b8f6188ce2c5cc5', '', '', '', 'p3kn+o+3WKMCTi6Nic+s+w=='),
(23, 'oN0qR4i57A9gcbKRsoxIfqeBlKSg', 'https://wx.qlogo.cn/mmopen/vi_32/1YCTsYBaPmMicwKkicp6tynCXlEqibaXqdOouYsc5wzF2zWL0XTrCqWnxproKRCTydeDtVs0ExRolnU64J9C0CiaBw/132', '%E6%9E%81%E7%9B%AE%E6%9C%AA%E6%9D%A5', '', '1587736610', '2020-04-24 21:56:50', '', 0, 'c53375e4662b376e62527a9126111e60', 'Hebei', 'China', 'Shijiazhuang', 'C1WVlFPqwWt1JmZYf/cMSQ=='),
(24, 'oN0qR4jdfuczCSI6yT6fcrcTfoGo', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoazqR3VXEYQd5mOLFgtg5Fg3FzSh9EHuRsst05kzGicJquDktp4yicnicrkeBics9yfPRGQiaKLIwibJUg/132', '%E5%80%BE%E5%9F%8E%E5%B0%8F%E5%8D%97%E7%93%9C', '', '1587736682', '2020-04-24 21:58:02', '', 0, '2f78e5c691e378c3a1979a0fa478f74d', 'Victoria', 'Australia', 'Melbourne', 'SbD5QxChn5VEawsQbaQWMQ=='),
(25, 'oN0qR4pa6DzQPwqWyLOYxoy11gbw', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83equbicpKuhZxXFlbKCMZ6vlC8GaqXjVTtiaic3M1Wia70ZrOHh2hs0s5YHTHXiax0X7nZq6iaz7SByVnxDA/132', '%E7%9B%9B%E9%A9%AC+%E6%9D%8E%E5%B0%91%E9%B9%8F', '', '1587770977', '2020-04-25 07:29:37', '', 0, '78b8ad58ff02f95a259648ba1797660c', 'Hebei', 'China', 'Shijiazhuang', 'Q+tQhrPMgSJgmmuUl+0NFA=='),
(26, 'oN0qR4rfs6r5iYc2HueAvhdjTSm8', 'https://wx.qlogo.cn/mmhead/hlWiaH7hoNuklTibXkACmMyHsBH7vXPcnxZV2R0z3A2Q0/132', '%E8%B0%A2%E5%8F%B0%E5%BF%B5', '', '1587777344', '2020-04-25 09:15:44', '通过视频《点睛科技宣传片三》获取到', 0, 'ed06b57e18eaa65bd7d40d23d19237e2', '', '', '', 'GYfuWc92+m8BQaO5hm3jmA=='),
(29, 'oN0qR4j1qfNhT1xHZVN9DI_vqiRs', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLs8SZLLWjyib9EXflhOxKrloXxQEhQNh8ymPib4nSuibGKF34aQSDGNwZ4iarxpUd5AjqVYCNyhA5lEA/132', '%C2%A0%C2%A0+%C2%A0+%C2%A0+%C2%A0+%C2%A0', '', '1587801589', '2020-04-25 15:59:49', '', 0, 'fb3ae8c5f594e6db85628afd406f9790', 'Beijing', 'China', 'Haidian', 'EXHa8pV6KKEtVezUeCm+5g=='),
(33, 'oN0qR4oiEcqBuAz1-qfGGonxgGpM', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTL9uyZLD5MrWffR2hGWzRGOprIDBkNtaOqpmNvftDKgeAWJg8ZibKbp4AEjeetPGLPSOH791sG7GDg/132', '%F0%9F%90%BB+%E5%B8%83%E6%9C%97', '18395614415', '1587803558', '2020-04-25 16:32:38', '通过商品《点睛网络科技网站开发》获取到', 0, '91a46e79259088cb0787ecdba0462e79', 'Hebei', 'China', 'Shijiazhuang', 'MX1kimu90aww0tYefTCO4A=='),
(34, 'oN0qR4hgO49Nn4_JLXqRAjwKYDpY', 'https://wx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEIIs1glKcYOaWVjkLwKNgL9raZRKaibdLibd7k1O2VqtOl8tcWrq3IRtGvjRqZiaT19D2OibI0IuYvOYQ/132', '%E6%AF%8D%E7%AC%91%E9%98%B3', '', '1587805966', '2020-04-25 17:12:46', '', 0, '49009f9abebddcfc6b3d2710f5693d97', 'Hebei', 'China', 'Baoding', 'MKv3E3e1/6WcP/TD95zZpQ=='),
(35, 'oN0qR4u2ihBxh2AYd9QE1ZwvFKwg', 'https://wx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEITQcuN2OHrNcMTqMK7zX7ib4MGYNAsxqAvHvb9uBsDVnLgicUty2jFWr4ibpHhIHr5iceVccrdhxVn5A/132', '%E8%93%9D%E8%89%B2%E5%A6%96%E5%A7%AC', '', '1587806114', '2020-04-25 17:15:14', '通过案例《狗拿HOUSE》获取到', 0, '512df449036e47ed87ef9aa05fe24a6a', 'Guangdong', 'China', 'Shenzhen', 'pr6eXBnGBiIwECNk8FR82w=='),
(36, 'oN0qR4ncdmlzL85ce0gDye6yETSc', '', '', '', '1587806160', '2020-04-25 17:16:00', '', 0, '509948c532c48076f55f4985d069fa5e', '', '', '', 'PR0Q9R7Aa1X9Q02ANY6RcQ=='),
(37, 'oN0qR4rGfYc0FRrrCDURw4rHXU74', '', '', '', '1587806887', '2020-04-25 17:28:07', '', 0, '92e5f0db17b1f8511c909f2d48934a72', '', '', '', 'N9aNS7k79iP2JREAaTTbIw=='),
(38, 'oN0qR4k5dAVCaGCaU73--So2X8bA', 'https://wx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEIRIuAMibWrm52KSricXOONz5g8zW9ZY2qadSRdTFV44ibq8RcQCxIKyHuQhNH98xNMMYY55XQXCgA4g/132', '%E6%B8%85%E6%96%B0', '', '1587813683', '2020-04-25 19:21:23', '通过案例《社区饮水机》获取到', 0, 'a8d51ec379a66d2e550618d2509260ba', 'Queensland', '', 'Cairns', 'XM6ffpKfr7jFAqkWFqNl9g=='),
(39, 'oN0qR4hZf7l3LH4YdQqOwYpU1bqg', '', '', '', '1587813827', '2020-04-25 19:23:47', '', 0, 'e263ecd7f97148b919e4a80973d6cfd7', '', '', '', 'FefR3+Ja2rkJ+iFzIgQH/w==');

-- --------------------------------------------------------

--
-- 表的结构 `zx_userlog`
--

CREATE TABLE IF NOT EXISTS `zx_userlog` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1看视频 2看案例 3看公告 4获取到手机号 5获取到微信信息',
  `inputtime` varchar(15) NOT NULL COMMENT '添加时间',
  `content` varchar(255) NOT NULL COMMENT '具体内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户日志';

-- --------------------------------------------------------

--
-- 表的结构 `zx_video`
--

CREATE TABLE IF NOT EXISTS `zx_video` (
  `id` int(11) NOT NULL,
  `videourl` varchar(255) NOT NULL COMMENT '视频地址',
  `picurl` varchar(255) NOT NULL COMMENT '封面地址',
  `companyid` int(11) NOT NULL COMMENT '公司id',
  `hits` int(11) NOT NULL COMMENT '点击次数',
  `sharecount` int(11) NOT NULL COMMENT '分享次数',
  `description` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `inputtime` varchar(15) NOT NULL,
  `createat` varchar(100) NOT NULL,
  `wxewm` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `zx_video`
--

INSERT INTO `zx_video` (`id`, `videourl`, `picurl`, `companyid`, `hits`, `sharecount`, `description`, `name`, `inputtime`, `createat`, `wxewm`, `mobile`) VALUES
(4, 'https://v.weishi.qq.com/shg_1047_1047_0bf2zqab6aaanmabmtnbyvpbptaed7nqag2a.f20.mp4', '/uploads/20200424/7236795c6a480c38ce3e551a516fbb11.png', 0, 0, 0, '办公室氛围', '点睛科技宣传片三', '1587700994', '2020-04-24 12:03:14', '/uploads/20200423/e2178f098d3dc5337b24d3e9af8e9f52.jpg', '18132453262'),
(5, 'https://v.weishi.qq.com/shg_1047_1047_0bf23aacoaaapqac7avb4fpbpwaee7hqai2a.f20.mp4', '/uploads/20200424/d0c88a186cfe3977790ae83da5dcb0c8.png', 0, 0, 0, '点睛科技宣传片二----企业文化', '点睛科技宣传片二', '1587701005', '2020-04-24 12:03:25', '/uploads/20200423/8debf663b576364e6cf620fc93acd950.jpg', '18132453262'),
(6, 'https://v.weishi.qq.com/shg_1047_1047_0bf2dyacaaaauiacppvb7fpbohqeeaeqajca.f20.mp4', '/uploads/20200424/bb9d29a0fd440e91f9afa4c45a175522.png', 0, 0, 0, '点睛科技宣传片', '点睛科技', '1587700939', '2020-04-24 12:02:19', '/uploads/20200423/38be98c3e7fd06b7e84be978f5db382b.jpg', '18132453262'),
(7, 'https://v.weishi.qq.com/shg_1047_1047_0bf2j4acaaaazuacvanb7bpbotyeebmaajca.f20.mp4', '/uploads/20200424/02b7d23606d521a7432e497ffb3b829b.png', 0, 0, 0, '办公氛围', '点睛科技宣传片四', '1587700909', '2020-04-24 12:01:49', '/uploads/20200423/3925db713b6021f96deb92b89e3842c3.jpg', '18132453262'),
(8, 'https://v.weishi.qq.com/shg_1047_1047_0bf2fmacqaaauuach5fb5vpbokyefa6aalca.f20.mp4', '/uploads/20200424/a96d550225ad13ea2b1230afb57f75bc.png', 0, 0, 0, '诚信带客', '点睛科技宣传片五', '1587700868', '2020-04-24 12:01:08', '/uploads/20200423/bd0db792c6cac38c1223681de34335a4.jpg', '18132453262');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `zx_adminuser`
--
ALTER TABLE `zx_adminuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_boss`
--
ALTER TABLE `zx_boss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_case`
--
ALTER TABLE `zx_case`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_company`
--
ALTER TABLE `zx_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_employee`
--
ALTER TABLE `zx_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_fenrunlog`
--
ALTER TABLE `zx_fenrunlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_goods`
--
ALTER TABLE `zx_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_notice`
--
ALTER TABLE `zx_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_order`
--
ALTER TABLE `zx_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_user`
--
ALTER TABLE `zx_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_userlog`
--
ALTER TABLE `zx_userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zx_video`
--
ALTER TABLE `zx_video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zx_adminuser`
--
ALTER TABLE `zx_adminuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `zx_boss`
--
ALTER TABLE `zx_boss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zx_case`
--
ALTER TABLE `zx_case`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `zx_company`
--
ALTER TABLE `zx_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `zx_employee`
--
ALTER TABLE `zx_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `zx_fenrunlog`
--
ALTER TABLE `zx_fenrunlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zx_goods`
--
ALTER TABLE `zx_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `zx_notice`
--
ALTER TABLE `zx_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zx_order`
--
ALTER TABLE `zx_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zx_user`
--
ALTER TABLE `zx_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `zx_userlog`
--
ALTER TABLE `zx_userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zx_video`
--
ALTER TABLE `zx_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

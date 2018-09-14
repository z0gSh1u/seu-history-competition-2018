/* MySQL database initialization */

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for xsxqsql
-- ----------------------------
DROP TABLE IF EXISTS `xsxqsql`;
CREATE TABLE `xsxqsql` (
  `stunum` varchar(255) NOT NULL,
  `yktnum` varchar(255) NOT NULL,
  `finishans` int(1) NOT NULL,
  `score` int(11) NOT NULL,
  `regtype` int(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `academy` varchar(255) NOT NULL,
  PRIMARY KEY (`stunum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for xsxqsql_gly
-- ----------------------------
DROP TABLE IF EXISTS `xsxqsql_gly`;
CREATE TABLE `xsxqsql_gly` (
  `un` varchar(255) NOT NULL,
  `paw` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `verify` bit(1) NOT NULL,
  PRIMARY KEY (`un`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for xsxqsql_ls
-- ----------------------------
DROP TABLE IF EXISTS `xsxqsql_ls`;
CREATE TABLE `xsxqsql_ls` (
  `unl` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pawl` varchar(255) NOT NULL,
  `academy` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for xsxqsql_sel
-- ----------------------------
DROP TABLE IF EXISTS `xsxqsql_sel`;
CREATE TABLE `xsxqsql_sel` (
  `queid` int(10) NOT NULL,
  `que` varchar(255) NOT NULL,
  `sel1` varchar(255) NOT NULL,
  `sel2` varchar(255) NOT NULL,
  `sel3` varchar(255) NOT NULL,
  `sel4` varchar(255) NOT NULL,
  `ans` int(1) NOT NULL,
  PRIMARY KEY (`queid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for xsxqsql_tf
-- ----------------------------
DROP TABLE IF EXISTS `xsxqsql_tf`;
CREATE TABLE `xsxqsql_tf` (
  `queid` int(11) NOT NULL,
  `que` varchar(255) NOT NULL,
  `ans` bit(1) NOT NULL,
  PRIMARY KEY (`queid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

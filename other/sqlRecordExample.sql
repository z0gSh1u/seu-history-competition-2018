/* Record examples. */

-- ----------------------------
-- Records of xsxqsql_gly
-- ----------------------------
/* Params: <Username> <Password> <Nickname> <Always 1> */
INSERT INTO `xsxqsql_gly` VALUES ('root', '123456', 'ZhangSan', '1');

-- ----------------------------
-- Records of xsxqsql
-- ----------------------------
/* Params: <StudentNo> <YikatongNo> <Always 0> <Always -1> <Always 0> <Name> <AcademyNo> */
INSERT INTO `xsxqsql` VALUES ('00000000', '111111111', '0', '-1', '0', '李四', '00');

-- ----------------------------
-- Records of xsxqsql_ls
-- ----------------------------
/* Params: <Username> <Nickname> <Password> <AcademyNo> */
INSERT INTO `xsxqsql_ls` VALUES ('fdy04', '辅导员', 'TXANBH', '04');

-- ----------------------------
-- Records of xsxqsql_tf
-- ----------------------------
/* Params: <Unique ID> <Question> <Answer, 1 for Yes, 0 for No> */
INSERT INTO `xsxqsql_tf` VALUES ('1', '地球绕着太阳转。', 1);

-- ----------------------------
-- Records of xsxqsql_sel
-- ----------------------------
/* Params: <Unique ID> <Question> <Selection A> <Selection B> <Selection C> <Selection D> <Answer, 1-A, 2-B, 3-C, 4-D> */
INSERT INTO `xsxqsql_sel` VALUES ('1', '今年是____年。', '2018', '2017', '2016', '8102', '1');

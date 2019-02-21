### 东南大学校史校情知识竞赛系统 (2018)
本系统用于完成东南大学18-19-1学期大一新生的校史校情知识竞赛活动。

**前端库：** jQuery + Bootstrap
**后端语言：** PHP
**数据库：** MySQL

##### 部署
　　`docs/部署指南-2.0.pdf`提供了*from-scratch*程度的在Ubuntu 18.04下的部署过程。<br>
　　若您已经部署好传统的LAMP/WAMP环境，只需复制-粘贴`src/`下的文件到本机的对应位置，并完成`src/config.conf`的配置即可。

##### 题目添加
　　除了使用后台自带的题目添加功能，您也可以通过直接执行SQL查询来进行题目添加。SQL查询的相关样例位于`other/sqlRecordExample.sql`。

*Author: z0gSh1u LongChen*

## 东南大学校史校情知识竞赛系统 (2018)

本系统用于完成东南大学2018级大一新生的校史校情知识竞赛活动。

![preview](https://s2.ax1x.com/2019/09/26/uuFE59.png)

**前端库：** jQuery + Bootstrap  

**后端语言：** PHP  

**数据库：** MySQL

### 部署

　　`docs/部署指南-2.0.pdf`提供了几乎从零开始程度的在*Ubuntu 18.04 Server*下的部署过程。  

　　若您已经部署好传统的LAMP/WAMP环境，只需复制`/src`下的文件到本机的对应网站根目录位置，并完成`/src/config.conf`的配置即可。

### 题目添加

　　除了使用后台自带的题目添加功能，您也可以通过直接执行SQL查询来进行题目添加。SQL查询的相关样例位于`other/sqlRecordExample.sql`。

*Author: z0gSh1u LongChen*

***早年的难忘的稚嫩的项目，前后端未完全分离，有机会要重构一次来怀旧...***

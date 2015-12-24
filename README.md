#yii2-whystic-blog
基于Yii2 开发的博客系统,功能正在完善

#安装
1.下载或```clone```源码，运行```composer install```安装依赖

2.配置```common/config/main-local.php```文件中数据库组件,执行数据库迁移```yii migrate```

3.执行```yii init/admin```,根据向导创建管理员用户

4.配置好服务器,入口文件位于```web```目录

5.前台访问```index.php```文件，后台访问```admin.php```文件

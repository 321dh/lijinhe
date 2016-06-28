1、判断某个软件是否安装
rpm -qa | grep 软件名；如：#rpm -qa | grep -i httd

2、查看软件安装路径
whereis 软件名；如whereis mysql。
或者rpm –ql 软件名；
数据库目录：/var/lib/mysql/
配置文件：/usr/share/mysql(mysql.server命令及配置文件)
相关命令：/usr/bin(mysqladmin、mysqldump等命令)
启动脚本：/etc/rc.d/init.d/

3、安装卸载某个软件方法
一、*.src.rpm形式的源代码软件包
       安装rpm -ivh rpm包名；如rpm -ivh soft.version.rpm
       卸载rpm -e 软件名；如：rpm -e httpd-2.2.3-11.el5_1.centos.3
二、tar.gz或tar.bz2形式的源代码包方式
       安装./configure --prefix=/usr/local/soft(指定安装目录) make make install
       卸载make uninstall或手动删除
三、bin文档安装
       安装 cd进入压缩包目录 chmod xx soft.bin ./soft.bin
       卸载 rm -rf 删除安装目录即可

4、修改用户密码方法
passwd 加用户名；如:passwd root;

5、查看修改主机名hostname
hostname 修改后的主机名;
/etc/sysconfig/network中的hostname为修改后的主机名;
修改/etc/hosts文件中的原主机名修改为现在主机名;
reboot，重启系统即可。

6、查找文件find path -option
find 路径 选项 命令；如find / -name httpd.conf

7、cron配置文件的格式:分钟 小时 日  月  周   ［用户名］  命令
列出cron服务详情cat /etc/crontab或crontab -l  结果*/2 * * * * root run-parts /srv/bakmysql/DBWeekBak.sh

8、设定查看crontab定时任务是否执行
设定crontab -e或vi /etc/crontab；
查看/var/log/cron文件或用命令tail -f /var/log/cron观察变化


9、检测shell语法是否正确
sh -n 路径/bak.sh；如sh -n /root/DBFullyBak.sh

10、导入导出数据库
导入
     第一种方法：mysql -u用户名 -p密码   数据库名  < 数据库名.sql；第二种方法：mysql>source /home/abc/abc.sql。
导出
   mysqldump -u用户名 -p密码  数据库名 > 数据库名.sql；如mysqldump -uroot -ptestlink testlink199 > jorly.sql
     只导出表结构mysqldump -u用户名 -p密码  -d  数据库名  > 数据库名.sql
     
11、查看关闭CentOS防火墙信息服务：
查看/etc/init.d/iptables status 
关闭/etc/init.d/iptables stop 
重启/etc/init.d/iptables restart

12、开启/关闭/重启MySql服务
开启：/etc/init.d/mysqld start
关闭：/etc/init.d/mysqld stop
重启：/etc/init.d/mysqld restart 

13、cron配置文件被修改后，想让新文件生效，必须重新crond服务器；
开启：/etc/init.d/crond start
关闭：/etc/init.d/crond stop
重启：/etc/init.d/crond restart

14、apache开机启动
cp /usr/local/apache2/bin/apachectl /etc/init.d/apache
vi /etc/init.d/apache
在#!/bin/sh后面加入下面两行
# chkconfig:2345 85 15
# Start and stops the Apache HTTP Server.
然后chmod +x /etc/rc.d/init.d/apache  chkconfig --add apache
以后启动apache就可以service apache start或者/usr/local/httpd/bin/apachectl -k start

15、手动执行脚本
执行某个脚本 sh -x 文件名；如sh -x bakup.sh
执行PHP脚本 /usr/local/php53/bin/php mergeData.php

linux上mysql的定时备份/增量备份
Shell> mkdir /srv/bakmysql
Shell> mkdir /srv/bakmysql/daily
Shell> touch /srv/bakmysql/mysqlbak.log

周日2点全量备份，周一到周六每天进行增量备份
设置crontab任务，每天执行备份脚本
# crontab -l //内容为下
0 2 * * 0 root /srv/bakmysql/DBWeekBak.sh >/dev/null 2>&1
0 2 * * 1-6 root /srv/bakmysql/DBDayBak.sh >/dev/null 2>&1

kill 80端口  fuser -k -n tcp 80
netstat -lnp | grep 80

查看有没有安装过
yum list installed mysql*
rpm -qa | grep mysql*

查看有没有安装包
yum list mysql*

安装mysql客户端
yum install mysql

安装mysql 服务器端
yum install mysql-server
yum install mysql-devel

mysqladmin -uroot -p老密码  password  新密码

svn提交文件命令
svn add schoolRenwu_xx.php schoolRenwu.class.php schoolRenwu.php 
svn commit -m "校园任务提醒"
svn回滚
svn up -r 版本号 文件名

//更新版本库文件（指定目录下所有文件（不包含指定的目录））
svn checkout 版本库/提定目录+空格+点（.）
svn checkout svn://svn.huixueyuan.cn/svn/ifdooApi/branches/api.huixueyuan.cn/ifdood_dev01/ .

nginx
service nginx restart 重启
service nginx start 启动
service nginx stop 停止

重启php-fpm
/etc/init.d/php-fpm start
netstat -anp |grep 9000
ps -ef | grep nginx

查看php安装
yum list installed | grep "php"

查看centos版本
cat /etc/redhat-release

查看指定端口号的进程情况
netstat -tunpl | grep 3306

svn在eclipse插件
http://subclipse.tigris.org/update_1.12.x

压缩
tar -zcvf filename.tar.gz --exclude=*.svn api.huixueyuan.cn

解压
tar -zxvf filename.tar.gz

切换svn
svn switch --relocate svn://svn.321dh.cn/svn/api/www.321dh.com svn://svn.321dh.cn/svn/api/www.365ysw.com.cn

修改表结构
ALTER TABLE `books` ADD `yongtu` INT(11) NOT NULL DEFAULT '1' COMMENT '用途' AFTER `order`;

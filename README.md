# 队列抢票示例
### 准备工作
1. 配置好ActiveMQ或者其他支持stomp的队列服务
2. 安装好stomp扩展 http://pecl.php.net/package/stomp
3. 有必要的话构建数据库，数据库文件在源码sql文件夹内
4. 修改相应的配置，配置文件在grabticket/config.php

### 运行
1. 运行provide.php生成票券
2. 运行grab.php进行抢票

### 运行结果
![](http://yoga.ibye.cn/images/pasted-3.png)

![](http://yoga.ibye.cn/images/pasted-2.png)

![](http://yoga.ibye.cn/images/pasted-1.png)
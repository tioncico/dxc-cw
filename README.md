# new Project
easyswoole项目封装,开箱即用
## 功能列表
- 基础的用户登陆注册+后台管理授权代码
- 文章分类,文章管理 
- ueditor 控制器封装
- 图片验证码
- 跨域封装
- 注解验证错误抛出
- 注解文档
- assert 断言封装
- 基础的model封装,model事务封装
- 阿里云 oss 前端直传,客户端直传封装
- 文件上传封装
- 多协程任务自定义进程封装
- redis,mysql初始化封装
- 基础的单元测试封装
- 代码生成示例

## 启动流程
- 配置 `dev.php`的 `WEB`,`MYSQL`,`REDIS`,`ALI_OSS`
- 将 `/Doc/install.sql` 导入到数据库
- 启动项目
- 访问`http://127.0.0.1:9501/adminDoc#/` 即可显示admin 端 api文档

## 基础的用户登陆注册+后台管理授权代码
- `App/HttpController/Api/Admin/Auth.php` 后台管理员登陆控制器
- `App/HttpController/Api/User/Auth.php` 用户登陆控制器
- `App/HttpController/Api/Admin/AdminBase.php` 管理员基类,继承的控制器都需要登陆后才可访问
- `App/HttpController/Api/User/UserBase.php` 用户基类,继承的控制器都需要登陆后才可访问
- `App/HttpController/Api/Common/CommonBase.php` 公共端基类,无需登陆即可访问

## 文章分类,文章管理

## ueditor 控制器封装
配置 ueditor.config.js中的服务器接口路径 改为`你的域名/Api/Admin/UEditor` 即可直接使用

可通过取消 `/App/HttpController/Api/Admin/UEditor.php` 注释实现 编辑器上传文件->服务器->上传oss->删除服务器文件->保存oss路径 
```php
protected function uploadImage()
{
    $result = $this->UEditor->uploadImage($this->request());
//        $fileInfo = $this->uploadOss($result);
//        unlink($this->rootPath.$result->getUrl());
//        $result->setUrl($fileInfo['path']);
//        $result->setTitle($fileInfo['title']);
    $this->writeData($result);
}
```
## 图片验证码
验证码生成文件 `/Users/tioncico/PhpstormProjects/tioncico/newProject/App/HttpController/Api/Common/VerifyCode.php`;  
接口将返回:
```json
{"code":200,"result":{"verifyCode":"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKIAAAAyBAMAAAAtuh1rAAAAG1BMVEX///+FZDbRxLOjimjCsZqynoHg2Mzv6+WUd08w65CgAAAACXBIWXMAAA7EAAAOxAGVKw4bAAABkUlEQVRYhe2UT0+DMBjG65iwo+/GlOOIh13F+QHkYjyOLRqPdS7oEUymV8min9u3BcZeUtYm6EV5Trz98+Npn7aMderU6R9oQsvn1kDrgpRPp62JASFuoDXRAkLM2hPDXyeO+A8Tt/zdaJqTNHb5lMg3Rqs+B48bEg2ydtbzEAA+DIn6ZHoZzBAIJ8reezPiejm7m5bFMeRSEi3g7FFLdEJJmBTlAL9HQcOqAxgaEF+opxRgnCB2rrSIf9YSe8UqS08+wDU7qjzvq4/jhqmOiITLOKo8ReAxXBkoD6TYIO0tdFYL9opEvhvhipmeCihN1rZYsY+rZSbCKCob4EwkMFYSpUkd8TbfxrK5LyfgdqmJfT1RJp1V22iJz9xoo8mDREzau0kC8MogZMrohL781ORBYir68Zq4ZYNMeSBOULNJ0lcnYv/XKtu7czLltIpeYdIldZ0YFed7t0iZsn81ZY0Kqf36G+4XxN0omXLzc4uyabnlte4H8BZhdeds+KQWtOKqxrc4Ll3ZB5bbqVOnv6Jv1WJIwWSlgK8AAAAASUVORK5CYII=","verifyCodeTime":1613975609,"verifyCodeHash":"738d7cf8f706945c45262a1924a553e2"},"msg":"验证码生成成功"}
```
- verifyCode 图片的base64
- verifyCodeTime 验证码生成时间
- verifyCodeHash 验证码hash, 用于后端验证验证码是否正确

在需要验证码的接口中,获取 用户输入的验证码,verifyCodeTime,verifyCodeHash
md5($code . $verifyCodeTime)==$verifyCodeHash 表示验证成功.

> 可参考 `/App/HttpController/Api/Admin/Auth.php`

## 跨域封装
`App/Utility/GlobalEvent.php`->crossDomainResponse()

## 注解验证抛出
`App/HttpController/Api/ApiBase.php`->onException()

## 注解文档
- `/App/HttpController/Index.php`->userDoc
- `/App/HttpController/Index.php`->commonDoc
- `/App/HttpController/Index.php`->adminDoc

## assert 断言封装
`App/Utility/Assert/Assert.php`  
原有代码判断写法:
```php
<?php
if(!$this->checkVerify()){
     $this->writeJson(400, [], "验证码错误");
     return false;
}
$admin = AdminUserModel::create()->where(['adminAccount' => $adminAccount, 'adminPassword' => AdminUserModel::hashPassword($adminPassword)])->get();
if(!$admin){
     $this->writeJson(400, [], "账号或密码错误");
}
```
使用assert写法:
```php
Assert::assert($this->checkVerify(),"验证码错误"); //断言$this->checkVerify() 一定会返回true,如果不返回true则直接抛出异常,并被apiBase 接管,直接响应错误
$admin = AdminUserModel::create()->where(['adminAccount' => $adminAccount, 'adminPassword' => AdminUserModel::hashPassword($adminPassword)])->get();
Assert::assert(!!$admin, "账号或密码错误"); //断言!!$admin  一定会返回true,如果不返回true则直接抛出异常,并被apiBase 接管,直接响应错误
//第一个感叹号将$admin数据强制转为bool并取反 ,第二个将bool数据还原取反
```

## 基础的model封装,model事务封装
`App/Model/BaseModel.php`
## 阿里云 oss 前端直传,客户端直传封装
- `App/HttpController/Api/Admin/FileUpload.php`->getSign()
- `App/HttpController/Api/Admin/FileUpload.php`->getAppStsSign()
具体使用方案可查看阿里云oss文档
## 文件上传封装
`App/HttpController/Api/Admin/FileUpload.php`->uploadFile()
## 多协程任务自定义进程封装
`App/Utility/TickProcess.php`
使用示例:
```php

//注册定时任务,自定义进程等
$tick = new TickProcess();

$tick->addTask(30, function () {//每隔30秒运行一次
    //执行代码 
});
$tick->addTask(0, function () {//只运行一次
    //执行代码 
});
//多个task为独立的协程,可并发
Manager::getInstance()->addProcess($tick);

```
## redis,mysql初始化封装
`App/Utility/GlobalEvent.php`->mysqlInit();
`App/Utility/GlobalEvent.php`->redisInit();
## 基础的单元测试封装
`/UnitTest` 需要协程环境
## 代码生成示例
`/test.php`

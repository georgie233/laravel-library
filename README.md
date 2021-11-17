# laravel 个人集合库

```angular2html
composer require georgie/laravel-library
```

## 数组
### 数组助手类
```
//  \georgie\arr\ArrayHelper
//把对象或者数组对象，转成数组
ArrayHelper::toArray($object, $properties = [], $recursive = true);

//获取对象或者数组的指定的值
ArrayHelper::getValue($array, $key, $default = null);

//根据指定的key，建立key对应索引的数组，或者分组后的索引数组
ArrayHelper::index($array, $key, $groups = []);

//把数组转成 key-value 的形式
ArrayHelper::map($array, $from, $to, $group = null);

//检查数组是否是列索引
ArrayHelper::isAssoc($array);
```

## 数组增强
数组增强组件主要是对数组等数据进行处理，如无限级分类操作、商品规格的迪卡尔乘积运算等。
### 功能介绍
#### 根据键名获取数据
如果键名不存在时返回默认值，支持键名的点语法

```
$d=['a'=>1,'b'=>2];
(new \georgie\arr\Arr())->get($d,'c','没有数据哟');
```
使用点语法查找：
```
$d = ['web' => [ 'id' => 1, 'url' => 'georgie.com' ]];
(new \georgie\arr\Arr())->get($d,'web.url');
```

#### 排队字段获取数据
以下代码获取除 id、url以外的数据

```
$d = ['id' => 1,'url' => 'georgie.com','name'=>'Georgie'];
print_r((new \georgie\arr\Arr())->getExtName($d,['id','url']));
```

#### 设置数组元素值支持点语法

```
$data = (new \georgie\arr\Arr())->set([],'a.b.c',99);
```

#### 改变数组键名大小写

```
$data = array('name'=>'georgie',array('url'=>'georgie.com'));
$data = (new \georgie\arr\Arr())->keyCase($data,1); 
第2个参数为类型： 1 大写  0 小写
```

#### 不区分大小写检测键名是否存

```
(new \georgie\arr\Arr())->keyExists('g',['g'=>'嘤嘤嘤']);
```

#### 数组值大小写转换

```
(new \georgie\arr\Arr())->valueCase(['name'=>'georgie'],1); 
第2个参数为类型： 1 大写  0 小写
```

#### 数组进行整数映射转换

```
$data = ['status'=>1];
$d = (new \georgie\arr\Arr())->intToString($data,['status'=>[0=>'关闭',1=>'开启']]); 
```

#### 数组中的字符串数字转为数值类型

```
$data = ['status'=>'1','click'=>'200'];
$d = (new \georgie\arr\Arr())->stringToInt($data); 
```

#### 根据下标过滤数据元素

```
$d = [ 'id' => 1, 'url' => 'georgie.com','title'=>'嘤嘤嘤' ];
print_r((new \georgie\arr\Arr())->filterKeys($d,['id','url']));
//过滤 下标为 id 的元素
```

当第三个参数为 0 时只保留指定的元素
```
$d = [ 'id' => 1, 'url' => 'georgie.com','title'=>'嘤嘤嘤' ];
print_r((new \georgie\arr\Arr())->filterKeys($d,['id'],0));
//只显示id与title 的元素
```

#### 获得树状结构

```
(new \georgie\arr\Arr())->tree($data, $title, $fieldPri = 'cid', $fieldPid = 'pid');
参数                   	说明
$data                 	数组
$title                	字段名称
$fieldPri             	主键 id
$fieldPid             	父 id
```

#### 获得目录列表

```
(new \georgie\arr\Arr())->channelList($data, $pid = 0, $html = "&nbsp;", $fieldPri = 'cid', $fieldPid = 'pid', $level = 1);
参数                      	说明 
data                 	操作的数组
pid                  	父级栏目的 id 值
html                	栏目名称前缀，用于在视图中显示层次感的栏目列表 
fieldPri              	唯一键名，如果是表则是表的主键
fieldPid              	父 ID 键名
level                 	等级（不需要传参数，系统运行时使用 ) 
```

#### 获得多级目录列表（多维数组）

```
(new \georgie\arr\Arr())->channelLevel($data, $pid = 0, $html = "&nbsp;", $fieldPri = 'cid', $fieldPid = 'pid') 
参数                          	说明
data                      	操作的数组
pid                      	父级栏目的 id 值
html                     	栏目名称前缀，用于在视图中显示层次感的栏目列表
fieldPri                 	唯一键名，如果是表则是表的主键
fieldPid                  	父 ID 键名
```

#### 获得所有父级栏目

```
(new \georgie\arr\Arr())->parentChannel($data, $sid, $fieldPri = 'cid', $fieldPid = 'pid');
参数                          	说明
data                      	操作的数组
sid                      	子栏目
fieldPri                 	唯一键名，如果是表则是表的主键
fieldPid                  	父 ID 键名

```

#### 是否为子栏目

```
(new \georgie\arr\Arr())->isChild($data, $sid, $pid, $fieldPri = 'cid', $fieldPid = 'pid')
参数                          	说明
data                      	操作的数组
sid                      	子栏目id
pid                      	父栏目id
fieldPri                 	唯一键名，如果是表则是表的主键
fieldPid                  	父 ID 键名
```

#### 是否有子栏目

```
(new \georgie\arr\Arr())->hasChild($data, $cid, $fieldPid = 'pid')
参数                          	说明
data                      	操作的数组
cid                      	栏目cid
fieldPid                  	父 ID 键名
```

#### 无限级栏目分类

```
(new \georgie\arr\Arr())->category($categories,$pid = 0,$title = 'title',$id = 'id',$parent_id = 'parent_id')
参数								说明
$categories						操作的数组
$pid								父级编号
$title                  		栏目字段
$id								主键名
$parent_id						父级字段名
```

#### 迪卡尔乘积

```
(new \georgie\arr\Arr())->descarte($arr, $tmp = array())
```



## 其他
>  \Georgie\Utils\

### Results 处理结果类的封装
* 一般用于返回统一格式的时候使用（API）
  1.Trait方式引入 ,在 Class 中引入 use Georgie\Utils\Traits\Results
  2.对象方式引入 new Georgie\Utils\Results
  3.Georgie\Utils\Results::getClass()

*  返回结果默认格式定义如下
```php

   //默认返回的消息
    protected static $defaultMsgList = [

        // 成功
        0 => '操作成功',

        // 2000 - 2999 服务器的业务交互的友好提示
        2000 => '服务器繁忙',    // 服务器返回友好提示
        2001 => '未知错误',
        2002 => '没有更多数据了', // （针对列表式加载更多）
        2003 => '暂无数据', // 数据不存在

        // 4001 - 4999 客户端引起的错误
        4002 => '非法请求', // （post & get 请求不正确）
        4003 => '参数错误', // 具体是什么参数错误，可以在返回的时候输入msg参数
        4004 => '签名无效', // --基类
        4005 => '认证错误', // token 无效--基类
        4006 => '请求无效', // （时间校验失败）--基类

        // 5001 - 5999 服务器错误（用户自定义的错误，都应该在这个段）
        5500 => '服务器内部错误',
        5501 => '服务器不具备完成请求的功能',
        5502 => '服务器网关异常',
        5503 => '服务器目前无法使用',
        5504 => '服务器网关超时',
        5505 => '服务器不支持请求',
        5403 => '服务器处理异常',
        5404 => '页面不存在',
        5413 => '请求实体过大',
        5414 => '请求的 URI 过长',
    ];

```
* 调用方法
```php
    (new Georgie\Utils\Results)->returnJson($array = null);

    (new Georgie\Utils\Results)->success($data = [], $msg = '', $params = []);

    (new Georgie\Utils\Results)->paramsError($msg = '', $params = []);

    (new Georgie\Utils\Results)->error($msg = '', $code = 2000, $params = []);

    (new Georgie\Utils\Results)->authError($params = []);

    (new Georgie\Utils\Results)->setCode($code);

    (new Georgie\Utils\Results)->setMsg($msg = '');

    //返回格式：
    [
        'code' => 0,
        'msg'  => '',
        'data' => [],
        'time' => 0
    ]

```
### 时间助手

```php
//获取当前时间
TimerHelper::getData($format = "Y-m-d H:i:s");
//获取当前时间戳
TimerHelper::getTime();
//获取当前毫秒时间
TimerHelper::getUDate();
//计算时间差  type: time(时间戳) day hour minute
TimerHelper::getTimeDifference($end_time, $start_time,$type='time');
//计算时间差 返回字符串  n天n小时n分钟
TimerHelper::getTimeDifferenceStr($end_time,$start_time,$type="dHis");
//将指定日期转换为时间戳
TimerHelper::dateToTimestamp($date);
//获取某个时间多少分钟之后的时间 
TimerHelper::dateRear($format = "Y-m-d H:i:s", $mun = 10);
//获取某个时间多少分钟之前的时间
TimerHelper::dateBefore($format = "Y-m-d H:i:s", $mun = 10);
//判断当前的时分是否在指定的时间段内
TimerHelper::checkIsBetweenTime($start, $end);
```

### 文件助手

```
//删除目录和文件
FileHelper::delDir($path, $isDelCurrent = false);

//获取文件扩展名
FileHelper::getExt($str);
```

### ip地址助手
```
//获取客户端的真实IP   （useProx是否使用代理IP）
IPHelper::remoteIp($useProxy = false)

//随机生成IP地址
IPHelper::randIp()
```

### 字符串助手(含随机)
```
//生成唯一数字 eg: YYYYMMDDHHIISSNNNNNNNNCC 24
StrHelper::uniqueNum();

//生成唯一的 guid
StrHelper::guid();

//随机字长度的随机字符串
//type: number letter string all
StrHelper::random($length = 6, $type = 'string')
```

### 验证助手
```
//验证手机号
ValidateHelper::checkPhone($phone);

//验证邮箱
ValidateHelper::checkEmail($email);

//验证是否HTTP地址
ValidateHelper::isHttp($str);

//验证是否是 json 字符串
ValidateHelper::isJson($str)
```
### HTTP请求助手
```
//curl post 请求封装
HttpHelper::curlPost($url, $data, $options = [])

//curl get 请求封装
HttpHelper::curlGet($url, $data, $options = [])

//curl 请求封装
curl($method, $url, $data='', $options = [])
```
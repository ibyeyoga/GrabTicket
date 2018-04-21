<?php
require_once 'Loader.php';
use \yoga\grabticket\Grabber;
$config = require('./grabticket/config.php');
$dbname = $config['db']['dbname'];
$username = $config['db']['username'];
$password = $config['db']['password'];
$pdo = new PDO("mysql:host=localhost;dbname=$dbname",$username, $password,[
    PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'
]);

$sql = 'SELECT *
FROM userinfo AS t1 JOIN (SELECT ROUND(RAND() * (SELECT MAX(id) FROM userinfo)) AS id) AS t2
WHERE t1.id = t2.id';
$query = $pdo->query($sql);
$uid = $query->fetch()['user_id'];

Grabber::grab(function($msgBody) use($pdo,$uid){
    try{
        $msgObj = json_decode($msgBody,true);
        $stmt = $pdo->prepare('insert into ticketgrabbed(tno,user_id,created_at) VALUES (:tno,:uid,:createTime)');
        $flag = $stmt->execute([
            ':tno' => $msgObj['tno'],
            ':uid' => $uid,
            ':createTime' => time()
        ]);
        if($flag){
            echo '用户 ' . $uid . ' 抢票成功！票券号：' . $msgObj['tno'];
        }
    }
    catch(Exception $e){
        return false;
    }
    return $flag;
},function($error){
    echo $error;
});
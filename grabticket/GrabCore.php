<?php
namespace yoga\grabticket;


class GrabCore
{
    protected $port = 61613;
    protected $host = '';
    protected $username = '';
    protected $password = '';

    public $stomp;
    public $queue = '/queue/activity/ticket-1';

    private function __construct()
    {
        $config = require('config.php');
        $mq = $config['mq'];
        $this->host = $mq['host'];
        $this->username = $mq['username'];
        $this->password = $mq['password'];
    }

    private static $_instance = null;

    static  public function getInstance(){
        if(!(self::$_instance instanceof Grabber)){
            self::$_instance = new Grabber();
            $uri = self::$_instance->host . ':' . self::$_instance->port;
            try{
                self::$_instance->stomp = new \Stomp($uri, self::$_instance->username, self::$_instance->password);
                self::$_instance->stomp->setReadTimeout(1);
            }
            catch (\StompException $e){
                echo 'Error: ' . $e->getMessage();
            }
        }
        return self::$_instance;
    }

    private function __clone()
    {
        // 禁止克隆
    }

    public static function close(){
        $stomp = self::getInstance()->stomp;
        unset($stomp);
    }

    function __destruct()
    {
        self::close();
    }
}
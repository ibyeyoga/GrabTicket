<?php
namespace yoga\grabticket;

class Grabber extends GrabCore
{
    public static function grab(\Closure $success, \Closure $failure, $_queue = null){
        $stomp = self::getInstance()->stomp;
        $queue = $_queue ? $_queue : self::getInstance()->queue;
        $isSubscribe = $stomp->subscribe($queue);

        try{
            if($isSubscribe){
                if($stomp->hasFrame()){
                    $frame = $stomp->readFrame();
                    if($stomp->ack($frame)){
                        //成功处理操作
                        $flag = $success($frame->body);
                        //如果抢票失败，再放回队列
                        if(!$flag){
                            $tMark = 're';
                            $stomp->begin('re');
                            $stomp->send($queue, $frame->body);
                            if($stomp->commit($tMark)){
                                echo '有一张票券入库异常，已经插回队列。';
                            }
                            else{
                                $stomp->abort($tMark);
                                echo '插入队列异常：' . $frame->body;
                            }
                        }
                    }
                    else{
                        $failure('没抢到票哦，请稍后再试试~');
                    }
                }
                else{
                    $failure('没有票了~');
                }
            }
        }
        catch (\Exception $exception){
            $failure($exception->getMessage());
        }
        finally{
            $stomp->unsubscribe($queue);
        }
    }
}
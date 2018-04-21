<?php

namespace yoga\grabticket;


class TicketProducer extends GrabCore
{
    public static function provide($number,$_queue = null){
        $tMark = 'batch';
        $stomp = self::getInstance()->stomp;
        $queue = $_queue ? $_queue : self::getInstance()->queue;
        $stomp->begin($tMark);
        for($i = 1; $i <= $number; $i++){
            $stomp->send($queue, self::generateTicket($i), [
                'persistent' => 'true'
            ]);
        }
        if($stomp->commit($tMark)){
            echo "生成 $number 张票券成功！";
        }
        else{
            $stomp->abort($tMark);
        }
    }

    private static function generateTicket($seed){
        $groupCode = ['A','B','C'];
        return json_encode([
            'tno' => $groupCode[array_rand($groupCode,1)] . substr(microtime(), 3,7) . random_int(1, 99) . $seed
        ]);
    }
}
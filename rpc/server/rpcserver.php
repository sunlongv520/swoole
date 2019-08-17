<?php
require("vendor/autoload.php");


function getMe(){
    return "shenyi".PHP_EOL;
}
function getAge($name){
    return $name."'s age is 19".PHP_EOL;
}

$server=new Swoole\Server('0.0.0.0', 8001, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);

$server->on("receive",function(swoole_server $server, int $fd, int $reactor_id, string $data){

       $rpcReq=\App\rpc\RpcRequest::build($data);
       if(function_exists($rpcReq->getMethod())){
           $result=[
           "jsonrpc"=>"2.0",
           "result"=>call_user_func($rpcReq->getMethod(),...$rpcReq->getParams()),
           "id"=>$rpcReq->getId()
        ];
       }

       $server->send($fd,json_encode($result));

});
$server->start();

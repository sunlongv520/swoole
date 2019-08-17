<?php
namespace App\rpc;

class RpcRequest{
    private $data="";
    private $method="";
    private $params=[];

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param string|null $method
     */
    public function setMethod(?string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return array|null
     */
    public function getParams(): ?array
    {
        return $this->params;
    }

    /**
     * @param array|null $params
     */
    public function setParams(?array $params): void
    {
        $this->params = $params;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    private $id=0;

    public function __construct(string $data)
    {
        $this->data = json_decode($data,1);
        $this->method=$this->getProp("method");
        $this->params=$this->getProp("params");
        $this->id=$this->getProp("id");
    }
    private function  getProp($prop){
        if(in_array($prop,array_keys($this->data))){
            return $this->data[$prop];
        }
        return null;
    }

    public static function build($data){
        return new self($data);
    }

}
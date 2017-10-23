<?php
namespace S7design\FileUploadVirusValidation\Antivirus\Types;

use S7design\FileUploadVirusValidation\Antivirus\ClamAv\Exceptions\SocketTestException;

abstract class AntivirusSocketConnectable
{
    private $socket;

    private $params;

    public function __construct(array $params)
    {
        $this->socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
        $this->params = $params;
    }

    public function connect()
    {
        if(!isset($this->params['connection']['socket']['url']) || !isset($this->params['connection']['socket']['port'])){
            throw new \Exception("Please provide configuration for socket connection");
        }

        if(isset($this->params['testing_mode']) && $this->params['testing_mode'] == true){
            throw new SocketTestException("Testing mode enabled, connection will not be enabled");
        }

        socket_connect(
            $this->socket,
            $this->params['connection']['socket']['url'],
            $this->params['connection']['socket']['port']
        );
    }

    protected function send(string $data){
        socket_write($this->socket, $data, strlen($data));
    }

    protected function read(int $bufferSize = 2048){
        $result = '';
        while ($out = socket_read($this->socket, 2048)) {
            $result .= $out;
        }

        return trim($result);
    }

    public function disconnect()
    {
        socket_close($this->socket);
    }
}
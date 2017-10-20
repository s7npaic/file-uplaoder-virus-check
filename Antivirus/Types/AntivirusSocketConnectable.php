<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 10/18/17
 * Time: 3:10 PM
 */

namespace S7design\FileUploadVirusValidation\Antivirus\Types;

abstract class AntivirusSocketConnectable
{
    private $socket;

    public function __construct()
    {
        $this->socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
    }

    public function connect()
    {
        socket_connect($this->socket,'127.0.0.1',3310);
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
<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 10/18/17
 * Time: 3:10 PM
 */

namespace S7design\FileUploadVirusValidation\Antivirus\ClamAv\Types;


use Socket\Raw\Socket;

abstract class AntivirusSocketConnectable
{
    protected $_socket;

    protected $_inSession = false;

    public function __construct(Socket $socket){
        $this->connection = $socket;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 10/19/17
 * Time: 9:51 AM
 */

namespace S7design\FileUploadVirusValidation\Antivirus\CommunicationAdapters;



use S7design\FileUploadVirusValidation\Antivirus\Types\AntivirusSocketConnectable;
use S7design\FileUploadVirusValidation\Antivirus\Types\ISocketAntivirusCommand;

class ClamAvAdapter extends AntivirusSocketConnectable implements ISocketAntivirusCommand
{
    const RESULT_OK    = 'OK';
    const RESULT_FOUND = 'FOUND';
    const RESULT_ERROR = 'ERROR';

    /**
     * Ping clamd to see if we get a response.
     *
     * @throws \SocketConnectionBrokenException
     *
     * @return bool
     */
    public function checkIsServiceAvailable() : bool
    {
        $this->send('PING');
        if ($this->read() === 'PONG') {
            return true;
        }
        throw new \SocketConnectionBrokenException('Could not ping clamd');
    }
    /**
     * Scan a single file.
     *
     * @param string $file The location of the file to scan
     *
     * @return bool
     */
    public function scanFile($file) : bool
    {
        $this->send('SCAN '.$file);
        $response = $this->read(4096);
        return $this->parseResponse($response);
    }

    /**
     * Parse the received response into a structured array ($filename, $reason, $status).
     *
     * @param string $response
     *
     * @return bool
     */
    public function parseResponse($response) : bool
    {
        $splitResponse = explode(': ', $response);
        $message  = isset($splitResponse[1]) ? $splitResponse[1] : '';

        if ($message === self::RESULT_OK) {
            return true;
        } else {
            return false;
        }
    }
}
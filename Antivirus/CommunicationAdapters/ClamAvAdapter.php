<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 10/19/17
 * Time: 9:51 AM
 */

namespace S7design\FileUploadVirusValidation\Antivirus\CommunicationAdapters;


use S7design\FileUploadVirusValidation\Types\Types\AntivirusSocketConnectable;
use S7design\FileUploadVirusValidation\Types\Types\ISocketAntivirusCommand;

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
        $this->executeCommand('PING');
        if ($this->getResponse() === 'PONG') {
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
        $this->executeCommand('SCAN '.$file);
        $response = $this->getResponse();
        return $this->parseResponse($response);
    }
    /**
     * A wrapper to send a command to clamd.
     *
     * @param string $command
     */
    public function executeCommand($command)
    {
        $this->_socket->send("n$command\n", MSG_DONTROUTE);
    }
    /**
     * A wrapper to cleanly read a response from clamd.
     *
     * @return string
     */
    public function getResponse()
    {
        $result = $this->_socket->read(4096);
        if (!$this->_inSession) {
            $this->closeConnection();
        }
        return trim($result);
    }
    /**
     * Explicitly close the current socket's connection.
     *
     * @return bool
     *
     * @throws \SocketConnectionBrokenException If the socket fails to close
     */
    public function closeConnection() : bool
    {
        try {
            $this->_socket->close();
            return true;
        } catch (\SocketConnectionBrokenException $e) {
            throw $e;
        }
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
        $idReturn = [];
        if (!$this->_inSession) {
            $filename = $splitResponse[0];
            $message  = $splitResponse[1];
        } else {
            $idReturn = ['id' => $splitResponse[0]];
            $filename = $splitResponse[1];
            $message  = $splitResponse[2];
        }
        if ($message === self::RESULT_OK) {
            return true;
        } else {
            $parts  = explode(' ', $message);
            $status = array_pop($parts);
            $reason = implode(' ', $parts);
            return false;
        }
    }
}
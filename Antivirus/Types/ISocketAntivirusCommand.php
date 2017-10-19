<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 10/19/17
 * Time: 9:38 AM
 */

namespace S7design\FileUploadVirusValidation\Types\Types;


interface ISocketAntivirusCommand
{

    /**
     * Ping clamd to see if we get a response.
     *
     * @throws \SocketConnectionBrokenException
     *
     * @return bool
     */
    public function checkIsServiceAvailable() : bool;
    /**
     * Scan a single file.
     *
     * @param string $file The location of the file to scan
     *
     * @return bool
     */
    public function scanFile($file) : bool;
    /**
     * A wrapper to send a command to clamd.
     *
     * @param string $command
     */
    public function executeCommand($command);
    /**
     * A wrapper to cleanly read a response from clamd.
     *
     * @return string
     */
    public function getResponse();
    /**
     * Explicitly close the current socket's connection.
     *
     * @return bool
     *
     * @throws \SocketConnectionBrokenException If the socket fails to close
     */
    public function closeConnection() : bool;
    /**
     * Parse the received response into a structured array ($filename, $reason, $status).
     *
     * @param string $response
     *
     * @return bool
     */
    public function parseResponse($response) : bool;
}
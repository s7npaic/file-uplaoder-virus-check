<?php

namespace S7design\FileUploadVirusValidation\Antivirus;

use S7design\FileUploadVirusValidation\Antivirus\ClamAv\ClamAvProvider;
use S7design\FileUploadVirusValidation\Antivirus\CommunicationAdapters\ClamAvAdapter;
use S7design\FileUploadVirusValidation\Antivirus\ClamAv\Types\IAntivirusFactory;
use Socket\Raw\Factory;

class ClamAvFactory implements IAntivirusFactory
{

    public function getProvider(): IAntivirusProvider
    {
        $socket = new Factory();
        $clamAvAdapter = new ClamAvAdapter($socket->createClient(''));

        return new ClamAvProvider($clamAvAdapter);
    }
}
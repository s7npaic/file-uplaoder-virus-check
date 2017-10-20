<?php

namespace S7design\FileUploadVirusValidation\Antivirus;

use S7design\FileUploadVirusValidation\Antivirus\ClamAv\ClamAvProvider;
use S7design\FileUploadVirusValidation\Antivirus\CommunicationAdapters\ClamAvAdapter;
use S7design\FileUploadVirusValidation\Antivirus\Types\IAntivirusFactory;
use S7design\FileUploadVirusValidation\Antivirus\Types\IAntivirusProvider;
use Socket\Raw\Factory;

class ClamAvFactory implements IAntivirusFactory
{

    public function getProvider(): IAntivirusProvider
    {
        $clamAvAdapter = new ClamAvAdapter();

        return new ClamAvProvider($clamAvAdapter);
    }
}
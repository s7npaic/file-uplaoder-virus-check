<?php

namespace S7design\FileUploadVirusValidation\Antivirus;

use S7design\FileUploadVirusValidation\Antivirus\ClamAv\ClamAvProvider;
use S7design\FileUploadVirusValidation\Antivirus\Types\IAntivirusFactory;
use S7design\FileUploadVirusValidation\Antivirus\Types\IAntivirusProvider;
use S7design\FileUploadVirusValidation\Antivirus\Types\ISocketAntivirusCommand;

class ClamAvFactory implements IAntivirusFactory
{
    private $antivirusCommand;

    public function __construct(ISocketAntivirusCommand $antivirusCommand)
    {
        $this->antivirusCommand = $antivirusCommand;
    }

    public function getProvider(): IAntivirusProvider
    {
        return new ClamAvProvider($this->antivirusCommand);
    }
}
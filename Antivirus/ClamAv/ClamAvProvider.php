<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 10/18/17
 * Time: 3:15 PM
 */

namespace S7design\FileUploadVirusValidation\Antivirus\ClamAv;


use S7design\FileUploadVirusValidation\Antivirus\ClamAv\Types\IAntivirusProvider;
use S7design\FileUploadVirusValidation\Antivirus\ClamAv\Types\ISocketAntivirusCommand;

class ClamAvProvider implements IAntivirusProvider
{
    private $command;

    public function __construct(ISocketAntivirusCommand $antivirusCommand)
    {
        $this->command = $antivirusCommand;
    }

    /**
     * @inheritdoc
     */
    public function checkIsSingleFileContaminated(string $absoluteFilePath): bool
    {
        try{
            $this->command->checkIsServiceAvailable();
            $result =  !$this->command->scanFile($absoluteFilePath);
            $this->command->closeConnection();

            return $result;
        }catch (\SocketConnectionBrokenException $e){
            return true;
        }
    }
}
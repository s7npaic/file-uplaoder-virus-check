<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 10/18/17
 * Time: 3:15 PM
 */

namespace S7design\FileUploadVirusValidation\Antivirus\ClamAv;


use S7design\FileUploadVirusValidation\Antivirus\Types\IAntivirusProvider;
use S7design\FileUploadVirusValidation\Antivirus\Types\ISocketAntivirusCommand;

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
            $this->command->connect();
            $result =  !$this->command->scanFile($absoluteFilePath);
            $this->command->disconnect();

            return $result;
        }catch (\SocketConnectionBrokenException $e){
            return true;
        }
        catch (\Exception $e){
            return true;
        }
    }
}
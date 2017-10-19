<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 10/18/17
 * Time: 3:06 PM
 */

namespace S7design\FileUploadVirusValidation\Antivirus;


interface IAntivirusProvider
{
    /**
     * Check is single file contaminated with virus
     *
     * If it is contaminated return bool true, if everything is ok return false
     *
     * @param string $absoluteFilePath
     * @return bool
     */
    public function checkIsSingleFileContaminated(string $absoluteFilePath) : bool;
}
<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 10/18/17
 * Time: 2:43 PM
 */

namespace S7design\FileUploadVirusValidation\Types\Types;


use S7design\FileUploadVirusValidation\Antivirus\IAntivirusProvider;

interface IAntivirusFactory
{
    public function getProvider() : IAntivirusProvider;
}
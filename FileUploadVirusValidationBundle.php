<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 10/18/17
 * Time: 5:16 PM
 */

namespace S7design\FileUploadVirusValidation;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FileUploadVirusValidationBundle extends Bundle
{

    public function getContainerExtension()
    {
        return parent::getContainerExtension();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 10/18/17
 * Time: 5:18 PM
 */

namespace S7design\FileUploadVirusValidation;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class FileUploadVirusValidationExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(dirname(__DIR__) . '/Resources/config')
            );

        $loader->load('services.xml');
    }
}
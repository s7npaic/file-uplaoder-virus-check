<?php

namespace S7design\FileUploadVirusValidation\DependencyInjection;

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
            new FileLocator(dirname(__DIR__) . '/../Resources/config')
            );

        $loader->load('services.xml');
    }
}
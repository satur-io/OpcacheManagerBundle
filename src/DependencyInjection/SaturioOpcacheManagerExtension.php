<?php


namespace Saturio\OpcacheManagerBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class SaturioOpcacheManagerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $defaultUri = $config['server']['default_uri'] ?? 'http://localhost';

        $statusCommand = $container->getDefinition('Saturio\OpcacheManagerBundle\Command\StatusCommand');
        $statusCommand->replaceArgument('$defaultUri', $defaultUri);

        $configurationCommand = $container->getDefinition('Saturio\OpcacheManagerBundle\Command\ConfigurationCommand');
        $configurationCommand->replaceArgument('$defaultUri', $defaultUri);

        $resetCommand = $container->getDefinition('Saturio\OpcacheManagerBundle\Command\ResetCommand');
        $resetCommand->replaceArgument('$defaultUri', $defaultUri);
    }
}

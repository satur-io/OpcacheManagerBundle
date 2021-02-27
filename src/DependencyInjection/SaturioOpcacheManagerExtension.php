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

        $statusCommand = $container->getDefinition('Saturio\OpcacheManagerBundle\Command\StatusCommand');
        $statusCommand->replaceArgument('$defaultUri', $config['server']['default_uri']);

        $configurationCommand = $container->getDefinition('Saturio\OpcacheManagerBundle\Command\ConfigurationCommand');
        $configurationCommand->replaceArgument('$defaultUri', $config['server']['default_uri']);

        $resetCommand = $container->getDefinition('Saturio\OpcacheManagerBundle\Command\ResetCommand');
        $resetCommand->replaceArgument('$defaultUri', $config['server']['default_uri']);
    }
}

<?php


namespace Saturio\OpcacheManagerBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('saturio_opcache_manager');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('server')
                    ->children()
                        ->scalarNode('default_uri')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
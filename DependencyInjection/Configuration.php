<?php

/*
 * This file is part of the GoogleAnalyticsBundle package.
 *
 * (c) Leblanc Simon <https://www.leblanc-simon.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LeblancSimon\GoogleAnalyticsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $tree_builder = new TreeBuilder();
        $root_node = $tree_builder->root('google_analytics');

        $root_node
            ->children()
                ->scalarNode('id')
                    ->defaultValue(null)
                ->end()
                ->scalarNode('template')
                    ->defaultValue('LeblancSimonGoogleAnalyticsBundle::google_analytics.html.twig')
                ->end()
            ->end()
        ;

        return $tree_builder;
    }
}

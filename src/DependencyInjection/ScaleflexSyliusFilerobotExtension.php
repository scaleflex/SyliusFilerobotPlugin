<?php

declare(strict_types=1);

namespace Scaleflex\SyliusFilerobotPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class ScaleflexSyliusFilerobotExtension extends AbstractResourceExtension
{
    /**
     * @psalm-suppress UnusedVariable
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $this->registerResources('scaleflex_sylius_filerobot', $config['driver'], $config['resources'], $container);
        $container->setParameter('scaleflex_sylius_filerobot_plugin.filters', $config['filters'] ?? []);

        $loader->load('services.xml');
    }

    public function getConfiguration(array $config, ContainerBuilder $container): ConfigurationInterface
    {
        return new Configuration();
    }
}

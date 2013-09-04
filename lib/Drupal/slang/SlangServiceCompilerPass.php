<?php

/**
 * @file
 * Contains \Drupal\slang\SlangServiceCompilerPass.
 */

namespace Drupal\slang;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class SlangServiceCompilerPass implements CompilerPassInterface {

  /**
   * Adds services to the Serializer.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
   *   The container to process.
   */
  public function process(ContainerBuilder $container) {
    $definition = $container->getDefinition('twig.loader.filesystem');
    $definition->setClass('Drupal\slang\Plugin\Twig\TwigFilesystemLoader');    
  }

}

<?php

/**
 * @file
 * Contains \Drupal\slang\SlangServiceProvider.
 */

namespace Drupal\slang;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderInterface;

/**
 * Slang dependency injection container.
 */
class SlangServiceProvider implements ServiceProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function register(ContainerBuilder $container) {
    // Add a compiler pass for adding Normalizers and Encoders to Serializer.
    $container->addCompilerPass(new SlangServiceCompilerPass());
  }
}


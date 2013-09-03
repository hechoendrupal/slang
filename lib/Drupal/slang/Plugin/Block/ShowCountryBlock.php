<?php

namespace Drupal\slang\Plugin\Block;

use Drupal\block\BlockBase;
use Drupal\block\Annotation\Block;
use Drupal\Core\Annotation\Translation;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\slang\Services\Slang;

/**
 * Provides a "Show Countrys" block.
 *
 * @Block(
 *   id = "slang_show_country_block",
 *   admin_label = @Translation("Show countrys")
 * )
 */
class ShowCountryBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * [__construct description]
   * @param array  $configuration     [description]
   * @param [type] $plugin_id         [description]
   * @param array  $plugin_definition [description]
   * @param Slang  $slang             [description]
   */
  public function __construct(array $configuration, $plugin_id, array $plugin_definition, Slang $slang) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->slang = $slang;
  }


  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, array $plugin_definition) {
    return new static($configuration, $plugin_id, $plugin_definition, $container->get('slang.phrase_collection'));
  }


  /**
   * Overrides \Drupal\block\BlockBase::settings().
   */
  public function settings() {
    return array(
      'properties' => array(
        'administrative' => TRUE
      ),
      'seconds_online' => 900,
      'max_list_count' => 10
    );
  }

  /**
   * Implements \Drupal\block\BlockBase::build().
   */
  public function build() {
    $build = array(
      '#theme' => 'select',
      '#prefix' => '<p> The country list</p>',
      '#attributes' => array(
        'onchange' => 'location.replace("/wawa");return false;'
      ),
    );

    $build['#options'][] = '- Select -';
    $build['#options'][] = $this->slang->getCountry();
    $build['#options'][] = $this->slang->getCountry() . '2';

    return $build;
  }

}


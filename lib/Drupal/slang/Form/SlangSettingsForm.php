<?php

namespace Drupal\slang\Form;

use Drupal\system\SystemConfigFormBase;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Config\Context\ContextInterface;
use Drupal\Core\Path\AliasManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Component\Utility\String;
use Drupal\Component\Utility\Url;


class SlangSettingsForm extends SystemConfigFormBase {

  protected $configFactory;

  /**
   * {@inheritdoc}
   */

  public function __construct(ConfigFactory $config_factory, ContextInterface $context){
    parent::__construct($config_factory, $context);
  }

  /**
   * {@inheritdoc}
   */
  public static function create (ContainerInterface $container){
    return new static(
      $container->get('config.factory'),
      $container->get('config.context.free')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'slang_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state){
    $config = $this->configFactory->get('slang.settings');

    $form = array();
    $form['url_end_point'] = array(
      '#type' => 'textfield',
      '#title' => t('End Point'),
      '#default_value' => $config->get('url_end_point'),
      '#description' => t('URL end point'),
    );
    $form['#submit'][] = array($this, 'submitForm');

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, array &$form_state){
    parent::validateForm($form, $form_state);

    if (!Url::isValid($form_state['values']['url_end_point'], true) ){
      form_set_error('url_end_point', t('Is not a valid URL'));
    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    parent::submitForm($form, $form_state);
    $config = $this->configFactory->get('slang.settings')
      ->set('url_end_point',$form_state['values']['url_end_point'])
    ->save();
  }

}

<?php

namespace Drupal\slang\Form;

use Drupal\system\SystemConfigFormBase;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Config\Context\ContextInterface;
use Drupal\Core\Path\AliasManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class SlangSettingsForm extends SystemConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'slang_settings_form';
  }

  public function buildForm(array $form, array &$form_state){

    $form = array();

    $form['End Point'] = array(
      '#type' => 'textfield',
      '#title' => t('End Point'),
      '#default_value' => 'http://',
      '#description' => t('URL end point'),
    );

    $form['#submit'][] = array($this, 'submitForm');

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {

    parent::submitForm($form, $form_state);

  }

}

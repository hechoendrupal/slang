<?php

namespace Drupal\slang\Plugin\Twig;

class TwigTitle extends \Twig_Extension{

  /**
   * Return a \Twig_SimpleFunction to add a drupal_title function in Twig
   * @return \Twig_SimpleFunction
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('drupal_title', array($this,'setTitle')),
    );
  }

  /**
   * set title from twig template
   * @param string $title
   */
  public function setTitle($title){
    drupal_set_title($title);
  }

  /**
   *
   * @return string
   */
  public function getName(){
    return 'slang_twig';
  }
}

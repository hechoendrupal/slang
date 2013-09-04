<?php

namespace Drupal\slang\Plugin\Twig;

class TwigTitle extends \Twig_Extension{
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('drupal_title', array($this,'setTitle')),
    );
  }
  
  public function setTitle($title){
    drupal_set_title($title); 
  }

  public function getName(){
    return 'slang_twig';
  }
}

<?php

namespace Drupal\slang\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Slang {

  protected $country;

  public function __construct($quotes) {
    $this->quotes = $quotes;
  }

  /**
   * [setCountry description]
   * @param String $country Slang country
   */
  public function setCountry($country) {
    $this->country = $country;
  }

  /**
   * [getCountry description]
   * @return [type] [description]
   */
  public function getCountry() {
    return $this->country;
  }

  /**
   * [get description]
   * @param  [type] $index [description]
   * @return [type]        [description]
   */
  public function get($index) {
    if(isset($this->quotes[$index])){
      return $this->quotes[$index];
    }
    else{
      return $this->getRandom();
    }
  }

  /**
   * get random key
   * @return string slang phrase
   */
  public function getRandom() {
    $max = count($this->quotes) - 1;
    $index = floor(rand(0, $max));
    return $this->quotes[$index];
  }
}

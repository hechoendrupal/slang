<?php

namespace Drupal\slang\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Slang {

  protected $country;

  public function __construct($phrases) {
    $this->quotes = $phrases;
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
   * [getCountries description]
   * @return [type] [description]
   */
  public function getCountries(){
    return array_keys($this->quotes);

  }

  /**
   * [get description]
   * @param  [type] $index [description]
   * @return [type]        [description]
   */
  public function get($index) {
    if(isset($this->quotes[$this->getCountry()][$index])){
      return $this->quotes[$this->getCountry()][$index];
    }
    else{
      return $this->getRandom();
    }
  }

  /**
   * get random key
   * @return string slang phrase
   */
  public function getRandom($country) {
    $this->country = $country;
    $max = count($this->quotes[$this->getCountry()]) - 1;
    $index = floor(rand(0, $max));
    return $this->quotes[$this->getCountry()][$index];
  }

}

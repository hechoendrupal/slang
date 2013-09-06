<?php

namespace Drupal\slang\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\slang\Services\Slang as SlangService;

/**
 * Slang Default Controller
 */
class DefaultController implements ContainerInjectionInterface {

  /**
  * @var Drupal\slang\Services\Slang
  */
  protected $slang;

 /**
  * @var \TwigEnvironment
  */
  protected $twig;

  /**
   * Constructor
   *
   * @param Drupal\slang\Services\Slang
   * @param \TwigEnvironment $twig
   */
  public function __construct(SlangService $slang,\TwigEnvironment $twig) {
    $this->twig = $twig;
    $this->slang = $slang;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('slang.phrase_collection'),
      $container->get('twig')
    );
  }

  /**
   * helloAction
   *
   * @param String $name
   */
  public function helloAction($name){
    $twig = $this->twig;
    $template = $twig->loadTemplate('slang::example.html.twig');

    return $template->render(array(
      'name' => $name,
      'title' => 'Slang Demo'
    ));
  }

  public function slangAction($country) {

    // TODO:
    $rand = $this->slang->getRandom($country);

    $twig = $this->twig;
    $template = $twig->loadTemplate('slang::slang.html.twig');

    return $template->render(array(
      'phrase' => $rand,
      'title' => "slang phrase"
    ));
  }

}

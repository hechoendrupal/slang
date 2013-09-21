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
   * Show slang phrase
   * @param  string $country get country
   * @return \TwigEnvironment return twig template
   */
  public function slangAction($country) {

    // TODO:
    $rand = $this->slang->getRandom($country);

    $template = $this->twig->loadTemplate('slang::slang.html.twig');

    return $template->render(array(
      'phrase' => $rand,
      'title' => "Slang Phrase",
      'country' => $country
    ));
  }

}

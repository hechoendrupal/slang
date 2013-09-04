<?php

namespace Drupal\slang\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
  public function helloAction($name) {
    $twig = $this->twig;
    $path = drupal_get_path('module', 'slang') . '/templates/example.html.twig';
    $template = $twig->loadTemplate($path);
    return $template->render(array(
      'name' => $name,
      'title' => 'Slang Demo'
    ));
  }

  public function slangAction($country) {
    $rand = $this->slang->getRandom($country);
    $twig = $this->twig;
    $path = drupal_get_path('module', 'slang') . '/templates/slang.html.twig';
    $template = $twig->loadTemplate($path);
    drupal_set_title("slang phrase");
    return $template->render(array('phrase' => $rand));
  }

}

<?php

namespace Drupal\slang\Controller;

use Drupa\Core\Controller\ControllerInterface;

class DefaultController extends ControllerInterface{

  public function nameAction() {

    $name = 'nombre';
    $twig = $this->container->get('twig');
    $path = $this->templateDir . 'page.html.twig';
    $template = $twig->loadTemplate($path);
    drupal_set_title("Route Parameter Example");
    return $template->render(array('name' => $name));
  }

}

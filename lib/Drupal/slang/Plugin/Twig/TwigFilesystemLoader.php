<?php

namespace Drupal\slang\Plugin\Twig;

class TwigFilesystemLoader extends \Twig_Loader_Filesystem {
  
  protected $locator;
  protected $parser;

  protected function findTemplate($template) {
        $logicalName = (string) $template;

        if (isset($this->cache[$logicalName])) {
            return $this->cache[$logicalName];
        }

        $file = null;
        $previous = null;
        try {
            $file = parent::findTemplate($template);
        } catch (\Twig_Error_Loader $e) {
            $previous = $e;

            // for BC
            try {
                
              $name = $template;
              if (false !== strpos($name, '..')) {
                throw new \RuntimeException(sprintf('Template name "%s" contains invalid characters.', $name));
              }

              if (!preg_match('/^([^:]*):([^:]*):(.+)\.([^\.]+)\.([^\.]+)$/', $name, $matches)) {
                throw new \InvalidArgumentException(sprintf('Template name "%s" is not valid (format is "module:section:template.format.engine").', $name));
              }
              
              $path = drupal_get_path('module', $matches[1]) . '/templates/' . $matches[3] .'.'. $matches[4] . '.' . $matches[5]; 
        
                try {
                    $file = $path;
                } catch (\InvalidArgumentException $e) {
                    $previous = $e;
                }
            } catch (\Exception $e) {
                $previous = $e;
            }
        }

        if (false === $file || null === $file) {
            throw new \Twig_Error_Loader(sprintf('Unable to find template "%s".', $logicalName), -1, null, $previous);
        }

        return $this->cache[$logicalName] = $file;
  }

}

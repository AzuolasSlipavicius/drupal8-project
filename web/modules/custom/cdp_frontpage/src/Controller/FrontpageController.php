<?php


namespace Drupal\cdp_frontpage\Controller;


use Drupal\Core\Controller\ControllerBase;

class FrontpageController extends ControllerBase {
  public function frontpage() {
//     cia panaudojam hook`a theme ir renderina template
    return [
      '#theme' => 'cdp_frontpage',
    ];
  }
}
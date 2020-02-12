<?php

namespace Drupal\cdp_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines CdpController class.
 */
class CdpController extends ControllerBase {
  /**
   * Display the markup.
   *
   * @return array
   *   Return markup array
   */
  public function content() {
    return [
      '#type'=>'markup',
      '#markup'=> $this->t('Hello, World'),
    ];
  }

}

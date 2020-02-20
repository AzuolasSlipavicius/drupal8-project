<?php
namespace Drupal\cdp_frontpage\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Block with 'Register in' button.
 *
 * @Block(
 *   id = "cdp_register",
 *   admin_label = @Translation("Register in button"),
 *   category = @Translation("CDP")
 * )
 */


class RegisterBlock extends BlockBase {

  public function build() {
    return [
      '#theme' => 'cdp_register'
    ];
  }
}
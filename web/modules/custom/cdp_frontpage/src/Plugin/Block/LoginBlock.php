<?php
namespace Drupal\cdp_frontpage\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Block with 'Log in' button.
 *
 * @Block(
 *   id = "cdp_login",
 *   admin_label = @Translation("Log in button"),
 *   category = @Translation("CDP")
 * )
 */


class LoginBlock extends BlockBase {

  public function build() {
    return [
      '#theme' => 'cdp_login'
    ];
  }
}
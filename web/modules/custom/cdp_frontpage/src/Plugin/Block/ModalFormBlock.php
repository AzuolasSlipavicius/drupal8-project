<?php
namespace Drupal\cdp_frontpage\Plugin\Block;

use Drupal\cdp_frontpage\Form\CdpUserCustomLoginForm;
use Drupal\Core\Block\BlockBase;

/**
 * Modal Log/register form button.
 *
 * @Block(
 *   id = "cdp_login_register_form",
 *   admin_label = @Translation("Login/register form"),
 *   category = @Translation("CDP")
 * )
 */


class ModalFormBlock extends BlockBase {

  public function build() {
    $form_builder = \Drupal::formBuilder();
    $basic_form_in_block = $form_builder->getForm(CdpUserCustomLoginForm::class);
    $build['basic_form_in_block'] = $basic_form_in_block;
//    dump($build);
    return $build;
  }
}
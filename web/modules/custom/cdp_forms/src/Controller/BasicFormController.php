<?php

namespace Drupal\cdp_forms\Controller;

use Drupal\cdp_forms\Form\BasicFormInController;
use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for Basic form.
 */
class BasicFormController extends ControllerBase {

  /**
   * Display basic form in controller.
   */
  public function renderBasicFormInController(): array {
    $form_builder = \Drupal::formBuilder();
    $basic_form_in_controller = $form_builder->getForm(BasicFormInController::class);

    $build['basic_form_in_controller'] = $basic_form_in_controller;

    return $build;
  }

  /**
   * Display basic form in controller with other elements.
   */
  public function renderBasicFormWithMultipleElementsInController(): array {
    $build['item'] = [
      '#type' => 'item',
      '#markup' => 'This is custom item.',
    ];

    $build['inline_template'] = [
      '#type' => 'inline_template',
      '#template' => '<h2>This is custom template rendered at {{ time }}</h2>',
      '#context' => [
        'time' => date('Y-m-d H:i:s'),
      ],
    ];

    $form_builder = \Drupal::formBuilder();
    $basic_form_in_controller = $form_builder->getForm(BasicFormInController::class);
    $build['basic_form_in_controller'] = $basic_form_in_controller;

    return $build;
  }

}

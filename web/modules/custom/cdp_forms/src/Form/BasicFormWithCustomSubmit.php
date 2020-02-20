<?php

namespace Drupal\cdp_forms\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides basic form with custom submit.
 *
 * This form is displayed as page content.
 * Route name for this form `cdp_forms.basic.custom_submit`
 *
 * @link http://cdp.docker.localhost/development/forms/basic-with-custom-submit
 */
class BasicFormWithCustomSubmit extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * The returned ID should be a unique string that can be a valid PHP function
   * name, since it's used in hook implementation names such as
   * hook_form_FORM_ID_alter().
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId(): string {
    return 'cdp_forms_basic_with_custom_submit';
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['basic_text_field'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Basic text field'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Default submit'),
    ];

    $form['custom_submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Custom submit'),
      '#submit' => [
        '::submitFormCustom',
      ],
    ];

    return $form;
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->messenger()->addMessage('This is default submit message');
  }

  /**
   * Custom form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitFormCustom(array &$form, FormStateInterface $form_state): void {
    $this->messenger()->addMessage('This is custom submit message');
  }

}

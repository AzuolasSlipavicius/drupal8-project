<?php

namespace Drupal\cdp_forms\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides basic form with validation.
 *
 * This form is displayed as page content.
 * Route name for this form `cdp_forms.basic.validate`
 *
 * @link http://cdp.docker.localhost/development/forms/basic-with-validation
 */
class BasicFormWithValidation extends FormBase {

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
    return 'cdp_forms_basic_with_validation';
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
      '#description' => $this->t('This field will be validated and if input value is longer than 10 symbols, it will be displayed invalid and form will not submit properly.'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit basic form'),
    ];

    return $form;
  }

  /**
   * Form validation handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $basic_text_field = $form_state->getValue('basic_text_field');
    $basic_text_field_length = mb_strlen($basic_text_field);
    if ($basic_text_field_length > 10) {
      $form_state->setError($form, '\'Basic text field\' value length is: ' . $basic_text_field_length);
    }
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
    $basic_text_field = $form_state->getValue('basic_text_field');
    $this->messenger()->addMessage('\'Basic text field\' value: ' . $basic_text_field);
  }

}

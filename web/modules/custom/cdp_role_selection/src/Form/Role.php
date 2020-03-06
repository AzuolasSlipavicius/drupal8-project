<?php

namespace Drupal\cdp_role_selection\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Cdp role selection settings for this site.
 */
class Role extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cdp_role_selection_role';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['cdp_role_selection.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = \Drupal::service('config.factory')->getEditable('cdp_role_selection.settings');
    $configRoles = $config->get('roles');
    //Returns role ID
    $rolesBundle =\Drupal::entityTypeManager()->getStorage('user_role')->loadMultiple();
    $roles=[];
    foreach ($rolesBundle as $role =>$value) {
      $roles[$role] =  $value->get('label');
    }

    $form['role_selection'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('General Configurations'),
      '#description' => $this->t('Select roles to be displayed in user registration form.'),
      '#open' => TRUE,
    ];
    $form['role_selection']['roles'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Select role'),
      '#options' => $roles,
      '#default_value' => $configRoles,
    ];


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $displayRoles = [];
    foreach($form_state->getUserInput()['roles'] as $key => $value){
      if ($value !== null) {
        $displayRoles[$key] = \Drupal::entityTypeManager()->getStorage('user_role')->load($key)->get('label');
      }
    }
    drupal_flush_all_caches();

    $this->config('cdp_role_selection.settings')
      ->set('roles', $form_state->getValue('roles'))
      ->set('display_roles', $displayRoles)
      ->save();
    parent::submitForm($form, $form_state);
  }

}

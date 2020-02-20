<?php

namespace Drupal\cdp_custom_signin\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\Role;
use Drupal\user\UserStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SettingsForm extends FormBase {

  protected $userStorage;

  public function __construct(UserStorageInterface $user_storage) {
    $this->userStorage = $user_storage;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')->getStorage('user'),
    );
  }

  public function getFormId() {
    return 'cdp_custom_signin_settings';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['mail'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#size' => 60,
      '#description' => $this->t('You will get registration instructions to your email after approval'),
      '#required' => TRUE,
    ];
//    dump(Role::loadMultiple());
    $form['role'] = [
      '#type' => 'radios',
      '#title' => $this->t('Select role'),
      '#options' => [
        'developer' => 'Developer',
        'tech_lead' => 'Tech-lead',
      ],
      '#required' => TRUE,
    ];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = ['#type' => 'submit', '#value' => $this->t('Register')];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $mail = $form_state->getValue('mail');
    $users = $this->userStorage->loadByProperties(['mail'=>$mail]);
    $role = $form_state->getValue('role');
    if (count($users) === 1) {
      $form_state->setError($form['mail'], $this->t('User with this email already exist.'));
    } else {
      $form_state->setError($form['mail'], $this->t('Pavyko. Check your email inbox for further instructions.'));
    }

    if ($role !== 'developer' && $role !== 'tech_lead') {
      $form_state->setError($form['role'], $this->t('Please select role!'));
    }

  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
//    $this->config('cdp_custom_signin.settings')
//      ->set('example', $form_state->getValue('example'))
//      ->save();
    dump('cia jau formos submitas');
  }

}

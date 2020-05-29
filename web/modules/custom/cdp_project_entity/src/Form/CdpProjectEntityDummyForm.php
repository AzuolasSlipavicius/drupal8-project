<?php

namespace Drupal\cdp_project_entity\Form;

use Drupal;
use Drupal\Component\Utility\Random;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for a cdp project entity entity type.
 */
class CdpProjectEntityDummyForm extends FormBase
{

  protected $projectStorage;

  public function __construct()
  {
    $this->projectStorage = Drupal::entityTypeManager()
      ->getStorage('cdp_project_entity');
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'cdp_project_entity_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {

    $form['num'] = [
      '#type' => 'number',
      '#title' => $this->t('How many project would you like to generate?'),
      '#default_value' => 0,
      '#required' => TRUE,
      '#min' => 0,
    ];

    $form['kill'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Delete all Dummy projects.'),
    ];

    $form['settings'] = [
      '#markup' => $this->t('Dummy content generator for a cdp project entity type.'),
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Generate'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $rnd = new Random();
    $number = $form['num']['#value'];
    $kill = $form['kill']['#value'];

    if ($kill === 1) {
      $uids = $this->projectStorage->getQuery()
        ->condition('title', 'Dummy%', 'LIKE')
        ->execute();
      $projects = $this->projectStorage->loadMultiple($uids);
      $this->projectStorage->delete($projects);
      if (count($projects) == 1) {
        $this->messenger()->addStatus($this->t(count($projects) . ' Dummy project was deleted.'));
      } else {
        $this->messenger()->addStatus($this->t(count($projects) . ' Dummy projects was deleted.'));
      }
    }


    if ($number > 0) {
      $projects = [];
      while (count($projects) < $number) {
        $title = 'Dummy ' . $rnd->word(5);
        $description = $rnd->sentences(12);
        $projects[] = ['title' => $title, 'description' => $description];
      }
      foreach ($projects as $project) {
        $this->projectStorage
          ->create([
            'title' => $project['title'],
            'description' => $project['description'],
          ])
          ->save();
      }
      if ($number == 1) {
        $this->messenger()->addStatus($this->t($number . ' dummy project was sucsefully created'));
      } else {
        $this->messenger()->addStatus($this->t($number . ' dummy projects was sucsefully created'));
      }
    }

  }

}

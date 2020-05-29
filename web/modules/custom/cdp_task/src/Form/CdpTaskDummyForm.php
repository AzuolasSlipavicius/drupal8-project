<?php

namespace Drupal\cdp_task\Form;

use Drupal;
use Drupal\Component\Utility\Random;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for a cdp project entity entity type.
 */
class CdpTaskDummyForm extends FormBase
{

  protected $taskStorage;
  protected $storageUserTechleads;
  protected $storageUserDevelopers;
  protected $storageProjects;


  public function __construct()
  {
    $this->taskStorage = Drupal::entityTypeManager()->getStorage('cdp_task');

    $this->storageProjects = $this->loadEntities('cdp_project_entity', 'id', '0', '>');
    $this->storageUserDevelopers = $this->loadEntities('user', 'roles', 'developer', '=');
    $this->storageUserTechleads = $this->loadEntities('user', 'roles', 'tech_lead', '=');
  }

  /**
   * @param $entity_type_id
   * @param $field
   * @param $value
   * @param $operator
   * @return array
   * @throws Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function loadEntities($entity_type_id, $field, $value, $operator)
  {
    $entityStorage = Drupal::entityTypeManager()->getStorage($entity_type_id);
    return $entityStorage->getQuery()
      ->condition($field, $value, $operator)
      ->execute();
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'cdp_task';
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
      $uids = $this->taskStorage->getQuery()
        ->condition('title', 'Dummy%', 'LIKE')
        ->execute();
      $tasks = $this->taskStorage->loadMultiple($uids);
      $this->taskStorage->delete($tasks);
      if (count($tasks) == 1) {
        $this->messenger()->addStatus($this->t(count($tasks) . ' Dummy task was deleted.'));
      } else {
        $this->messenger()->addStatus($this->t(count($tasks) . ' Dummy tasks was deleted.'));
      }
    }


    if ($number > 0) {
      $tasks = [];
      while (count($tasks) < $number) {
        $tasks[] = [
          'title' => 'Dummy ' . $rnd->word(5),
          'description' => $rnd->sentences(12),
          'task_status' => $this->rndArrayValue(['To do', 'Done', 'In progress']),
          'techlead' => $this->rndArrayValue($this->storageUserTechleads),
          'techlead_time' => rand(0, 20),
          'developer' => $this->rndArrayValue($this->storageUserDevelopers),
          'developer_time' => rand(0, 20),
          'total_time' => rand(0, 20),
          'project' => $this->rndArrayValue($this->storageProjects),
          'link' => '',
          'jira_key' => rand(1, 5),
        ];
      }

      foreach ($tasks as $task) {
        $this->taskStorage
          ->create($task)
          ->save();
      }
      if ($number == 1) {
        $this->messenger()->addStatus($this->t($number . ' Dummy task was sucsefully created'));
      } else {
        $this->messenger()->addStatus($this->t($number . ' Dummy tasks was sucsefully created'));
      }
    }

  }

  /**
   * @param array $array
   * @return mixed
   */
  public function rndArrayValue(array $array)
  {
    return array_rand(array_flip($array), 1);
  }

}

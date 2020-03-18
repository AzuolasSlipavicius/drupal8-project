<?php

namespace Drupal\cdp_task\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the cdp task entity edit forms.
 */
class CdpTaskForm extends ContentEntityForm {

  function _cdp_task_get_role(){
    $roles = ['developer', 'tech_lead'];
    foreach ($roles as $role) {
      if (\Drupal\user\Entity\User::load(\Drupal::currentUser()->id())->hasRole($role)) {
        return $role;
      }
    }
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form,$form_state);

    $current_role = _cdp_task_get_role();

    if ($current_role === 'developer') {
      $form['techlead']['widget']['#access'] = false;
      $form['techlead']['widget']['#required'] = false;
      $form['techlead_time']['widget']['#access'] = false;
    } elseif ($current_role === 'tech_lead') {
      $form['developer']['widget']['#access'] = false;
      $form['developer']['widget']['#required'] = false;
      $form['developer_time']['widget']['#access'] = false;
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New cdp task %label has been created.', $message_arguments));
      $this->logger('cdp_task')->notice('Created new cdp task %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The cdp task %label has been updated.', $message_arguments));
      $this->logger('cdp_task')->notice('Updated new cdp task %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.cdp_task.canonical', ['cdp_task' => $entity->id()]);
  }

}

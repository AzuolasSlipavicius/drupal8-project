<?php

namespace Drupal\cdp_task_entity\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the cdp_task_entity entity edit forms.
 */
class CdpTaskEntityForm extends ContentEntityForm {

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
      $this->messenger()->addStatus($this->t('New cdp_task_entity %label has been created.', $message_arguments));
      $this->logger('cdp_task_entity')->notice('Created new cdp_task_entity %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The cdp_task_entity %label has been updated.', $message_arguments));
      $this->logger('cdp_task_entity')->notice('Updated new cdp_task_entity %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.cdp_task_entity.canonical', ['cdp_task_entity' => $entity->id()]);
  }

}

<?php

namespace Drupal\cdp_project_entity\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the cdp project entity entity edit forms.
 */
class CdpProjectEntityForm extends ContentEntityForm {

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
      $this->messenger()->addStatus($this->t('New cdp project entity %label has been created.', $message_arguments));
      $this->logger('cdp_project_entity')->notice('Created new cdp project entity %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The cdp project entity %label has been updated.', $message_arguments));
      $this->logger('cdp_project_entity')->notice('Updated new cdp project entity %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.cdp_project_entity.canonical', ['cdp_project_entity' => $entity->id()]);
  }

}

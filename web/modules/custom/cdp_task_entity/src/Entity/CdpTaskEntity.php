<?php

namespace Drupal\cdp_task_entity\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\cdp_task_entity\CdpTaskEntityInterface;

/**
 * Defines the cdp task entity entity class.
 *
 * @ContentEntityType(
 *   id = "cdp_task_entity",
 *   label = @Translation("Cdp task entity"),
 *   label_collection = @Translation("Cdp task entities"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\cdp_task_entity\CdpTaskEntityListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\cdp_task_entity\Form\CdpTaskEntityForm",
 *       "edit" = "Drupal\cdp_task_entity\Form\CdpTaskEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "cdp_task_entity",
 *   admin_permission = "administer cdp task entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "title",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/cdp-task-entity/add",
 *     "canonical" = "/cdp_task_entity/{cdp_task_entity}",
 *     "edit-form" = "/admin/content/cdp-task-entity/{cdp_task_entity}/edit",
 *     "delete-form" = "/admin/content/cdp-task-entity/{cdp_task_entity}/delete",
 *     "collection" = "/admin/content/cdp-task-entity"
 *   },
 *   field_ui_base_route = "entity.cdp_task_entity.settings"
 * )
 */
class CdpTaskEntity extends ContentEntityBase implements CdpTaskEntityInterface {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return $this->get('title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTitle($title) {
    $this->set('title', $title);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The title of the cdp task entity entity.'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDescription(t('A description of the cdp task entity.'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'above',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}

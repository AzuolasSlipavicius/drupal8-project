<?php

namespace Drupal\cdp_task\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\cdp_task\CdpTaskInterface;

/**
 * Defines the cdp task entity class.
 *
 * @ContentEntityType(
 *   id = "cdp_task",
 *   label = @Translation("Cdp task"),
 *   label_collection = @Translation("Cdp tasks"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\cdp_task\CdpTaskListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\cdp_task\CdpTaskAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\cdp_task\Form\CdpTaskForm",
 *       "edit" = "Drupal\cdp_task\Form\CdpTaskForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "cdp_task",
 *   data_table = "cdp_task_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer cdp task",
 *   entity_keys = {
 *     "id" = "id",
 *     "langcode" = "langcode",
 *     "label" = "title",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/cdp-task/add",
 *     "canonical" = "/cdp_task/{cdp_task}",
 *     "edit-form" = "/admin/content/cdp-task/{cdp_task}/edit",
 *     "delete-form" = "/admin/content/cdp-task/{cdp_task}/delete",
 *     "collection" = "/admin/content/cdp-task"
 *   },
 *   field_ui_base_route = "entity.cdp_task.settings"
 * )
 */
class CdpTask extends ContentEntityBase implements CdpTaskInterface {

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
  public function isEnabled() {
    return (bool) $this->get('status')->value;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setTranslatable(TRUE)
      ->setLabel(t('Title'))
      ->setDescription(t('The title of the cdp task entity.'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setTranslatable(TRUE)
      ->setLabel(t('Description'))
      ->setDescription(t('A description of the cdp task.'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => 1,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'above',
        'weight' => 1,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['task_status'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Task Status'))
      ->setDefaultValue(TRUE)
      ->setCardinality()
      ->setSetting('allowed_values', [
        'To do' => t('To do'),
        'Done' => t('Done'),
        'In progress' => t('In progress')
      ])
      ->setDefaultValue('To do')
      ->setDisplayOptions('form', [
        'type' => 'list',
        'weight' => 2,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'list',
        'weight' => 2,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['techlead'] = BaseFieldDefinition::create('entity_reference')
      ->setTranslatable(TRUE)
      ->setLabel(t('Techlead name'))
      ->setRequired(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default:user')
      ->setSetting('handler_settings', [
        'include_anonymous' => false,
        'filter' => [
          'type' => 'role',
          'role' => [
            'developer' => '0',
            'tech_lead' => 'tech_lead',
            'administrator' =>'0'
          ],
        ],
        'target_bundles' => NULL,
        'auto_create' => false
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_autocomplete',
        'weight' => 3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => 3,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['techlead_time'] = BaseFieldDefinition::create('integer')
      ->setTranslatable( TRUE)
      ->setLabel(t('Time Techlead Needs'))
      ->setSetting('min', '0')
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'number',
        'weight' => 4,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['developer'] = BaseFieldDefinition::create('entity_reference')
      ->setTranslatable(TRUE)
      ->setLabel(t('Developer name'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default:user')
      ->setSetting('handler_settings', [
        'include_anonymous' => false,
        'filter' => [
          'type' => 'role',
          'role' => [
            'developer' => 'developer',
            'tech_lead' => '0',
            'administrator' =>'0'
          ],
        ],
        'target_bundles' => NULL,
        'auto_create' => false
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_autocomplete',
        'weight' => 5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => 5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['developer_time'] = BaseFieldDefinition::create('integer')
      ->setTranslatable( TRUE)
      ->setLabel(t('Time Developer Needs'))
      ->setSetting('min', '0')
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 6,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'number',
        'weight' => 6,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['total_time'] = BaseFieldDefinition::create('integer')
      ->setTranslatable( TRUE)
      ->setLabel(t('Time Spent'))
      ->setSetting('min', '0')
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 7,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'number',
        'weight' => 7,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['project'] = BaseFieldDefinition::create('entity_reference')
      ->setTranslatable(TRUE)
      ->setRequired(TRUE)
      ->setLabel(t('Project'))
      ->setSetting('target_type', 'cdp_project_entity')
      ->setDisplayOptions('form', [
        'type' => 'entity_autocomplete',
        'weight' => 8,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'string',
        'weight' => 8,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['link'] = BaseFieldDefinition::create('link')
      ->setTranslatable(TRUE)
      ->setLabel(t('Task link'))
      ->setSetting('link_type', '16')
      ->setSetting('title', '1')
      ->setDisplayOptions('form', [
        'type' => 'url',
        'weight' => 9,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'rul',
        'weight' => 9,
      ])
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}

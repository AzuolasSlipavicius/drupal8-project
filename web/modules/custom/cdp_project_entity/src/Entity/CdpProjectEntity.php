<?php

namespace Drupal\cdp_project_entity\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\cdp_project_entity\CdpProjectEntityInterface;

/**
 * Defines the cdp project entity entity class.
 *
 * @ContentEntityType(
 *   id = "cdp_project_entity",
 *   label = @Translation("Cdp project entity"),
 *   label_collection = @Translation("Cdp project entities"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\cdp_project_entity\CdpProjectEntityListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\cdp_project_entity\Form\CdpProjectEntityForm",
 *       "edit" = "Drupal\cdp_project_entity\Form\CdpProjectEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "cdp_project_entity",
 *   admin_permission = "administer cdp project entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "id",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/cdp-project-entity/add",
 *     "canonical" = "/cdp_project_entity/{cdp_project_entity}",
 *     "edit-form" = "/admin/content/cdp-project-entity/{cdp_project_entity}/edit",
 *     "delete-form" = "/admin/content/cdp-project-entity/{cdp_project_entity}/delete",
 *     "collection" = "/admin/content/cdp-project-entity"
 *   },
 *   field_ui_base_route = "entity.cdp_project_entity.settings"
 * )
 */
class CdpProjectEntity extends ContentEntityBase implements CdpProjectEntityInterface {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    return $fields;
  }

}

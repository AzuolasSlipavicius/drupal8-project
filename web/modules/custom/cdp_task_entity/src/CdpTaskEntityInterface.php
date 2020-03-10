<?php

namespace Drupal\cdp_task_entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a cdp_task_entity entity type.
 */
interface CdpTaskEntityInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the cdp_task_entity title.
   *
   * @return string
   *   Title of the cdp_task_entity.
   */
  public function getTitle();

  /**
   * Sets the cdp_task_entity title.
   *
   * @param string $title
   *   The cdp_task_entity title.
   *
   * @return \Drupal\cdp_task_entity\CdpTaskEntityInterface
   *   The called cdp_task_entity entity.
   */
  public function setTitle($title);

  /**
   * Gets the cdp_task_entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the cdp_task_entity.
   */
  public function getCreatedTime();

  /**
   * Sets the cdp_task_entity creation timestamp.
   *
   * @param int $timestamp
   *   The cdp_task_entity creation timestamp.
   *
   * @return \Drupal\cdp_task_entity\CdpTaskEntityInterface
   *   The called cdp_task_entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the cdp_task_entity status.
   *
   * @return bool
   *   TRUE if the cdp_task_entity is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the cdp_task_entity status.
   *
   * @param bool $status
   *   TRUE to enable this cdp_task_entity, FALSE to disable.
   *
   * @return \Drupal\cdp_task_entity\CdpTaskEntityInterface
   *   The called cdp_task_entity entity.
   */
  public function setStatus($status);

}

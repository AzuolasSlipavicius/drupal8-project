<?php

namespace Drupal\cdp_task_entity;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a cdp task entity entity type.
 */
interface CdpTaskEntityInterface extends ContentEntityInterface {

  /**
   * Gets the cdp task entity title.
   *
   * @return string
   *   Title of the cdp task entity.
   */
  public function getTitle();

  /**
   * Sets the cdp task entity title.
   *
   * @param string $title
   *   The cdp task entity title.
   *
   * @return \Drupal\cdp_task_entity\CdpTaskEntityInterface
   *   The called cdp task entity entity.
   */
  public function setTitle($title);

}

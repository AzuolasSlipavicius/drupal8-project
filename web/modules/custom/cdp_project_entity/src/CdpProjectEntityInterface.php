<?php

namespace Drupal\cdp_project_entity;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a cdp project entity entity type.
 */
interface CdpProjectEntityInterface extends ContentEntityInterface {

  /**
   * Gets the cdp project entity title.
   *
   * @return string
   *   Title of the cdp project entity.
   */
  public function getTitle();

  /**
   * Sets the cdp project entity title.
   *
   * @param string $title
   *   The cdp project entity title.
   *
   * @return \Drupal\cdp_project_entity\CdpProjectEntityInterface
   *   The called cdp project entity entity.
   */
  public function setTitle($title);

}

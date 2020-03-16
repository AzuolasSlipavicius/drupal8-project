<?php

namespace Drupal\cdp_task;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a cdp task entity type.
 */
interface CdpTaskInterface extends ContentEntityInterface {

  /**
   * Gets the cdp task title.
   *
   * @return string
   *   Title of the cdp task.
   */
  public function getTitle();

  /**
   * Sets the cdp task title.
   *
   * @param string $title
   *   The cdp task title.
   *
   * @return \Drupal\cdp_task\CdpTaskInterface
   *   The called cdp task entity.
   */
  public function setTitle($title);

  /**
   * Returns the cdp task status.
   *
   * @return bool
   *   TRUE if the cdp task is enabled, FALSE otherwise.
   */
  public function isEnabled();

}

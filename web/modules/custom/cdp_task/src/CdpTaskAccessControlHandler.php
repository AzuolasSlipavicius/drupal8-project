<?php

namespace Drupal\cdp_task;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the cdp task entity type.
 */
class CdpTaskAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view cdp task');

      case 'update':
        return AccessResult::allowedIfHasPermissions($account, ['edit cdp task', 'administer cdp task'], 'OR');

      case 'delete':
        return AccessResult::allowedIfHasPermissions($account, ['delete cdp task', 'administer cdp task'], 'OR');

      default:
        // No opinion.
        return AccessResult::neutral();
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermissions($account, ['create cdp task', 'administer cdp task'], 'OR');
  }

}

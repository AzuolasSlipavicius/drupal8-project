<?php

namespace Drupal\cdp_project_entity;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the Cdp project entity entity type.
 */
class CdpProjectEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view project entity');

      case 'update':
        return AccessResult::allowedIfHasPermissions($account, ['edit project entity', 'administer project entity'], 'OR');

      case 'delete':
        return AccessResult::allowedIfHasPermissions($account, ['delete project entity', 'administer project entity'], 'OR');

      default:
        // No opinion.
        return AccessResult::neutral();
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermissions($account, ['create Cdp project entity', 'administer Cdp project entity'], 'OR');
  }

}

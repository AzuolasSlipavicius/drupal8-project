<?php


namespace Drupal\cdp_task\Form;


class CdpGetLoggedUserCustomRole
{
  private $currentRole;

  public function __construct(array $roles)
  {
    $this->cdpTaskGetRole($roles);
  }

  private function cdpTaskGetRole(array $roles)
  {
//    $this->currentRole = 'developer';
    foreach ($roles as $role) {
      if (\Drupal\user\Entity\User::load(\Drupal::currentUser()->id())->hasRole($role)) {
        $this->currentRole = $role;
      }
    }
  }
  public function getRole(){
    return $this->currentRole;
  }
}

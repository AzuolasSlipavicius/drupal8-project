<?php

namespace Drupal\Tests\cdp_task\Functional;

use Drupal\cdp_task\Form;
use Drupal\Tests\BrowserTestBase;

/**
 * Test description.
 *
 * @group cdp_task
 */
class CustomRoleTest extends BrowserTestBase
{

  private $role;
  private $user;

  /**
   * {@inheritdoc}
   */
  protected function setUp()
  {
    parent::setUp();
    $this->user = $this->createUser([], NULL, FALSE, ['roles' => 'developer']);
  }

  /**
   * Test callback.
   */
  public function testSomething()
  {
    $this->drupalLogin($this->user);
    $this->assertSession();

    $this->role = new Form\CdpGetLoggedUserCustomRole(['tech_lead', 'developer']);
    $this->assertEquals('developer', $this->role->getRole());
  }

}

<?php

namespace Drupal\Tests\cdp_task\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\cdp_task\Form;

/**
 * Test description.
 *
 * @group cdp_task
 */
class GetCustomRoleTest extends UnitTestCase {

  /**
   * {@inheritdoc}
   */
  protected $role;
  protected function setUp() {
    parent::setUp();
    // @TODO: Mock required classes here.
  }

  /**
   * Tests something.
   */
  public function testSomething() {
    $this->role = new Form\CdpGetLoggedUserCustomRole(['developer']);
    $this->assertEquals('developer',$this->role->getRole());
  }

}

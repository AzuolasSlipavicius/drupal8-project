<?php

namespace Drupal\Tests\cdp_task\Unit;

use Drupal\cdp_task\Form;
use Drupal\Tests\UnitTestCase;

/**
 * Test description.
 *
 * @group cdp_task
 */
class GetCustomRoleTest extends UnitTestCase
{

  /**
   * {@inheritdoc}
   */
  protected $role;

  protected function setUp()
  {
    parent::setUp();
    // @TODO: Mock required classes here.
  }

  /**
   * Tests something.
   */
  public function testSomething()
  {
    $this->role = new Form\CdpGetLoggedUserCustomRole(['developer']);
    $this->assertEquals('developer', $this->role->getRole());
  }

}

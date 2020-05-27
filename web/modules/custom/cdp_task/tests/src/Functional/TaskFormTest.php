<?php

namespace Drupal\Tests\cdp_task\Functional;

use Drupal\Core\Url;
use Drupal\Tests\BrowserTestBase;

/**
 * Test description.
 *
 * @group cdp_task
 */
class TaskFormTest extends BrowserTestBase
{


  /**
   * The modules to load to run the test.
   *
   * @var array
   */
  public static $modules = [
    'cdp_task',
    'user'
  ];
  private $user;
  private $user_dev;
  private $user_tech;
  private $session;
  private $task_form;

  /**
   * {@inheritdoc}
   */
  protected function setUp()
  {
    parent::setUp();
    $this->user = $this->CreateUser(['create cdp task'], 'test_user');
    $this->user_dev = $this->CreateUser([], 'user_dev');
    $this->user_dev->addRole('developer');
    $this->user_tech = $this->CreateUser([], 'test_tech');
    $this->user_tech->addRole('techlead');
    // Login as created user.
    $this->drupalLogin($this->user);
    // Create session.
    $this->session = $this->assertSession();
    // Get the task add form path from the route.
    $this->task_add_form = Url::fromRoute('entity.cdp_task.add_form');
    $this->drupalGet($this->task_form);

  }

  /**
   * Test callback.
   */
  public function testTaskFormStatus()
  {
    // Assure we loaded settings with proper permissions.
    $this->session->statusCodeEquals(200);
  }

  public function testTaskFormFields()
  {
    // Check if all fields exists.
    $this->session->fieldExists('title[0][value]');
    $this->session->fieldExists('description[0][value]');
    $this->session->fieldExists('task_status');
    $this->session->fieldExists('techlead[0][target_id]');
    $this->session->fieldExists('techlead_time[0][value]');
    $this->session->fieldExists('developer[0][target_id]');
    $this->session->fieldExists('developer_time[0][value]');
    $this->session->fieldExists('total_time[0][value]');
    $this->session->fieldExists('project[0][target_id]');
    $this->session->fieldExists('link[0][uri]');
    $this->session->fieldExists('link[0][title]');
  }

  public function testTaskFormCreateNewForm()
  {
    // Field data for new task.
    $new_task = [
      'title[0][value]' => 'simple task',
      'description[0][value]' => 'Lorem ipsum',
      'task_status' => 'To do',
      'developer[0][target_id]' => 'test_dedv',
      'techlead[0][target_id]' => 'test_tech',
      'developer_time[0][value]' => 10,
    ];
    // Create new task.
    $this->drupalPostForm($this->task_form, $new_task, 'Save', [], 'cdp_task');
  }

}

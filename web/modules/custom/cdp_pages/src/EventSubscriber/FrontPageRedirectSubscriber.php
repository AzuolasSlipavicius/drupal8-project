<?php

namespace Drupal\cdp_pages\EventSubscriber;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Custom front page redirect.
 *
 * Redirect user '/development/pages/custom-front-page'
 * if no front page url is configured in Drupal.
 *
 * @package Drupal\cdp_pages\EventSubscriber
 */
class FrontPageRedirectSubscriber implements EventSubscriberInterface {

  use ContainerAwareTrait;

  /**
   * Current user.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a new FrontPageRedirectSubscriber.
   *
   * @param \Drupal\Core\Session\AccountProxyInterface $account
   *   Current user.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   Config factory.
   */
  public function __construct(
    AccountProxyInterface $account,
    ConfigFactoryInterface $config_factory
  ) {
    $this->currentUser = $account;
    $this->configFactory = $config_factory;
  }

  /**
   * Returns an array of event names this subscriber wants to listen to.
   *
   * The array keys are event names and the value can be:
   *
   *  * The method name to call (priority defaults to 0)
   *  * An array composed of the method name to call and the priority
   *  * An array of arrays composed of the method names to call and respective
   *    priorities, or 0 if unset
   *
   * For instance:
   *
   *  * ['eventName' => 'methodName']
   *  * ['eventName' => ['methodName', $priority]]
   *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
   *
   * @return array
   *   The event names to listen to
   */
  public static function getSubscribedEvents(): array {
    $events[KernelEvents::REQUEST][] = ['redirectToCustomFrontPageIfNoFrontPageIsConfigured', 300];

    return $events;
  }

  /**
   * Redirect to custom front page if no front page is configured.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   *   Kernel response event.
   */
  public function redirectToCustomFrontPageIfNoFrontPageIsConfigured(GetResponseEvent $event): void {
    // Don't do anything if this is a sub request and not a master request.
    if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
      return;
    }

    $current_path = $event->getRequest()->getPathInfo();

    if ($current_path === '/') {
      $system_site_config = $this->configFactory->get('system.site');
      $front_page_config_value = $system_site_config->get('front');

      if ($front_page_config_value === NULL) {
        $front_page_url_object = Url::fromRoute('cdp_pages.pages.custom_front_page');
        $front_page_url_string = $front_page_url_object->toString();
        $response = new RedirectResponse($front_page_url_string);
        $response->send();
      }
    }
  }

}

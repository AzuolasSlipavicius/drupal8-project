<?php

namespace Drupal\cdp_frontpage\EventSubscriber;

use Drupal\cdp_frontpage\Form\CdpUserCustomLoginForm;
use Drupal\Core\Routing\RouteSubscriberBase;
use Drupal\Core\Routing\RoutingEvents;
use Symfony\Component\Routing\RouteCollection;

/**
 * CDP User custom login form route subscriber.
 */
class CdpUserCustomLoginFormRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    foreach ($collection->all() as $route) {
      if (strpos($route->getPath(), '/user/login') === 0) {
        $route->setDefault('_form', CdpUserCustomLoginForm::class);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events = parent::getSubscribedEvents();
    $events[RoutingEvents::ALTER] = ['onAlterRoutes', -300];

    return $events;
  }

}

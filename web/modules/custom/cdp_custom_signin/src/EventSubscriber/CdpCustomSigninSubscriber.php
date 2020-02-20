<?php

namespace Drupal\cdp_custom_signin\EventSubscriber;


use Drupal\cdp_custom_signin\Form\SettingsForm;
use Drupal\Core\Routing\RouteSubscriberBase;
use Drupal\Core\Routing\RoutingEvents;
use Symfony\Component\Routing\RouteCollection;

/**
 * cdp_custom_signin event subscriber.
 */
class CdpCustomSigninSubscriber extends RouteSubscriberBase {


  /**
   * @inheritDoc
   */
  protected function alterRoutes(RouteCollection $collection) {
//    foreach ($collection->all() as $route) {
//      if (strpos($route->getPath(), '/user/register') === 0) {
//        $route->setDefault('_form', SettingsForm::class);
//      }
//    }
//  }
//
//  public static function getSubscribedEvents() {
//    $events =  parent::getSubscribedEvents();
//    $events[RoutingEvents::ALTER] = ['onAlterRoutes', -320];
//    return $events;
  }

}

<?php

namespace Drupal\noahs_page_builder_pro\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Alter user/login API route to return more data



    // if ($route = $collection->get('noahs_page_builder.edit_widget')) {
    //   $route->setDefaults([
    //     '' => '\Drupal\noahs_page_builder_pro\Controller\noahs_page_builderProController::editor',
    //   ]);
    // }
    // if ($route = $collection->get('user.logout')) {
    //   $route->setDefaults([
    //     '_controller' => '\Drupal\sice_restful\Controller\RestLoginAddonsController::logout',
    //   ]);
    // }
    // if ($route = $collection->get('rest.entity.user.GET')) {
    //   $route->setDefaults([
    //     '_controller' => '\Drupal\sice_restful\Controller\GetUserAddonsController::getUserData',
    //   ]);
    // }

  }
}

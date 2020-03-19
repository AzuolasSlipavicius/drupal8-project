<?php

namespace Drupal\cdp_statistic\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\cdp_task\Entity;

/**
 * Returns responses for Cdp statistic routes.
 */
class CdpStatisticController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

   $raw_data = Entity\CdpTask::loadMultiple();
   $data = [];
   foreach ($raw_data as $entity) {
    $data['labels'][] = $entity->get('title')->value;
    $data['datasets'][0]['label'] = 'Techlead time';
    $data['datasets'][1]['label'] = 'Developer time';
    $data['datasets'][2]['label'] = 'Actual time';

    $data['datasets'][0]['data'][] = $entity->get('techlead_time')->value;
    $data['datasets'][1]['data'][] = $entity->get('developer_time')->value;
    $data['datasets'][2]['data'][] = $entity->get('total_time')->value;

    $data['datasets'][0]['backgroundColor'] = 'rgba(255, 99, 132, 1)';
    $data['datasets'][1]['backgroundColor'] = 'rgba(54, 162, 235, 1)';
    $data['datasets'][2]['backgroundColor'] = 'rgba(255, 206, 86, 1)';
   }

    $build['#theme'] = 'cdp_statistic';
    $build['#total'] = 15;
    $build['#attached']['library'][] = 'cdp_statistic/chart';
    $build['#attached']['drupalSettings']['cdp_stats'] = $data;
   return $build;
  }

}

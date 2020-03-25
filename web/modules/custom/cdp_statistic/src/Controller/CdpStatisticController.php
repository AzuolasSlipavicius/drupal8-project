<?php

namespace Drupal\cdp_statistic\Controller;

use Drupal\cdp_boom\KetvirtasServisas;
use Drupal\cdp_boom\TreciasServisas;
use Drupal\cdp_task\CdpTaskService;
use Drupal\Core\Controller\ControllerBase;
use Drupal\cdp_task\Entity;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
     $current_project = $entity->getCdpTaskValue('project');

    $data['labels'][] = $entity->get('title')->value;
    $data['datasets'][0]['label'] = t('Techlead time');
    $data['datasets'][1]['label'] = t('Developer time');
    $data['datasets'][2]['label'] = t('Actual time');

    $data['datasets'][0]['data'][] = $entity->getCdpTaskValue('techlead_time');
    $data['datasets'][1]['data'][] = $entity->getCdpTaskValue('developer_time');
    $data['datasets'][2]['data'][] = $entity->getCdpTaskValue('total_time');

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

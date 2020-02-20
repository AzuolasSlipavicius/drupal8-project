<?php

namespace Drupal\cdp_forms\Plugin\Block;

use Drupal\cdp_forms\Form\BasicFormInBlock;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a block with basic form and custom elements in it.
 *
 * @Block(
 *   id = "cdp_forms_basic_form_in_block_with_elements",
 *   admin_label = @Translation("BasicFormInBlockWithElementsBlock"),
 *   category = @Translation("CDP")
 * )
 */
class BasicFormInBlockWithElementsBlock extends BlockBase {

  /**
   * Builds and returns the renderable array for this block plugin.
   *
   * If a block should not be rendered because it has no content, then this
   * method must also ensure to return no content: it must then only return an
   * empty array, or an empty array with #cache set (with cacheability metadata
   * indicating the circumstances for it being empty).
   *
   * @return array
   *   A renderable array representing the content of the block.
   *
   * @see \Drupal\block\BlockViewBuilder
   */
  public function build(): array {
    $build['item'] = [
      '#type' => 'item',
      '#markup' => 'This is custom item in block.',
    ];

    $build['inline_template'] = [
      '#type' => 'inline_template',
      '#template' => '<h2>This is custom template in block rendered at {{ time }}</h2>',
      '#context' => [
        'time' => date('Y-m-d H:i:s'),
      ],
    ];

    $form_builder = \Drupal::formBuilder();
    $basic_form_in_block = $form_builder->getForm(BasicFormInBlock::class);
    $build['basic_form_in_block_with_elements'] = $basic_form_in_block;
    return $build;
  }

}

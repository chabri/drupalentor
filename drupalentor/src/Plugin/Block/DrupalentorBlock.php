<?php

/**
 * @file
 * Contains \Drupal\drupalentor\Plugin\Block\DrupalentorBlock.
 */

namespace Drupal\drupalentor\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides block to show drupalentor
 *
 *
 * @Block(
 *   id = "drupalentor_block",
 *   admin_label = @Translation("Drupalentor Block Content"),
 *   category = @Translation("drupalentor Content"),
 * )
 *
 */

class DrupalentorBlock extends BlockBase {

  protected $bid;

  /**
   * {@inheritdoc}
   */
  public function build() {
     $block = array();
    return $block;
  }
    
  /**
   *  Default cache is disabled. 
   * 
   * @param array $form
   * @param \Drupal\gavias_content_builder\Plugin\Block\FormStateInterface $form_state
   * @return 
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $rebuild_form = parent::buildConfigurationForm($form, $form_state);
    $rebuild_form['cache']['max_age']['#default_value'] = 0;
    return $rebuild_form;
  }
}

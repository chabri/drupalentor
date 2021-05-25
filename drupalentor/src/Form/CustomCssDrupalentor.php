<?php

namespace Drupal\drupalentor\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures drupalentor settings.
 */
class CustomCssDrupalentor extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'drupalentor-custom-css';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['drupalentor.custom_css'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('drupalentor.custom_css');
    $form['#attached']['library'][] = 'drupalentor/drupalentor.assets.settings';
    $form['drupalentor_custom_css'] = [
      '#type' => 'textarea',
      '#rows' => 15,
      '#title' => $this->t('CSS Code'),
      '#default_value' => $config->get('drupalentor_custom_css'),
      '#description' => $this->t('Please enter custom style without <b> @style </b> tag.', ["@style" => '<style>']) ,
    ];


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */

    
   public function submitForm(array &$form, FormStateInterface $form_state) {
       $theme = \Drupal::theme()->getActiveTheme()->getName();
//      if ($theme) {
        $this->config('drupalentor.custom_css')
          ->set('drupalentor_custom_css', $form_state->getValue('drupalentor_custom_css'))
          ->save();
        drupal_flush_all_caches();
//      }
        drupalentor_generate_css($theme);
      // Remove the settings from the form state so the values are not saved in the
      // theme settings.
      $form_state->unsetValue('drupalentor_custom_css');
    }

}




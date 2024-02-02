<?php

namespace Drupal\noahs_page_builder\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures noahs_page_builder settings.
 */
class NoahsCustomCssForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'noahs_page_builder-custom-css';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['noahs_page_builder.custom_css'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('noahs_page_builder.custom_css');
    $form['#attached']['library'][] = 'noahs_page_builder/noahs_page_builder.assets.settings';
    $form['noahs_page_builder_custom_css'] = [
      '#type' => 'textarea',
      '#rows' => 15,
      '#title' => $this->t('CSS Code'),
      '#default_value' => $config->get('noahs_page_builder_custom_css'),
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
        $this->config('noahs_page_builder.custom_css')
          ->set('noahs_page_builder_custom_css', $form_state->getValue('noahs_page_builder_custom_css'))
          ->save();
        
        $css = $form_state->getValue('noahs_page_builder_custom_css');
        noahs_page_builder_generate_css($theme, $css, $name='noahs_page_builder_custom');
//        drupal_flush_all_caches();
      // Remove the settings from the form state so the values are not saved in the
      // theme settings.
      $form_state->unsetValue('noahs_page_builder_custom_css');
    }

}




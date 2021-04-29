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
    $form['drupalentor_custom_css'] = [
      '#type' => 'textarea',
      '#title' => $this->t('CSS Code'),
      '#default_value' => $config->get('drupalentor_custom_css'),
      '#description' => $this->t('Please enter custom style without <b> @style </b> tag.', ["@style" => '<style>']) ,
    ];

    $themes = array_keys(\Drupal::service('theme_handler')->listInfo());
    $form['drupalentor_themes'] = [
      '#type' => 'select',
      '#multiple' => TRUE,
      '#title' => $this->t('Select Themes'),
      '#options' => array_combine($themes, $themes),
      '#default_value' => $config->get('drupalentor_themes') ?? $themes,
      '#description' => $this->t('Select the themes, you want the CSS/JS code to appear on. If none is selected code will be applied to all the themes listed here.') ,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
//    drupalentor_generate_css();
    // Save the configuration.
    $this->config('drupalentor.custom_css')
      ->set('drupalentor_custom_css', $form_state->getValue('drupalentor_custom_css'))
      ->set('drupalentor_themes', $form_state->getValue('drupalentor_themes'))
      ->save();
    drupal_flush_all_caches();
    parent::submitForm($form, $form_state);
  }

}

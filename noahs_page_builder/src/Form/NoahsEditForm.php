<?php

namespace Drupal\noahs_page_builder\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\NodeForm; 
/**
 * Defines a form that configures noahs_page_builder settings.
 */
class NoahsEditForm extends NodeForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'noahs_page_builder-edit-form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['noahs_page_builder.admin.edit'];
  }

  /**
   * {@inheritdoc}
   */
    public function form(array $form, FormStateInterface $form_state, $nid = NULL) {
//        dump($nid);
    }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}

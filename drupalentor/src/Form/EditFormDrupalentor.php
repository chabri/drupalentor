<?php

namespace Drupal\drupalentor\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\NodeForm; 
/**
 * Defines a form that configures drupalentor settings.
 */
class EditFormDrupalentor extends NodeForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'drupalentor-edit-form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['drupalentor.admin.edit'];
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

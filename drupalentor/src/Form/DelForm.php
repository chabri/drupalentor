<?php

namespace Drupal\drupalentor\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class DelForm extends ConfigFormBase  {
   /**
   * The ID of the item to delete.
   *
   * @var string
   */
    protected $bid;

   /**
   * Implements \Drupal\Core\Form\FormInterface::getFormID().
   */
  
  /**
   * {@inheritdoc}
   *
   * @param int $id
   *   (optional) The ID of the item to be deleted.
   */
  public function buildForm(array $form, FormStateInterface $form_state, $bid = NULL) {
    $this->bid = $bid;
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
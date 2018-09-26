<?php

namespace Drupal\d8_routing\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class WeatherConfigForm extends ConfigFormBase {

 /**
  *
  * {@inheritdoc}
  *
  * @see \Drupal\Core\Form\FormInterface::getFormId()
  */
 public function getFormId() {
  // TODO: Auto-generated method stub
  return 'd8_routing_demo_config_form';
 }
 /**
  *
  * {@inheritdoc}
  *
  * @see \Drupal\Core\Form\ConfigFormBase::buildForm()
  */
 public function buildForm(array $form, FormStateInterface $form_state) {
  $form ['app_id'] = array (
    '#type' => 'textfield',
    '#title' => t ( 'App ID:' ),
    '#required' => TRUE
  );
  $form ['actions'] ['submit'] = array (
    '#type' => 'submit',
    '#value' => $this->t ( 'Submit' ),
    '#button_type' => 'primary'
  );

  return $form;
 }
 /**
  *
  * {@inheritdoc}
  *
  * @see \Drupal\Core\Form\ConfigFormBase::submitForm()
  */
 public function submitForm(array &$form, FormStateInterface $form_state) {
 }

 /**
  *
  * {@inheritdoc}
  *
  * @see \Drupal\Core\Form\ConfigFormBaseTrait::getEditableConfigNames()
  */
 protected function getEditableConfigNames() {
  // TODO: Auto-generated method stub
 }
}
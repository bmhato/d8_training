<?php

namespace Drupal\d8_routing\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DiForm extends FormBase {
 protected $db;
 /**
  *
  * @param Connection $db
  */
 public function __construct(Connection $db) {
  $this->db = $db;
 }

 /**
  *
  * {@inheritdoc}
  *
  */
 public static function create(ContainerInterface $container) {
  return new static ( $container->get ( 'database' ) );
 }

 /**
  *
  * {@inheritdoc}
  *
  * @see \Drupal\Core\Form\FormInterface::getFormId()
  */
 public function getFormId() {
  // TODO: Auto-generated method stub
  return 'simple form';
 }

 /**
  *
  * {@inheritdoc}
  *
  * @see \Drupal\Core\Form\FormInterface::buildForm()
  */
 public function buildForm(array $form, FormStateInterface $form_state) {
  $results = $this->db->select ( 'd8_demo', 'dd' )->fields ( 'dd' )->orderBy ( 'id', 'DESC' )->range ( 0, 1 )->execute ()->fetchAll ();
  $last_value = $results [0];

  $form ['first_name'] = array (
    '#type' => 'textfield',
    '#title' => t ( 'First Name:' ),
    '#required' => TRUE,
    '#default_value' => $last_value->first_name
  );
  $form ['last_name'] = array (
    '#type' => 'textfield',
    '#title' => t ( 'Last Name' ),
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
  * @see \Drupal\Core\Form\FormBase::validateForm()
  */
 public function validateForm(array &$form, FormStateInterface $form_state) {
  if (strlen ( $form_state->getValue ( 'first_name' ) ) < 5) {
   $form_state->setErrorByName ( 'first_name', $this->t ( 'Name must not be less than 5 chars.' ) );
  }
 }

 /**
  *
  * {@inheritdoc}
  *
  * @see \Drupal\Core\Form\FormInterface::submitForm()
  */
 public function submitForm(array &$form, FormStateInterface $form_state) {
  // TODO: Auto-generated method stub
  $this->db->insert ( 'd8_demo' )->fields ( [
    'first_name' => $form_state->getValue ( 'first_name' ),
    'last_name' => $form_state->getValue ( 'last_name' )
  ] )->execute ();
  $this->messenger ()->addMessage ( $this->t ( 'Form submitted successfully.' ) );
 }
}
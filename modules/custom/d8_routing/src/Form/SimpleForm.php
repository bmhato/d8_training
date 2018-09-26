<?php

namespace Drupal\d8_routing\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SimpleForm extends FormBase {

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
  $form ['name'] = array (
    '#type' => 'textfield',
    '#title' => t ( 'Full Name:' ),
    '#required' => TRUE
  );
  $form ['mail'] = array (
    '#type' => 'email',
    '#title' => t ( 'Email ID:' ),
    '#required' => TRUE
  );
  $form ['qualification'] = array (
    '#type' => 'select',
    '#title' => ('Qualification'),
    '#options' => array (
      'UG' => t ( 'Under Graduate' ),
      'PG' => t ( 'Post Graduate' ),
      'DOC' => t ( 'Doctoral' ),
      'OTH' => t ( 'Others' )
    )
  );
  $form ['others'] = array (
    '#type' => 'textfield',
    '#title' => 'Others',
    '#states' => array (
      'visible' => array (
        ':input[name="qualification"]' => array (
          'value' => 'OTH'
        )
      )
    )
  );
  $form ['country'] = array (
    '#type' => 'select',
    '#title' => ('Country'),
    '#options' => array (
      'IND' => t ( 'India' ),
      'UK' => t ( 'United Kingdom' )

    )
  );
  $form ['india-states'] = array (
    '#type' => 'select',
    '#title' => 'State',
    '#options' => array (
      'AP' => t ( 'Andra Predesh' ),
      'KA' => t ( 'Karnataka' )
    ),
    '#states' => array (
      'visible' => array (
        ':input[name="qualification"]' => array (
          'value' => 'IND'
        )
      )
    )
  );

  $form ['uk-states'] = array (
    '#type' => 'select',
    '#title' => 'State',
    '#options' => array (
      'LON' => t ( 'London' )
    ),
    '#states' => array (
      'visible' => array (
        ':input[name="qualification"]' => array (
          'value' => 'OTH'
        )
      )
    )
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
  if (strlen ( $form_state->getValue ( 'name' ) ) < 5) {
   $form_state->setErrorByName ( 'name', $this->t ( 'Name must not be less than 5 chars.' ) );
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
  $this->messenger ()->addMessage ( $this->t ( 'Form submitted successfully.' ) );
 }
}
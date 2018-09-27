<?php

namespace Drupal\d8_routing\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'DemoBlock' block.
 *
 * @Block(
 * id = "demo_block",
 * admin_label = @Translation("Demo Block"),
 * )
 */
class DemoBlock extends BlockBase {

 /**
  * Drupal\Core\DependencyInjection\ContainerInjectionInterface definition.
  *
  * @var \Drupal\Core\DependencyInjection\ContainerInjectionInterface
  */
 protected $d8RoutingDataController;
 protected $db;

 /**
  * Constructs a new TestBlock object.
  *
  * @param array $configuration
  *         A configuration array containing information about the plugin instance.
  * @param string $plugin_id
  *         The plugin_id for the plugin instance.
  * @param string $plugin_definition
  *         The plugin implementation definition.
  */
 public function __construct(array $configuration, $plugin_id, $plugin_definition, ContainerInjectionInterface $d8_routing_data_controller, DataController $db) {
  parent::__construct ( $configuration, $plugin_id, $plugin_definition );
  $this->d8RoutingDataController = $d8_routing_data_controller;
  $this->db = $db;
 }

 /**
  *
  * {@inheritdoc}
  *
  */
 public function defaultConfiguration() {
  return [ ] + parent::defaultConfiguration ();
 }

 /**
  *
  * {@inheritdoc}
  *
  */
 public function blockForm($form, FormStateInterface $form_state) {
  $form ['test'] = [
    '#type' => 'textfield',
    '#title' => $this->t ( 'Test' ),
    '#default_value' => $this->configuration ['test'],
    '#maxlength' => 64,
    '#size' => 64,
    '#weight' => '0'
  ];

  return $form;
 }

 /**
  *
  * {@inheritdoc}
  *
  */
 public function blockSubmit($form, FormStateInterface $form_state) {
  $this->configuration ['test'] = $form_state->getValue ( 'test' );
 }

 /**
  *
  * {@inheritdoc}
  *
  */
 public function build() {
  $results = $this->db->select ( 'd8_demo', 'dd' )->fields ( 'dd' )->orderBy ( 'id', 'DESC' )->range ( 0, 1 )->execute ()->fetchAll ();
  $last_value = $results [0];
  $build = [ ];
  $build ['demo_block_test'] ['#markup'] = 'Last Name is ' . $last_value->first_name . ' ' . $last_value->last_name;

  return $build;
 }
}

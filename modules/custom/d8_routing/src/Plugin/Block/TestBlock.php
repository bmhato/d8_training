<?php

namespace Drupal\d8_routing\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;

/**
 * Provides a 'TestBlock' block.
 *
 * @Block(
 * id = "test_block",
 * admin_label = @Translation("Test block"),
 * )
 */
class TestBlock extends BlockBase implements ContainerFactoryPluginInterface {

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
 public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
  return new static ( $configuration, $plugin_id, $plugin_definition, $container->get ( 'd8_routing.data_controller' ) );
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
  $build ['test_block'] ['#markup'] = 'Last Name is ' . $last_value->first_name . ' ' . $last_value->last_name;

  return $build;
 }
}

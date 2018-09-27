<?php

namespace Drupal\d8_routing\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;

/**
 * Provides a 'TestdemoBlock' block.
 *
 * @Block(
 * id = "testdemo_block",
 * admin_label = @Translation("Testdemo block"),
 * )
 */
class TestdemoBlock extends BlockBase implements ContainerFactoryPluginInterface {

 /**
  * Drupal\Core\DependencyInjection\ContainerInjectionInterface definition.
  *
  * @var \Drupal\Core\DependencyInjection\ContainerInjectionInterface
  */
 protected $d8RoutingDataController;
 /**
  * Constructs a new TestdemoBlock object.
  *
  * @param array $configuration
  *         A configuration array containing information about the plugin instance.
  * @param string $plugin_id
  *         The plugin_id for the plugin instance.
  * @param string $plugin_definition
  *         The plugin implementation definition.
  */
 public function __construct(array $configuration, $plugin_id, $plugin_definition, ContainerInjectionInterface $d8_routing_data_controller) {
  parent::__construct ( $configuration, $plugin_id, $plugin_definition );
  $this->d8RoutingDataController = $d8_routing_data_controller;
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
  $build = [ ];
  $build ['testdemo_block'] ['#markup'] = 'Test Demo Block';

  return $build;
 }
}

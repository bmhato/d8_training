<?php

namespace Drupal\d8_routing\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountProxyInterface;

/**
 * Provides a 'CurrentUser' block.
 *
 * @Block(
 * id = "current_user",
 * admin_label = @Translation("Current user"),
 * )
 */
class CurrentUser extends BlockBase implements ContainerFactoryPluginInterface {

 /**
  * Drupal\Core\Session\AccountProxyInterface definition.
  *
  * @var \Drupal\Core\Session\AccountProxyInterface
  */
 protected $currentUser;
 /**
  * Constructs a new CurrentUser object.
  *
  * @param array $configuration
  *         A configuration array containing information about the plugin instance.
  * @param string $plugin_id
  *         The plugin_id for the plugin instance.
  * @param string $plugin_definition
  *         The plugin implementation definition.
  */
 public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountProxyInterface $current_user) {
  parent::__construct ( $configuration, $plugin_id, $plugin_definition );
  $this->currentUser = $current_user;
 }
 /**
  *
  * {@inheritdoc}
  *
  */
 public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
  return new static ( $configuration, $plugin_id, $plugin_definition, $container->get ( 'current_user' ) );
 }
 /**
  *
  * {@inheritdoc}
  *
  */
 public function build() {
  $cu = $this->currentUser->getAccountName ();
  $build = [ ];
  $build ['current_user'] ['#markup'] = 'Hello ' . $cu;

  return $build;
 }
}

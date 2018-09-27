<?php

namespace Drupal\d8_routing\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\EntityManagerInterface;

/**
 * Provides a 'LastThreeArticles' block.
 *
 * @Block(
 * id = "last_three_articles",
 * admin_label = @Translation("Last three articles"),
 * )
 */
class LastThreeArticles extends BlockBase implements ContainerFactoryPluginInterface {

 /**
  * Drupal\Core\Entity\EntityManagerInterface definition.
  *
  * @var \Drupal\Core\Entity\EntityManagerInterface
  */
 protected $entityManager;
 /**
  * Constructs a new LastThreeArticles object.
  *
  * @param array $configuration
  *         A configuration array containing information about the plugin instance.
  * @param string $plugin_id
  *         The plugin_id for the plugin instance.
  * @param string $plugin_definition
  *         The plugin implementation definition.
  */
 public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityManagerInterface $entity_manager) {
  parent::__construct ( $configuration, $plugin_id, $plugin_definition );
  $this->entityTypeManager = $entity_manager;
 }
 /**
  *
  * {@inheritdoc}
  *
  */
 public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
  return new static ( $configuration, $plugin_id, $plugin_definition, $container->get ( 'entity.manager' ) );
 }
 /**
  *
  * {@inheritdoc}
  *
  */
 public function build() {
  $cache_tags = array ();
  $query = $this->entityTypeManager->getStorage ( 'node' )->getQuery ();
  $nids = $query->condition ( 'type', 'page' )->condition ( 'status', '1' )->range ( 0, 3 )->sort ( 'created', 'DESC' )->execute ();
  $nodes = $this->entityTypeManager->getStorage ( 'node' )->loadMultiple ( $nids );

  $build = [ ];
  $build ['#markup'] = '<b>Implement LastThreeArticles</b><br>';

  foreach ( $nodes as $node ) {

   $build ['#markup'] .= $node->getTitle () . "<br>";
   $cache_tags [] = 'node:' . $node->id ();
  }

  $build ['#cache'] ['max-age'] = 3600;
  $build ['#cache'] ['tags'] = $cache_tags;

  return $build;
 }
}

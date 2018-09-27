<?php

namespace Drupal\d8_routing\Controller;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;

class DataController implements ContainerInjectionInterface {
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
  * @param unknown $first_name
  * @param unknown $last_name
  */
 public function insertToTable($first_name, $last_name) {
  $this->db->insert ( 'd8_demo' )->fields ( [
    'first_name' => $first_name,
    'last_name' => $last_name
  ] )->execute ();
 }
}
<?php

namespace Drupal\d8_demo\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class DemorouteController.
 */
class DemorouteController extends ControllerBase {

 /**
  * Hellodynamic.
  *
  * @return string Return Hello string.
  */
 public function helloDynamic($name) {
  return [
    '#type' => 'markup',
    '#markup' => $this->t ( 'Hello Dynamic' )
  ];
 }

 /**
  * Hellodynamic.
  *
  * @return string Return Hello string.
  */
 public function helloWorld() {
  return [
    '#type' => 'markup',
    '#markup' => $this->t ( 'Hello World' )
  ];
 }
}

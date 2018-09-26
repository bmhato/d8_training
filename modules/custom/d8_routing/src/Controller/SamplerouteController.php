<?php

/**
 * @filesource* Routing controller for d8
 * Contains \Drupal\d8_routing\SamplerouteController.php
 **/
namespace Drupal\d8_routing\Controller;

use Drupal\user\UserInterface;
use Drupal\node\NodeInterface;

class SamplerouteController {
 /*
  * *
  *
  */
 public function GetUserList() {
  return [
    "#type" => "#markup",
    "#markup" => "List of all users"
  ];
 }
 /*
  * *
  *
  */
 public function get_user_details($uid = 2) {
  return "Looking for User ID " . $uid;
 }
 /*
  * *
  *
  */
 public function get_content_details(UserInterface $user) {
  return "Hello " . $user->getUsername ();
 }

 /*
  * *
  *
  */
 public function GetNode(NodeInterface $node) {
  $owner = $node->getOwner ()->getAccountName ();
  return [
    '#type' => '#markup',
    '#markup' => $node->getTitle () . '|' . $owner
  ];
 }
}

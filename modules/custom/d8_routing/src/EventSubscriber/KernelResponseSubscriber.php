<?php

namespace Drupal\d8_routing\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class KernelResponseSubscriber.
 */
class KernelResponseSubscriber implements EventSubscriberInterface {


  /**
   * Constructs a new KernelResponseSubscriber object.
   */
  public function __construct() {

  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {

    return $events;
  }


}

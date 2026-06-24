<?php

use Drupal\Core\Entity\Entity\EntityViewDisplay;

$view = EntityViewDisplay::load('node.program.teaser');

$view->setComponent('field_program_image', [
  'type' => 'image',
  'label' => 'hidden',
  'weight' => 0,
]);

$view->setComponent('field_program_summary', [
  'type' => 'string',
  'label' => 'hidden',
  'weight' => 1,
]);

$view->save();

print "Teaser image and summary enabled.\n";

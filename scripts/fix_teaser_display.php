<?php

use Drupal\Core\Entity\Entity\EntityViewDisplay;

$view = EntityViewDisplay::load('node.program.teaser') ?: EntityViewDisplay::create([
  'targetEntityType' => 'node',
  'bundle' => 'program',
  'mode' => 'teaser',
  'status' => TRUE,
]);

$all_fields = \Drupal::service('entity_field.manager')->getFieldDefinitions('node', 'program');

foreach ($all_fields as $field_name => $definition) {
  $view->removeComponent($field_name);
}

$view->setComponent('field_program_image', [
  'type' => 'image',
  'label' => 'hidden',
  'weight' => 0,
]);

$view->save();

print "Teaser display fixed.\n";

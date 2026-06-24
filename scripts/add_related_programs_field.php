<?php

use Drupal\field\Entity\FieldStorageConfig;
use Drupal\field\Entity\FieldConfig;
use Drupal\Core\Entity\Entity\EntityFormDisplay;

if (!FieldStorageConfig::loadByName('node', 'field_related_programs')) {
  FieldStorageConfig::create([
    'field_name' => 'field_related_programs',
    'entity_type' => 'node',
    'type' => 'entity_reference',
    'cardinality' => -1,
    'settings' => ['target_type' => 'node'],
  ])->save();
}

if (!FieldConfig::loadByName('node', 'program', 'field_related_programs')) {
  FieldConfig::create([
    'field_name' => 'field_related_programs',
    'entity_type' => 'node',
    'bundle' => 'program',
    'label' => 'Related Programs',
    'settings' => [
      'handler' => 'default:node',
      'handler_settings' => [
        'target_bundles' => ['program' => 'program'],
      ],
    ],
  ])->save();
}

$form = EntityFormDisplay::load('node.program.default');
$form->setComponent('field_related_programs', [
  'type' => 'entity_reference_autocomplete',
  'weight' => 30,
]);
$form->save();

print "Related programs field added.\n";

<?php

use Drupal\field\Entity\FieldStorageConfig;
use Drupal\field\Entity\FieldConfig;

$fields = [
  'field_program_image' => ['image', 'Hero Image'],
  'field_start_date' => ['datetime', 'Start Date'],
  'field_end_date' => ['datetime', 'End Date'],
  'field_price' => ['decimal', 'Standard Price'],
  'field_member_price' => ['decimal', 'Member Price'],
  'field_level' => ['string', 'Level'],
  'field_schedule' => ['string', 'Schedule'],
  'field_sessions' => ['integer', 'Sessions'],
  'field_class_size' => ['string', 'Class Size'],
  'field_location' => ['string', 'Location'],
];

foreach ($fields as $name => $info) {
  if (!FieldStorageConfig::loadByName('node', $name)) {
    FieldStorageConfig::create([
      'field_name' => $name,
      'entity_type' => 'node',
      'type' => $info[0],
      'cardinality' => 1,
    ])->save();
  }

  if (!FieldConfig::loadByName('node', 'program', $name)) {
    FieldConfig::create([
      'field_name' => $name,
      'entity_type' => 'node',
      'bundle' => 'program',
      'label' => $info[1],
    ])->save();
  }
}

if (!FieldStorageConfig::loadByName('node', 'field_program_category')) {
  FieldStorageConfig::create([
    'field_name' => 'field_program_category',
    'entity_type' => 'node',
    'type' => 'entity_reference',
    'settings' => ['target_type' => 'taxonomy_term'],
  ])->save();
}

if (!FieldConfig::loadByName('node', 'program', 'field_program_category')) {
  FieldConfig::create([
    'field_name' => 'field_program_category',
    'entity_type' => 'node',
    'bundle' => 'program',
    'label' => 'Program Category',
    'settings' => [
      'handler' => 'default:taxonomy_term',
      'handler_settings' => [
        'target_bundles' => ['program_category' => 'program_category'],
      ],
    ],
  ])->save();
}

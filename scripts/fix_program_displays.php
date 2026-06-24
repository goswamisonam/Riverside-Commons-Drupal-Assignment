<?php

use Drupal\field\Entity\FieldStorageConfig;
use Drupal\field\Entity\FieldConfig;
use Drupal\Core\Entity\Entity\EntityFormDisplay;
use Drupal\Core\Entity\Entity\EntityViewDisplay;

// Add body field to Program if missing.
if (!FieldConfig::loadByName('node', 'program', 'body')) {
  if (!FieldStorageConfig::loadByName('node', 'body')) {
    FieldStorageConfig::create([
      'field_name' => 'body',
      'entity_type' => 'node',
      'type' => 'text_with_summary',
      'cardinality' => 1,
    ])->save();
  }

  FieldConfig::create([
    'field_name' => 'body',
    'entity_type' => 'node',
    'bundle' => 'program',
    'label' => 'Body',
  ])->save();
}

// Form display.
$form = EntityFormDisplay::load('node.program.default') ?: EntityFormDisplay::create([
  'targetEntityType' => 'node',
  'bundle' => 'program',
  'mode' => 'default',
  'status' => TRUE,
]);

$form_fields = [
  'field_program_image' => ['type' => 'image_image', 'weight' => 1],
  'field_program_category' => ['type' => 'options_select', 'weight' => 2],
  'field_level' => ['type' => 'string_textfield', 'weight' => 3],
  'field_schedule' => ['type' => 'string_textfield', 'weight' => 4],
  'field_start_date' => ['type' => 'datetime_default', 'weight' => 5],
  'field_end_date' => ['type' => 'datetime_default', 'weight' => 6],
  'field_sessions' => ['type' => 'number', 'weight' => 7],
  'field_class_size' => ['type' => 'string_textfield', 'weight' => 8],
  'field_location' => ['type' => 'string_textfield', 'weight' => 9],
  'field_price' => ['type' => 'number', 'weight' => 10],
  'field_member_price' => ['type' => 'number', 'weight' => 11],
  'body' => ['type' => 'text_textarea_with_summary', 'weight' => 12],
];

foreach ($form_fields as $field => $component) {
  $form->setComponent($field, $component);
}
$form->save();

// Full view display.
$view = EntityViewDisplay::load('node.program.default') ?: EntityViewDisplay::create([
  'targetEntityType' => 'node',
  'bundle' => 'program',
  'mode' => 'default',
  'status' => TRUE,
]);

$view_fields = [
  'field_program_image' => ['type' => 'image', 'label' => 'hidden', 'weight' => 1],
  'field_program_category' => ['type' => 'entity_reference_label', 'label' => 'hidden', 'weight' => 2],
  'field_level' => ['type' => 'string', 'label' => 'above', 'weight' => 3],
  'field_schedule' => ['type' => 'string', 'label' => 'above', 'weight' => 4],
  'field_start_date' => ['type' => 'datetime_default', 'label' => 'above', 'weight' => 5],
  'field_end_date' => ['type' => 'datetime_default', 'label' => 'above', 'weight' => 6],
  'field_sessions' => ['type' => 'number_integer', 'label' => 'above', 'weight' => 7],
  'field_class_size' => ['type' => 'string', 'label' => 'above', 'weight' => 8],
  'field_location' => ['type' => 'string', 'label' => 'above', 'weight' => 9],
  'field_price' => ['type' => 'number_decimal', 'label' => 'above', 'weight' => 10],
  'field_member_price' => ['type' => 'number_decimal', 'label' => 'above', 'weight' => 11],
  'body' => ['type' => 'text_default', 'label' => 'hidden', 'weight' => 12],
];

foreach ($view_fields as $field => $component) {
  $view->setComponent($field, $component);
}
$view->save();

print "Program form and full display fixed.\n";

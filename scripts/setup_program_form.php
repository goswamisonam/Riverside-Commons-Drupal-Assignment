<?php

use Drupal\Core\Entity\Entity\EntityFormDisplay;

$form = EntityFormDisplay::load('node.program.default');

if (!$form) {
  $form = EntityFormDisplay::create([
    'targetEntityType' => 'node',
    'bundle' => 'program',
    'mode' => 'default',
    'status' => TRUE,
  ]);
}

$fields = [
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

foreach ($fields as $field_name => $settings) {
  $form->setComponent($field_name, $settings);
}

$form->save();

print "Program form display updated.\n";

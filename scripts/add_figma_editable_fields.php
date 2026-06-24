<?php

use Drupal\field\Entity\FieldStorageConfig;
use Drupal\field\Entity\FieldConfig;
use Drupal\Core\Entity\Entity\EntityFormDisplay;

$fields = [
  'field_program_summary' => ['string_long', 'Short Summary'],
  'field_what_youll_learn' => ['text_long', "What You'll Learn"],
  'field_whats_included' => ['text_long', "What's Included"],
  'field_instructor_name' => ['string', 'Instructor Name'],
  'field_instructor_bio' => ['text_long', 'Instructor Bio'],
  'field_instructor_image' => ['image', 'Instructor Image'],
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

$form = EntityFormDisplay::load('node.program.default');
$components = [
  'field_program_summary' => ['type' => 'string_textarea', 'weight' => 13],
  'field_what_youll_learn' => ['type' => 'text_textarea', 'weight' => 14],
  'field_whats_included' => ['type' => 'text_textarea', 'weight' => 15],
  'field_instructor_name' => ['type' => 'string_textfield', 'weight' => 16],
  'field_instructor_bio' => ['type' => 'text_textarea', 'weight' => 17],
  'field_instructor_image' => ['type' => 'image_image', 'weight' => 18],
];

foreach ($components as $field => $component) {
  $form->setComponent($field, $component);
}
$form->save();

print "Figma editable fields added.\n";

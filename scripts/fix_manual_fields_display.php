<?php

use Drupal\Core\Entity\Entity\EntityViewDisplay;

$view = EntityViewDisplay::load('node.program.default');

$fields = [
  'field_program_summary' => ['type' => 'string', 'label' => 'hidden', 'weight' => 0],
  'body' => ['type' => 'text_default', 'label' => 'hidden', 'weight' => 1],
  'field_what_youll_learn' => ['type' => 'text_default', 'label' => 'hidden', 'weight' => 2],
  'field_whats_included' => ['type' => 'text_default', 'label' => 'hidden', 'weight' => 3],
  'field_instructor_name' => ['type' => 'string', 'label' => 'hidden', 'weight' => 4],
  'field_instructor_bio' => ['type' => 'text_default', 'label' => 'hidden', 'weight' => 5],
  'field_instructor_image' => ['type' => 'image', 'label' => 'hidden', 'weight' => 6],
];

for ($i = 1; $i <= 3; $i++) {
  $fields["field_related_{$i}_image"] = ['type' => 'image', 'label' => 'hidden', 'weight' => 20 + $i];
  $fields["field_related_{$i}_label"] = ['type' => 'string', 'label' => 'hidden', 'weight' => 30 + $i];
  $fields["field_related_{$i}_title"] = ['type' => 'string', 'label' => 'hidden', 'weight' => 40 + $i];
  $fields["field_related_{$i}_meta"] = ['type' => 'string', 'label' => 'hidden', 'weight' => 50 + $i];
}

foreach ($fields as $field => $component) {
  $view->setComponent($field, $component);
}

$view->save();

print "Manual frontend display fixed.\n";

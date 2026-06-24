<?php

use Drupal\field\Entity\FieldStorageConfig;
use Drupal\field\Entity\FieldConfig;
use Drupal\Core\Entity\Entity\EntityFormDisplay;

$fields = [];

for ($i = 1; $i <= 3; $i++) {
  $fields["field_related_{$i}_image"] = ['image', "Related {$i} Image"];
  $fields["field_related_{$i}_label"] = ['string', "Related {$i} Label"];
  $fields["field_related_{$i}_title"] = ['string', "Related {$i} Title"];
  $fields["field_related_{$i}_meta"] = ['string', "Related {$i} Meta"];
}

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
$weight = 40;

for ($i = 1; $i <= 3; $i++) {
  $form->setComponent("field_related_{$i}_image", ['type' => 'image_image', 'weight' => $weight++]);
  $form->setComponent("field_related_{$i}_label", ['type' => 'string_textfield', 'weight' => $weight++]);
  $form->setComponent("field_related_{$i}_title", ['type' => 'string_textfield', 'weight' => $weight++]);
  $form->setComponent("field_related_{$i}_meta", ['type' => 'string_textfield', 'weight' => $weight++]);
}

$form->save();

print "Manual editable related cards added.\n";

<?php

use Drupal\taxonomy\Entity\Term;
use Drupal\Core\Entity\Entity\EntityViewMode;

$terms = ['Ceramics', 'Painting', 'Photography', 'Textiles'];
foreach ($terms as $name) {
  $existing = \Drupal::entityTypeManager()
    ->getStorage('taxonomy_term')
    ->loadByProperties(['vid' => 'program_category', 'name' => $name]);

  if (!$existing) {
    Term::create([
      'vid' => 'program_category',
      'name' => $name,
    ])->save();
  }
}

if (!EntityViewMode::load('node.teaser')) {
  EntityViewMode::create([
    'id' => 'node.teaser',
    'targetEntityType' => 'node',
    'status' => TRUE,
    'enabled' => TRUE,
    'label' => 'Teaser',
  ])->save();
}

print "Program taxonomy terms and teaser mode ready.\n";

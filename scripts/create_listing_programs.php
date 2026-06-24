<?php

use Drupal\node\Entity\Node;

$base = Node::load(1);
$image = !$base->get('field_program_image')->isEmpty() ? $base->get('field_program_image')->getValue() : [];

$items = [
  ['Intro to Oil Painting', 'Painting', 'Color mixing, brushwork, and composition for first-time painters.', 'Wed 6–8pm', 6, 150],
  ['Open Studio Access', 'Ceramics', 'Drop-in use of shared equipment and bench space.', 'Included with membership', 0, 0],
  ['Relief Printmaking', 'Textiles', 'Carve and hand-print bold linocut editions.', 'Thu 6–8pm', 5, 140],
  ['Teen Photography', 'Photography', 'Digital basics, composition, and darkroom printing.', 'Sat 10am–12pm', 6, 120],
  ['Spring Members’ Exhibition', 'Ceramics', 'Rotating show of work by resident and member artists.', 'Apr 4–May 30', 0, 0],
];

$terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadByProperties(['vid' => 'program_category']);
$term_map = [];
foreach ($terms as $term) {
  $term_map[$term->label()] = $term->id();
}

foreach ($items as $item) {
  [$title, $category, $summary, $schedule, $sessions, $price] = $item;

  $exists = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties([
    'type' => 'program',
    'title' => $title,
  ]);

  if ($exists) {
    continue;
  }

  $node = Node::create([
    'type' => 'program',
    'title' => $title,
    'field_program_summary' => $summary,
    'field_schedule' => $schedule,
    'field_sessions' => $sessions,
    'field_price' => $price,
    'field_level' => 'Beginner',
    'field_class_size' => '12 students',
    'field_location' => 'Riverside Studio A',
    'field_program_image' => $image,
    'status' => 1,
  ]);

  if (!empty($term_map[$category])) {
    $node->set('field_program_category', $term_map[$category]);
  }

  $node->save();
}

print "Listing programs created.\n";

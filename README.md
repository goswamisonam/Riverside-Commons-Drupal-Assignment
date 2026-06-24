# Riverside Commons Drupal Assignment

Drupal 11 + DDEV + Composer build for the Riverside Commons Program Detail page and Programs listing.

## Setup
composer install
ddev start
ddev import-db --file=database.sql.gz
unzip files.zip -d web/sites/default
ddev drush cim -y
ddev drush cr

Admin: admin / admin

## Built
- Program content type with editable fields
- Program Category taxonomy
- Program detail page desktop + mobile
- Programs listing View at /programs
- Reusable Program Card SDC
- Custom theme
- Drupal Behavior mobile nav using once()
- Sticky header and desktop registration card
- JSON-LD Event + BreadcrumbList
- Editable footer/listing settings module

## Accessibility
Added visible focus states, keyboard Escape handling for mobile nav, semantic regions, accessible buttons, and improved contrast/target sizing where needed.

## Questions & Flags
Hover/focus/empty/loading states were undefined in Figma, so accessible defaults were added. Listing category pills match the Figma visually; in production they should be wired fully to exposed taxonomy filters.

## AI Use
AI was used for scaffolding commands, README drafting, and implementation guidance. Final decisions were reviewed during build.

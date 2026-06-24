<?php

namespace Drupal\riverside_settings\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class RiversideSettingsForm extends ConfigFormBase {

  protected function getEditableConfigNames() {
    return ['riverside_settings.settings'];
  }

  public function getFormId() {
    return 'riverside_settings_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('riverside_settings.settings');

    $form['programs_intro'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Programs page intro'),
      '#default_value' => $config->get('programs_intro') ?: 'Classes, open studios, exhibitions, and workshops — something for every age and skill level.',
      '#maxlength' => 255,
    ];

    $form['cta_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CTA title'),
      '#default_value' => $config->get('cta_title') ?: 'Not sure where to start?',
      '#maxlength' => 120,
    ];

    $form['cta_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CTA text'),
      '#default_value' => $config->get('cta_text') ?: 'Become a member for open-studio access and member pricing on every class.',
      '#maxlength' => 255,
    ];

    $form['footer_copyright'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Footer Copyright text'),
      '#default_value' => $config->get('footer_copyright') ?: '© 2026 Riverside Commons · Instagram · Facebook',
      '#maxlength' => 255,
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $editable = $this->configFactory()->getEditable('riverside_settings.settings');

    foreach (['programs_intro', 'cta_title', 'cta_text', 'footer_copyright'] as $key) {
      $editable->set($key, $form_state->getValue($key));
    }

    $editable->save();

    parent::submitForm($form, $form_state);
  }

}

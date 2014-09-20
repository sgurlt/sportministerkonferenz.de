<?php

require_once 'includes/slider.inc';

function finesse_form_system_theme_settings_alter(&$form, $form_state) {


  $form['settings'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Theme settings'),
      '#weight' => 2,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['home'] = array(
      '#type' => 'fieldset',
      '#title' => t('Homepage settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );
  $form['settings']['home']['home_tagline'] = array(
      '#type' => 'textarea',
      '#title' => t('Home tagline'),
      '#default_value' => theme_get_setting('home_tagline', 'finesse'),
  );

  $form['settings']['social_links'] = array(
      '#type' => 'fieldset',
      '#title' => t('Social links settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['social_links']['twitter_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Twitter URL'),
      '#default_value' => theme_get_setting('twitter_url', 'finesse'),
  );
  $form['settings']['social_links']['facebook_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Facebook URL'),
      '#default_value' => theme_get_setting('facebook_url', 'finesse'),
  );
  $form['settings']['social_links']['google_plus_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Google+ URL'),
      '#default_value' => theme_get_setting('google_plus_url', 'finesse'),
  );
  $form['settings']['social_links']['youtube_url'] = array(
      '#type' => 'textfield',
      '#title' => t('LinkedIn URL'),
      '#default_value' => theme_get_setting('youtube_url', 'finesse'),
  );
  $form['settings']['social_links']['skype'] = array(
      '#type' => 'textfield',
      '#title' => t('Flickr URL'),
      '#default_value' => theme_get_setting('skype', 'finesse'),
  );
  $form['settings']['social_links']['rss_url'] = array(
      '#type' => 'textfield',
      '#title' => t('RSS URL'),
      '#default_value' => theme_get_setting('rss_url', 'finesse'),
  );

  $form['settings']['portfolio'] = array(
      '#type' => 'fieldset',
      '#title' => t('Portfolio settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['portfolio']['default_portfolio'] = array(
      '#type' => 'select',
      '#title' => t('Default portfolio display'),
      '#options' => array(
          '2c' => 'Portfolio - 2cols',
          '3c' => 'Portfolio - 3cols',
          '4c' => 'portfolio - 4cols',
      ),
      '#default_value' => theme_get_setting('default_portfolio', 'finesse'),
  );
  $form['settings']['portfolio']['default_nodes_portfolio'] = array(
      '#type' => 'select',
      '#title' => t('Number nodes show on portfolio page'),
      '#options' => drupal_map_assoc(array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 25, 30)),
      '#default_value' => theme_get_setting('default_nodes_portfolio', 'finesse'),
  );




  $form['settings']['footer'] = array(
      '#type' => 'fieldset',
      '#title' => t('Footer settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['footer']['footer_copyright_message'] = array(
      '#type' => 'textarea',
      '#title' => t('Footer copyright message'),
      '#default_value' => theme_get_setting('footer_copyright_message', 'finesse'),
  );

  $form['settings']['skin'] = array(
      '#type' => 'fieldset',
      '#title' => t('Skin settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['skin']['layout_style'] = array(
      '#type' => 'select',
      '#title' => t('Layout style'),
      '#options' => array(
          'wide' => t('Wide'),
          'boxed' => t('Boxed'),
      ),
      '#default_value' => theme_get_setting('layout_style', 'finesse'),
  );

  $form['settings']['skin']['wide'] = array(
      '#type' => 'fieldset',
      '#title' => t('Wide settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $wide_bg_img_options = array('none' => 'No background');

  $wide_bg_dir = drupal_get_path('theme', 'finesse') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'background-patterns' . DIRECTORY_SEPARATOR . 'wide';
  $bgs = file_scan_directory($wide_bg_dir, '/.*\.png/');

  if (!empty($bgs)) {
    foreach ($bgs as $bg) {
      if (isset($bg->filename)) {
        $wide_bg_img_options[$bg->filename] = $bg->filename;
      }
    }
  }

  $form['settings']['skin']['wide']['wide_bg_img'] = array(
      '#title' => t('Background image pattern '),
      '#type' => 'select',
      '#default_value' => theme_get_setting('wide_bg_img', 'finesse'),
      '#options' => $wide_bg_img_options,
  );


  $form['settings']['skin']['boxed'] = array(
      '#type' => 'fieldset',
      '#title' => t('Boxed settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $boxed_bg_img_options = array();
  $dir = drupal_get_path('theme', 'finesse') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'background-patterns' . DIRECTORY_SEPARATOR . 'boxed';

  $files = file_scan_directory($dir, '/.*\.png/');

  if (!empty($files)) {
    foreach ($files as $file) {
      if (isset($file->filename)) {
        $boxed_bg_img_options[$file->filename] = $file->filename;
      }
    }
  }


  $form['settings']['skin']['boxed']['boxed_bg_img'] = array(
      '#title' => t('Background image pattern '),
      '#type' => 'select',
      '#default_value' => theme_get_setting('boxed_bg_img', 'finesse'),
      '#options' => $boxed_bg_img_options,
  );

  $form['settings']['skin']['boxed']['boxed_bg_color'] = array(
      '#type' => 'select',
      '#title' => t('Background color'),
      '#default_value' => theme_get_setting('boxed_bg_color', 'finesse'),
      '#options' => array(
          'none' => 'No background color',
          '#D9D9D9' => '#D9D9D9',
          '#262626' => '#262626',
          '#F25824' => '#F25824',
          '#7EB01A' => '#7EB01A',
          '#4396BF' => '#4396BF',
          '#EB7F00' => '#EB7F00',
          '#E53C3C' => '#E53C3C',
          '#B28EB4' => '#B28EB4',
          '#CE5C76' => '#CE5C76',
          '#1693A5' => '#1693A5',
      ),
  );


  $skins_options = array();

  $dir = drupal_get_path('theme', 'finesse') . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'colors';

  $files = file_scan_directory($dir, '/.*\.css/');

  if (!empty($files)) {
    foreach ($files as $file) {
      if (isset($file->filename)) {
        $skins_options[$file->name] = $file->filename;
      }
    }
  }



  $form['settings']['skin']['skin_color'] = array(
      '#type' => 'select',
      '#title' => t('Theme color'),
      '#default_value' => theme_get_setting('skin_color', 'finesse'),
      '#options' => $skins_options,
  );




//slider
  $form['slider'] = array(
      '#type' => 'fieldset',
      '#title' => t('Slider managment'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#weight' => 100,
  );

  $banners = finesse_get_banners();
  $form['slider']['banner']['images'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Banner images'),
      '#weight' => 2,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#tree' => TRUE,
  );

  $i = 0;
  foreach ($banners as $image_data) {
    $form['slider']['banner']['images'][$i] = array(
        '#type' => 'fieldset',
        '#title' => t('Image !number: !title', array('!number' => $i + 1, '!title' => $image_data['image_title'])),
        '#weight' => $i,
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
        '#tree' => TRUE,
        // Add image config form to $form
        'image' => _finesse_banner_form($image_data),
    );

    $i++;
  }

  $form['slider']['banner']['image_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload a new image'),
      '#weight' => $i,
  );

  $form['#submit'][] = 'finesse_settings_submit';
}
<?php

include_once 'includes/custom_menu.inc';

include_once 'includes/slider.inc';

/**
 * Implements hook_preprocess_html().
 */
function finesse_preprocess_html(&$variables) {

  _finesse_add_css();
  
  
  // Cache path to theme for duration of this function:
  // Add 'viewport' meta tag:
  drupal_add_html_head(
          array(
      '#tag' => 'meta',
      '#attributes' => array(
          'name' => 'viewport',
          'content' => 'width=device-width, initial-scale=1',
      ),
          ), 'finesse:viewport_meta'
  );
}

function _finesse_add_css() {
  $theme_path = path_to_theme();

  drupal_add_css($theme_path . '/css/html5-reset.css');
  drupal_add_css($theme_path . '/css/polyglot-language-switcher.css');
  drupal_add_css($theme_path . '/css/flexslider.css');
  drupal_add_css($theme_path . '/css/jquery.fancybox.css');
  drupal_add_css($theme_path . '/css/mediaelementplayer.css');
  drupal_add_css($theme_path . '/css/shortcodes.css');
  drupal_add_css($theme_path . '/style.css');
  drupal_add_css($theme_path . '/css/finesse.css');
  drupal_add_css($theme_path . '/css/ie.css');

  $skin_color = theme_get_setting('skin_color', 'finesse');
  drupal_add_css($theme_path . '/css/colors/' . $skin_color . '.css');
}

/**
 * Implements hook_preprocess_page().
 */
function finesse_preprocess_page(&$vars) {

  if (arg(0) == 'node' && arg(1)) {
    $nid = arg(1);

    $node = node_load($nid);
    switch ($node->type) {
      case 'blog':
        $vars['title'] = t('Blog');

        break;
    }
  }


  $seach_block_form = drupal_get_form('search_block_form');
  $seach_block_form['#id'] = 'search-form';
  $seach_block_form['search_block_form']['#attributes']['placeholder'] = t('Search …');
  $seach_block_form['search_block_form']['#id'] = 's';
  $seach_block_form['actions']['submit']['#id'] = 'search-submit';

  $vars['seach_block_form'] = drupal_render($seach_block_form);

  $custom_main_menu = _custom_main_menu_render_superfish();
  if (!empty($custom_main_menu['content'])) {
    $vars['navigation'] = $custom_main_menu['content'];
  }


  if (variable_get('theme_finesse_first_install', TRUE)) {

    _finesse_install();
  }

  $banners = finesse_show_banners();
  $vars['slider'] = finesse_banners_markup($banners);
}

function finesse_form_alter(&$form, &$form_state, $form_id) {

  if (!empty($form['actions']['submit'])) {
    $form['actions']['submit']['#attributes']['class'][] = 'button';
  }
  if (isset($form['actions']['preview'])) {
    $form['actions']['preview']['#attributes']['class'][] = 'button';
  }

  if (isset($form['submit'])) {
    $form['submit']['#attributes']['class'] = array('button expand');
  }
}

function tabvn_format_comma_field($field_category, $node, $limit = NULL) {

  $content_langcode = $node->language;
  $langcode = $node->translate ? $content_langcode : LANGUAGE_NONE;

  $category_arr = array();
  $category = '';
  if (!empty($node->{$field_category}[$langcode])) {
    foreach ($node->{$field_category}[$langcode] as $item) {
      $term = taxonomy_term_load($item['tid']);
      if ($term) {
        $category_arr[] = l($term->name, 'taxonomy/term/' . $item['tid']);
      }

      if ($limit) {
        if (count($category_arr) == $limit) {
          $category = implode(', ', $category_arr);
          return $category;
        }
      }
    }
  }
  $category = implode(', ', $category_arr);

  return $category;
}

function finesse_field__field_image($variables) {
  $count = 0;
  if (!empty($variables['items'])) {
    $count = count($variables['items']);
  }
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';
  }

  // Render the items.
  //$output .= '<div class="article_media">';
  if ($count > 1) {
    $output .= '<div class="entry-slider">';
  } else {
    $output .= '<div class="entry-image">';
  }
  if ($count > 1) {
    $output .= '<ul>';
    foreach ($variables['items'] as $delta => $item) {
      $output.= '<li>';

      $output .= drupal_render($item);
      $output .= '</li>';
    }
    $output .= '</ul>';
  } else {
    foreach ($variables['items'] as $delta => $item) {

      $output .= drupal_render($item);
    }
  }


  $output .= '</div>';

  //$output .= '</div>';
  // Render the top-level DIV.
  //$output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';


  return $output;
}

function finesse_image_formatter($variables) {


  $item = $variables['item'];
  $image = array(
      'path' => $item['uri'],
  );

  if (array_key_exists('alt', $item)) {
    $image['alt'] = $item['alt'];
  }

  if (isset($item['attributes'])) {
    $image['attributes'] = $item['attributes'];
  }

  if (isset($item['width']) && isset($item['height'])) {
    $image['width'] = $item['width'];
    $image['height'] = $item['height'];
  }

  // Do not output an empty 'title' attribute.
  if (isset($item['title']) && drupal_strlen($item['title']) > 0) {
    $image['title'] = $item['title'];
  }

  if ($variables['image_style']) {
    $image['style_name'] = $variables['image_style'];
    $output = theme('image_style', $image);
  } else {
    $output = theme('image', $image);
  }

  // The link path and link options are both optional, but for the options to be
  // processed, the link path must at least be an empty string.
  if (isset($variables['path']['path'])) {
    $path = $variables['path']['path'];
    $options = isset($variables['path']['options']) ? $variables['path']['options'] : array();
    // When displaying an image inside a link, the html option must be TRUE.
    $options['html'] = TRUE;
    if ($variables['image_style'] == 'node_teaser') {
      $span_class = 'overlay link';
      if (arg(0) == 'node' && is_numeric(arg(1))) {

        //$options['attributes']['class'][] = 'fancybox';
        $span_class = 'overlay zoom';
      }
      $output = '<span class="' . $span_class . '"></span>' . $output;
    }
    $output = l($output, $path, $options);
  }

  return $output;
}

function finesse_preprocess_node(&$variables) {
  $variables['view_mode'] = $variables['elements']['#view_mode'];
  // Provide a distinct $teaser boolean.
  $variables['teaser'] = $variables['view_mode'] == 'teaser';
  $variables['node'] = $variables['elements']['#node'];
  $node = $variables['node'];

  $variables['date'] = format_date($node->created);
  $variables['name'] = theme('username', array('account' => $node));

  $uri = entity_uri('node', $node);
  $variables['node_url'] = url($uri['path'], $uri['options']);
  $variables['title'] = check_plain($node->title);
  $variables['page'] = $variables['view_mode'] == 'full' && node_is_page($node);

  // Flatten the node object's member fields.
  $variables = array_merge((array) $node, $variables);

  // Helpful $content variable for templates.
  $variables += array('content' => array());
  foreach (element_children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }

  // Make the field variables available with the appropriate language.
  field_attach_preprocess('node', $node, $variables['content'], $variables);

  // Display post information only on certain node types.
  if (variable_get('node_submitted_' . $node->type, TRUE)) {
    $variables['display_submitted'] = TRUE;
    //$variables['submitted'] = t('Submitted by !username on !datetime', array('!username' => $variables['name'], '!datetime' => $variables['date']));

    $node_url = url('node/' . $node->nid);
    $submitted = '<a href="' . $node_url . '" class="post-format-wrap" title="' . $node->title . '"><span class="post-format standard">' . t('Permalink') . '</span></a>';
    $node_date = format_date($node->created, 'custom', 'M d, Y');
    $submitted .= '<span><span class="title">' . t('Posted') . ':</span> ' . $node_date . ' by ' . $variables['name'] . '</span>';
    $submitted .= '<span><span class="title"> ' . t('Tags') . ':</span> ' . tabvn_format_comma_field('field_tags', $node) . '</span>';
    $submitted .= '<span><span class="title"> ' . t('Comments') . ':</span> <a href="' . $node_url . '">' . $node->comment_count . '</a></span>';
    $variables['submitted'] = $submitted;
    $variables['user_picture'] = theme_get_setting('toggle_node_user_picture') ? theme('user_picture', array('account' => $node)) : '';
  } else {
    $variables['display_submitted'] = FALSE;
    $variables['submitted'] = '';
    $variables['user_picture'] = '';
  }

  // Gather node classes.
  $variables['classes_array'][] = drupal_html_class('node-' . $node->type);
  if ($variables['promote']) {
    $variables['classes_array'][] = 'node-promoted';
  }
  if ($variables['sticky']) {
    $variables['classes_array'][] = 'node-sticky';
  }
  if (!$variables['status']) {
    $variables['classes_array'][] = 'node-unpublished';
  }
  if ($variables['teaser']) {
    $variables['classes_array'][] = 'node-teaser';
  }
  if (isset($variables['preview'])) {
    $variables['classes_array'][] = 'node-preview';
  }

  // Clean up name so there are no underscores.
  $variables['theme_hook_suggestions'][] = 'node__' . $node->type;
  $variables['theme_hook_suggestions'][] = 'node__' . $node->nid;
}

function finesse_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.
  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next ›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));

  if ($pager_total[$element] > 1) {
    if ($li_first) {
      $items[] = array(
          'class' => array('pager-first'),
          'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
          'class' => array('pager-previous'),
          'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
            'class' => array('pager-ellipsis'),
            'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
              'class' => array('pager-item'),
              'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
              'class' => array('pager-current', 'current'),
              'data' => $i,
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
              'class' => array('pager-item'),
              'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
            'class' => array('pager-ellipsis'),
            'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
          'class' => array('pager-next'),
          'data' => $li_next,
      );
    }
    if ($li_last) {
      $items[] = array(
          'class' => array('pager-last'),
          'data' => $li_last,
      );
    }
    return '<nav class="page-nav"><h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
                'items' => $items,
                'attributes' => array('class' => array('tabvn-pager')),
            )) . '</nav>';
  }
}

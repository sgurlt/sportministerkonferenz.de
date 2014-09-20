<!DOCTYPE HTML>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js"> <!--<![endif]-->
  <head profile="<?php print $grddl_profile; ?>">
    <?php print $head; ?>
    <title><?php print $head_title; ?></title>
    <?php print $styles; ?>
    <?php print $scripts; ?>


    <?php
    $bg_image = 'none';

    $theme_style = theme_get_setting('layout_style', 'finesse');
    if ($theme_style == 'boxed') {
      $classes .= ' boxed';
      $box_image = theme_get_setting('boxed_bg_img', 'finesse');

      if ($box_image != 'none') {
        $bg_image = 'url("' . base_path() . path_to_theme() . '/images/background-patterns/boxed/' . $box_image . '") !important';
      }

      $bg_color = theme_get_setting('boxed_bg_color', 'finesse');
    } else {

      $wide_image = theme_get_setting('wide_bg_img', 'finesse');
      if ($wide_image != 'none') {
        $bg_image = 'url("' . base_path() . path_to_theme() . '/images/background-patterns/wide/' . $wide_image . '") !important';
      }
    }
    ?>

    <style type="text/css">
      body{

        background-image: <?php print $bg_image; ?>;
        <?php if (!empty($bg_color) && $bg_color != 'none'): ?>
          background: <?php print $bg_color; ?> !important;
        <?php endif; ?>
      }
    </style>

  </head>


  <body class="<?php print $classes; ?>" <?php print $attributes; ?>>
    <div id="skip-link">
      <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
    </div>
    <?php print $page_top; ?>
    <?php print $page; ?>
    <?php print $page_bottom; ?>
  </body>
</html>

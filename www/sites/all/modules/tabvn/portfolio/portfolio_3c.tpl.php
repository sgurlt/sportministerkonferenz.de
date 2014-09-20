
<?php
require_once 'portfolio_filter.tpl.php';
?>

<?php if (!empty($nodes)): ?>
  <!-- begin gallery -->

  <ul id="gallery" class="portfolio-grid clearfix">
    <?php foreach ($nodes as $node) : ?>

      <?php
      $content_langcode = $node->language;
      $langcode = $node->translate ? $content_langcode : LANGUAGE_NONE;

      $image_full = '';
      if (!empty($node->field_image[$langcode][0]['uri'])) {
        $image_full = file_create_url($node->field_image[$langcode][0]['uri']);
      }
      ?>

      <li data-id="id-1" data-type="<?php print portfolio_format_terms('field_portfolio_category', $node); ?>" class="entry one-third">
        <?php
        $image_uri = $node->field_image[$langcode][0]['uri'];
        $image_url = file_create_url($image_uri);
        $style_name = 'portfolio_item';
        $node_url = url('node/' . $node->nid);
        $node_title = $node->title;
        ?>
        <div class="entry-image">
          <a class="fancybox" href="<?php print $image_full; ?>" title="<?php print $node->title; ?>"><span class="overlay zoom"></span>
            <?php print theme('image_style', array('style_name' => $style_name, 'path' => $image_uri)); ?>
          </a>
        </div>
        <h4 class="entry-title"><a href="<?php print $node_url; ?>"><?php print $node_title; ?></a></h4>

      </li>
    <?php endforeach; ?>

  </ul>

<?php endif; ?>
<!-- end gallery -->
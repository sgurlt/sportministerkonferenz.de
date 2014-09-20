<?php
$content_langcode = $node->language;
$langcode = $node->translate ? $content_langcode : LANGUAGE_NONE;
?>
<article class="<?php print $classes; ?> entry clearfix">
  <div id="node-<?php print $node->nid; ?>" class="clearfix"<?php print $attributes; ?>>
    <div class="three-fourths">
      <?php print render($content['field_image']); ?>
    </div>

    <div class="one-fourth column-last">
      <h3><?php print t('Overview'); ?></h3>
      <?php if ($display_submitted): ?>
        <div class="submitted entry-meta">
          <?php print $submitted; ?>
        </div>
      <?php endif; ?>

      <div class="entry-body">
        <?php print render($title_prefix); ?>
        <?php if (!$page): ?>
          <h2<?php print $title_attributes; ?> class="entry-title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
        <?php endif; ?>
        <?php print render($title_suffix); ?>

        <?php if ($page && $node->type == 'blog') : ?>
          <h2 class="entry-title"><?php print $title; ?></h2>
        <?php endif; ?>

        <div class="entry-content content"<?php print $content_attributes; ?>>
          <?php
          // We hide the comments and links now so that we can render them later.
          hide($content['comments']);
          hide($content['links']);
          hide($content['field_tags']);
          hide($content['field_website']);
          print render($content);
          ?>
          <?php if (!empty($node->field_website)): ?>
            <a class="button" href="<?php print url($node->field_website[$langcode][0]['value']); ?>"><?php print t('Visit Website'); ?></a>
          <?php endif; ?>
        </div>
      </div>

    </div>
    <?php
    if ($page) {
      print render($content['links']);
    }
    ?>
    <?php print render($content['comments']); ?>

  </div>
</article>
<?php
if (empty($titel)) {
  $title = t('Latest posts');
}
?>
<!-- begin latest posts -->
<section>
  <h2><?php print $title; ?> <span class="more">&ndash; <a href="blog.html">View All Posts &raquo;</a></span></h2>

  <!-- begin post carousel -->
  <ul class="post-carousel">
    <?php foreach ($nodes as $node): ?>
      <?php
      $content_langcode = $node->language;
      $langcode = $node->translate ? $content_langcode : LANGUAGE_NONE;
      $node_url = url('node/' . $node->nid);
      ?>
      <li class="entry">
        <?php
        if (!empty($node->field_image[$langcode])) {
          $image_uri = $node->field_image[$langcode][0]['uri'];

          $style_name = 'portfolio_item';

          $image = theme('image_style', array('style_name' => $style_name, 'path' => $image_uri));
        }
        ?>

        <?php if (!empty($image)): ?>
          <div class="entry-image">
            <a href="<?php print $node_url ?>" title="<?php print $node->title; ?>"><span class="overlay link"></span>
              <?php print $image; ?>
            </a>
          </div>
        <?php endif; ?>

        <div class="entry-meta">
          <a href="<?php print $node_url; ?>" class="post-format-wrap" title="<?php print $node->title; ?>"><span class="post-format standard"><?php print t('Permalink'); ?></span></a>
          <span><?php print format_date($node->created, 'custom', 'M d, Y'); ?></span>
        </div>
        <div class="entry-body">
          <h4 class="entry-title"><a href="<?php print $node_url; ?>"><?php print $node->title; ?></a></h4>
          <div class="entry-content">
            <?php print custom_trim_text(array('html' => TRUE, 'ellipsis' => TRUE, 'max_length'=>90), $node->body[$langcode][0]['value']); ?>
          </div>
        </div>
      </li>
    <?php endforeach; ?>

  </ul>
  <!-- end post carousel -->
</section>
<!-- end latest posts -->
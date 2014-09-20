<?php
if (empty($title)) {
  $title = t('Recent Work');
}
?>
<!-- begin selected projects -->
<section>
  <h2><?php print $title; ?> <span class="more">&ndash; <a href="<?php print url('portfolio'); ?>"><?php print t('View All Projects'); ?> &raquo;</a></span></h2>

  <!-- begin project carousel -->
  <ul class="project-carousel">


    <?php foreach ($nodes as $node): ?>
      <?php
      $content_langcode = $node->language;
      $langcode = $node->translate ? $content_langcode : LANGUAGE_NONE;
      $node_url = url('node/' . $node->nid);

      if (!empty($node->field_image[$langcode])) {
        $image_uri = $node->field_image[LANGUAGE_NONE][0]['uri'];
        $image_url = file_create_url($image_uri);
        $style_name = 'portfolio_item';


        $image = theme('image_style', array('style_name' => $style_name, 'path' => $image_uri));
        $image_full = file_create_url($image_uri);
      }
      ?>
      <li class="entry">
        <?php if (!empty($image)): ?>
          <div class="entry-image">
            <a class="fancybox" href="<?php print $image_full ?>" title="<?php print $node->title; ?>"><span class="overlay zoom"></span>
              <?php print $image; ?>
            </a>
          </div>
        <?php endif; ?>
        <h4 class="entry-title"><a href="<?php print $node_url; ?>"><?php print $node->title; ?></a></h4>

      </li>
    <?php endforeach; ?>
  </ul>
  <!-- end project carousel -->
</section>
<!-- end selected projects -->
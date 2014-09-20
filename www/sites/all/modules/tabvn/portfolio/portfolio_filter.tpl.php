
<div id="filter">
  <span><?php print t('Filter'); ?>:</span>
  <?php
  $terms = array();
  $vid = NULL;
  $vid_machine_name = 'portfolio_categories';
  $vocabulary = taxonomy_vocabulary_machine_name_load($vid_machine_name);
  if (!empty($vocabulary->vid)) {
    $vid = $vocabulary->vid;
  }
  if (!empty($vid)) {
    $terms = taxonomy_get_tree($vid);
  }
  ?>
  <?php if (!empty($terms)): ?>
    <ul>
      <li class="active"><a href="#" class="all"><?php print t('All'); ?></a></li>
      <?php foreach ($terms as $term): ?>
        <li><a href="#" class="tid-<?php print $term->tid; ?>"><?php print $term->name; ?></a></li>
      <?php endforeach; ?>

    </ul>
  <?php endif; ?>
</div>
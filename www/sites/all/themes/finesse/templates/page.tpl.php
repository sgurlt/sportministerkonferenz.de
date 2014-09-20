<!-- begin container -->
<div id="wrap">
  <!-- begin header -->
  <header id="header" class="container">
    <!-- begin header top -->
    <section id="header-top" class="clearfix">
      <!-- begin header left -->
      <div class="one-half"> 
	  
	  <div class="logo smk"><img src="/sites/all/themes/finesse/images/smklogo.png"></div>
      <!--  <?php if ($logo): ?><h1 id="logo"><a href="<?php print $front_page; ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"></a></h1><?php endif; ?> -->
        <?php if ($site_slogan): ?><p id="tagline"><?php print $site_slogan; ?></p><?php endif; ?>
      </div>
      <!-- end header left -->

      <!-- begin header right -->
      <div class="one-half column-last">
        <?php print render($page['header']); ?>
      </div>
      <!-- end header right -->
    </section>
    <!-- end header top -->

    <!-- begin navigation bar -->
    <section id="navbar" class="clearfix">
      <!-- begin navigation -->
      <?php if (!empty($navigation)): ?>
        <nav id="nav">
          <?php print $navigation; ?>
        </nav>
        <!-- end navigation -->
      <?php endif; ?>

      <?php if (!empty($seach_block_form)): ?>
        <!-- begin search form -->
        <?php print $seach_block_form; ?>
        <!-- end search form -->
      <?php endif; ?>
    </section>
    <!-- end navigation bar -->

  </header>
  <!-- end header -->

  <!-- begin content -->
  <section id="content" class="container clearfix">

    <?php if (drupal_is_front_page() && !empty($slider)): ?>
      <!-- begin slider -->
      <section id="slider-home">
        <div class="flex-container">
          <div class="flexslider">
            <?php print $slider; ?>
          </div>
        </div>
      </section>
      <!-- end slider -->
    <?php endif; ?>


    <?php $tagline = theme_get_setting('home_tagline', 'finesse'); ?>
    <?php if (drupal_is_front_page() && !empty($tagline)): ?>
      <!-- begin infobox -->
      <section>
        <div class="infobox">
          <div class="infobox-inner">
            <?php print $tagline; ?>
          </div>
        </div>
      </section>
      <!-- end infobox -->
    <?php endif; ?>

 <?php if (!drupal_is_front_page()):?>	
    <?php
    $content_class = 'main-content';
    if ($page['sidebar_second'] || $page['sidebar_first']) {

      if ($page['sidebar_second']) {
        $content_class = 'three-fourths';
      } else {
        $content_class = 'three-fourths column-last';
      }
    }
    if (arg(0) == 'blog') {
      $content_class .= ' blog-entry-list';
    }
    ?>
    <?php if ($title): ?>
      <header id="page-header">
        <h1 id="page-title"><?php print $title; ?></h1>	
      </header>
    <?php endif; ?>

    <?php if ($page['highlighted']): ?>
      <section>
        <?php print render($page['highlighted']); ?>
      </section>
    <?php endif; ?>
    <?php if ($page['sidebar_first']): ?>
      <aside class="one-fourth" id="sidebar">
        <?php print render($page['sidebar_first']); ?>

      </aside>
    <?php endif; ?>

    <section id="main" class="<?php print $content_class; ?>">
      <?php print $messages; ?>
      <?php if (!empty($tabs['#primary']) || !empty($tabs['#secondary'])): ?>
        <div class="tabs">
          <?php print render($tabs); ?>
        </div>
      <?php endif; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </section>

    <?php if ($page['sidebar_second']): ?>
      <aside class="one-fourth column-last" id="sidebar">
        <?php print render($page['sidebar_second']); ?>

      </aside>
    <?php endif; ?>
   <?php endif; ?>

  </section>
  <!-- end content -->      

  <!-- begin footer -->
  <footer id="footer">
    <div class="container">
      <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
        <!-- begin footer top -->
        <div id="footer-top">

          <div class="one-fourth">
            <?php print render($page['footer_firstcolumn']); ?>
          </div>


          <div class="one-fourth">
            <?php print render($page['footer_secondcolumn']); ?>

          </div>
          <div class="one-fourth">

            <?php print render($page['footer_thirdcolumn']); ?>

          </div>
          <div class="one-fourth column-last">
            <div class="widget contact-info">
              <?php print render($page['footer_fourthcolumn']); ?>
<!--              <div class="social-links">
                <h4><?php print t('Follow Us'); ?></h4>
                <?php
                $twitter_url = theme_get_setting('twitter_url', 'finesse');
                $facebook_url = theme_get_setting('facebook_url', 'finesse');
                $google_plus_url = theme_get_setting('google_plus_url', 'finesse');
                $youtube = theme_get_setting('youtube_url', 'finesse');
                $skkype = theme_get_setting('skype', 'finesse');
                $rss_url = theme_get_setting('rss_url', 'finesse');

                $theme_path = base_path() . path_to_theme();
                ?>
                <ul>
                  <li class="twitter"><a href="<?php print $twitter_url; ?>" title="Twitter" target="_blank">Twitter</a></li>
                  <li class="facebook"><a href="<?php print $facebook_url; ?>" title="Facebook" target="_blank">Facebook</a></li>
                  <li class="google"><a href="<?php print $google_plus_url; ?>" title="Google+" target="_blank">Google+</a></li>
                  <li class="youtube"><a href="<?php print $youtube; ?>" title="YouTube" target="_blank">YouTube</a></li>
                  <li class="skype"><a href="skype:<?php $skkype; ?>?call" title="Skype">Skype</a></li>
                  <li class="rss"><a href="<?php print $rss_url; ?>" title="RSS" target="_blank">RSS</a></li>
                </ul>
              </div> -->
            </div>
          </div>
        </div>
        <!-- end footer top -->
      <?php endif; ?>


      <!-- begin footer bottom -->
      <div id="footer-bottom">
        <div class="one-half">
        </div>

        <div class="one-half column-last footer_navi">
          <?php print render($page['footer']); ?>
        </div>
      </div>
      <!-- end footer bottom -->
    </div>
  </footer>
  <!-- end footer -->
</div>
<!-- end container -->

<!--
Template Name: photography
-->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <?php get_header(); ?>
</head>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
  <main>
    <div class="page-loader">
      <div class="loader">Loading...</div>
    </div>
    <?php get_template_part('template/navbar'); ?>
    <div class="main">
      <section class="module bg-dark-60 portfolio-page-header"
        data-background="<?php echo get_template_directory_uri(); ?>/assets/images/backgrounds/DSC08044.jpg">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt">Photography Gallery</h2>
              <div class="module-subtitle font-serif">誰かのココロに残るような写真撮るにはどうすればいいか？ いつも考えながらシャッターを切っています。</br>How can I
                take pictures that will stay in someone's heart? I am always thinking about this as I release the
                shutter.</div>
              <div class="text-center"><a class="btn btn-w btn-round"
                  href="https://www.instagram.com/safu0822_underwater/" target="_blank">follow my <i
                    class="fa fa-instagram">!!</i></a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="module">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <ul class="filter font-alt" id="filters">
                <li><a class="current wow fadeInUp" href="#" data-filter="*">All</a></li>
                <li><a class="wow fadeInUp" href="#" data-filter=".macro" data-wow-delay="0.5s">Macro</a>
                </li>
                <li><a class="wow fadeInUp" href="#" data-filter=".wide" data-wow-delay="0.5s">Wide</a></li>
                <li><a class="wow fadeInUp" href="#" data-filter=".landscape" data-wow-delay="0.5s">Landscape</a>
                </li>
                <li><a class="wow fadeInUp" href="#" data-filter=".wreck" data-wow-delay="0.5s">Wreck</a></li>
                <li><a class="wow fadeInUp" href="#" data-filter=".daily" data-wow-delay="0.5s">Daily</a></li>
              </ul>
            </div>
          </div>
          <div class="row multi-columns-row">
            <ul class="works-grid works-grid-gut works-grid-4 works-hover-w" id="gallery-grid">
              <?php if ( have_posts() ) : ?>
              <?php while ( have_posts() ) : the_post(); ?>
              <!-- 繰り返したい内容　ここから -->
              <?php
                $terms = get_the_terms(get_the_ID(), 'genre');
                  if ($terms && !is_wp_error($terms)) {
                      $slugs = array();
                      foreach ($terms as $term) {
                          $slugs[] = $term->slug;
                      }
                      $insertTags = implode(' ', $slugs);
                  }
              ?>

              <?php
                $content = get_the_content();
                preg_match_all('/<img[^>]+src="([^">]+)"/i', $content, $matches);
                  foreach ($matches[1] as $src) {
                    $insert_src = $src;
                  }
              ?>

              <li class="photography-item <?php echo $insertTags; ?> col-sm-6 col-md-3 col-lg-3">
                <div class="gallery-item">
                  <div class="gallery-image">
                    <a class="gallery" href="<?php echo $insert_src; ?>" title="<?php echo get_the_title(); ?>">
                      <?php the_post_thumbnail(array( 640, 360 )); ?>
                      <div class=" gallery-caption">
                        <div class="gallery-icon">
                          <span class="icon-magnifying-glass"></span>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </li>
              <!-- 繰り返したい内容　ここまで -->
              <?php endwhile; ?>
              <?php else : ?>
              <p>まだ投稿はありません。</p>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </section>
  </main>
  <?php get_footer(); ?>
</body>

</html>
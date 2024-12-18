<!--
Template Name: works
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
        data-background="<?php echo get_template_directory_uri(); ?>/assets/images/backgrounds/21830aIMGL99841974_TP_V.jpg">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt">MY works list</h2>
              <div class="module-subtitle font-serif">「9割の使いやすさと1割の遊び心」<br>使ってくれる人が楽しみながらできるだけ使いやすいように。</br>90% ease of
                use and 10% playfulness” </br>We try to make our products as easy to use as possible for the people who
                use them.</div>
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
                <li><a class="wow fadeInUp" href="#" data-filter=".application" data-wow-delay="0.5s">Application</a>
                </li>
                <li><a class="wow fadeInUp" href="#" data-filter=".diving" data-wow-delay="0.5s">Diving</a></li>
                <li><a class="wow fadeInUp" href="#" data-filter=".photography" data-wow-delay="0.5s">Photography</a>
                </li>
                <li><a class="wow fadeInUp" href="#" data-filter=".webdesign" data-wow-delay="0.5s">Web Design</a></li>
              </ul>
            </div>
          </div>
          <ul class="works-grid works-grid-gut works-grid-3 works-hover-w" id="works-grid">
            <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <!-- 繰り返したい内容　ここから -->
            <?php
                $terms = get_the_terms(get_the_ID(), 'work_category');
                  if ($terms && !is_wp_error($terms)) {
                      $slugs = array();
                      foreach ($terms as $term) {
                          $slugs[] = $term->slug;
                      }
                      $insertTags = implode(' ', $slugs);
                  }
              ?>

            <li class="work-item <?php echo $insertTags; ?>">
              <a href="<?php the_permalink(); ?>">
                <div class="work-image">
                  <?php the_post_thumbnail(array(940, 567)); ?>
                </div>
                <div class="work-caption font-alt">
                  <h3 class="work-title"><?php the_title(); ?></h3>
                  <div class="work-descr"><?php echo $insertTags; ?></div>
                </div>
              </a>
            </li>

            <?php endwhile; ?>
            <?php else : ?>
            <p>まだ投稿はありません。</p>
            <?php endif; ?>
          </ul>
        </div>
      </section>
  </main>
  <?php get_footer(); ?>
</body>

</html>
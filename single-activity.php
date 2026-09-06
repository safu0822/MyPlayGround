<!--
Template Name: activity-detail
-->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <?php get_header(); ?>
</head>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
  <main class="single-activity-main">
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <?php
      $content = get_the_content();
    ?>
    <?php
      $terms = get_the_terms(get_the_ID(), 'activity_category');
    ?>
    <div class="page-loader">
      <div class="loader">Loading...</div>
    </div>
    <?php get_template_part('template/navbar'); ?>
    <?php get_template_part('template/header-single'); ?>
    <div class="main">
      <?php get_template_part('template/activity-explain', null, ['content' => $content]); ?>
      <?php get_template_part('template/image-slider-box', null, ['content' => $content, 'terms' => $terms]); ?>
      <?php get_template_part('template/activity-policy', null, ['content' => $content]); ?>
      <?php get_template_part('template/timeline', null, ['content' => $content]); ?>
      <section class="module-small bg-blue">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center">
              <h3 class="font-alt mb-20">そのほかのアクティビティはこちら！</h3>
            </div>
          </div>
        </div>
      </section>
      <?php get_template_part('template/recommend-tour'); ?>
      <?php get_template_part('template/activity-liner'); ?>
      <?php get_template_part('template/latest-blog'); ?>
      <?php endwhile; ?>
      <?php else : ?>
      <p>投稿の詳細がありません</p>
      <?php endif; ?>
  </main>
  <?php get_footer(); ?>
</body>

</html>
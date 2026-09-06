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
      <section class="module">
        <div class="container">
          <div class="row">
            <div class="col-sm-8">
              <?php if ( have_posts() ) : ?>
              <?php while ( have_posts() ) : the_post(); ?>
              <div class="blog-contents">
                <div class="breadcrumb-wrapper">
                  <ol class="breadcrumb-white">
                    <li><a href="/news">ホーム</a></li>
                    <li><?php the_title() ?></a></li>
                  </ol>
                </div>
                <div class="blog-title">
                  <h1>
                    <?php the_title() ?>
                  </h1>
                </div>
                <div class="blog-main">
                  <div class="post-meta">By&nbsp;<a href="#"><?php the_author_meta('display_name'); ?></a>|
                    <?php the_date(); ?>
                  </div>
                  <?php the_content() ?>
                </div>
              </div>
              <?php endwhile; ?>
              <?php else : ?>
              <p>まだコンテンツがありません。</p>
              <?php endif; ?>
            </div>
            <?php get_template_part('sidebar-news'); ?>
          </div>
        </div>
        <div class="blog-single-backall">
          <div class="text-center"><a class="btn btn-border-d mt-100"
              href="<?php echo esc_url( home_url( '/news' ) ); ?>">Back to All news</a>
          </div>
        </div>
    </div>
    </section>
  </main>
  <?php get_footer(); ?>
</body>

</html>
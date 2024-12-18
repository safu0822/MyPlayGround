<!--
Template Name: NewsList
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
      <section class="module bg-dark-60 blog-page-header">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt">
                <?php echo '「'.get_search_query().'」の検索結果：' .$wp_query->found_posts. ' 件の記事が該当しました。';?></h2>
            </div>
          </div>
        </div>
      </section>
      <section class="module">
        <div class="container">
          <?php get_sidebar(); ?>
          <div class="col-sm-8 col-sm-offset-1">
            <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <?php
                $terms = get_the_terms(get_the_ID(), 'blog_category');
                $tag_terms = get_the_terms(get_the_ID(), 'blog_tag');
              ?>
            <div class="post">
              <div class="post-thumbnail"><a
                  href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array( 640, 360 )); ?></a></div>
              <div class="post-header font-alt">
                <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-meta">By&nbsp;<a href="#"><?php the_author_meta('display_name'); ?></a>|
                  <?php the_date(); ?> |
                  <?php foreach ($terms as $term) : ?>
                  <a href="#<?php echo $term->slug; ?>"><?php echo $term->slug; ?></a>
                  <?php endforeach; ?> |
                  <?php foreach ($tag_terms as $term) : ?>
                  <a href="#<?php echo $term->slug; ?>"><?php echo $term->slug; ?></a>
                  <?php endforeach; ?>
                </div>
              </div>
              <div class="post-entry">
                <p><?php echo get_custom_post_excerpt(get_the_ID()); ?></p>
              </div>
              <div class="post-more"><a class="more-link" href="<?php the_permalink(); ?>">Read more</a></div>
            </div>
            <?php endwhile; ?>
            <?php else : ?>
            <p>該当の投稿はありません。</p>
            <?php endif; ?>
            <div class="pagination font-alt">
              <?php
                  echo paginate_links(array(
                      'total' => $wp_query->max_num_pages,
                      'prev_text' => '<i class="fa fa-angle-left"></i>',
                      'next_text' => '<i class="fa fa-angle-right"></i>',
                  ));
                  ?>
            </div>
          </div>
        </div>
    </div>
    </section>
  </main>
  <?php get_footer(); ?>
</body>

</html>
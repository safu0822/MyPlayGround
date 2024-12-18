<!--
Template Name: workdetail
-->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <?php get_header(); ?>
</head>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
  <main>
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <?php
      $content = get_the_content();
      preg_match_all('/<img[^>]+src="([^">]+)"/i', $content, $matches);
    ?>

    <div class="page-loader">
      <div class="loader">Loading...</div>
    </div>
    <?php get_template_part('template/navbar'); ?>
    <div class="main">
      <section class="module bg-dark-60 portfolio-page-header"
        data-background="<?php echo get_the_post_thumbnail_url(); ?>">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt"><?php the_title(); ?></h2>
              <div class="module-subtitle font-serif"><?php echo get_post_meta( get_the_ID(), 'introduction', true) ?>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="module">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-md-8 col-lg-8">
              <div class="post-images-slider">
                <ul class="slides">
                  <?php foreach ($matches[1] as $src) : ?>
                  <li><img class="center-block" src="<?php echo $src; ?>" alt="Slider Image" /></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class="work-details">
                <h5 class="work-details-title font-alt">Project Details</h5>
                <p><?php echo get_post_meta( get_the_ID(), 'detail', true) ?>
                </p>
                <ul>
                  <li><strong>Client: </strong><span class="font-serif"><a href="#"
                        target="_blank"><?php echo get_post_meta( get_the_ID(), 'client', true) ?></a></span>
                  </li>
                  <li><strong>Date: </strong><span class="font-serif"><a href="#"
                        target="_blank"><?php echo get_post_meta( get_the_ID(), 'date', true) ?></a></span>
                  </li>
                  <li><strong>Online: </strong><span class="font-serif"><a href="#"
                        target="_blank"><?php echo get_post_meta( get_the_ID(), 'online', true) ?></a></span>
                  </li>
                </ul>
                <div class="text-center"><a class="btn btn-border-d mt-50"
                    href="<?php echo get_post_meta( get_the_ID(), 'github', true) ?>" target="_blank">github <i
                      class="fa fa-github"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="module">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <h5 class="font-alt mb-20">Skills for this project</h5><br>
              <h6 class="font-alt"><span class="<?php echo get_post_meta( get_the_ID(), 'icon1', true) ?>"></span>
                <?php echo get_post_meta( get_the_ID(), 'skill1', true) ?>
              </h6>
              <div class="progress">
                <div class="progress-bar pb-dark"
                  aria-valuenow="<?php echo get_post_meta( get_the_ID(), 'progress1', true) ?>" role="progressbar"
                  aria-valuemin="0" aria-valuemax="100"><span class="font-alt"></span></div>
              </div>
              <h6 class="font-alt"><span class="<?php echo get_post_meta( get_the_ID(), 'icon2', true) ?>"></span>
                <?php echo get_post_meta( get_the_ID(), 'skill2', true) ?>
              </h6>
              <div class="progress">
                <div class="progress-bar pb-dark"
                  aria-valuenow="<?php echo get_post_meta( get_the_ID(), 'progress2', true) ?>" role="progressbar"
                  aria-valuemin="0" aria-valuemax="100"><span class="font-alt"></span></div>
              </div>
              <h6 class="font-alt"><span class="<?php echo get_post_meta( get_the_ID(), 'icon3', true) ?>"></span>
                <?php echo get_post_meta( get_the_ID(), 'skill3', true) ?>
              </h6>
              <div class="progress">
                <div class="progress-bar pb-dark"
                  aria-valuenow="<?php echo get_post_meta( get_the_ID(), 'progress3', true) ?>" role="progressbar"
                  aria-valuemin="0" aria-valuemax="100"><span class="font-alt"></span></div>
              </div>
              <h6 class="font-alt"><span class="<?php echo get_post_meta( get_the_ID(), 'icon4', true) ?>"></span>
                <?php echo get_post_meta( get_the_ID(), 'skill4', true) ?>
              </h6>
              <div class="progress">
                <div class="progress-bar pb-dark"
                  aria-valuenow="<?php echo get_post_meta( get_the_ID(), 'progress4', true) ?>" role="progressbar"
                  aria-valuemin="0" aria-valuemax="100"><span class="font-alt"></span></div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
              <div class="alt-features-item mt-20">
                <div class="alt-features-icon"><span
                    class="<?php echo get_post_meta( get_the_ID(), 'icon1', true) ?>"></span></div>
                <h3 class="alt-features-title font-alt"><?php echo get_post_meta( get_the_ID(), 'skill1', true) ?></h3>
                <?php echo get_post_meta( get_the_ID(), 'skillDetail1', true) ?>
              </div>
              <div class="alt-features-item">
                <div class="alt-features-icon"><span
                    class="<?php echo get_post_meta( get_the_ID(), 'icon2', true) ?>"></span></div>
                <h3 class="alt-features-title font-alt"><?php echo get_post_meta( get_the_ID(), 'skill2', true) ?></h3>
                <?php echo get_post_meta( get_the_ID(), 'skillDetail2', true) ?>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
              <div class="alt-features-item mt-20">
                <div class="alt-features-icon"><span
                    class="<?php echo get_post_meta( get_the_ID(), 'icon3', true) ?>"></span></div>
                <h3 class="alt-features-title font-alt"><?php echo get_post_meta( get_the_ID(), 'skill3', true) ?></h3>
                <?php echo get_post_meta( get_the_ID(), 'skillDetail3', true) ?>
              </div>
              <div class="alt-features-item">
                <div class="alt-features-icon"><span
                    class="<?php echo get_post_meta( get_the_ID(), 'icon4', true) ?>"></span></div>
                <h3 class="alt-features-title font-alt"><?php echo get_post_meta( get_the_ID(), 'skill4', true) ?></h3>
                <?php echo get_post_meta( get_the_ID(), 'skillDetail4', true) ?>
              </div>
            </div>
          </div>
          <div class="text-center"><a class="btn btn-border-d mt-50" href="/works">back to Works</a>
          </div>
      </section>
      <hr class="divider-w">
      <?php endwhile; ?>
      <?php else : ?>
      <p>投稿の詳細がありません</p>
      <?php endif; ?>
  </main>
  <?php get_footer(); ?>
</body>

</html>
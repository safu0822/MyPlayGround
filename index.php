<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <?php get_header(); ?>
</head>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="10">
  <main>
    <div class="page-loader">
      <div class="loader">Loading...</div>
    </div>
    <nav class="navbar navbar-custom navbar-fixed-top navbar-transparent" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span
              class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a
            href="/"><img class="navbar-brand"
              src='<?php echo get_template_directory_uri(); ?>/assets/images/navbar/websitlogo.svg'></a>
        </div>
        <div class="collapse navbar-collapse" id="custom-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#totop">Home</a></li>
            <li><a class="section-scroll" href="#about">About</a></li>
            <li><a class="section-scroll" href="#photography">Photography</a></li>
            <li><a class="section-scroll" href="#works">Works</a></li>
            <li><a class="section-scroll" href="#blog">Blog</a></li>
            <li><a class="section-scroll" href="#contact">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <section class="home-section home-full-height bg-dark-30" id="home"
      data-background="<?php echo get_template_directory_uri(); ?>/assets/images/backgrounds/DSC07814.jpg">
      <div id="video-player"
        data-property="{videoURL:'https://youtu.be/vQrnu5JBIVI', containment:'.home-section', startAt:0, fadeOnStartTime: 1000, mute:false, autoPlay:true, loop:true, showControls:false, showYTLogo:false, delayAtStart: 2000, vol:15}">
      </div>
      <div class="video-controls-box">
        <div class="container">
          <div class="video-controls"><a class="fa fa-volume-up" id="video-volume" href="#">&nbsp;</a><a
              class="fa fa-pause" id="video-play" href="#">&nbsp;</a></div>
        </div>
      </div>
      <div class="titan-caption">
        <div class="caption-content">
          <div class="font-alt mb-30 titan-title-size-1">welcome　To</div>
          <div class="font-alt mb-40 titan-title-size-4">my playground</div><a
            class="section-scroll btn btn-border-w btn-round" href="#about">Explore</a>
        </div>
      </div>
    </section>
    <div class="main">
      <section class="module pt-0 pb-0" id="about">
        <div class="row position-relative m-0">
          <div class="col-xs-12 col-md-6 side-image"
            data-background="<?php echo get_template_directory_uri(); ?>/assets/images/profile/Profile1.JPG">
          </div>
          <div class="col-xs-12 col-md-6 col-md-offset-6 side-image-text">
            <div class="row">
              <div class="col-sm-12">
                <h2 class="module-title font-alt align-left">SO SUZUKI</h2>
                <div class="module-subtitle font-serif align-left">
                  1999年生まれ。大好きなものはダイビングと釣り。3度の飯よりも海が好きです。普段はITの会社でフルスタックにエンジニアをしたり、PLしたりしています。</div>
                <p>「90%の使いやすさと10%の遊び心」そんな想いでアプリを考えたりもしています。将来的には海に関わる仕事のDXを進めていきたいな〜と思ってます。<br>資格：AWS
                  SAA、PADI ダイブマスター</p>
                <p>Born in 1999. My favorite things are diving and fishing, and I love the ocean more than three meals a
                  day. I usually work as an engineer and PL for a full stack IT company.I sometimes think of
                  applications with this in mind: “90% usability and 10% playfulness. In the future, I would like to
                  promote DX for work related to the sea.</p>
                <div class="module-icon">
                  <a class="link-icon" href="https://www.instagram.com/safu0822_underwater/">
                    <i class="fa fa-instagram"></i>
                  </a>
                  <a class="link-icon" href="https://www.facebook.com/profile.php?id=100025317318258">
                    <i class="fa fa-facebook"></i>
                  </a>
                  <a class="link-icon" href="https://www.linkedin.com/in/so-suzuki-46697a257/">
                    <i class="fa fa-linkedin"></i>
                  </a>
                  <a class="link-icon" href="https://github.com/safu0822">
                    <i class="fa fa-github"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <a href="/photography">
        <section class="module bg-dark-60"
          data-background="<?php echo get_template_directory_uri(); ?>/assets/images/backgrounds/DSC06182.jpg"
          id="photography">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="video-box">
                  <div class="video-box-icon"><span class="icon-camera"></span></div>
                  <div class="video-title font-alt">photography gallery</div>
                  <div class="video-subtitle font-alt">Capturing the scenery in a ocean</div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </a>
      <section class="module pb-0" id="works">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt">My Works</h2>
              <div class="module-subtitle font-serif"></div>
            </div>
          </div>
        </div>
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
        </div>
        <ul class="works-grid works-grid-gut works-grid-3 works-hover-w" id="works-grid">
          <?php
            $args = array(//ページネーションを使いたいなら指定
              'posts_per_page' => 6, //３記事のみ出力
              'post_status' => 'publish', //公開の記事だけ
              'post_type' => 'works', //カスタム投稿slag
              'orderby' => 'date', //日付を出力する基準
              'order' => 'DESC' //表示する順番（逆はASC）         
            );
            $the_work_query = new WP_Query($args);
          ?>
          <?php if ( $the_work_query->have_posts() ) : ?>
          <?php while ( $the_work_query->have_posts() ) : ?>
          <?php $the_work_query->the_post(); ?>
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
          <?php wp_reset_postdata();?>
        </ul>
      </section>
      <section class="module-small bg-dark">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-md-8 col-lg-6 col-lg-offset-2">
              <div class="callout-text font-alt">
                <h3 class="callout-title">Want to see more works?</h3>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-2">
              <div class="callout-btn-box"><a class="btn btn-w btn-round" href="/works">All My works</a></div>
            </div>
          </div>
        </div>
      </section>
      <hr class="divider-w">
      <section class="module" id="blog">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt">Latest Blog</h2>
              <div class="module-subtitle font-serif">My record of activities, thoughts and feelings.</div>
            </div>
          </div>
          <div class="row multi-columns-row post-columns">
            <?php
                $args = array(//ページネーションを使いたいなら指定
                  'posts_per_page' => 3, //３記事のみ出力
                  'post_status' => 'publish', //公開の記事だけ
                  'post_type' => 'blog', //カスタム投稿slag
                  'orderby' => 'date', //日付を出力する基準
                  'order' => 'DESC' //表示する順番（逆はASC）         
                );
                $the_blog_query = new WP_Query($args);
                ?>
            <?php if ( $the_blog_query->have_posts() ) : ?>
            <?php while ( $the_blog_query->have_posts() ) : the_post(); ?>
            <?php $the_blog_query->the_post(); ?>
            <?php
                $terms = get_the_terms(get_the_ID(), 'blog_category');
                $tag_terms = get_the_terms(get_the_ID(), 'blog_tag');
                ?>
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class="post mb-20">
                <div class="post-thumbnail">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(array(940, 567)); ?>
                  </a>
                </div>
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
            </div>
            <?php endwhile; ?>
            <?php else : ?>
            <p>まだ投稿はありません。</p>
            <?php endif; ?>
            <?php wp_reset_postdata();?>
          </div>
          <div class="text-center"><a class="btn btn-border-d mt-50" href="/blog">Check All Blog</a>
          </div>
        </div>
      </section>
      <section class="module" id="contact">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt">Contact</h2>
              <div class="module-subtitle font-serif"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <form id="contactForm" role="form">
                <div class="text-center">
                  <a class="btn btn-block btn-round btn-d"
                    href="mailto:support@sosuzuki.site?subject=%E3%81%8A%E5%95%8F%E3%81%84%E5%90%88%E3%82%8F%E3%81%9B&amp;body=%5B%E3%81%8A%E5%90%8D%E5%89%8D%5D%0D%0A%0D%0A%5B%E3%81%94%E9%80%A3%E7%B5%A1%E5%85%88%5D%0D%0A%0D%0A%5B%E3%81%8A%E5%95%8F%E3%81%84%E5%90%88%E3%82%8F%E3%81%9B%E5%86%85%E5%AE%B9%5D">Send
                    Mail</a>
                </div>
              </form>
              <div class="ajax-response font-alt" id="contactFormResponse"></div>
            </div>
          </div>
        </div>
        <br>
        <div class="col-sm-6 col-sm-offset-3">
          <div class="module-icon">
            <a class="link-icon" href="https://www.instagram.com/safu0822_underwater/">
              <i class="fa fa-instagram"></i>
            </a>
            <a class="link-icon" href="https://www.facebook.com/profile.php?id=100025317318258">
              <i class="fa fa-facebook"></i>
            </a>
            <a class="link-icon" href="https://www.linkedin.com/in/so-suzuki-46697a257/">
              <i class="fa fa-linkedin"></i>
            </a>
            <a class="link-icon" href="https://github.com/safu0822">
              <i class="fa fa-github"></i>
            </a>
          </div>
      </section>
  </main>
  <?php get_footer(); ?>
</body>

</html>
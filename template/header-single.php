<section class="home-section home-parallax home-fade home-full-height bg-dark-30" id="home"
  data-background="<?php echo get_the_post_thumbnail_url(); ?>">
  <div class="titan-caption">
    <div class="caption-content">
      <div class="font-alt mb-30 titan-title-size-1"><?php echo get_post_meta( get_the_ID(), 'introduction', true) ?>
      </div>
      <div class="font-alt mb-40 titan-title-size-4"><?php the_title(); ?></div><a
        class="section-scroll btn btn-border-w btn-round" href="#explain">Learn More</a>
    </div>
  </div>
</section>
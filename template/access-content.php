<section class="module bg-dark landing-reason parallax-bg" id="access"
  data-background="<?php echo esc_url( hatatate_get_image_url( 'access_section_bg' ) ); ?>">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-push-6">
        <a href="<?php echo esc_url( hatatate_get_content( 'access_map_url' ) ); ?>" target="_blank">
          <img class="center-block"
            src="<?php echo esc_url( hatatate_get_image_url( 'access_map_image' ) ); ?>"
            alt="">
        </a>
      </div>
      <div class="col-sm-6 col-sm-pull-6">
        <h2 class="access-title font-alt align-left"><?php echo esc_html( hatatate_get_content( 'access_title' ) ); ?></h2>
        <?php echo hatatate_render_rich_text( hatatate_get_content( 'access_body' ) ); ?>
      </div>
    </div>
  </div>
</section>
<img src="<?php echo esc_url( hatatate_get_image_url( 'access_transfer_image' ) ); ?>" alt="">
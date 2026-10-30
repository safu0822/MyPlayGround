<section class="module pt-0 pb-0" id="about">
  <div class="row position-relative m-0">
    <div class="col-xs-12 col-md-6 side-image"
      data-background="<?php echo esc_url( hatatate_get_image_url( 'about_image' ) ); ?>">
    </div>
    <div class="col-xs-12 col-md-6 col-md-offset-6 side-image-text">
      <div class="row">
        <div class="col-sm-12 font-yosugara wow fadeInUp">
          <h2 class="module-title align-left color-blue"><?php echo esc_html( hatatate_get_content( 'about_title' ) ); ?>
          </h2>
          <div class="module-subtitle align-left">
            <?php echo hatatate_render_rich_text( hatatate_get_content( 'about_body' ) ); ?>
          </div>
          <div class="module-icon">
            <a class="link-icon" href="<?php echo esc_url( hatatate_get_content( 'about_instagram_url' ) ); ?>" target="_blank">
              <i class="fa fa-instagram"></i>
            </a>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
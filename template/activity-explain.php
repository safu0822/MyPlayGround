<?php
$content = $args['content'] ?? [];
preg_match_all('/<p\b[^>]*>(.*?)<\/p>/is', $content, $matches);
?>
<section class="module bg-dark-60" id="explain"
  data-background="<?php echo get_template_directory_uri(); ?>/assets/images/backgrounds/696B07AF-6AB0-4F61-9519-F81F5DF088F1.jpg">
  <div class="container">
    <div class="row wow fadeInUp">
      <div class="col-sm-8 col-sm-offset-2">
        <div class="module-subtitle font-alt large-text">
          <?php foreach ($matches[0] as $p) : ?>
          <?php echo $p; ?>
          <?php endforeach; ?></div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-sm-offset-5">
        <div class="large-text align-center"><a class="section-scroll" href="#equipments"><i
              class="fa fa-angle-down"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>
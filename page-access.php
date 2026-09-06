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
    <?php get_template_part('template/navbar'); ?>
    <?php get_template_part('template/access-header'); ?>
    <div class="main">
      <?php get_template_part('template/text-flow-access'); ?>
      <?php get_template_part('template/access-content'); ?>
      <?php get_template_part('template/qa'); ?>
      <section class="module-small bg-blue">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center">
              <h3 class="font-alt mb-20">何をしようか迷っている方は以下をチェック！</h3>
            </div>
          </div>
        </div>
      </section>
      <?php get_template_part('template/activity-liner'); ?>
  </main>
  <?php get_footer(); ?>
</body>

</html>
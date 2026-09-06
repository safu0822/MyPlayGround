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
    <span id="totop"></span>
    <?php get_template_part('template/navbar-top'); ?>
    <?php get_template_part('template/header-slider'); ?>
    <div class="main">
      <?php get_template_part('template/main-top-activity1'); ?>
      <?php get_template_part('template/main-top-activity2'); ?>
      <?php get_template_part('template/text-flow'); ?>
      <?php get_template_part('template/about'); ?>
      <?php get_template_part('template/staff'); ?>
      <?php get_template_part('template/equipments'); ?>
      <?php get_template_part('template/go-to-access'); ?>
      <?php get_template_part('template/latest-blog'); ?>
      <?php get_template_part('template/latest-news'); ?>
  </main>
  <?php get_footer(); ?>
</body>

</html>
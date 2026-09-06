<!--
Template Name: activity
-->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <?php get_header(); ?>
</head>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
  <main class="archive-activity-main">
    <div class="page-loader">
      <div class="loader">Loading...</div>
    </div>
    <?php get_template_part('template/navbar'); ?>
    <?php get_template_part('template/activity-header-slider'); ?>
    <div class="main">
      <?php get_template_part('template/recommend-tour'); ?>
      <?php get_template_part('template/activity-liner'); ?>
      <?php get_template_part('template/latest-blog'); ?>
    </div>
  </main>
  <?php get_footer(); ?>
</body>

</html>
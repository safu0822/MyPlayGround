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
    <?php get_template_part('template/news-header'); ?>
    <div class="main">
      <?php get_template_part('template/news-main'); ?>
  </main>
  <?php get_footer(); ?>
</body>

</html>
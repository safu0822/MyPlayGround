<!--
Template Name: priceList
-->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <?php get_header(); ?>
</head>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
  <main class="archive-pricelist-main">
    <div class="page-loader">
      <div class="loader">Loading...</div>
    </div>
    <?php get_template_part('template/navbar'); ?>
    <?php get_template_part('template/pricelist-header'); ?>
    <div class="main">
      <?php get_template_part('template/pricelist-main'); ?>
      <section class="module-small bg-blue">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center">
              <h3 class="font-alt mb-20">そのほかのアクティビティはこちら！</h3>
            </div>
          </div>
        </div>
      </section>
      <?php get_template_part('template/recommend-tour'); ?>
      <?php get_template_part('template/activity-liner'); ?>
    </div>
  </main>
  <?php get_footer(); ?>
</body>

</html>

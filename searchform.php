<div>
  <form action="<?php echo esc_url(home_url('/blog/')); ?>" method="get" class="Search-form-style">
    <input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力" id="s" class="form-text">
    <button type="submit" id="s" class="search-btn"><span class="i fa fa-search"></span></button>
  </form>
</div>
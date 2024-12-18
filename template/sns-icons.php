<div class="share-icons">
  <?php
  // 現在のページURLを取得してURLエンコード
  $url_encode = urlencode( get_permalink() );
  // 現在のページのタイトルを取得してURLエンコード
  $title_encode = urlencode( get_the_title() );
  ?>
  <ul class="sns-list">
    <!-- Twitterの共有リンク -->
    <li class="sns-twitter">
      <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-lang="ja"
        data-show-count="false">Tweet</a>
      <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </li>
    <!-- Facebookの共有リンク -->
    <li class="sns-fb">
      <div class="fb-share-button" data-href="<?php $url_encode; ?>" data-layout="" data-size=""><a target="_blank"
          href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
          class="fb-xfbml-parse-ignore">シェアする</a></div>
    </li>
    <!-- pocket -->
    <li class="sns-pocket">
      <a data-pocket-label="pocket" data-pocket-count="none" class="pocket-btn" data-lang="en"></a>
      <script type="text/javascript">
      ! function(d, i) {
        if (!d.getElementById(i)) {
          var j = d.createElement("script");
          j.id = i;
          j.src = "https://widgets.getpocket.com/v1/j/btn.js?v=1";
          var w = d.getElementById(i);
          d.body.appendChild(j);
        }
      }(document, "pocket-btn-js");
      </script>
    </li>
    <!-- hatena -->
    <li class="sns-hatena">
      <a href="https://b.hatena.ne.jp/entry/" class="hatena-bookmark-button"
        data-hatena-bookmark-layout="basic-label-counter" data-hatena-bookmark-lang="ja"
        title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/v4/public/entry-button/button-only@2x.png"
          alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a>
      <script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async">
      </script>
    </li>
    <!-- LINEの共有リンク -->
    <li class="sns-line">
      <div class="line-it-button" data-lang="ja" data-type="share-a" data-env="REAL" data-url="<?php $url_encode; ?>"
        data-color="default" data-size="small" data-count="true" data-ver="3" style="display: none;"></div>
      <script src="https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js" async="async" defer="defer">
      </script>
    </li>
    <li class="sns-copy">
      <a title="クリップボードに URL をコピー" class="share-url" href="javascript:void(0);"
        data-clipboard-text="<?php the_permalink(); ?>"></a>
      <!-- URLコピー完了時に表示するメッセージ -->
      <span class="url-copied">
        <span>URL copied</span>
      </span>
    </li>
  </ul>
</div>
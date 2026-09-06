(function () {
  var section = document.getElementById("equipments");
  if (!section) return;

  var video = section.querySelector(".fixed-bg");
  if (!video) return;

  // IntersectionObserver: セクションがある程度見えているときに active
  var options = {
    root: null,
    threshold: [0, 0.25, 0.5], // 25% 以上見えたら有効にする調整が可能
  };

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting && entry.intersectionRatio >= 0.25) {
        video.classList.add("is-active");
      } else {
        video.classList.remove("is-active");
      }
    });
  }, options);

  observer.observe(section);

  // （オプション）ウィンドウリサイズで video サイズを調整したいならここに処理を追加
})();

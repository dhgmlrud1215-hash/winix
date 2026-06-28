$(function () {
  let index = 0;

  const $slider = $(".airbest-slider");
  const $items = $(".airbest-slider li");
  const itemCount = $items.length;
  const visibleCount = 2;
  const gap = 18;

  $(".airright").click(function () {
    const itemWidth = $items.outerWidth();

    if (index < itemCount - visibleCount) {
      index++;

      $slider.css(
        "transform",
        `translateX(-${(itemWidth + gap) * index}px)`
      );
    }
  });

  $(".airleft").click(function () {
    const itemWidth = $items.outerWidth();

    if (index > 0) {
      index--;

      $slider.css(
        "transform",
        `translateX(-${(itemWidth + gap) * index}px)`
      );
    }
  });
});
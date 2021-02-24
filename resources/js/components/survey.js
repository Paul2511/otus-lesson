$('.survey-questions').slick({
  arrows: false,
  dots: true,
  infinite: false
});


$('[data-survey-switch]').on('click', () => {
  setTimeout(() => {
    $('.survey-questions').slick('slickNext');
  }, 100);
});

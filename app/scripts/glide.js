try {
  var glide = new Glide('.glide', {
    type: 'carousel',
    autoplay: 4000,
    perView: 3,
    focusAt: 'center',
    animationTimingFunc: 'ease',
    animationDuration: 800,
    breakpoints: {
      800: {
        perView: 2
      },
      480: {
        perView: 1
      }
    }
  });
  glide.mount();

  var glideTestimonial = new Glide('.glide-testimonial', {
    type: 'carousel',
    autoplay: 4000,
    perView: 1,
    focusAt: 'center',
    animationTimingFunc: 'ease',
    animationDuration: 800
  });

  glideTestimonial.mount();

} catch(err) {
  err
}
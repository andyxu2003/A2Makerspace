document.addEventListener("DOMContentLoaded", function() {
  const track = document.querySelector(".carousel-track");
  const slides = Array.from(track.children);
  const prevButton = document.querySelector(".carousel-prev");
  const nextButton = document.querySelector(".carousel-next");
  const slideWidth = slides[0].getBoundingClientRect().width;

  // Arrange the slides horizontally
  const setSlidePosition = (slide, index) => {
    slide.style.left = `${slideWidth * index}px`;
  };
  slides.forEach(setSlidePosition);

  // Move the slides based on the button click
  const moveSlide = (track, currentSlide, targetSlide) => {
    track.style.transform = `translateX(-${targetSlide.style.left})`;
    currentSlide.classList.remove("current-slide");
    targetSlide.classList.add("current-slide");
  };

  // Move to the next slide
  nextButton.addEventListener("click", function() {
    const currentSlide = track.querySelector(".current-slide");
    const nextSlide = currentSlide.nextElementSibling || slides[0]; // Wrap to first slide
    moveSlide(track, currentSlide, nextSlide);
  });

  // Move to the previous slide
  prevButton.addEventListener("click", function() {
    const currentSlide = track.querySelector(".current-slide");
    const prevSlide = currentSlide.previousElementSibling || slides[slides.length - 1]; // Wrap to last slide
    moveSlide(track, currentSlide, prevSlide);
  });
});

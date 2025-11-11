<div class="ad-carousel-container">
  <div class="ad-carousel">
    @foreach ($adbanner as $ads)
      <div class="ad-slide">
        <a href="{{ $ads->link ?? '#' }}" target="_blank">
          <img src="{{ asset('storage/' . $ads->image) }}" alt="{{ $ads->title ?? 'Ad Banner' }}">
        </a>
      </div>
    @endforeach
  </div>

  <!-- Navigation -->
  <button class="carousel-btn prev">&#10094;</button>
  <button class="carousel-btn next">&#10095;</button>

  <!-- Dots -->
  <div class="carousel-dots"></div>
</div>

<style>
/* Container */
.ad-carousel-container {
  position: relative;
  overflow: hidden;
  max-width: 100%;
  margin: 20px auto;
  border-radius: 12px;
}

/* Carousel slides wrapper */
.ad-carousel {
  display: flex;
  transition: transform 0.6s ease-in-out;
}

/* Each slide */
.ad-slide {
  min-width: 100%;
  transition: opacity 0.5s ease;
}
.ad-slide img {
  width: 100%;
  height: 320px;
  object-fit: cover;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.4);
}

/* Buttons */
.carousel-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255, 193, 7, 0.8);
  color: #000;
  border: none;
  padding: 10px 15px;
  border-radius: 50%;
  cursor: pointer;
  z-index: 10;
  transition: 0.3s;
}
.carousel-btn:hover {
  background: #ffc107;
}
.prev { left: 15px; }
.next { right: 15px; }

/* Dots */
.carousel-dots {
  text-align: center;
  position: absolute;
  bottom: 10px;
  width: 100%;
}
.carousel-dots span {
  height: 10px;
  width: 10px;
  margin: 0 5px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.3s;
}
.carousel-dots .active {
  background-color: #ffc107;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".ad-slide");
  const carousel = document.querySelector(".ad-carousel");
  const prevBtn = document.querySelector(".prev");
  const nextBtn = document.querySelector(".next");
  const dotsContainer = document.querySelector(".carousel-dots");

  let current = 0;
  let autoPlayInterval;

  // Create dots
  slides.forEach((_, i) => {
    const dot = document.createElement("span");
    if (i === 0) dot.classList.add("active");
    dotsContainer.appendChild(dot);
  });

  const dots = document.querySelectorAll(".carousel-dots span");

  function updateCarousel() {
    carousel.style.transform = `translateX(-${current * 100}%)`;
    dots.forEach(dot => dot.classList.remove("active"));
    dots[current].classList.add("active");
  }

  function nextSlide() {
    current = (current + 1) % slides.length;
    updateCarousel();
  }

  function prevSlide() {
    current = (current - 1 + slides.length) % slides.length;
    updateCarousel();
  }

  nextBtn.addEventListener("click", nextSlide);
  prevBtn.addEventListener("click", prevSlide);

  dots.forEach((dot, i) => {
    dot.addEventListener("click", () => {
      current = i;
      updateCarousel();
      resetAutoplay();
    });
  });

  // Autoplay
  function startAutoplay() {
    autoPlayInterval = setInterval(nextSlide, 4000);
  }

  function resetAutoplay() {
    clearInterval(autoPlayInterval);
    startAutoplay();
  }

  startAutoplay();
});
</script>
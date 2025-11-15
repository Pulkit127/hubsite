<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HUBSITE | Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #0f0f0f;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
    }

    /* Navbar */
    .navbar {
      background-color: rgba(0, 0, 0, 0.9);
      border-bottom: 2px solid #ffc107;
      backdrop-filter: blur(10px);
    }

    .navbar-brand {
      font-weight: 700;
      color: #ffc107 !important;
      letter-spacing: 1px;
    }

    .nav-link {
      color: #fff !important;
      transition: color 0.3s ease-in-out;
      font-weight: 500;
    }

    .nav-link:hover,
    .nav-link.active {
      color: #ffc107 !important;
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(15, 15, 15, 0.9)), 
                  url('https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
      height: 100vh;
      display: flex;
      align-items: center;
      text-align: center;
      justify-content: center;
      flex-direction: column;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
      color: #ffc107;
      animation: fadeInDown 1s ease;
    }

    .hero p {
      font-size: 1.2rem;
      color: #ddd;
      margin-bottom: 30px;
      animation: fadeInUp 1s ease;
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .btn-warning {
      font-weight: 600;
      border-radius: 50px;
      padding: 12px 28px;
      box-shadow: 0 0 15px rgba(255, 193, 7, 0.4);
      transition: all 0.3s ease;
    }

    .btn-warning:hover {
      background-color: #e6b800;
      box-shadow: 0 0 25px rgba(255, 193, 7, 0.7);
      transform: translateY(-2px);
    }

    /* About Section */
    #about {
      background-color: #1a1a1a;
      padding: 80px 0;
    }

    #about h2 {
      color: #ffc107;
      font-weight: 700;
    }

    .about-icon {
      font-size: 3rem;
      color: #ffc107;
      margin-bottom: 15px;
    }

    /* Contact Section */
    #contact {
      background-color: #111;
      padding: 80px 0;
    }

    #contact input,
    #contact textarea {
      background-color: #222;
      border: 1px solid #444;
      color: #fff;
    }

    #contact input:focus,
    #contact textarea:focus {
      border-color: #ffc107;
      box-shadow: 0 0 10px rgba(255, 193, 7, 0.3);
    }

    /* Footer */
    footer {
      background: #000;
      padding: 25px 0;
      text-align: center;
      color: #aaa;
      border-top: 2px solid #ffc107;
      font-size: 0.9rem;
    }

    footer a {
      color: #ffc107;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">🎬 HUBSITE</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="#hero">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="hero" class="hero">
    <div class="container">
      <h1>Welcome to HUBSITE</h1>
      <p>Your ultimate hub for Videos, Music & Entertainment</p>
      <a href="{{ route('frontend.home') }}" class="btn btn-warning">Get Started</a>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="text-center">
    <div class="container">
      <h2 class="mb-5">About HUBSITE</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <i class="bi bi-camera-reels-fill about-icon"></i>
          <h5>High-Quality Videos</h5>
          <p>Stream top-quality videos anytime with no interruptions. HUBSITE brings entertainment to your screen.</p>
        </div>
        <div class="col-md-4">
          <i class="bi bi-music-note-beamed about-icon"></i>
          <h5>Unlimited Music</h5>
          <p>Access endless tracks and playlists curated just for you — all in one smooth platform.</p>
        </div>
        <div class="col-md-4">
          <i class="bi bi-lightning-charge-fill about-icon"></i>
          <h5>Fast & Reliable</h5>
          <p>Experience lightning-fast loading and smooth streaming — because your time matters.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
<section id="contact" class="py-5" style="background: linear-gradient(180deg, #000 40%, #1a1a1a);">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="text-warning fw-bold">Contact Us</h2>
      <p class="text-light">Have questions or feedback? We’d love to hear from you.</p>
    </div>

    <div class="row justify-content-center align-items-center g-4">
      <!-- Contact Form -->
      <div class="col-md-6">
        <div class="p-4 bg-dark rounded-4 shadow-lg border border-warning">
          <form action="{{ route('contact') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label text-warning">Your Name</label>
              <input type="text" name="name" class="form-control bg-black text-light border-warning" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
              <label class="form-label text-warning">Your Email</label>
              <input type="email" name="email" class="form-control bg-black text-light border-warning" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
              <label class="form-label text-warning">Your Message</label>
              <textarea name="message" rows="4" class="form-control bg-black text-light border-warning" placeholder="Type your message..." required></textarea>
            </div>
            <button type="submit" class="btn btn-warning w-100 fw-semibold rounded-pill shadow-sm">
              <i class="bi bi-send-fill me-1"></i> Send Message
            </button>
          </form>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="col-md-5 text-light">
        <div class="p-4">
          <h4 class="text-warning fw-semibold mb-3"><i class="bi bi-chat-dots-fill me-2"></i> Get In Touch</h4>
          <p class="mb-3"><i class="bi bi-geo-alt-fill text-warning me-2"></i> Jaipur, Rajasthan, India</p>
          <p class="mb-3"><i class="bi bi-telephone-fill text-warning me-2"></i> +91 7073251917</p>
          <p><i class="bi bi-envelope-fill text-warning me-2"></i> support@hubsite.com</p>

          <div class="mt-4">
            <h5 class="text-warning mb-3">Follow Us</h5>
            <a href="#" class="text-warning fs-4 me-3"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-warning fs-4 me-3"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-warning fs-4 me-3"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="text-warning fs-4"><i class="bi bi-youtube"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Footer -->
  <footer>
    <p>© {{ date('Y') }} HUBSITE. All Rights Reserved. | Built with ❤️ by <a href="#">Pulkit Mangal</a></p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
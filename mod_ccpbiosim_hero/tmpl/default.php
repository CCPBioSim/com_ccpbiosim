<?php
defined('_JEXEC') or die;

?>

<header class="hero d-flex align-items-center">
  <!-- Replace src with real simulation movie -->
  <video
    autoplay
    muted
    loop
    playsinline
    poster="hero-poster.jpg"
  >
    <source src="simulation.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <div class="container hero-content">
    <div class="row">
      <div class="col-lg-7">
        <h1 class="display-4 fw-bold mb-3">
          Advancing Biomolecular Simulation in the UK
        </h1>
        <p class="lead mb-4">
          CCPBioSim is a UK research network supporting the development,
          training, and application of biomolecular simulation methods.
        </p>
        <div class="d-flex gap-3">
          <a href="#" class="btn btn-primary btn-lg">Explore Software</a>
          <a href="#" class="btn btn-outline-light btn-lg">Training & Events</a>
        </div>
      </div>
    </div>
  </div>
</header>

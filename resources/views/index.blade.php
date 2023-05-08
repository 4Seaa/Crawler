@extends('layouts.app')

@section('content')
<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Crawler</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<main>
  <div class="container marketing mt-2">
@if($crawl_type == 'profiles')
<h2>Crawl Profiles</h2>
@include('_crawl_profiles_form')
@elseif($crawl_type == 'video')
<h2>Crawl Video</h2>
@include('_crawl_video_form')
@elseif($crawl_type == 'audio')
<h2>Crawl Audio</h2>
@include('_crawl_audio_form')
@elseif($crawl_type == 'image')
<h2>Crawl Image</h2>
@include('_crawl_image_form')
@elseif($crawl_type == 'custom')
<h2>Crawl Anything</h2>
@include('_crawl_anything_form')
@endif
@include('results')

    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
        <a href="/?crawl_type=profiles" class="text-decoration-none">
        <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('profile.jpeg') }}">
        <h2>Crawl Profiles</h2>
       </a>
      </div>
      <div class="col-lg-4">
        <a href="/?crawl_type=video" class="text-decoration-none">
        <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('video-icon.webp') }}">
        <h2>Crawl Videos</h2>
       </a>
      </div>
      <div class="col-lg-4">
        <a href="/?crawl_type=audio" class="text-decoration-none">
        <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('audio-icon.png') }}">
        <h2>Crawl Audio</h2>
       </a>
      </div>
      <div class="col-lg-4">
        <a href="/?crawl_type=image" class="text-decoration-none">
        <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('images-icon.png') }}">
        <h2>Crawl Images</h2>
       </a>
      </div>
      <div class="col-lg-4">
        <a href="/?crawl_type=custom" class="text-decoration-none">
        <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('custom-icon.png') }}">
        <h2>Crawl Anything</h2>
       </a>
      </div>
    </div>


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
        <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Another featurette? Of course. More placeholder content here to give you an idea of how this layout would work with some actual real-world content in place.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">And yes, this is the last block of representative placeholder content. Again, not really intended to be actually read, simply here to give you a better view of what this would look like with some actual content. Your content.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


  <!-- FOOTER -->
  <footer class="container">
  </footer>
</main>

<script>
$(document).ready(function() {
  $('#crawl-form').on('submit', function() {
  $('#submit-btn-container').html(`
  <button class="btn btn-primary" type="button" disabled>
    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
    Loading...
  </button>
  `);
  })

  $("#download-all-btn").on('click', function(){
  $(".download-link").each(function() {
    var link = $(this).attr("href");
    window.open(link, '_blank');
  });
})
});
</script>


@endsection


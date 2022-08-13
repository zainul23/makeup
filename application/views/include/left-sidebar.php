<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<section class="page-header page-header-xs">
  <div class="container">

    <h1>BLOG</h1>

    <!-- breadcrumbs -->
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li><a href="#">Blog</a></li>
      <li class="active">Single</li>
    </ol><!-- /breadcrumbs -->

  </div>
</section>
<!-- /PAGE HEADER -->

<!-- -->
<section class="page-header page-header-xs">
  <div class="container">

    <div class="row">

      <!-- LEFT -->
      <div class="col-md-3 col-sm-3">

        <!-- INLINE SEARCH -->
        <div class="inline-search clearfix mb-30">
          <form action="#" method="get" class="widget_search">
            <input type="search" placeholder="Start Searching..." id="s" name="s" class="serch-input">
            <button type="submit">
              <i class="fa fa-search"></i>
            </button>
          </form>
        </div>
        <!-- /INLINE SEARCH -->

        <hr />

        <!-- side navigation -->
        <div class="side-nav mb-60 mt-30">

          <div class="side-nav-head" data-toggle="collapse" data-target="#categories">
            <button class="fa fa-bars btn btn-mobile"></button>
            <h4>CATEGORIES</h4>
          </div>
          <ul id="categories" class="list-group list-group-bordered list-group-noicon uppercase">
            <li class="list-group-item"><a href="#"><span class="fs-11 text-muted float-right">(12)</span> LOREM</a></li>
            <li class="list-group-item"><a href="#"><span class="fs-11 text-muted float-right">(8)</span> LOREM</a></li>
            <li class="list-group-item"><a href="#"><span class="fs-11 text-muted float-right">(32)</span> LOREM</a></li>
            <li class="list-group-item"><a href="#"><span class="fs-11 text-muted float-right">(16)</span> LOREM</a></li>
            <li class="list-group-item"><a href="#"><span class="fs-11 text-muted float-right">(2)</span> LOREM</a></li>
            <li class="list-group-item"><a href="#"><span class="fs-11 text-muted float-right">(1)</span> LOREM</a></li>

          </ul>
          <!-- /side navigation -->


        </div>


        <!-- JUSTIFIED TAB -->
        <div class="tabs mt-0 hidden-xs-down mb-60">

          <!-- tabs -->
          <ul class="nav nav-tabs nav-bottom-border nav-justified">
            <li class="nav-item">
              <a class="nav-item active" href="#tab_1" data-toggle="tab">
                Popular
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-item" href="#tab_2" data-toggle="tab">
                Recent
              </a>
            </li>
          </ul>

          <!-- tabs content -->
          <div class="tab-content mb-60 mt-30">

            <!-- POPULAR -->
            <div id="tab_1" class="tab-pane active">

              <div class="row tab-post">
                <!-- post -->
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <a href="blog-sidebar-left.html">
                    <img src="assets/content-images/slider-1-100x100.png" width="50" alt="" />
                  </a>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <a href="blog-sidebar-left.html" class="tab-post-link">Maecenas metus nulla</a>
                  <small>June 29 2014</small>
                </div>
              </div><!-- /post -->

              <div class="row tab-post">
                <!-- post -->
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <a href="blog-sidebar-left.html">
                    <img src="assets/content-images/slider-1-100x100.png" width="50" alt="" />
                  </a>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <a href="blog-sidebar-left.html" class="tab-post-link">Curabitur pellentesque neque eget diam</a>
                  <small>June 29 2014</small>
                </div>
              </div><!-- /post -->

              <div class="row tab-post">
                <!-- post -->
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <a href="blog-sidebar-left.html">
                    <img src="assets/content-images/slider-1-100x100.png" width="50" alt="" />
                  </a>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <a href="blog-sidebar-left.html" class="tab-post-link">Nam et lacus neque. Ut enim massa, sodales</a>
                  <small>June 29 2014</small>
                </div>
              </div><!-- /post -->

            </div>
            <!-- /POPULAR -->


            <!-- RECENT -->
            <div id="tab_2" class="tab-pane">

              <div class="row tab-post">
                <!-- post -->
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <a href="blog-sidebar-left.html">
                    <img src="assets/content-images/slider-1-100x100.png" width="50" alt="" />
                  </a>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <a href="blog-sidebar-left.html" class="tab-post-link">Curabitur pellentesque neque eget diam</a>
                  <small>June 29 2014</small>
                </div>
              </div><!-- /post -->

              <div class="row tab-post">
                <!-- post -->
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <a href="blog-sidebar-left.html">
                    <img src="assets/content-images/slider-1-100x100.png" width="50" alt="" />
                  </a>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <a href="blog-sidebar-left.html" class="tab-post-link">Maecenas metus nulla</a>
                  <small>June 29 2014</small>
                </div>
              </div><!-- /post -->

              <div class="row tab-post">
                <!-- post -->
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <a href="blog-sidebar-left.html">
                    <img src="assets/content-images/slider-1-100x100.png" width="50" alt="" />
                  </a>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <a href="blog-sidebar-left.html" class="tab-post-link">Quisque ut nulla at nunc</a>
                  <small>June 29 2014</small>
                </div>
              </div><!-- /post -->
            </div>
            <!-- /RECENT -->

          </div>

        </div>
        <!-- JUSTIFIED TAB -->


        <!-- TAGS -->
        <h3 class="hidden-xs-down fs-16 mb-20">TAGS</h3>
        <div class="hidden-xs-down mb-60">

          <a class="tag" href="#">
            <span class="txt">RESPONSIVE</span>
            <span class="num">12</span>
          </a>
          <a class="tag" href="#">
            <span class="txt">CSS</span>
            <span class="num">3</span>
          </a>
          <a class="tag" href="#">
            <span class="txt">HTML</span>
            <span class="num">1</span>
          </a>
          <a class="tag" href="#">
            <span class="txt">JAVASCRIPT</span>
            <span class="num">28</span>
          </a>
          <a class="tag" href="#">
            <span class="txt">DESIGN</span>
            <span class="num">6</span>
          </a>
          <a class="tag" href="#">
            <span class="txt">DEVELOPMENT</span>
            <span class="num">3</span>
          </a>

        </div>

      </div>

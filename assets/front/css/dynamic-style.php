<?php

  header("Content-Type:text/css");

  $color = $_GET['color']; // Change Your Color Form Here


  if( isset( $_GET[ 'color' ] ) ) {
      $color = '#'.$_GET[ 'color' ];
  }else{
    $color = "#4285f4";
  }

?>




.button,
.social-list li a:hover,
.about-list li:hover,
.team-member .team-details li a,
.services-post:hover .service-image,
.services-post .service-image.active,
.counter-item i,
.pricing-header,
.pricing-header i,
.subscription .form-area button,
.widget-categories li span.cat-counter,
.contact-us .left-area .contact-form .submit-btn,
.pricingPlan-section .single-price .name
{
  background: <?php echo $color; ?>!important;

}

.banner .intro-text h1 span,
.panel-heading .panel-title::before,
.panel-heading .panel-title[aria-expanded=true]::before,
.testimonial-item .stars,
.copyright-section a:hover,
.blog-post .post-type i,
.blog-post .post-meta li a:hover,
.blog-post .post-meta li i,
.blog-section .blog-category-list a:hover,
.blog-section .blog-category-list a.active,
.pagination li a,
.pagination li a:hover,
.pagination li a:focus,
.sidebar .widget-recent-post h4.media-heading a:hover,
.contact-us .right-area .contact-info .left .icon i,
.contact-us .right-area .contact-info .content a:hover,
.contact-us .right-area .social-links ul li a
{
  color: <?php echo $color; ?>!important;
}

.team-member .team-details li:hover a{
  background: #fff !important;
  color: <?php echo $color; ?>!important;

}

.button:hover,
.contact-us .left-area .contact-form .submit-btn:hover
{
  background: #ffffff !important;
  border: 1px solid <?php echo $color; ?>;
  color: <?php echo $color; ?>!important;
}

.footer-social li a {
    background: <?php echo $color; ?>;
    color: #fff;
    border: 1px solid <?php echo $color; ?>;
}


.footer-social li:hover a {
    background: transparent;
    border: 1px solid <?php echo $color; ?>;
    color: <?php echo $color; ?>;
}


.navbar-default .navbar-nav>li>a.active,
.navbar-default .navbar-nav>li:hover>a
{
    border-top: 2px solid <?php echo $color; ?>;
    background: <?php echo $color; ?> ;
}

.pagination>.active>a,
.pagination>.active>a:focus,
.pagination>.active>a:hover,
.pagination>.active>span,
.pagination>.active>span:focus,
.pagination>.active>span:hover,
.pagination li.active a{
    background-color:  <?php echo $color; ?>;
    border-color: <?php echo $color; ?>;
}

.contact-us .right-area .social-links ul li a:hover {
    background: <?php echo $color; ?>;
    color: #fff !important;
}


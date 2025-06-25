<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>ISoqia</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{asset('img/logo1.png')}}" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="css/main.css" rel="stylesheet">


    <style>
        .pricing-img-top {
            height: 180px;
            overflow: hidden;
            margin: -20px -20px 20px -20px;
            border-radius: 8px 8px 0 0;
            position: relative;
        }

        .pricing-img-top img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pricing-item.featured .popular {
            position: absolute;
            top: 10px;
            right: 10px;
            margin: 0;
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('img/logo1.png') }}" alt="" style="width: 140px; height: 50px;">
            </a>

            <!-- Breeze Navigation (Modified) -->
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    </li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#pricing">Product</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>

                @auth
                    <!-- Mobile Menu Toggle -->
                    <i class="mobile-nav-toggle d-xl-none bi bi-list" @click="open = !open"
                        :class="{ 'bi-x': open, 'bi-list': !open }"></i>

                    <!-- Desktop User Dropdown -->
                    <div class="user-dropdown">
                        <button @click="userMenuOpen = !userMenuOpen" class="user-dropdown-btn">
                            {{ Auth::user()->name }}
                            <i class="bi bi-chevron-down"></i>
                        </button>

                        <div x-show="userMenuOpen" @click.away="userMenuOpen = false" class="dropdown-content">
                            <a href="{{ route('profile.edit') }}">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </a>
                            </form>
                        </div>
                    </div>
                @else
                    <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="hero-bg">
                <img src="{{ asset('img/hero-bg-light.webp') }}" alt="">
            </div>
            <div class="container text-center">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h1 data-aos="fade-up">Welcome to <span>Soqia</span></h1><br>
                    <!-- <p data-aos="fade-up" data-aos-delay="100">Quickly start your project now and set the stage for success<br></p> -->
                    <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        <a href="#about" class="btn-get-started">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                            class="glightbox btn-watch-video d-flex align-items-center"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div><br>
                    <img src="{{ asset('img/logo2.png') }}" class="img-fluid hero-img" alt="" data-aos="zoom-out"
                        data-aos-delay="300">
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section light-background">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-droplet"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Smart Water Management</a></h4>
                                <p class="description">AI and IoT-based systems for real-time water tracking, quality
                                    monitoring, and waste reduction across agricultural, industrial and urban sectors.
                                </p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-sun"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Solar-Powered Solutions</a></h4>
                                <p class="description">Sustainable water systems powered by solar energy to reduce
                                    reliance on traditional power sources and lower environmental impact.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-tree"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Smart Irrigation Systems</a></h4>
                                <p class="description">Innovative agricultural solutions that optimize water
                                    distribution, increase productivity and minimize wastage through precision
                                    technology.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->
                </div>
            </div>
        </section><!-- /Featured Services Section -->

        <!-- About Section -->
        <section id="about" class="about section">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                        <p class="who-we-are">{{ $about->title ?? 'About Us' }}</p>
                        <p class="fst-italic">
                            {{ $about->content ?? '' }}
                        </p>
                    </div>
                    <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ asset($about->image_url ?? 'img/default.png') }}" class="img-fluid" alt="About Us Image">
                    </div>
                </div>
            </div>
        </section>
        <!-- /About Section -->

        <!-- Clients Section -->
        <section id="clients" class="clients section">

            <div class="container" data-aos="fade-up">

                <div class="row gy-4">

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('img/icones/cfg.png') }}" class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('img/icones/just.png') }}" class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('img/icones/narc.png') }}" class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('img/icones/river.png') }}" class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('img/icones/royal.png') }}" class="img-fluid" alt="">
                    </div><!-- End Client Item -->

                    <div class="col-xl-2 col-md-3 col-6 client-logo">
                        <img src="{{ asset('img/icones/uni.png') }}" class="img-fluid" alt="">
                    </div><!-- End Client Item -->


                </div>

            </div>

        </section><!-- /Clients Section -->

        <!-- Features Section -->
        <section id="features" class="features section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Core Innovations</h2>
                <p>Cutting-edge technologies transforming water management across sectors</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row justify-content-between">

                    <div class="col-lg-5 d-flex align-items-center">

                        <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                                    <i class="bi bi-cpu"></i>
                                    <div>
                                        <h4 class="d-none d-lg-block">AI-Driven Water Optimization</h4>
                                        <p>
                                            Our Intelligent Water Consumption System (IWCS) uses artificial intelligence
                                            to analyze usage patterns and automatically adjust water flow for maximum
                                            efficiency.
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                                    <i class="bi bi-wifi"></i>
                                    <div>
                                        <h4 class="d-none d-lg-block">IoT Monitoring Network</h4>
                                        <p>
                                            Real-time water quality and level measurement devices provide continuous
                                            monitoring with instant alerts for any anomalies in your water systems.
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                                    <i class="bi bi-lightning-charge"></i>
                                    <div>
                                        <h4 class="d-none d-lg-block">Solar Integration</h4>
                                        <p>
                                            Our solar-powered water systems reduce energy costs by up to 70% while
                                            maintaining consistent water pressure and flow rates.
                                        </p>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- End Tab Nav -->

                    </div>

                    <div class="col-lg-6">

                        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                            <div class="tab-pane fade active show" id="features-tab-1">
                                <img src="{{ asset('img/logo2.png') }}"
                                    alt="AI water management dashboard showing real-time analytics" class="img-fluid">

                            </div><!-- End Tab Content Item -->

                            <div class="tab-pane fade" id="features-tab-2">
                                <img src="{{ asset('img/logo2.png') }}"
                                    alt="IoT sensors installed in agricultural field" class="img-fluid">

                            </div><!-- End Tab Content Item -->

                            <div class="tab-pane fade" id="features-tab-3">
                                <img src="{{ asset('img/logo2.png') }}" alt="Solar panel array powering water pumps"
                                    class="img-fluid">

                            </div><!-- End Tab Content Item -->
                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Features Section -->

        <!-- Features Details Section -->
        <section id="features-details" class="features-details section">

            <div class="container">

                <div class="row gy-4 justify-content-between features-item">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('img/image2.png') }}" class="img-fluid" alt="Smart Water Management System">
                    </div>

                    <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <h3>Smart Water Solutions for Tomorrow's Challenges</h3>
                            <p>
                                Soqia combines artificial intelligence with IoT technology to revolutionize water
                                management. Our systems deliver precise water control, reducing waste by up to 40% while
                                maintaining optimal agricultural and industrial productivity. Awarded by the European
                                Union, we're setting new standards in sustainable water use.
                            </p>
                            <a href="#" class="btn more-btn">Discover Our Technology</a>
                        </div>
                    </div>

                </div><!-- Features Item -->

                <div class="row gy-4 justify-content-between features-item">

                </div><!-- Features Item -->

            </div>

        </section><!-- /Features Details Section -->

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Services</h2>
                <p>Innovative environmental solutions for smart and sustainable water management</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row g-5">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item item-cyan position-relative">
                            <i class="bi bi-water icon"></i>
                            <div>
                                <h3>Smart Water Management</h3>
                                <p>Integrated water management systems based on AI and IoT to ensure optimal water usage
                                    and reduce waste.</p>
                                <!-- <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a> -->
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item item-orange position-relative">
                            <i class="bi bi-clipboard2-data icon"></i>
                            <div>
                                <h3>Environmental Consultancy</h3>
                                <p>Specialized consultancy for agricultural and industrial sectors to reduce water
                                    consumption.</p>
                                <!-- <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a> -->
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item item-teal position-relative">
                            <i class="bi bi-droplet-half icon"></i>
                            <div>
                                <h3>Smart Irrigation Systems</h3>
                                <p>Innovative solutions ensuring efficient water distribution to increase agricultural
                                    productivity.</p>
                                <!-- <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a> -->
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item item-red position-relative">
                            <i class="bi bi-sun icon"></i>
                            <div>
                                <h3>Solar-Powered Systems</h3>
                                <p>Designing water systems powered by solar energy to reduce reliance on traditional
                                    energy sources.</p>
                                <!-- <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a> -->
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item item-indigo position-relative">
                            <i class="bi bi-graph-up-arrow icon"></i>
                            <div>
                                <h3>Data Monitoring</h3>
                                <p>Utilizing AI and IoT technologies to monitor and analyze environmental data for
                                    better management.</p>
                                <!-- <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a> -->
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item item-pink position-relative">
                            <i class="bi bi-droplet icon"></i>
                            <div>
                                <h3>Water Quality Devices</h3>
                                <p>Continuous monitoring and maintenance of water quality and resources through advanced
                                    devices.</p>
                                <!-- <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a> -->
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Services Section -->



        <!-- Pricing Section -->
        <section id="pricing" class="pricing section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Our Products</h2>
                <p>Innovative water management products for every need</p>
            </div>
            <div class="container">
                <div class="row gy-4">
                    @foreach($products as $product)
                        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                            <div class="pricing-item">
                                <div class="pricing-img-top">
                                    <img src="{{ asset($product->featured_image_url ?? 'img/default.png') }}" alt="{{ $product->name }}" class="img-fluid">
                                </div>
                                <h3>{{ $product->name }}</h3>
                                <p class="description">{{ $product->description }}</p>
                                <h4>
                                    <sup>$</sup>{{ $product->price }}<span></span>
                                </h4>
                                <a href="#contact" class="cta-btn">Contact Sales</a>
                                <p class="text-center small">Stock: {{ $product->stock_quantity }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- /Pricing Section -->

        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Frequently Asked Questions</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                        <div class="faq-container">

                            <div class="faq-item faq-active">
                                <h3>What technologies does Soqia use in its solutions?</h3>
                                <div class="faq-content">
                                    <p>Soqia integrates Artificial Intelligence (AI), Internet of Things (IoT),
                                        Information and Communication Technology (ICT), and solar energy to create smart
                                        and sustainable water management systems. Our solutions leverage these
                                        technologies to optimize water usage across agricultural, industrial, and urban
                                        sectors.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>How does the Intelligent Water Consumption System work?</h3>
                                <div class="faq-content">
                                    <p>Our IWCS uses AI algorithms and IoT sensors to monitor water usage in real-time.
                                        The system analyzes consumption patterns, detects inefficiencies, and provides
                                        automated recommendations to optimize irrigation processes. It helps reduce
                                        water waste while maintaining optimal crop hydration.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>What are the benefits of your solar-powered water systems?</h3>
                                <div class="faq-content">
                                    <p>Our solar-powered solutions reduce reliance on traditional energy sources,
                                        lowering operational costs by up to 70%. They provide sustainable, off-grid
                                        water access, require minimal maintenance, and help reduce carbon footprint
                                        while ensuring reliable water supply for agricultural and industrial use.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Can Soqia's solutions be integrated with existing irrigation systems?</h3>
                                <div class="faq-content">
                                    <p>Yes, most of our products are designed for seamless integration with existing
                                        infrastructure. Our water quality monitoring devices, quantity control systems,
                                        and smart irrigation solutions can typically be added to current setups with
                                        minimal modifications.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>What sectors does Soqia serve?</h3>
                                <div class="faq-content">
                                    <p>We provide solutions for three main sectors: Agriculture (smart irrigation and
                                        farming), Industrial Water Management (manufacturing and production facilities),
                                        and Urban & Municipal Services (smart city water solutions). Our technologies
                                        are adaptable to various water management needs.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>How does Soqia contribute to environmental sustainability?</h3>
                                <div class="faq-content">
                                    <p>Our solutions promote water conservation through precise monitoring and control,
                                        reduce energy consumption via solar-powered systems, and minimize water waste
                                        through AI optimization. We're committed to enhancing water and food security
                                        while reducing environmental impact across all our operations.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                        </div>

                    </div><!-- End Faq Column-->

                </div>

            </div>

        </section><!-- /Faq Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Testimonials</h2>
                <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 1
                }
              }
            }
          </script>
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                    rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                    risus at semper.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('img/testimonials/testimonials-1.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Saul Goodman</h3>
                                    <h4>Ceo &amp; Founder</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid
                                    cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet
                                    legam anim culpa.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('img/testimonials/testimonials-2.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Sara Wilsson</h3>
                                    <h4>Designer</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
                                    veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint
                                    minim.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('img/testimonials/testimonials-3.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Jena Karlis</h3>
                                    <h4>Store Owner</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                    fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem
                                    dolore labore illum veniam.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('img/testimonials/testimonials-4.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Matt Brandon</h3>
                                    <h4>Freelancer</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster
                                    veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam
                                    culpa fore nisi cillum quid.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('img/testimonials/testimonials-5.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>John Larson</h3>
                                    <h4>Entrepreneur</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Testimonials Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <p>We welcome your inquiries and will respond as promptly as possible</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <p>Jordan / Amman</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone"></i>
                            <h3>Call Us</h3>
                            <p>+962 78 666 8371</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Us</h3>
                            <p>infosoqia@gmail.com</p>
                        </div>
                    </div><!-- End Info Item -->

                </div>

                <div class="row gy-4 mt-1">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
                            frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div><!-- End Google Maps -->

                    {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
                    <div class="col-lg-6">
                        <form action="{{ route('contact.send') }}" method="POST" class="php-email-form"
                            data-aos="fade-up" data-aos-delay="400" id="contactForm">
                            @csrf <!-- Laravel CSRF Protection -->
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject"
                                        required>
                                </div>
                                <div class="col-md-12">
                                    <textarea name="message" class="form-control" rows="6" placeholder="Message"
                                        required></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                    <button type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer position-relative light-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Soqia</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jordan - Amman</p>
                        <p> airport street</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+962 78 666 8371</span></p>
                        <p><strong>Email:</strong> <span>infosoqia@gmail.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#hero">Home</a></li>
                        <li><a href="#about">About us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#pricing">Product</a></li>
                        <li><a href="#contact">Contact Uu</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#services">Smart Water Management</a></li>
                        <li><a href="#services">Smart Irrigation Systems</a></li>
                        <li><a href="#services">Environmental Consultancy</a></li>
                        <li><a href="#services">Solar-Powered Systems</a></li>
                        <li><a href="#services">Water Quality Devices</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Our Newsletter</h4>
                    <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                    <form action="{{ asset('forms/newsletter.php') }}" method="post" class="php-email-form">
                        <div class="newsletter-form"><input type="email" name="email"><input type="submit"
                                value="Subscribe"></div>
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                    </form>
                </div>

            </div>
        </div>


    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('nav', () => ({
                open: false,
                userMenuOpen: false
            }))
        })
    </script>
    <!-- Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>

<!doctype html>
<html lang="en">
<!--

Page    : index / MobApp
Version : 1.0
Author  : Colorlib
URI     : https://colorlib.com

 -->

<head>
    <title>Schedule and Automate Your Social Media Posts with Mateauto</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    <meta name="description" content="Our social media scheduling platform allows you to easily schedule and manage your posts across all your social media accounts in one place. Save time and grow your online presence with our intuitive platform.">
    <meta name="keywords" content="social media scheduling, social media management, social media platform, social media marketing, social media scheduling tool">
    <meta name="author" content="Mateauto">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Mateauto Social Media Scheduling Platform">
    <meta name="twitter:description" content="Our social media scheduling platform allows you to easily schedule and manage your posts across all your social media accounts in one place. Save time and grow your online presence with our intuitive platform.">
    <meta name="twitter:image" content="assets/images/mateauto.png">
    <meta name="og:title" content="Mateauto Social Media Scheduling Platform">
    <meta name="og:description" content="Our social media scheduling platform allows you to easily schedule and manage your posts across all your social media accounts in one place. Save time and grow your online presence with our intuitive platform.">
    <meta name="og:image" content="assets/images/mateauto.png">
    <meta name="og:url" content="mateauto.io">
    <meta name="og:site_name" content="mateauto">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="assets/images/favicon.ico">

    <!-- Font -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!-- Main css -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="30">

    <!-- Nav Menu -->

    <div class="nav-menu fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-dark navbar-expand-lg">
                        <a class="navbar-brand" href="index.html"><img src="assets/images/mateauto.png" class="img-fluid" alt="mateauto.io The social media content scheduling platform for users. Manage your tweet, post from a single platform. Subscribe for further updates."></a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                        <div class="collapse navbar-collapse" id="navbar">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"> <a class="nav-link active" href="#home">HOME <span class="sr-only">(current)</span></a> </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <header class="bg-gradient" id="home">
        <div class="container mt-5">
            <h1>Effortlessly Schedule Your Social Media Posts with Our User-Friendly Platform</h1>
            <!-- <p class="tagline">Are you tired of spending hours each day managing your social media presence? Our platform allows you to schedule and automate your social media posts, freeing up time for you to focus on other important tasks.With our platform, you can schedule posts for multiple social media networks, including Facebook, Twitter, and LinkedIn. You can also schedule posts for different accounts on the same network, making it easy to manage your personal and business accounts in one place. Our platform is user-friendly and intuitive, making it easy for you to schedule and publish your posts. Plus, our analytics tools allow you to track the performance of your posts and see how well your content is resonating with your audience. Try our platform today and see how much time you can save!</p> -->
        </div>
        <!-- <div class="img-holder mt-3"><img src="images/iphonex.png" alt="phone" class="img-fluid"></div> -->
        <div class="container mt-5" style="height: 100%; display: flex; justify-content: center; align-items: center;">
            <div class="row">
                <!-- <div class="col-md-6 col-offset-md-3 col-sm-12 col-xs-12"> -->
                <div class="col-12 h-100 d-flex align-items-center justify-content-center mb-3">
                    <form method="post" action="{{route('email.store')}}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control @error('name')is-invalid @enderror" id="exampleInputName" aria-describedby="nameHelp" placeholder="Enter full name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <small id="nameHelp" class="form-text text-muted">{{$message}}</small>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
                <div class="col-12">
                    @if ($message = Session::get('success'))
                        <div class="col-12">
                            <div class="alert alert-success custom-alert-success alert-dismissible fade show" role="alert">
                            {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="col-12">
                            <div class="alert alert-danger custom-alert-error alert-dismissible fade show" role="alert">
                            {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <div class="section light-bg" id="features">


        <div class="container">

            <div class="section-title">
                <small>HIGHLIGHTS</small>
                <h3>Features you love</h3>
            </div>


            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-settings gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">Analytics</h4>
                                    <p class="card-text">Interactive dashboard, graphics, charts and various other tools which will provide you with the detailed metrics whether it is related to profile or tweets that have you have posted.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-lock gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">Schedule Content</h4>
                                    <p class="card-text">You can schedule your content based on the calendar. You can also update and delete the content before it is posted on to the social media platform. More manageable UI for users.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div>
            <div class="row" style="margin-top: 2%;"> -->
                <div class="col-12 col-lg-6">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-face-smile gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">Customize Bookmarks</h4>
                                    <p class="card-text">Now with our tool, you can customize your bookmarks and save items. Manage and categorize your bookmarks so that you do not miss any of your bookmarks. You can add reminders to read them.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-settings gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">Various Insights</h4>
                                    <p class="card-text">Visually explore your data through a broad range of modern data visualizations, and an easy-to-view report experience. Our priority is to keep you engaged with the your own popular content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
    <!-- // end .section -->
    <div class="section">

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="box-icon"><span class="ti-mobile gradient-fill ti-3x"></span></div>
                    <h2>Schedule Content</h2>
                    <p class="mb-4">Scheduling social media content features allows you to plan out and schedule your posts in advance, ensuring that you are consistently posting high-quality content to your social media platforms. This can be done through the use of a social media management tool, which allows you to schedule posts, track performance, and analyze data to better understand your audience. </p>
                    <ul>
                        <li>Option to schedule posts for specific days and times.</li>
                        <li>Ability to schedule posts to multiple social media platforms at once. Right now we are working on Twitter only.</li>
                        <li>Integration with content calendar for easy organization and planning.</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div>
                        <div class="box-icon"><span class="ti-rocket gradient-fill ti-3x"></span></div>
                        <h2>Customize Bookmarks</h2>
                        <p class="mb-4">Bookmarks or saved items for users are the most important. Users bookmark the tweets, post for later use but their is high possibility that the bookmarks or saved items are not browsed by the user again. Don't worry our tool will help you to keep you upto date with your saved items and make sure you don't miss them.</p>
                        <ul>
                            <li>Categorize Bookmarks.</li>
                            <li>Add reminder for un-read bookmarks.</li>
                            <li>Get bookmarks over the mail.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- <div class="perspective-phone">
                <img src="assets/images/perspective.png" alt="perspective phone" class="img-fluid">
            </div> -->
        </div>

    </div>
    <!-- // end .section -->

    <div class="light-bg py-5 bg-gradient" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <!-- <p class="mb-2"> <span class="ti-location-pin mr-2"></span> 1485 Pacific St, Brooklyn, NY 11216 USA</p> -->
                    <div class=" d-block d-sm-inline-block">
                        <p class="mb-2 mt-3">
                            <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:admin@mateauto.io">admin@mateauto.io</a>
                        </p>
                    </div>
                    <!-- <div class="d-block d-sm-inline-block">
                        <p class="mb-0">
                            <span class="ti-headphone-alt mr-2"></span> <a href="tel:51836362800">518-3636-2800</a>
                        </p>
                    </div> -->

                </div>
                <div class="col-lg-6">
                    <div class="social-icons">
                        <!-- <a href="#"><span class="ti-facebook"></span></a> -->
                        <a href="#"><span class="ti-twitter-alt"></span></a>
                        <a href="#"><span class="ti-instagram"></span></a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- // end .section -->
    <footer class="my-5 text-center">
        <!-- Copyright removal is not prohibited! -->
        <p class="mb-2"><small>COPYRIGHT © <script type="text/javascript">var year = new Date();document.write(year.getFullYear());</script>. ALL RIGHTS RESERVED.</small></p>

        <!-- <small>
            <a href="#" class="m-2">PRESS</a>
            <a href="#" class="m-2">TERMS</a>
            <a href="#" class="m-2">PRIVACY</a>
        </small> -->
    </footer>

    <!-- jQuery and Bootstrap -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Plugins JS -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>

</body>

</html>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Schedule and Automate Your Social Media Posts with Mateauto</title>
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
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!--Google fonts links-->
        <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"> -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">


        <!--For Plugins external css-->
        <link rel="stylesheet" href="assets/css/plugins.css" />
        <link rel="stylesheet" href="assets/css/roboto-webfont.css" />

        <!--Theme custom css -->
        <link rel="stylesheet" href="assets/css/style.css">

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" />

        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Sections -->
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="assets/images/mateauto.png" alt="mateauto.io The social media content scheduling platform for users. Manage your tweet, post from a single platform. Subscribe for further updates." /></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#home">Home</a></li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <!--Home page style-->
        <header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="home-content">

                                    <h1>Effortlessly Schedule Your Social Media Posts with Our User-Friendly Platform</h1>
                                    <p>Are you tired of spending hours each day managing your social media presence? Our platform allows you to schedule and automate your social media posts, freeing up time for you to focus on other important tasks.

With our platform, you can schedule posts for multiple social media networks, including Facebook, Twitter, and LinkedIn. You can also schedule posts for different accounts on the same network, making it easy to manage your personal and business accounts in one place.

Our platform is user-friendly and intuitive, making it easy for you to schedule and publish your posts. Plus, our analytics tools allow you to track the performance of your posts and see how well your content is resonating with your audience.

Don't waste any more time manually posting to social media. Try our platform today and see how much time you can save!</p>

                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                                            <form method="post" action="{{route('email.store')}}">
                                                @csrf
                                                <div class="home-contact">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Enter your email address" name="email">
                                                        <input type="submit" class="form-control" value="Register here">

                                                    </div><!-- /input-group -->
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    @if(session()->has('status'))
                                                        <div class="alert alert-success">
                                                            {{ session()->get('status') }}
                                                        </div>
                                                    @endif

                                                </div>
                                            </form>
                                            
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>

        <!-- Sections -->
        <section id="features" class="features sections">
            <div class="container">
                <div class="row">
                    <div class="main_features_content2">

                        <div class="col-sm-6">
                            <div class="single_features_left text-center">
                                <img src="assets/images/feature-2.jpg" alt="" />
                            </div>
                        </div>

                        <div class="col-sm-6 margin-top-60">
                            <div class="single_features_right ">
                                <h2>Schedule Content</h2>
                                <p>Scheduling social media content features allows you to plan out and schedule your posts in advance, ensuring that you are consistently posting high-quality content to your social media platforms. This can be done through the use of a social media management tool, which allows you to schedule posts, track performance, and analyze data to better understand your audience.</p>
                                <ul>
                                    <li>Option to schedule posts for specific days and times.</li>
                                    <li>Ability to schedule posts to multiple social media platforms at once. Right now we are working on Twitter only.</li>
                                    <li>Integration with content calendar for easy organization and planning..</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section><!--End of Features 2 Section -->
        <section id="features" class="features sections">
            <div class="container">
                <div class="row">
                    <div class="main_features_content2">



                        <div class="col-sm-6 margin-top-60">
                            <div class="single_features_right">
                                <h2>Customize Bookmarks</h2>
                                <p>Bookmarks or saved items for users are the most important. Users bookmark the tweets, post for later use but their is high possibility that the bookmarks or saved items are not browsed by the user again. Don't worry our tool will help you to keep you upto date with your saved items and make sure you don't miss them.</p>
                                <ul>
                                    <li>Categorize Bookmarks.</li>
                                    <li>Add reminder for un-read bookmarks.</li>
                                    <li>Get bookmarks over the mail.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="single_features_left text-center">
                                <img src="assets/images/feature-1.jpg" alt="" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section><!--End of Features 2 Section -->	

        <!-- Sections -->
        <section id="business" class="portfolio sections">
            <div class="container">
                <div class="head_title text-center">
                    <h1>Platform Features</h1>
                    <p>The various platform features are listed below. We make sure that these features are provided to you as well as new features will aslo be implemented and communicated from time to time.</p>
                </div>

                <div class="row">
                    <div class="portfolio-wrapper text-center">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="community-edition">
                                <i class="fa fa-gears"></i>
                                <div class="separator"></div>
                                <h4>Analytics</h4>
                                <p>Interactive dashboard, graphics, charts and various other tools which will provide you with the detailed metrics whether it is related to profile or tweets that have you have posted.</p>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="community-edition">
                                <i class="fa fa-calendar"></i>
                                <div class="separator"></div>
                                <h4>Schedule Content</h4>
                                <p>You can schedule your content based on the calendar. You can also update and delete the content before it is posted on to the social media platform. More manageable UI for users.</p>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="community-edition">
                                <i class="fa fa-external-link"></i>
                                <div class="separator"></div>
                                <h4>Customize Bookmarks</h4>
                                <p>Now with our tool, you can customize your bookmarks and save items. Manage and categorize your bookmarks so that you do not miss any of your bookmarks. Also you can add reminders to read them.</p>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="community-edition">
                                <i class="fa fa-book"></i>
                                <div class="separator"></div>
                                <h4>Various Insights</h4>
                                <p>Visually explore your data through a broad range of modern data visualizations, and an easy-to-view report experience. Our priority is to keep you engaged with the your own popular content.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- /container -->       
        </section>

        <!--Footer-->
        <footer id="footer" class="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-wrapper">

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="footer-brand">
                                <img src="assets/images/mateauto.png" alt="mateauto.io The social media content scheduling platform for users. Manage your tweet, post from a single platform. Subscribe for further updates." />
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="copyright">
                                <p><script type="text/javascript">var year = new Date();document.write(year.getFullYear());</script>. All rights reserved.</p>
                            </div>
                            
                        </div>
                         
                       
                    </div>
                </div>
            </div>
        </footer>


        <div class="scrollup">
            <a href="#"><i class="fa fa-chevron-up"></i></a>
        </div>


        <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>

        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/modernizr.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>

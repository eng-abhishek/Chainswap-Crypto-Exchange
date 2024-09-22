<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
     @yield('meta_refresh')
	<title>@yield('title', 'Secureshift')</title>
     
	<meta name="description" content="Exchange between BTC, ETH, BCH, XMR, XAI and 30+ other cryptocurrencies. The best exchange rates.">
	<meta name="keywords" content="BTC, ETH, BCH, XMR">
	<meta name="author" content="PDPL">

	<link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/error-page.css') }}">
</head>
<body>
	<noscript>
		<style>
			h1{
				font-family: 'Arial', sans-serif;
			}
			h1 span{
				animation: none;
			}
			h1 span::before{
				display: none;
			}
		</style>
	</noscript>
	<main>
		<section>
			<div class="container-fluid">
				<div class="row d-flex justify-content-center min-vh-100">
					<div class="col-xxl-12 col-12 align-self-center">
						@yield('content')
					</div>
					<div class="col-xxl-12 col-12 align-self-end p-0">
						<footer>
							<div class="text-center">
								<p>&copy; {{config('app.name')}} {{date('Y')}}</p>
							</div>
						</footer>
					</div>
				</div>
			</div>
		</section>		
	</main>	
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secureshift | WP</title>

    <link rel="shortcut icon" href="https://secureshift.io/assets/img/favicon.png" type="image/png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/partner-slider.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script type="text/javascript" src="https://widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
</head>
<body class="bg-main">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-main bg-theme">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-2 col-6">
                                <div class="brand-logo">
                                    <a href="#" title="Logo">
                                        <img src="assets/images/logo/logo-white.png" class="img-fluid" alt="Logo">
                                    </a>
                                </div>
                            </div>
    
                            <div class="col-lg-10 col-6">
                                <input type="checkbox" id="main_nav" class="d-none">
                                <label for="main_nav" class="nav-toggle d-lg-none d-block">
                                    <span class="menu-bar menu-bar1"></span>
                                    <span class="menu-bar menu-bar2"></span>
                                    <span class="menu-bar menu-bar3"></span>
                                </label>
                                <ul class="nav justify-content-lg-end flex-lg-row flex-column main-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.html" title="Home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="about.html" title="About">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="history.html" title="History">History</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="exchange-tutorials.html" title="Exchange Tutorials">Exchange Tutorials</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="blog.html" title="Blog">Blog</a>
                                    </li>
                                     <li class="nav-item">
                                        <a class="nav-link" href="glossary.html" title="glossary">Glossary</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.html" title="Contact">Contact</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.html" title="Login">Login</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="py-5 text-center text-white">
            <div class="container">
                <div class="row justify-content-center align-items-center error-page">
                    <div class="col-lg-12">
                        <h1>404</h1>
                        <h2>Page Not Found</h2>
                        <p>The page you were trying to reach couldn't be found on this server. <br> Click "Go Back" to access the Home page.</p>
                        <a href="index.html" class="btn btn-custom px-5 rounded-pill">Go Back</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <section class="divider">
            <span class="dot"></span>
            <span class="mid"></span>
            <span class="dot"></span>
        </section>
        <section>
            <div class="container-lg container-fluid text-white">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 order-lg-1 order-1">
                        <div class="footer-link">
                            <h4 class="fs-5 ff-medium">Quick Links</h4>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="Home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="History">History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="About">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="pgp">PGP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="pgpsign">PGP SIGN</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 order-lg-2 order-3">
                        <div class="footer-link">
                            <h4 class="fs-5 ff-medium d-lg-block d-none">Quick Links</h4>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="Contact">Contact</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="FAQ">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="Reviews">Reviews</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="Privacy Policy">Privacy Policy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="Terms of Services">Terms of Services</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 order-lg-3 order-2">
                        <div class="footer-link">
                            <h4 class="fs-5 ff-medium">Crypto Pairs</h4>
                            <ul class="nav flex-column first-column-pair">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="ETH to BTC">ETH to BTC</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="ETH to SOL">ETH to SOL</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="BTC to XMR">BTC to XMR</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="XMR to BTC">XMR to BTC</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="BTC to TRX">BTC to TRX</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 order-lg-4 order-4">
                        <div class="footer-link">
                            <h4 class="fs-5 ff-medium d-lg-block d-none">Crypto Pairs</h4>
                            <ul class="nav flex-column second-column-pair">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="ETH to XOR">ETH to XOR</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="ETH to BNB">ETH to BNB</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="BTC to BNB">BTC to BNB</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="SOL to NEAR">SOL to NEAR</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="LTCBSC to ETH">LTCBSC to ETH</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="divider">
            <span class="dot"></span>
            <span class="mid"></span>
            <span class="dot"></span>
        </section>
        <section>
            <div class="container">
                <div class="row justify-content-between align-items-center text-white">
                    <div class="col-lg-4 col-lg-4 order-lg-2 order-1">
                        <div class="footer-social py-2">
                            <ul class="nav justify-content-lg-end justify-content-center align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="https://twitter.com/secureshift_io" target="_blank" title="Twitter"><span class="social-link"><i class="fa-brands fa-x-twitter"></i></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://www.reddit.com/r/secureshift/" target="_blank" title="Reddit"><span class="social-link"><i class="fa-brands fa-reddit-alien"></i></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://t.me/secureshiftTg" target="_blank" title="Telegram"><span class="social-link"><i class="fa-brands fa-telegram"></i></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://www.facebook.com/secureshift" target="_blank" title="Facebook"><span class="social-link"><i class="fa-brands fa-facebook-f"></i></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 order-lg-1 order-2">
                        <div class="footer-copyright text-lg-start text-center">
                            <p class="mb-0">© Secureshift 2023</p>
                        </div>
                    </div>
                    <div class="col-lg-4 order-lg-1 order-2">
                        <div class="text-center">
                            <div class="trustpilot-widget" data-locale="en-US" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="64b44c2e19a49263867ccebf" data-style-height="24px" data-style-width="100%" data-theme="dark" data-min-review-count="0" data-style-alignment="center">
                                <a href="https://www.trustpilot.com/review/secureshift.io" target="_blank" rel="noopener">Trustpilot</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center text-white my-3">
                    <div class="col-auto">
                        <label>Select Language</label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select form-select-custom changeLanguage">
                            <option value="en">English</option>
                            <option value="fr">France</option>
                            <option value="es">Spanish</option>
                            <option value="hi">Hindi</option>
                            <option value="de">Germany</option>
                            <option value="ru">Russia</option>
                            <option value="pt">Portugal</option>
                            <option value="cn">China</option>
                            <option value="ja">Japan</option>
                            <option value="id">Indonesia</option>
                            <option value="ge">Georgia</option>
                        </select>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
        <title>Animated perbaikan Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="Cool animated coming soon template">
        <meta name="keywords" content="html, html5, css3, animation, coming soon">


        <!-- BEGIN: stylesheets !-->
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,700&amp;subset=latin' rel='stylesheet' type='text/css'>
        <link href="{{asset('perbaikan/css/jquery.countdown.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('perbaikan/css/screen.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('perbaikan/css/app.css')}}" rel="stylesheet" type="text/css">
		<!-- END stylesheets !-->
        
        <!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
		<![endif]-->
        <style>
            img {
            display: block;
            margin: 0 auto;
        }
        </style>
    </head>
    <body>

        <!-- BEGIN: header !-->
        <header>
            <div id="clouds"></div>
            
            <div id="city"></div>
            <div id="city2"></div>
            
            <div class="center">
                <img src="{{ asset('mitradelima/assets/img/logo-klasik.png') }}" alt="" class="img-fluid" style="max-width: 50%; height: auto;">
                <h1>Website Maintenance</h1>
                
                <!-- BEGIN: counter !-->
                <div id="counter">
                    <div id="countdown"></div>
                    <p id="labels">
                        <span>days</span>
                        <span>hours</span>
                        <span>min</span>
                        <span>sec</span>
                    </p>
                </div>
                <!-- END counter !-->
                
                <div id="social">
                    <ul>
                        <li><a href="#" id="fb"></a></li>
                        <li><a href="#" id="google"></a></li>
                        <li><a href="#" id="twitter"></a></li>
                    </ul>
                </div>
            </div>
            
        </header>
        <!-- END: header !-->

        <!-- BEGIN: header !-->
        <section id="content">
            <div class="center">
                <div id="house"></div>
                <div id="car"></div>
                
                <!-- BEGIN: Information !-->
                <div id="info">
                    <h3>Information</h3>
                    <div class="col">
                        <p>Mohon maaf atas ketidaknyamanannya, saat ini kami sedang melakukan pemeliharaan.</p>
                    </div>
                    <div class="col">
                        <p>Jika Anda membutuhkan bantuan, Anda selalu dapat <a href="mailto:klinikmitradelima@gmail.com">menghubungi kami</a>, atau kami akan segera kembali online!</p>
                    </div>
                </div>
                <!-- END Information !-->
                
                <!-- BEGIN: newsletter !-->
                <div id="newsletter">
                    <h3>Newsletter</h3>
                    
                    <div id="box-input">
                        <form action="#" method="post" id="form-newsletter">
                            <input type="text" id="email" name="newsletter" class="required email" placeholder="Enter your email"/>
                            <input type="submit" value="Add"/>
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
                <!-- END newsletter !-->
                
            </div>
        </section>
        <!-- END header !-->

        <!-- BEGIN: footer !-->
        <footer>
            <div class="center">
                <p class="left">Copyright &copy; 2023 by <a href="#">Ihya Natik Wibowo</a><br/>
                [All rights reserved] </p>
                <p class="right">Made by <a href="https://shameem.me">Ihya Natik Wibowo</a></p>
            </div>
        </footer>
        <!-- END: footer !-->

        
        <!-- BEGIN: Scripts on bottom for perfomance !-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js" type="text/javascript"></script>
        <script src="{{asset('perbaikan/js/jquery.countdown.js')}}" type="text/javascript"></script>
        <script src="{{asset('perbaikan/js/app.js')}}" type="text/javascript"></script>
        <!-- END Scripts on bottom for perfomance !-->
        
    </body>
</html>

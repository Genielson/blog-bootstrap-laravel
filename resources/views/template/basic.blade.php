<!doctype html>
<html class="no-js" lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>PHP Brasil - Tudo sobre PHP e um pouco mais! </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

		<!-- CSS here -->
            <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/ticker-style.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/slicknav.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/fontawesome-all.min.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/nice-select.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
            <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
   </head>

   <body>

        @include('template.header')
        @yield('content')
        @include("template.footer")

        <!-- JS here -->
		<!-- All JS Custom Plugins Link Here here -->
        <script src="{{asset('assets/js/vendor/modernizr-3.5.0.min.js')}}"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="{{asset('assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('assets/js/slick.min.js')}}"></script>
        <!-- Date Picker -->
        <script src="{{asset('assets/js/gijgo.min.js')}}"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="{{asset('assets/js/wow.min.js')}}"></script>
		<script src="{{asset('assets/js/animated.headline.js')}}"></script>
        <script src="{{asset('assets/js/jquery.magnific-popup.js')}}"></script>

        <!-- Breaking New Pluging -->
        <script src="{{asset('assets/js/jquery.ticker.js')}}"></script>
        <script src="{{asset('assets/js/site.js')}}"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="{{asset('assets/js/jquery.scrollUp.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery.sticky.js')}}"></script>

        <!-- contact js -->
        <script src="{{asset('assets/js/contact.js')}}"></script>
        <script src="{{asset('assets/js/jquery.form.js')}}"></script>
        <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
        <script src="{{asset('assets/js/mail-script.js')}}"></script>
        <script src="{{asset('assets/js/jquery.ajaxchimp.min.js')}}"></script>

		<!-- Jquery Plugins, main Jquery -->
        <script src="{{asset('assets/js/plugins.js')}}"></script>
        <script src="{{asset('assets/js/main.js')}}"></script>
        <script type="text/javascript">

            function loadingPost() {
                var url = "/loadingPosts";
                console.log(url);
                var xmlHttp = new XMLHttpRequest();
                var row = parseInt(document.getElementById("post").value);
                var all = parseInt(document.getElementById("all").value);
                var rowPerPage = 4;
                row = row + rowPerPage;
                if(row <= all) {
                    var myrow = document.getElementById("post");
                    console.log(myrow);
                    myrow.value = row;
                    xmlHttp.onreadystatechange = function () {
                        if (xmlHttp.readyState == XMLHttpRequest.DONE) {
                            if (xmlHttp.status == 200) {
                                console.log(this.responseText);
                                var item = document.querySelectorAll(".post");
                                var renderer = document.createElement('div');
                                renderer.innerHTML = this.responseText;
                                console.log(item);
                                item[item.length - 1]
                                    .insertAdjacentHTML('afterend',this.responseText);
                            }
                        }
                    };
                    xmlHttp.open('GET', url+"?row="+row, true);
                    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlHttp.send();
                    console.log(row);
                    if((row+rowPerPage >= all)){
                        var button = document.getElementById("buttonLoading");
                        button.style.display = "none";
                    }

                }else{
                    var button = document.getElementById("buttonLoading");
                    button.style.display = "none";
                }

            }

        </script>

   </body>
</html>


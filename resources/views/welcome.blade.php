<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DELETION POET</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300|Montserrat" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Montserrat', sans-serif;
                font-weight: 400;
                height: 100vh;
				line-height: 1.6;
                margin: 20px;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
				font-family: 'Josefin Sans', sans-serif;
				font-weight: 300;
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body onload="grabText()">
	
			<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous">
  
// wrap words in spans
$('p').each(function() {
    var $this = $(this);
    $this.html($this.text().replace(/\b(\w+)\b/g, "<span>$1</span>"));
});

// bind to each span
$('p span').hover(
    function() { $('#word').text($(this).css('background-color','#ffff66').text()); },
    function() { $('#word').text(''); $(this).css('background-color',''); }
);
  </script>
  
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Deletion Poet
                </div>
				
				<div class="body">
				<p id="grabbedText">oops... pls refresh the page</p>
				</div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
		function grabText() {
			var grabbed = <?php 
			
			$response;
			
			$client = new GuzzleHttp\Client();

			$data = $client->get('https://en.wikipedia.org/api/rest_v1/page/random/summary');//, ['auth' =>  ['user', 'pass']]);
			
			$decoded = json_decode($data->getBody()); // { "type": "User", ....
			
			$response = $decoded->extract;
			
			// if there are double quotes within the turned up extract, turn this bad boy around to avoid early escaping
			echo '"' . addslashes($response) . '"';
			
			?>;
			
			document.getElementById("grabbedText").innerHTML = grabbed;//explodeText(grabbed);
		}
		
		function explodeText(input) {
			var result = input.split(" "); // can also use a regular expression to split along diff lines
			//var rejoined = result.join(" ");
			return result;
		}

	</script>
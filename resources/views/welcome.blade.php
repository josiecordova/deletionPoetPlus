<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DELETION POET</title>
		
			
			<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300|Montserrat" rel="stylesheet" type="text/css">

        <!-- Styles (lightly adjusted from the default laravel proj)-->
        <style>
		
            html, body {
                background-color: #fff;
                color: #111;
                font-family: 'Montserrat', sans-serif;
                font-weight: 400;
                height: 100vh;
				line-height: 1.6;
                margin: 20px;
            }
			
			.note {
                color: #444;
                font-family: 'Montserrat', sans-serif;
                font-weight: 400;
                font-size: 10px;
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
                color: #111;
				padding-top: 30px;
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
				
				<p class="note">note: text below here SHOULD be highlight-able (and delete-able) like this by my jquery script</p>
								
				<p id="grabbedText">oops... pls refresh the page</p>
				
				</div>

                <div class="links">
                    <a href="/poem/store?text='grabbedText'">save poem</a>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
	// I will eventually move these scripts to their own dedicated js files
	// a lil script which retrieves and formats a random wiki article summary (just the extract)
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
		
		// overwrite the grabbedText element with the newly snagged text
		document.getElementById("grabbedText").innerHTML = grabbed;//explodeText(grabbed);
	}
	
	/* wrote this in case I needed to split the output above for easier jquery handling
	* in retrospect this will prob sidestep the issue I was having with the jquery script I retrieve from
	* the public js folder
	*/
	function explodeText(input) {
		var result = input.split(" "); // can also use a regular expression to split along diff lines
		//var rejoined = result.join(" ");
		return result;
	}
</script>

<script type="text/javascript" src="{{ URL::asset('js/highlighter.js') }}"></script>
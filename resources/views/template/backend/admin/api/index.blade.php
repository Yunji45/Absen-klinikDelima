<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <meta name="description" content="">
    <meta name="author" content="ticlekiwi">

    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{asset('API/css/dark.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,300&family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="{{asset('API/css/style.css')}}" media="all">
    <script>
        hljs.initHighlightingOnLoad();
    </script>
</head>

<body class="one-content-column-version">
<div class="left-menu">
    <div class="content-logo">
        <div class="logo">
            <img alt="platform by Emily van den Heever from the Noun Project" title="platform by Emily van den Heever from the Noun Project" src="{{asset('API/images/logo.png')}}" height="32" />
            <span>API Docs Klinik MD</span>
        </div>
        <button class="burger-menu-icon" id="button-menu-mobile">
            <svg width="34" height="34" viewBox="0 0 100 100"><path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"></path><path class="line line2" d="M 20,50 H 80"></path><path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"></path></svg>
        </button>
    </div>
    <div class="mobile-menu-closer"></div>
    <div class="content-menu">
        <div class="content-infos">
            <div class="info"><b>Version:</b> 1.0.5</div>
            <div class="info"><b>Last Updated:</b> June 2024</div>
        </div>
        <ul>
            <li class="scroll-to-link active" data-target="content-get-started">
                <a>Get Started</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-spesifications">
                <a>Specifications</a>
            </li>
            <li class="scroll-to-link" data-target="content-errors">
                <a>Errors</a>
            </li>
        </ul>
    </div>
</div>


<div class="content-page">
    <div class="content">
        <div class="overflow-hidden content-section" id="content-get-started">
            <h1>Get started</h1>
            <p>
                The Westeros API provides programmatic access to read data. Retrieve a character, provide an oauth connexion, retrieve a familly, filter them, etc.
            </p>
            <p>
                To use this API, you need an <strong>API key</strong>. Please contact us at <a href="mailto:adm@klinikmitradelima.com">adm@klinikmitradelima.com</a> to get your own API key.
            </p>
        </div>
        <div class="overflow-hidden content-section" id="content-get-spesifications">
            <h2>Specifications</h2>
            <p>
                To Specifications you need to make a GET call to the following url :<br>
                <code class="higlighted break-word">https://klinikmitradelima.com/api/api_name</code>
            </p>
            <br>
            <h4>QUERY PARAMETERS</h4>
            <table>
                <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">API_Name</th>
                    <th class="text-center">Function</th>
                    <th class="text-center">Method</th>
                    <th class="text-center">Url</th>
                    <th class="text-center">Content_Type</th>
                    <th class="text-center">Time_Out</th>
                </tr>
                </thead>
                <tbody>
                @php $no =1; @endphp 
                @foreach ($data as $item)
                <tr>
                    <td class="text-center">{{$no++}}.</td>
                    <td class="text-center">{{$item->api_name}}</td>
                    <td class="text-center">{{$item->function}}</td>
                    <td class="text-center">{{$item->method}}</td>
                    <td class="text-center"><a href="https://klinikmitradelima.com/api{{$item->url}}">{{$item->url}}</a></td>
                    <td class="text-center">{{$item->content_type}}</td>
                    <td class="text-center">{{$item->time_out}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="overflow-hidden content-section" id="content-errors">
            <h2>Errors</h2>
            <p>
                The Westeros API uses the following error codes:
            </p>
            <table>
                <thead>
                <tr>
                    <th>Error Code</th>
                    <th>Meaning</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>500</td>
                    <td>
                        Some parameters are missing. This error appears when you don't pass every mandatory parameters.
                    </td>
                </tr>
                <tr>
                    <td>404</td>
                    <td>
                        Unknown or unvalid <code class="higlighted">secret_key</code>. This error appears if you use an unknow API key or if your API key expired.
                    </td>
                </tr>
                <tr>
                    <td>401</td>
                    <td>
                        Unvalid <code class="higlighted">secret_key</code> for this domain. This error appears if you use an API key non specified for your domain. Developper or Universal API keys doesn't have domain checker.
                    </td>
                </tr>
                <tr>
                    <td>200</td>
                    <td>
                        Unknown or unvalid user <code class="higlighted">token</code>. This error appears if you use an unknow user <code class="higlighted">token</code> or if the user <code class="higlighted">token</code> expired.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Github Corner Ribbon - to remove (Ribbon created with : http://tholman.com/github-corners/ ) -->
<a href="https://github.com/ticlekiwi/API-Documentation-HTML-Template" class="github-corner" aria-label="View source on Github" title="View source on Github"><svg width="80" height="80" viewBox="0 0 250 250" style="z-index:99999; fill:#08a02e; color:#fff; position: fixed; top: 0; border: 0; right: 0;" aria-hidden="true"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a>
<style>
    .github-corner:hover .octo-arm {
        animation: octocat-wave 560ms ease-in-out
    }

    @keyframes octocat-wave {
        0%,
        100% {
            transform: rotate(0)
        }
        20%,
        60% {
            transform: rotate(-25deg)
        }
        40%,
        80% {
            transform: rotate(10deg)
        }
    }

    @media (max-width:500px) {
        .github-corner:hover .octo-arm {
            animation: none
        }
        .github-corner .octo-arm {
            animation: octocat-wave 560ms ease-in-out
        }
    }
    @media only screen and (max-width:680px){ .github-corner > svg { right: auto!important; left: 0!important; transform: rotate(270deg)!important;}}
</style>
<!-- END Github Corner Ribbon - to remove -->
<script src="{{asset('API/js/script.js')}}"></script>
</body>

</html>
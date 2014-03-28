<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Auth</title>
        <style>
            .body {
                position: relative;
            }
            .center-container {
                position:absolute;
                display: table;
                width: 98%;
                height: 92%;
            }
            .center-container > :first-child {
                display: table-cell;
                text-align: center;
                vertical-align: middle;
            }
            .center-container > :first-child > :first-child {
                display: inline-block;
                text-align: left;
            }
        </style>
    </head>
    <body>
        <div class="center-container">
            <div>
                <div>
                    @yield('contents')
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/s/js/jquery.js"></script>
        <script type="text/javascript">
            function sendRequest(url, data, method) {
                var method = method == 'get' ? 'GET' : 'POST';
                return $.ajax({
                    method: method,
                    data: data,
                    dataType: 'json',
                    url: url
                })
                    .fail(function(xhr, status, message) {
                        console.log(xhr);
                        alert('Http error:' + message);
                    })
            }
        </script>
        @yield('script')
    </body>
</html>

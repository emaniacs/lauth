<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Not allowed</title>
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
                <h1>Not Allowed</h1>
            </div>
        </div>
    </div>
</body>
</html>

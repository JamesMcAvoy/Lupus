<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lycanthrope</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <style>
            html {
                background-color: #355395;
            }
            #chat {
                padding: 0;
                font-size: 1.1em;
                background-color: #cdcdcd;
                border-radius: 3px;
                min-height: 260px;
                position: absolute;
                top: 50%;
                left: 50%;
                border: 1px solid black;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
                -webkit-transform: translate(-50%, -50%);
                   -moz-transform: translate(-50%, -50%);
                    -ms-transform: translate(-50%, -50%);
                     -o-transform: translate(-50%, -50%);
                        transform: translate(-50%, -50%);
            }
            .list {
                background-color: #08182b;
                color: #ddd;
            }
            .list h1  {
                font-size: 1.15em;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <section id="chat" class="container row">
            <div class="list col-md-3">
                <h1>Liste</h1>
            </div>
             <div class="msg col-md-9">
                <p>test</p>
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="js/lycanthrope.js"></script>
        <script>
            Lycanthrope.connect({
                token: 'token',
                pseudo: 'pseudo'
            })
        </script>
    </body>
</html>

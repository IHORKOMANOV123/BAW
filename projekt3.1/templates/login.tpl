<!DOCTYPE HTML>
<html>
    <head>
        <title>Login - Directive by HTML5 UP</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <style>
            #login-container {
                background-color: #f0f0f0;
                border: 1px solid #ccc;
                border-radius: 10px;
                padding: 20px;
                text-align: center;
                margin: 50px auto;
                width: 300px;
            }
            #login-container form {
                text-align: left;
            }
            #login-container input {
                background-color: #e0e0e0;
                border: 1px solid #aaa;
                border-radius: 5px;
                padding: 8px;
                margin: 5px 0;
                width: 100%;
                box-sizing: border-box;
            }
            #login-container button {
                background-color: #007BFF;
                border: none;
                border-radius: 5px;
                padding: 10px;
                color: #fff;
                cursor: pointer;
                width: 100%;
            }
            #scrollButton {
                margin-top: 20px;
                background-color: #28a745;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                color: #fff;
                text-decoration: none;
                display: inline-block;
                cursor: pointer;
                opacity: 1;
            }
        </style>
    </head>
    <body class="is-preload">
        <div id="header">
            <span class="logo icon fa-paper-plane"></span>
            <div class="intro">
                <h1>Cześć, aby skorzystać z kalkulatora kredytowego, musisz się zalogować</h1>
                <a href="#footer" id="scrollButton">Log in</a>
            </div>
        </div>
        <div id="main">
            <header class="major container medium">
                <h2>Login</h2>
            </header>
            <div class="box alt container">
                <section class="feature left">
                    <div id="login-container">
                        {if isset($error)}
                            <p style="color:red;">{$error}</p>
                        {/if}
                        <form method="post" action="login.php">
                            <div>
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" required>
                            </div>
                            <div>
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <button type="submit">Login</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        <footer id="footer">
            <div class="container">
                <p>&copy; Your Company. All rights reserved.</p>
            </div>
        </footer>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/browser.min.js"></script>
        <script src="assets/js/breakpoints.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <script>
            $(document).ready(function(){
                $("#scrollButton").click(function(e){
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $("#footer").offset().top
                    }, 1000);
                });
            });
        </script>
    </body>
</html>

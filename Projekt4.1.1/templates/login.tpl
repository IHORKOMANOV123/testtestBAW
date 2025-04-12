<!DOCTYPE HTML>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    <style>
        html { scroll-behavior: smooth; }

        .fade-in {
            animation: fadeIn 1.2s ease-in forwards;
            opacity: 0;
        }

        .slide-up {
            animation: slideUp 1s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .button.slide-down {
            animation: slideDown 0.8s ease-out both;
        }

        #welcome {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f4f4f4;
        }

        #welcome-box {
            background: white;
            padding: 2em;
            border-radius: 12px;
            text-align: center;
        }

        #login {
            background-image: url('images/pic01.jpg');
            background-size: cover;
            background-position: center;
            padding: 5em 0;
        }

        #login .inner {
            background: rgba(255,255,255,0.9);
            padding: 2em;
            border-radius: 12px;
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>

<section id="welcome">
    <div id="welcome-box" class="fade-in">
        <h2>Cześć! Jeśli chcesz skorzystać z kalkulatora, najpierw się zaloguj!</h2>
        <a href="#login" class="button primary slide-down">Login</a>
    </div>
</section>

<section id="login">
    <div class="inner slide-up">
        <h3>Logowanie</h3>
        {if count($msgs) > 0}
            <div style="color:red;">
                {foreach from=$msgs item=msg}
                    <p>{$msg}</p>
                {/foreach}
            </div>
        {/if}
        <form method="post" action="login.php">
            <input type="text" name="username" placeholder="Login" required />
            <input type="password" name="password" placeholder="Hasło" required />
            <button type="submit" class="button">Zaloguj się</button>
        </form>
    </div>
</section>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>

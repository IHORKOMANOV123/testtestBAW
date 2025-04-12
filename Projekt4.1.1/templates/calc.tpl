<!DOCTYPE HTML>
<html>
<head>
    <title>Kalkulator</title>
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

        #calculator {
            background-image: url('images/pic2.jpg');
            background-size: cover;
            background-position: center;
            padding: 5em 0;
        }

        #calculator .inner {
            background: rgba(255, 255, 255, 0.9);
            padding: 2em;
            border-radius: 12px;
            max-width: 500px;
            margin: auto;
        }
    </style>
</head>
<body>

<section id="welcome">
    <div id="welcome-box" class="fade-in">
        <h2>Teraz możesz obliczyć swoją ratę kredytu!</h2>
        <a href="#calculator" class="button primary slide-down">Oblicz</a>
    </div>
</section>

<section id="calculator">
    <div class="inner slide-up">
        <h3>Kalkulator</h3>
        <form method="post" action="calc.php">
            <input type="number" name="kwota" placeholder="Kwota kredytu" value="{$form->kwota|default:''}" required />
            <input type="number" name="lat" placeholder="Liczba lat" value="{$form->lat|default:''}" required />
            <input type="number" step="0.1" name="procent" placeholder="Oprocentowanie" value="{$form->procent|default:''}" required />
            <button type="submit" class="button primary">Oblicz ratę</button>
        </form>

        {if $result->monthlyPayment}
            <div class="box" style="margin-top: 1em; background-color: #dff0d8;">
                <strong>Rata miesięczna:</strong> {$result->monthlyPayment} PLN
            </div>
        {/if}

        {if count($messages) > 0}
            <div class="box" style="margin-top: 1em; background-color: #f8d7da;">
                {foreach from=$messages item=msg}
                    <p>{$msg}</p>
                {/foreach}
            </div>
        {/if}

        <a href="logout.php" class="button small">Wyloguj się</a>
    </div>
</section>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>

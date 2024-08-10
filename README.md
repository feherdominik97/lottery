<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lottery Simulator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #A5D9C8, #F6F0C6);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #020056;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            background: linear-gradient(to right, #A5D9C8, #F6F0C6);
            -webkit-background-clip: text;
            color: transparent;
        }
         pre {
            background: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: auto;
        }
        code {
            font-family: 'Courier New', Courier, monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lottery Simulator</h1>
        <h2>Installation Instructions</h2>
        <p>Follow the steps below to install the Lottery Simulator:</p>
        <ol>
            <li>Install the required dependencies and run tests:
                <pre><code>npm i
npm run test:unit</code></pre>
            </li>
            <li>Commands for server:
                <pre><code>cd api
composer install
copy .env.example .env
php artisan migrate --seed
php artisan test
php artisan serve</code></pre>
            </li>
            <li>Run the application:
                <pre><code>npm run dev</code></pre>
            </li>
            <span> Enjoy:
                <a>http://localhost:3000/</a>
            </span>
        </ol>
    </div>
</body>
</html>
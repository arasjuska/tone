<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Gift card') }}</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #fdf6f9;
            margin: 0;
            padding: 0;
        }

        .coupon {
            border: 2px solid #eac1d1;
            width: 90%;
            max-width: 350px;
            padding: 30px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: #5e3b49;
            position: relative;
            overflow: hidden;
        }

        .coupon h2 {
            font-size: 1.8em;
            margin: 0;
            color: #b3597f;
        }

        .from-to {
            font-size: 1.2em;
            color: #a0406d;
            margin: 30px 0;
            font-weight: bold;
            padding: 15px;
            border: 1px solid #eac1d1;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .expire {
            color: #a0406d;
            font-style: italic;
        }

        .service-name, .master-name {
            font-size: 1.4em;
            background: rgba(248, 195, 208, 0.4);
            border-radius: 10px;
            padding: 15px;
            color: #5e3b49;
            font-weight: bold;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            letter-spacing: 1px;
        }

        .service-name::before, .master-name::before {
            content: attr(data-label);
            display: block;
            font-weight: bold;
            color: #b3597f;
            margin-bottom: 5px;
            font-size: 1em;
            text-transform: uppercase;
        }

        .price {
            font-size: 1.3em;
            color: #b3597f;
            margin-top: 15px;
            font-weight: bold;
        }

        .qr-code {
            margin-top: 20px;
        }

        .qr-code img {
            width: 120px;
            height: 120px;
        }

        .decorative-element {
            position: absolute;
            z-index: -1;
            opacity: 0.7;
            background-color: rgba(248, 195, 208, 0.3);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: float 4s infinite ease-in-out;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0);
            }
        }

    </style>
</head>
<body>

<div class="coupon" role="document">
    <div class="decorative-element" style="top: -20px; left: 10%;"></div>
    <div class="decorative-element" style="top: 10px; right: 15%;"></div>
    <div class="decorative-element" style="top: 30px; left: 20%;"></div>
    <div class="decorative-element" style="top: 5%; right: 25%;"></div>
    <div class="decorative-element" style="top: 50px; left: 40%;"></div>
    <div class="decorative-element" style="top: 60px; left: 5%;"></div>
    <div class="decorative-element" style="top: 80px; right: 10%;"></div>
    <div class="decorative-element" style="top: 100px; left: 70%;"></div>
    <div class="decorative-element" style="top: 150px; left: 25%;"></div>
    <div class="decorative-element" style="top: 90px; right: 15%;"></div>
    <div class="decorative-element" style="top: 130px; left: 10%;"></div>
    <div class="decorative-element" style="top: 120px; left: 50%;"></div>
    <div class="decorative-element" style="top: 40px; right: 40%;"></div>
    <div class="decorative-element" style="top: 30%; left: 70%;"></div>
    <div class="decorative-element" style="top: 25%; right: 5%;"></div>
    <div class="decorative-element" style="top: 55%; left: 15%;"></div>
    <div class="decorative-element" style="top: 70%; right: 30%;"></div>
    <div class="decorative-element" style="top: 85%; left: 35%;"></div>
    <div class="decorative-element" style="top: 65%; right: 5%;"></div>
    <div class="decorative-element" style="top: 75%; left: 20%;"></div>
    <div class="decorative-element" style="top: 15%; left: 55%;"></div>
    <div class="decorative-element" style="top: 45%; right: 20%;"></div>
    <div class="decorative-element" style="top: 95%; left: 5%;"></div>
    <div class="decorative-element" style="top: 5%; left: 15%;"></div>
    <div class="decorative-element" style="top: 85%; right: 15%;"></div>
    <div class="decorative-element" style="top: 55%; left: 60%;"></div>
    <div class="decorative-element" style="top: 100%; left: 30%;"></div>
    <div class="decorative-element" style="top: 50%; right: 50%;"></div>
    <div class="decorative-element" style="top: 75%; left: 40%;"></div>
    <div class="decorative-element" style="top: 25%; left: 30%;"></div>
    <div class="decorative-element" style="top: 90%; right: 40%;"></div>
    <div class="decorative-element" style="top: 40%; left: 5%;"></div>
    <div class="decorative-element" style="top: 80%; left: 50%;"></div>
    <div class="decorative-element" style="top: 10%; left: 80%;"></div>
    <div class="decorative-element" style="top: 95%; left: 60%;"></div>
    <div class="decorative-element" style="top: 15%; left: 35%;"></div>
    <div class="decorative-element" style="top: 70%; right: 50%;"></div>
    <div class="decorative-element" style="top: 60%; left: 25%;"></div>
    <div class="decorative-element" style="top: 30%; right: 35%;"></div>
    <div class="decorative-element" style="top: 5%; right: 45%;"></div>
    <div class="decorative-element" style="top: 55%; left: 75%;"></div>
    <div class="decorative-element" style="top: 45%; right: 35%;"></div>
    <div class="decorative-element" style="top: 80%; right: 20%;"></div>
    <div class="decorative-element" style="top: 20%; left: 45%;"></div>
    <div class="decorative-element" style="top: 90%; right: 10%;"></div>
    <div class="decorative-element" style="top: 60%; left: 10%;"></div>
    <div class="decorative-element" style="top: 40%; right: 30%;"></div>

    <h2>{{ __('Gift card') }}</h2>

    <div class="from-to">
        <p>A Gift From: <strong>[Your Name]</strong></p>
        <p>To: <strong>[Recipient's Name]</strong></p>
    </div>

    <p class="service-name" data-label="{{ __('Service') }}">
        <strong>Kobido veido masažas</strong>
    </p>

    <p class="master-name" data-label="{{ __('Master') }}">
        <strong>Jurgita</strong>
    </p>

    <p class="price">{{ __('Value') }}: <strong>{{ $giftCard->buyer->amount }} €</strong></p>
    <p class="expire">{{ __('Expires') }}: <strong>{{ $giftCard->buyer->expires_at }}</strong></p>

    <div class="qr-code">
        @if($giftCard->buyer->qr_code)
            <img src="data:image/png;base64,{{ $giftCard->buyer->qr_code }}" alt="QR Code">
        @else
            <p>{{ __('QR Code not available') }}</p>
        @endif
    </div>
</div>

</body>
</html>

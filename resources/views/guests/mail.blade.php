<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('css/style-guest.css') }}"> --}}
    <style>
        .email_header {
            height: 80px;
            background-color: #BB181D;
        }

        .email_main {
            height: calc(100vh - 160px);
        }

        .container_order_email {
            display: flex;
            width: 100%;
            height: 100%;
            margin: 0 auto;
        }
        .order_email_img {
            width: 50%;
        }
        .order_email_img > img {
            max-width: 100%;
            height: 100%;
            object-position: center;
            object-fit: contain;
        }

        .order_email {
            width: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .email_footer {
            height: 80px;
            background-color: black;
        }

    </style>
    <title>Email conferma ordine n° #####</title>
</head>
<body id="template-email">
    <div class="email_header">
        <img src="" alt="">
    </div>
    <div class="email_main">
        <div class="container_order_email">
            <div class="order_email_img">
                <img src="{{asset('img/21266937.jpg')}}" alt="">
            </div>
            <div class="order_email">
                <h1>Grazie di averci scelto</h1>
                <p>Di seguito il suo ordine:</p>
                <ul>
                    @php
                        $order->counter = explode( ',', $order->counter);
                     @endphp

                    @for($i = 0; $i < count($order->products); $i++)
                        <li>{{ $order->products[$i]->name }} x{{ $order->counter[$i] }}</li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
    <div class="email_footer"></div>
</body>
</html>

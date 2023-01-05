<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="MobileOptimized" content="176" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Fast Food</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <script>
        function setThemeClass() {
            document.documentElement.className = Telegram.WebApp.colorScheme;
        }
        Telegram.WebApp.onEvent('themeChanged', setThemeClass);
        setThemeClass();
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            background-color: var(--tg-theme-bg-color, #ffffff);
            color: var(--tg-theme-text-color, #222222);
            font-size: 16px;
            margin: 0;
            padding: 0;
            color-scheme: var(--tg-color-scheme);
        }

        /* a {
            color: var(--tg-theme-link-color, #2678b6);
        } */

        .container {
            width: 100%;
            margin-top: 50px;
            display: flex;
            justify-content: center;
        }

        .wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 50px 10px;
            grid-auto-rows: minmax(50px, auto);
            width: 90%;
        }

        .image-cont {
            position: relative;
        }

        .count {
            position: absolute;
            top: 0;
            right: 0;
        }

        .wrapper>.item {
            position: relative;
            list-style-type: none;
        }

        .food-image {
            margin: auto;
            width: 120px;
        }

        .bottom,
        .footer {
            text-align: center;
            width: 100%;
            display: block;
        }

        .title {
            color: var(--tg-theme-link-color, #222222);
            font-family: Arial, Helvetica, sans-serif;
        }

        .btn-add {
            margin: auto;
            width: 80%;
        }

        .row-btn {
            width: 80%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .status {
            display: none;
        }

        .minus,
        .plus {
            flex: 1;
        }

        .count {
            display: none;
        }

        /* .btn {
    background: #f39c12;
    color: #fff;
    padding: 1rem 3rem;
    font-size: 1.5rem;
    font-weight: 600;
    border: none;
    border-radius: 2rem;
    cursor: pointer;
    transition-duration: 0.4s;
} */
    </style>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="item" data-id="1" data-price="15">
                <div class="image-cont">
                    <div class="count">1</div>
                    <img class="food-image" src="./icon/hotdog.png" alt="Hotdog">
                </div>
                <div class="bottom">
                    <span class="title">icon 1</span>
                </div>
                <div class="footer">
                    <button class="btn-add">Add</button>
                    <div class="status">
                        <div class="row-btn">
                            <button class="minus">-</button>
                            <button class="plus">+</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item" data-id="2" data-price="10">
                <div class="image-cont">
                    <div class="count">1</div>
                    <img class="food-image" src="./icon/hotdog.png" alt="Hotdog">
                </div>
                <div class="bottom">
                    <span class="title">icon 1</span>
                </div>
                <div class="footer">
                    <button class="btn-add">Add</button>
                    <div class="status">
                        <div class="row-btn">
                            <button class="minus">-</button>
                            <button class="plus">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <section>
        <h1 id="greeting"></h1>

        <div id="buttons">
            <button onclick="toggleMainButton(this);">Hide Main Button</button>
        </div>

        <h3>Init Data: </h3>
        <pre id="initData"></pre>
        <h3>Init Data (unsafe): </h3>
        <pre id="initDataUnsafe"></pre>
    </section> --}}

    <script type="application/javascript">
        Telegram.WebApp.ready();

        let data = $('.item');
        var cart = {};
        $.each(data, function(index, value){
            let id = $(value).attr('data-id')
            let price = $(value).attr('data-price')
            cart[id]= [price, 1]
        })

        var jsonStr = JSON.stringify(cart);
        sessionStorage.setItem("cart", jsonStr);
        var cartValue = sessionStorage.getItem( "cart" );
        var cartObj = JSON.parse(cartValue);

    
        const initData = Telegram.WebApp.initData || '';
        const initDataUnsafe = Telegram.WebApp.initDataUnsafe || {};
    
        // document.querySelector('#greeting').innerHTML = `Hi, ${initDataUnsafe.user.first_name}!`;
        // document.querySelector('#initData').innerHTML = JSON.stringify(initData, null, 2);
        // document.querySelector('#initDataUnsafe').innerHTML = JSON.stringify(initDataUnsafe, null, 2);
        // document.querySelector('#themeData').html(JSON.stringify(Telegram.WebApp.themeParams, null, 2));
    
        Telegram.WebApp.onEvent('themeChanged', function() {
            document.querySelector('#themeData').innerHTML = JSON.stringify(Telegram.WebApp.themeParams, null, 2);
        });

        Telegram.WebApp.MainButton.text = "Savatga qo`shish";

        function MainButtonShow(el) {
            const mainButton = Telegram.WebApp.MainButton;
            mainButton.show();
        }

        function MainButtonHide(el) {
            const mainButton = Telegram.WebApp.MainButton;
            if (mainButton.isVisible) {
                mainButton.hide();
            }
        }

        $('.btn-add').on('click', function(){
            $(this).hide();
            $(this).siblings('.status').show();
            let id = $(this).parents('.item').attr('data-id');
            let count = cartObj[id][1]
            $(this).parents('.footer').siblings('.image-cont').children(".count").text(count);
            $(this).parents('.footer').siblings('.image-cont').children(".count").show();
            MainButtonShow()
        })

        $('.plus').on('click', function(){
            let id = $(this).parents('.item').attr('data-id');
            let count = cartObj[id][1]
            count++
            cartObj[id][1] = count
            cartObj[id][0] = cartObj[id][0] * count
            $(this).parents('.footer').siblings('.image-cont').children(".count").text(count);
        })

        $('.minus').on('click', function(){
            let id = $(this).parents('.item').attr('data-id');
            let count = cartObj[id][1]
            --count
            if(count < 1){
                $(this).parents('.status').hide();
                $(this).parents('.status').siblings('.btn-add').show();
                let id = $(this).parents('.item').attr('data-id');
                cartObj[id][0] = 0
                cartObj[id][1] = 1
                $(this).parents('.footer').siblings('.image-cont').children(".count").hide();
                MainButtonHide()
            }else{
                cartObj[id][1] = count
                cartObj[id][0] = cartObj[id][0] * count
                $(this).parents('.footer').siblings('.image-cont').children(".count").text(count);
            }
        })

        Telegram.WebApp.onEvent('mainButtonClicked', function(){
            Telegram.WebApp.sendData("some string that we need to send"); 
        })
    
    </script>
</body>

</html>

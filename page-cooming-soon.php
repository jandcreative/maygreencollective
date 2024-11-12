<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body id="top" <?php body_class(); ?>>

    <div class="container-coming-soon">
        <div class="logo-coming">
            <img
                src="https://nivd.world/wp-content/uploads/elementor/thumbs/NIVD-LOGO-ORANGE-qj7ppwhgcisvr19wbcqjbuxclo3z513dw8fumutkzu.png">
        </div>

        <div class="content">
             <img class="heart" src="https://nivd.world/wp-content/uploads/2024/02/NIVD-Heart.png-.png">

            <h2 class="white">Just because you can not see it
            <mark>does not mean it is not there</mark></h2>

            <p>Our website is under construction.<br>If you want to know more, get in touch at:</p>

            <a class="button-elementor" href="mailto:sonia@nivd.world">sonia@nivd.world</a>
        
        </div>
    </div>
</body>

</html>

<style>
    body {
        background-color: #000;
    }

    body .container-coming-soon {
        text-align: center;
        max-width: 800px;
        width: 100%;
        margin: 0 auto;
        padding: 60px 40px;
    }

    .container-coming-soon .content img{
        max-width: 279px;
        width: 100%;
        height: auto;
        padding-top: 80px;
    }

    .container-coming-soon .content h2{
        font-size: 36px;
        font-weight: 400;
        line-height: 1.20em;
        color: #fff;
        padding: 0.25em 0 0.8em;
        margin-bottom: 0;
    }

    .container-coming-soon .content h2 mark{
        display: block;
        font-size: 36px;
        font-weight: 400;
        color: #FF5B22;
        background-color: transparent;
    }

    .container-coming-soon .content p{
        font-size: 13px;
        line-height: 1.538461538461538em;
        letter-spacing: 1px;
        font-weight: 600;
        color: #fff;
        padding-bottom: 1em;
    }


    .container-coming-soon .content a{
        display: inline-block;
        line-height: 1;
        background-color: #FF5B22;
        border-radius: 28px 28px 28px 28px!important;
        font-size: 15px;
        padding: 12px 24px;
        border-radius: 3px;
        color: #fff;
        fill: #fff;
        text-align: center;
        transition: all .3s;
        text-decoration: none;
    }


    .container-coming-soon .content a:hover{
        text-decoration: underline;
    }

</style>
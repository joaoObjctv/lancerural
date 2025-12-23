<head>
    <?php wp_head(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

     <!-- Google Tag Manager -->
        <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-M4PGWHN9');</script> -->
    <!-- End Google Tag Manager -->
    
</head>

<header>
    <div class="container flex-center">
        <a href="/" class="logo">
            <img src="<?= get_template_directory_uri() . '/assets/img/header-lr.svg'?>" alt="Logo Lance Rural" />
        </a>

        <div class="wrapMenu">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'menu-navegue',
                    'container' => 'nav',
                ));
            ?>
            <form action="https://www.lancerural.com.br" role="search" method="get" aria-label="Search form">
                <label for="searchForm">Pesquise aqui...</label>
                <input type="search" name="" id="searchForm" placeholder="Pesquise aqui...">
                <button type="submit">
                    <img src="<?= get_template_directory_uri() . '/assets/img/pesquisar.svg'?>" alt="Ícone de lupa" />
                </button>
            </form>
        </div>

        <a href="#" class="actShowMenu mobMenu">
            <span></span>
        </a>
    </div>
</header>

<body <?php body_class(); ?>>
    

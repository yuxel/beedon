<!DOCTYPE html>
<html>
    <head>
        <title>Title</title>
        <meta charset="utf-8" />

        {literal}
        <style type="text/css">

            @font-face {
              font-family: 'EastMarket';
              font-style: normal;
              font-weight: normal;
              src: local('EastMarket'), url('/github/beedon/Templates/default/_static/fonts/EastMarket-webfont.ttf') format('truetype');
            }

            @font-face {
              font-family: 'Florli';
              font-style: normal;
              font-weight: normal;
              src: local('Florli'), url('/github/beedon/Templates/default/_static/fonts/Florli-webfont.ttf') format('truetype');
            }

            @font-face {
              font-family: 'Florlrg';
              font-style: normal;
              font-weight: normal;
              src: local('Florlrg'), url('/github/beedon/Templates/default/_static/fonts/Florlrg-webfont.ttf') format('truetype');
            }


            @font-face {
              font-family: 'HollaScript';
              font-style: normal;
              font-weight: normal;
              src: local('HollaScript'), url('/github/beedon/Templates/default/_static/fonts/HollaScript-webfont.ttf') format('truetype');
            }


            @font-face {
              font-family: 'Mothproof';
              font-style: normal;
              font-weight: normal;
              src: local('Mothproof'), url('/github/beedon/Templates/default/_static/fonts/Mothproof-webfont.ttf') format('truetype');
            }






        </style>
        {/literal}

        <link rel="stylesheet" href="/github/beedon/Templates/default/_static/css/reset.css" media="screen" type="text/css" />

        <link  href="http://fonts.googleapis.com/css?family=Reenie+Beanie|Tangerine|Lobster" rel="stylesheet" type="text/css" >

        <meta name="description" content="Personal webspace and resume of Ed Wheeler, a Web/Graphic Designer and HTML/CSS Developer." />
        <meta name="keywords" content="web designer, graphic designer, html, xhtml, css, developer, portfolio, resume, Ed Wheeler" />
        <meta name="robots" content="all, index, follow" />

        <script src="http://cdn.jquerytools.org/1.2.3/jquery.tools.min.js"></script>

        {literal}
        <style type="text/css">
            body {
                background:#FFFFFF url('/github/beedon/Templates/default/_static/img/bg.jpg') repeat-x 0 164px;
                height:100%;
                font-family:Verdana,Arial,Geneva,Helvetica,sans-serif;
                font-size:12px;
                line-height:20px;
            }

            .sprite {
                background:url('/github/beedon/Templates/default/_static/img/sprite.jpg') no-repeat 0 0;
            }
            
            #headerWrapper {
                background-color:#020703;
            }

            #header {
                background-position:center 0;
                height:164px;
                padding:0 2px;
            }

            #pageWrapper {
                margin:0 auto;
                background-position:center -161px;
            }

            #pageCenter {
                width:960px;
                background:#FFFFFF;
                min-height:615px;
                height:auto !important;
                height:615px;
                margin:0 auto;

            }


            .toLeft {
                float:left;
            }

            .toRight {
                float:right;
            }


            .clear {
                clear:both;
            }

            .marginCentered{
                width:960px;
                margin:0 auto;
            }

            #sloganWrapper {
                float:right;
                margin:10px 160px 0 0; 
                width:300px;
                height:40px;
                text-align:center;
                font-weight:bold;
                text-shadow: 1px 1px #999;
                font-size:16px;
                font-family: 'Mothproof', serif;
                letter-spacing: 0.3em;
                color:#000;
                line-height:40px;
            }
            
            #navWrapper{
                float:right;
            }

            #navbar {
                margin:70px 10px 0 0 ;
                height:25px;
                width:650px;
                white-space:nowrap;
            }

            #navbar li{
                float:left;
                margin-right:24px;
            }

            #navbar li a {
                text-decoration:none;
                text-shadow: 1px 1px #999;
                font-size:18px;
                font-family: 'lobster', serif;
                letter-spacing: 5px;
                color:#000;
                font-weight:400;
            }

            #navbar li a:hover {
                color:#11b00f;
                text-shadow: 1px 1px #11b00f;
            }

            #main {
                width:740px;
                float:left;
                padding:0 5px;
            }

            #asideWrapper{
                width:200px;
                float:right;
            }


            #footerTop{
                padding-top:119px;
                background:#FFFFFF url('/github/beedon/Templates/default/_static/img/footer.jpg') no-repeat center 0;
            }

            #footerWrapper{
                color:white;
                background:#090b0a;
            }

            #footer .footerSide {
                width:300px;
                margin:0 10px;
            }

            #footer .footerSide h3 {
                text-align:center;
                border-bottom:1px dotted #FFF;

            }

            .article {
                font-family:Helvetica;
                color:#1e1e1e;
            }
        
            .article .header {
                margin-top:20px;
                padding:10px 3px;
                background:#f1f1f1;
                border-bottom:2px solid #cecece;
                height:25px;
            }

            .article .header a {
                text-decoration: none;
            }

            .article .header h1 {
                color:#4E4E4E;
                text-shadow:1px 1px 1px #FFFFFF;
                font-size:18px;
                float:left;
            }
            
            .article .header .dateTime {
                float:right;
                background-position:-100px 0;
                font-weight:bold;
            }

            .article .header .dateTime .month{
                padding-top:10px;
                display:block;
            }
            .article .header .dateTime .day{
                padding-top:10px;
                display:block;
            }


            .article .header .comments{
                padding-top:10px;
                float:right;
                font-size:20px;
                font-weight:bold;
                padding-top:18px;
            }

            .article .header .comments .commentText{
                text-indent : 99999px;
                display:block;
            }
 


            .articleSprite {
                background:url('/github/beedon/Templates/default/_static/img/articleSprite.png') no-repeat 0 0;
                width:100px;
                text-align:center;
                margin-top:-45px;
                color:#444444;
                font-size:18px;
                padding-bottom:20px;
            }


            .article .content {
                text-align:justify;
                line-height:20px;
                padding-bottom:20px;
            }

            .article .content img {
                padding:3px 10px 3px 0;
            }

        </style>
        {/literal}

    </head>
    <body>
        <div id="headerWrapper">
            <div id="header" class="sprite marginCentered">
                <header>
                    <div id="sloganWrapper">
                        <section id="sloganSection">
                            Can't stop learning!
                        </section>
                    </div> <!-- #slogan -->
                    <div class="clear"></div>

                    <div id="navWrapper">
                        <nav>
                            <ul id="navbar">
                                <li> 
                                    <a href="#">
                                        Blog
                                    </a>
                                </li>

                                <li> 
                                    <a href="#">
                                        Documents
                                    </a>
                                </li>

                                <li> 
                                    <a href="#">
                                        About
                                    </a>
                                </li>

                                <li> 
                                    <a href="#">
                                        Projects
                                    </a>
                                </li>

                                <li> 
                                    <a href="#">
                                        Gallery
                                    </a>
                                </li>

                                <li> 
                                    <a href="#">
                                        Contact
                                    </a>
                                </li>

                            </ul> <!-- #navbar -->
                        </nav>
                    </div> <!-- #navWrapper-->
                </header>
            </div> <!-- #header -->
        </div> <!-- #headerWrapper -->

        <div id="pageWrapper" class="sprite">
            <div id="pageCenter">
                <div id="main">     

                    {section name=foo start=1 loop=4 step=1}

                    <div class="article">
                        <article>
                            <div class="header">
                                <a href="#">
                                    <h1>Smarty Integration to Zend Framework</h1>

                                    <div class="dateTime articleSprite">
                                        <span class="month">May</span>
                                        <span class="day">13</span>
                                    </div><!-- .dateTime -->

                                    <div class="comments articleSprite">
                                        <span class="commentCount">13</span>
                                        <span class="commentText">Comments</span>
                                    </div>
                                    <div class="clear"></div>
                                </a>
                            </div> <!-- .header -->

                            <div class="content">
                                <img src="http://thehoopshaven.com/wp-content/uploads/2009/12/Kobe-game-winning-shot.jpg" alt="" style="float:left"/>

                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                Lorem Ipsum has been the industry's standard 
                                dummy text ever since the 1500s, when an unknown printer took 
                                a galley of type and scrambled it to make a type specimen book. 
                                It has survived not only five centuries, but also the leap into electroni
                                ypesettine, remaining essentially unchanged. It was popularised in the 1960s with the release 
                                of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                Lorem Ipsum has been the industry's standard 
                                dummy text ever since the 1500s, when an unknown printer took 
                                a galley of type and scrambled it to make a type specimen book. 
                                It has survived not only five centuries, but also the leap into electroni
                                ypesettine, remaining essentially unchanged. It was popularised in the 1960s with the release 
                                of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                            </div> <!-- .content -->


                        </article>
                    </div> <!-- .article -->
                {/section}
                </div> <!-- #main -->

                <div id="asideWrapper">
                    <aside>
                        <section id="rightBlock">
                            Right block
                        </section>    
                    </aside>
                </div> <!-- #asideWrapper-->

            </div> <!-- #page -->
            <div class="clear"></div>
        </div> <!-- #pageWrapper-->
       
    
        <div id="footerTop" class="marginCentered"></div>

        <div id="footerWrapper" >
            <div id="footer" class="marginCentered">
                <footer>    
                    <div class="footerSide toLeft">    
                        <aside>
                            <h3>Behind the site</h3>
                            <span>
                                Some text about site
                            </span>
                        </aside>
                    </div>

                    <div class="footerSide toLeft">    
                        <aside>
                            <h3>Some good sites</h3>
                            <span>
                                Some text other sites
                            </span>

                        </aside>
                    </div>


                    <div class="footerSide toRight">    
                        <aside>
                            <h3>About author</h3>
                            <span>
                                Some text about author
                            </span>

                        </aside>
                    </div>
                    <div class="clear"></div>
                </footer>
            </div> <!-- #footer -->
        </div> <!-- #footerWrapper -->
    </body>
</html>



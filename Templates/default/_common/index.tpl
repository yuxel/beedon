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

        <script src="/github/beedon/Templates/default/_static/js/html5.js"></script>
        <script src="http://cdn.jquerytools.org/1.2.3/jquery.tools.min.js"></script>

        {literal}
        <style type="text/css">

            header, nav, article, footer, section, figure {  
                    display: block;  
            }  

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
                border-left:2px solid #ddd;
                border-right:2px solid #ddd;
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

            #sidebar{
                width:200px;
                float:right;
            }

            #sidebar .section {
                margin-bottom:15px;
            }

            #sidebar .section h3 {
                color:red;
                background:transparent url('/github/beedon/Templates/default/_static/img/sideBar.png') no-repeat right 0;
                display:block;
                width:199px;
                height:41px;
                line-height:30px;
                padding-left:9px;
                color:#FFFFFF;
                text-shadow: 2px 2px 3px #000000;
            }


            #footerTop{
                padding-top:119px;
                background:#FFFFFF url('/github/beedon/Templates/default/_static/img/footer.jpg') no-repeat center 0;
                border-left:2px solid #ddd;
                border-right:2px solid #ddd;
 
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
                margin-top:30px;
                background:transparent url('/github/beedon/Templates/default/_static/img/leftCaption.png') no-repeat 0 0;
                height:31px;
                padding-bottom:7px;
                margin-left:-22px;
            }

            .article .header a {
                text-decoration: none;
            }

            .article .header .headerBg {
                float:left;
                background:#f1f1f1;
                width:655px;
                height:31px;
                line-height:31px;

            }        

            .article .header h1 {
                height:31px;
                line-height:31px;
                background:#f1f1f1;
                background:transparent;
                color:#4E4E4E;
                text-shadow:0px 0px 4px #777777;
                font-size:18px;
                float:left;
                display:block;
                padding-left:10px;
            }
            
            .article .header .dateTime {
                float:left;
                font-weight:bold;
                width:107px;
                color:#FFFFFF;
                text-shadow: 2px 2px 3px black;
                text-align:center;
                line-height:31px;
            }

            .article .header .comments{
                height:38px;
                float:right;
                font-size:20px;
                font-weight:bold;
                padding-top:14px;
            }

            .article .header .comments .commentText{
                display:none;
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
            <header id="header" class="sprite marginCentered">
                <section id="sloganWrapper">
                    Can't stop learning!
                </section>
                <div class="clear"></div>

                <nav id="navWrapper">
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
                </nav> <!-- #navWrapper-->

            </header> <!-- #header -->
        </div> <!-- #headerWrapper -->

            <div id="pageWrapper" class="sprite">
                <div id="pageCenter">
                    <div id="main">     

                        {section name=foo start=1 loop=4 step=1}

                        <article class="article">
                            <div class="header">
                               <div class="dateTime">
                                    <span class="month">May</span>
                                    <span class="day">13</span>
                                </div><!-- .dateTime -->
                                <a href="#">
                                   <div class="headerBg">
                                        <h1>Smarty Integration to Zend Framework</h1>

                                        <div class="comments articleSprite">
                                            <span class="commentCount">13</span>
                                            <span class="commentText">Comments</span>
                                        </div>
                                    </div><!-- .headerBg -->
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


                        </article> <!-- article -->
                    {/section}
                    </div> <!-- #main -->

                    <aside id="sidebar">
                        <section id="search" class="section">
                            <h3>Search</h3>
                            <span>
                                Right block <br/>
                            </span>
                        </section>    

                        <section id="search" class="section">
                            <h3>Search</h3>
                            <span>
                                Right block
                            </span>
                        </section>    


                    </aside> <!-- #sidebar -->

                    <div class="clear"></div>
                </div> <!-- #pageCenter -->
                <div class="clear"></div>
            </div> <!-- #pageWrapper-->
           
        
            <div id="footerTop" class="marginCentered"></div>

            <div id="footerWrapper" >
                <footer id="footer" class="marginCentered">

                    <aside class="footerSide toLeft">    

                        <h3>Behind the site</h3>
                        <span>
                            Some text about site
                        </span>
                    </aside>

                    <aside class="footerSide toLeft">
                        <h3>Some good sites</h3>
                        <span>
                            Some text other sites
                        </span>

                    </aside>


                    <aside class="footerSide toRight">    

                        <h3>About author</h3>
                        <span>
                            Some text about author
                        </span>

                    </aside>

                    <div class="clear"></div>
                </footer> <!-- #footer -->
        </div> <!-- #footerWrapper -->
    </body>
</html>



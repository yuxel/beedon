<!DOCTYPE html>
<html>
    <head>
        <title>Title</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="/github/beedon/Templates/default/_static/css/reset.css" media="screen" type="text/css" />

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
            }
            
            #navWrapper{
                float:right;
            }

            #navbar {
                border:1px solid blue;
                margin:70px 10px 0 0 ;
                height:25px;
                width:650px;

            }

            #navbar li{
                float:left;
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
                            Cant stop learning!
                        </section>
                    </div> <!-- #slogan -->
                    <div class="clear"></div>

                    <div id="navWrapper">
                        <nav>
                            <ul id="navbar">
                                <li> 
                                    <a href="#">
                                        Link1
                                    </a>
                                </li>

                                <li> 
                                    <a href="#">
                                        Link2
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
                    Burası ana içerik
                </div> <!-- #main -->

                <div id="asideWrapper">
                    <aside>

                        <section id="resume-dl">
                            Burası sag taraftaki bir blok
                        </section>    
                    </aside>
                </div> <!-- #asideWrapper-->

            </div> <!-- #page -->
            <div class="clear"></div>
        </div> <!-- #pageWrapper-->
        
        <div id="footer-wrapper" class="marginCentered">
            <footer>        
                Burası footer
            </footer>
        </div>
    </body>
</html>



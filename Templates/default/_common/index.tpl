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
            }

            .sprite {
                background:url('/github/beedon/Templates/default/_static/img/sprite.jpg') no-repeat 0 0;
            }
            
            #headerWrapper {
                background-color:#020703;
            }

            #header {
                background-position:0 0;
                height:164px;
            }

            #pageWrapper {
                margin:0 auto;
                width:1182px;
            }

            #pageCenter {
                margin-left:2px;
                width:788px;
                background:#FFFFFF;
                min-height:615px;
                height:auto !important;
                height:615px;

            }


            .pageWings {
                width:196px;
                min-height:615px;
                height:auto !important;
                height:615px;
            }

            #pageLeft{
                background-position:-353px -234px;
            }


            #pageRight{
                background-position:-589px -234px;
            }

            .toLeft {
                float:left;
            }

            .clear {
                clear:both;
            }

            .marginCentered{
                width:790px;
                margin:0 auto;
            }

            
        </style>
        {/literal}

    </head>
    <body>
        <div id="headerWrapper">
            <div id="header" class="sprite marginCentered">
                <header>
                    <nav>
                        <ul id="navbar">
                            <li></li>
                        </ul> <!-- #navbar -->
                    </nav>
                </header>
            </div> <!-- #header -->
        </div> <!-- #headerWrapper -->

        <div id="pageWrapper" class="marginCentered">
            <div id="pageLeft" class="sprite toLeft pageWings"></div>
            <div id="pageCenter" class="marginCentered toLeft">
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
            <div id="pageRight" class="sprite toLeft pageWings"></div>
            <div class="clear"></div>
        </div> <!-- #pageWrapper-->
        
        <div id="footer-wrapper" class="marginCentered">
            <footer>        
                Burası footer
            </footer>
        </div>
    </body>
</html>



<!DOCTYPE html>
<html>
    <head>
        <title>Title</title>
        <meta charset="utf-8" />

        <link  href="http://fonts.googleapis.com/css?family=Reenie+Beanie|Tangerine|Lobster" rel="stylesheet" type="text/css" >

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
                min-height:515px;
                height:auto !important;
                height:515px;
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
                font-size:18px;
                font-family: 'lobster', serif;
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
            }

            #navbar li{
                float:left;
                margin-right:35px;
            }

            #navbar li a {
                text-decoration:none;
                text-shadow: 1px 1px #999;
                font-size:18px;
                font-family: 'Reenie Beanie', serif;
                letter-spacing: 0.3em;
                color:#000;
                font-weight:bolder;
            }

            #navbar li a:hover {
                color:#11b00f;
                text-shadow: 1px 1px #11b00f;
            }

            #main {
                width:750px;
                float:left;
                padding-bottom:127px;
            }

            #asideWrapper{
                width:200px;
                float:right;
            }

            #footerWrapper{
                margin-top:-127px;
                padding-top:127px;
                background:#090b0a url('/github/beedon/Templates/default/_static/img/footer.jpg') no-repeat 0 0;
                color:white;
            }

            #footerWrapper .footerSide {
                width:300px;
                margin:0 10px;
            }

            #footerWrapper .footerSide h3 {
                text-align:center;
                border-bottom:1px dotted #FFF;

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
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
                    Main content comes here <br/>
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
        
        <div id="footerWrapper" class="marginCentered">
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
        </div>
    </body>
</html>



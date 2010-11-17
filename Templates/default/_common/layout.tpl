<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Eksigator</title>
        <script src="{$_staticPath}/js/html5.js"></script>
        <link rel="stylesheet" href="{$_staticPath}/css/reset.css" />
        <link rel="stylesheet" href="{$_staticPath}/css/generic.css" />
        <link rel="stylesheet" href="{$_staticPath}/css/layout.css" />
        <link rel="stylesheet" href="{$_staticPath}/css/articles.css" />
    </head>
    <body>
        <div id="headerWrapper">
            <header class="center">
                <a class="logo" href="{$_root}">
                    Osman Yuksel :: Blog
                </a>
                <section> 
                    Burası slogan 
                </section>
                <nav>
                    Link1  Link 2
                </nav>
            </header>
        </div>

        <div id="contentWrapper"> 
            <div id="content" class="center">
                <aside id="leftBlock">
                    {$content}
                </aside> <!-- leftBlock -->

                <aside id="rightBlock">
                    Burası da sag
                </aside>
                <div class="clear"></div>
            </div> <!-- #content -->
        </div> <!-- #contentWrapper -->


        <div id="footerTop" class="center"></div>
        <div id="footerWrapper">
            <footer class="center">
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
            </footer>
        </div> <!-- #footerWrapper -->
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{$_layoutConstants->header->globalTitle}{if $_layoutConstants->header->title}
                | {$_layoutConstants->header->title}
            {/if}</title>
        <script src="{$_staticPath}/js/html5.js"></script>
        <link rel="stylesheet" type="text/css" href="{$_staticPath}/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="{$_staticPath}/css/generic.css" />
        <link rel="stylesheet" type="text/css" href="{$_staticPath}/css/layout.css" />
        <link rel="stylesheet" type="text/css" href="{$_staticPath}/css/articles.css" />
    </head>
    <body>
        <div id="headerWrapper">
            <header class="center">
                <a class="logo" href="{$_root}">
                    Osman Yuksel :: Blog
                </a>
                <section> 
                    {$_layoutConstants->header->slogan}
                </section>
                <nav>
                    Blog ,
                    Projects ,
                    About This Blog ,
                    About Author ,
                    Contact
                </nav>
            </header>
        </div>

        <div id="contentWrapper"> 
            <div id="content" class="center">
                <aside id="leftBlock">
                    {$content}
                </aside> <!-- leftBlock -->

                <aside id="rightBlock">
                    <a class="handmade">
                        <img src="{$_staticPath}/img/handmade.jpg">
                    </a>
                </aside>
                <div class="clear"></div>
            </div> <!-- #content -->
        </div> <!-- #contentWrapper -->


        <div id="footerTop" class="center"></div>
        <div id="footerWrapper">
            <footer class="center">
                {include file="_common/footer.tpl"}
            </footer>
        </div> <!-- #footerWrapper -->

        <a id="forkMe" class="hidden" href="http://github.com/yuxel/beedon/tree/yuxel.net" target="blank">
            Fork me on GitHub
        </a>


    </body>
</html>

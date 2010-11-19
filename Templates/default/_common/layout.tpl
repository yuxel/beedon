<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>
            {$_layoutConstants->header->globalTitle}
            {if $_layoutConstants->header->title}
                | {$_layoutConstants->header->title}
            {/if}
        </title>
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
                    {$_layoutConstants->header->slogan}
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
                        This site is flavored with Beedon, 
                        PHP, HTML5, CSS3, and a 
                        jQuery based JavaScript awesome. <br/> <br/>
                       
                        There're lots of tools which helped me to build
                        this kitchen such as Debian (the universal oeprating system),
                        vim (the ultimate text editor). <br/><br/>

                        FBI Warning!!! <br/>
                        This blog can become <em>'schizophrenic blog'</em> on some posts!
                    </span>
                </aside>

                <aside class="aboutAuthor footerSide toRight">    
                    <h3>About author</h3>
                    <span>
                        <img src="{$_staticPath}/img/yuxel.jpg" />
                        Osman Yuksel, works as a front-end developer in a 
                        software house named 
                        <a href="http://www.tart.com.tr/" target="blank">Tart</a> 
                        with great Bospohourus view in Istanbul. <br/> <br/>

                        After 6 years of blogging in Turkish, he decided to write 
                        something in English. He's passionate about open sourced
                        web technologies. <br/> <br/>

                        He is well known as <em>'The front-end guy who uses Vim'</em>, 
                        <em>'web standarts evangelist who even sends email in valid markup'</em>,
                        <em>'man in `browse me` tshirt'</em> and
                        <em>'blogger who introduces himself speaking in third person'</em>
                        among his entourage. <br/> <br/>

                        You can check his <a href="http://yuxel.net/cv/_en">CV</a> 
                        and 6 years old <a href="http://yuxel.net">Turkish blog</a>.

                    </span>

                </aside>
                <div class="clear"></div>
            </footer>
        </div> <!-- #footerWrapper -->

        <a id="forkMe" href="https://github.com/yuxel/beedon/tree/yuxel.net" target="blank">
            Fork me on GitHub
        </a>


    </body>
</html>

<!DOCTYPE html>

<html>

    <head>

        <title>Eksigator</title>

        <meta charset="utf-8" />

        <link rel="stylesheet" href="http://beedon.org/beta/Templates/default/_static/css/reset.css" media="screen" type="text/css" />
        {literal}

    <style>

        #header,
        #contentWrapper {
            background:url('/github/beedon/Templates/default/_static/img/sprite.jpg') no-repeat 0 0;
        }

        #headerWrapper {
            background-color:#020703;
        }

    

        body {
            background:#FFFFFF url('/github/beedon/Templates/default/_static/img/bg.jpg') repeat-x 0 164px;
            height:100%;
            font-family:Verdana,Arial,Geneva,Helvetica,sans-serif;
            font-size:12px;
            line-height:20px;
        }



        .center {
            width:960px;
            margin:0 auto;
        }
        
        #header {
            position:relative;
            background-position:center 0;
            height:164px;
        }
        
        #header #slogan {
            width:300px;
            height:40px;
            position:relative;
            top:10px;
            left:500px;
            border:1px solid red;
        }

        #header #menu {
            width:600px;
            height:25px;
            position:absolute;
            top:115px;
            right:40px;
            border:1px solid blue;
        }

        #contentWrapper {
            background-position:center -161px;

        }

        #content {
            min-height:515px;
            height:auto !important;
            height:515px;

        }

        #content #leftBlock {
            width:700px;
            float:left;
            background:#CCC;
        }
        
        #content #rightBlock {
            width:250px;
            float:right;
            background:#DDD;
        }

        #content .article {
            background:#FFF;
            width:698px;
            border:1px solid red;
        }

        #content .article .title {
            margin-top:20px;
            border:2px solid green;
            position:relative;
            top:0;
            left:-40px;
            background:yellow;
            color:red;
        }

        #content .article div {
            position:relative;

        }

        #content .article .title .titleText {
            float:left;
        } 

        #content .article .title .date {
            float:left;
        } 

        #content .article .title .comments {
            float:right;
            height:40px;
            width:40px;
            border:3px solid yellow;
            position:absolute;
            right:-40px;
            top:-20px;
        } 


        #content .article span {
            display:block;
        } 



        #footerTop {
            background:#000 url('/github/beedon/Templates/default/_static/img/footer.jpg') no-repeat center 0;
            height:119px;
            border-left:1px solid #BBB;
            width:956px;

        }
        #footer {
            height:20px;
            background:#090b0a;
        }
    </style>
    {/literal}
    
    </head>
    <body>
    <div id="headerWrapper">
        <div id="header" class="center">
            <div id="slogan"> Burası slogan </div>
            <div id="menu">Link1  Link 2</div>
        </div>
    </div>
   
    <div id="contentWrapper"> 
        <div id="content" class="center">
            <div id="leftBlock">
                <div class="article">
                    <div class="title"> 
                        <div class="date">  
                            23 mart
                        </div>

                        <div class="titleText">
                            Buraya baslik
                        </div>

                        <div class="comments">
                        </div>
                    
                        <div style="clear:both"></div>
                    </div>
                    <span>

    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat


                    </span>
                </div>    
            </div>

            <div id="rightBlock">
                Burası da sag
            </div>
        </div>
    </div>
   
        <div id="footerTop" class="center">
        </div>
        <div id="footer">
        </div>

    </body>
</html>


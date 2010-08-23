<!DOCTYPE html>

<html>

    <head>

        <title>Eksigator</title>

        <meta charset="utf-8" />

        <link rel="stylesheet" href="http://beedon.org/beta/Templates/default/_static/css/reset.css" media="screen" type="text/css" />
    {literal}
    <style>

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
       
        #headerWrapper {
            background-color:#020703;
        }



        #header {
            background:url('/github/beedon/Templates/default/_static/img/sprite.jpg') no-repeat 0 0;
            position:relative;
            background-position:center 0;
            height:164px;
            padding:0 1px;

        }
        
        #header #slogan {
            width:300px;
            height:40px;
            position:relative;
            top:10px;
            left:500px;
            background:yellow;
        }

        #header #menu {
            width:600px;
            height:25px;
            position:absolute;
            top:120px;
            right:40px;
            background:blue;
        }

        #contentWrapper {
            background:url('/github/beedon/Templates/default/_static/img/sprite.jpg') no-repeat 0 0;
            background-position:center -161px;
        }

        #content {
            border-left:1px solid #BBB;
            border-right:1px solid #BBB;
            min-height:515px;
            height:auto !important;
            height:515px;
            background:#FFFFFF;
        }

        #content #leftBlock {
            width:700px;
            float:left;
        }
        
        #content #rightBlock {
            width:250px;
            float:right;
            background:#DDD;
        }

        #content .article {
            background:#FFF;
            width:698px;
        }

        #content .article .title {

            background:transparent url('/github/beedon/Templates/default/_static/img/leftCaption.png') no-repeat 0 0;
            margin-top:20px;
            position:relative;
            top:0;
            left:-16px;
            padding-bottom:7px;
            color:red;
            height:31px;

        }

        #content .article div {
            position:relative;

        }

        #content .article .title .titleText {
            background:#f1f1f1;
            height:31px;
            float:left;
            width:550px;

            line-height:30px;
            color:#4E4E4E;
            text-shadow:0px 0px 4px #777777;
            font-size:18px;
            float:left;
            display:block;
            padding-left:10px;


        } 

        #content .article .title .date {
            float:left;
            font-weight:bold;
            color:#FFFFFF;
            text-shadow: 2px 2px 3px black;
            text-align:center;
            padding:5px 0 0 10px;
            width:97px;
        } 

        #content .article .title .comments {
            float:right;
            height:40px;
            width:40px;
            border:3px solid yellow;
            position:absolute;
            right:-10px;
            top:-20px;
        } 


        #content .article span {
            display:block;
        } 



        #footerTop {
            background:#000 url('/github/beedon/Templates/default/_static/img/footer.jpg') no-repeat center 0;
            height:119px;
            border-left:1px solid #BBB;
            border-right:1px solid #BBB;
            width:960px;

        }
        #footer {
            height:20px;
            background:#090b0a;
        }
 

        {/literal}
    </style>
    
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
                {section name=foo start=10 loop=20 step=2}  
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
                    </div> <!-- .title -->
                    <span>

    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat


                    </span>
                </div> <!-- .article -->
                {/section}
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


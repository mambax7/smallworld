<html>
<head>
    <style type="text/css">
        ol, ul {
            list-style: none
        }

        a {
            text-decoration: none;
            color: #1f1f1f;
        }

        a:hover {
            text-decoration: none;
            color: #5d8ba6;
        }

        h4 {
            font-family: Puritan20Normal, sans-serif;
            font-weight: normal;
            color: #1f1f1f;
            margin-bottom: 10px;
            font-size: 17px;
        }

        img.left {
            top: 0px;
            float: left;
            display: block;
            margin: 0;
            padding: 0;
            margin-right: 20px;
        }

        #wrapper {
            width: 960px;
            margin: 100px auto 0;
            padding-top: 0;
            line-height: 20px;
            background-color: #33FFFF;
            border-style: groove;
            border-color: #00ffff;
            border-width: medium;
        }

        #newslist ul li {
            width: 850px;
            px;
            background: none;
            margin: 2px 0 18px 2px;
            background-color: #FFF;
            -webkit-box-shadow: 0px 1px 2px 0px #b7b7b7;
            -moz-box-shadow: 0px 1px 2px 0px #b7b7b7;
            box-shadow: 0px 1px 2px 0px #b7b7b7;
            padding: 15px;
            display: block;
            overflow: hidden;
        }

        #newslist p {
            margin: 0;
        }

        #newslist h4 {
            margin-bottom: 8px;
            line-height: 1;
        }

        #newslist h4 span {
            font-style: italic;
            font-family: Georgia, "Times New Roman", Times, serif;
            font-size: 12px;
            color: #565656;
            padding-left: 5px;
        }

        #news h2 {
            float: left;
            margin-top: 10px;
        }

        .greeting {
            margin: 0px 0px 0px 25px;
        }

        .infotext {
            margin: 10px 0px 0px 25px;
        }

        .title2 {
            margin-bottom: 12px;
            margin-top: 2px;
        }

        .title {
            margin-bottom: 12px;
            margin-top: 4px;
        }
    </style>
</head>
<body>
<!-- Begin Wrapper -->
<div id="wrapper">
    <br>
    <p class="greeting">Hello <{$receivename}>,</p>
    <p class="infotext"><{$sendname}> commented your wall-update on <{$sitename}></p>
    <div id="news">
        <!-- Begin News Navigation -->
        <div id="newslist">
            <ul>
                <!-- Begin Entry Heading 1 -->
                <li><{$to_avatarlink}>
                    <h4 class="title"><{$ownernameurl}> <span style="font-size:11px">Original message is</span></h4>
                    <p><{$ownermessage}></p>
                </li>
                <!-- End Entry Heading 1 -->

                <!-- Begin Entry Heading 2 -->
                <li style="margin-left:25px;width:780px"><{$from_avatarlink}>
                    <h4 class="title2"><{$sendnameurl}> <span style="font-size:11px"> replied on (<{$itemtextdate}> servertime)</span></h4>
                    <p><{$itemtext}></p>
                </li>
                <!-- End Entry Heading 2 -->
            </ul>
        </div>
    </div>
    <!-- End News Navigation -->
    <br>
    <p align="center"><{$replylink}></p>
    <br>
</div>

<!-- End Wrapper -->
</body>
</html>

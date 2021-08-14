<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <!-- Facebook sharing information tags -->
        <meta property="og:title" content="Starter Kit" />
        
        <title>{{config('app.name', 'Laravel')}}</title>
        <style type="text/css">
            /* Client-specific Styles */
            #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
            body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
            body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */

            /* Reset Styles */
            body{margin:0; padding:0;}
            img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
            table td{border-collapse:collapse;}
            #backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}

            /* Template Styles */
            body, #backgroundTable{
                background-color:#dce4e9;
            }

            h1, .h1{
                color:#333333;
                display:block;
                font-family:Arial;
                font-size:34px;
                font-weight:bold;
                line-height:100%;
                margin-top:0;
                margin-right:0;
                margin-bottom:10px;
                margin-left:0;
                text-align:left;
            }

            h2, .h2{
                color:#333333;
                display:block;
                font-family:Arial;
                font-size:30px;
                font-weight:bold;
                line-height:100%;
                margin-top:0;
                margin-right:0;
                margin-bottom:10px;
                margin-left:0;
                text-align:left;
            }

            h3, .h3{
                color:#333333;
                display:block;
                font-family:Arial;
                font-size:26px;
                font-weight:bold;
                line-height:100%;
                margin-top:0;
                margin-right:0;
                margin-bottom:10px;
                margin-left:0;
                text-align:left;
            }

            h4, .h4{
                color:#333333;
                display:block;
                font-family:Arial;
                font-size:22px;
                font-weight:bold;
                line-height:100%;
                margin-top:0;
                margin-right:0;
                margin-bottom:10px;
                margin-left:0;
                text-align:left;
            }

            #templateHeader{
                background-color:#FFFFFF;
                border-bottom:0;
            }

            .headerContent{
                color:#333333;
                font-family:Arial;
                font-size:34px;
                font-weight:bold;
                line-height:100%;
                padding:20px;
                vertical-align:middle;
                border-bottom: 3px solid #c1bdbe;
            }

            .headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
                color:#008ccc;
                font-weight:normal;
                text-decoration:underline;
            }

            #headerImage{
                height:auto;
                max-width:600px !important;
            }

            #templateContainer, .bodyContent{
                background-color:#FFFFFF;
            }

            .bodyContent {
                padding-bottom: 100px;
            }
            
            .bodyContent div{
                color:#505050;
                font-family:Arial;
                font-size:14px;
                line-height:150%;
                text-align:left;
            }

            .bodyContent div a:link, .bodyContent div a:visited, /* Yahoo! Mail Override */ .bodyContent div a .yshortcuts /* Yahoo! Mail Override */{
                color:#008ccc;
                font-weight:normal;
                text-decoration:underline;
            }

            .templateButton{
                -moz-border-radius:3px;
                -webkit-border-radius:3px;
                background-color:#336699;
                border:0;
                border-collapse:separate !important;
                border-radius:3px;
            }

            .bodyContent img{
                display:inline;
                height:auto;
            }

            #templateFooter{
                background-color:#FFFFFF;
                border-top:0;
            }

            .footerContent div{
                color:#707070;
                font-family:Arial;
                font-size:12px;
                line-height:125%;
                text-align:center;
            }

            .footerContent p {
                background: #444444;
                color: #ffffff;
                font-size: 13px;
                text-align: center;
                padding: 10px;
                margin: 0;
            }

            .footerContent div a:link, .footerContent div a:visited, /* Yahoo! Mail Override */ .footerContent div a .yshortcuts /* Yahoo! Mail Override */{
                color:#008ccc;
                font-weight:normal;
                text-decoration:underline;
            }

            .footerContent img{
                display:inline;
            }
        </style>
    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
        <center>
            <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
                <tr>
                    <td align="center" valign="top" style="padding-top:20px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader">
                                        <tr>
                                            <td class="headerContent">
                                                <img src="{{ $message->embed(public_path() . '/images/mousebags-logo.png') }}" style="width: 150px; height: auto;" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
                                        <tr>
                                            <td valign="top">
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top" class="bodyContent">
                                                            <div>
                                                                @yield('content')
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateFooter">
                                        <tr>
                                            <td valign="top" class="footerContent">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top">
                                                            <div>
                                                                <p>{{ \Carbon\Carbon::now()->format('Y') }} by {{config('app.name', 'Laravel')}}. all rights reserved.</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>                                            
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <br />
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>

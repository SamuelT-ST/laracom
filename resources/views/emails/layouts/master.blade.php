<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lumo')</title>
    <style type="text/css">

        #outlook a {padding:0;}

        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
        #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
        img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
        a img {border:none;}
        .image_fix {display:block;}
        p {margin: 0px 0px !important;}

        table td {border-collapse: collapse;}
        table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }

        table[class=full] { width: 100%; clear: both; }

        .full {
            width:300px;
        }

        @media only screen and (max-width: 640px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: #ffffff;
                pointer-events: none;
                cursor: default;
            }
            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #ffffff !important;
                pointer-events: auto;
                cursor: default;
            }
            table[class=devicewidth] {width: 440px!important;text-align:center!important; object-fit:cover;}
            table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
            table[class="sthide"]{display: none!important;}
            img[class="bigimage"]{width: 420px!important;height:219px!important;}
            img[class="col2img"]{width: 420px!important;height:258px!important;}
            img[class="image-banner"]{width: 440px!important;height:106px!important;}
            td[class="menu"]{text-align:center !important; padding: 0 0 10px 0 !important;}
            td[class="logo"]{padding:10px 0 5px 0!important;margin: 0 auto !important;}
            img[class="logo"]{padding:0!important;margin: 0 auto !important;}

            .full {
                width: 100%;
            }

        }

        @media only screen and (max-width: 480px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: #ffffff;
                pointer-events: none;
                cursor: default;
            }
            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #ffffff !important;
                pointer-events: auto;
                cursor: default;
            }

            td[class=bg1] {height:auto !important;}

            table[class=devicewidth] {width: 280px!important;text-align:center!important;}
            table[class=devicewidth] {width: 280px!important;text-align:center!important;}
            table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
            table[class="sthide"]{display: none!important;}
            img[class="bigimage"]{width: 260px!important;height:136px!important;}
            img[class="col2img"]{width: 260px!important;height:160px!important;}
            img[class="image-banner"]{width: 280px!important;height:68px!important;}

        }

        .data {
            border-spacing: 20px 11px;
            border-collapse: separate;
            width: 100%;
        }

        .data tr td{
            font-size: 12px;
        }
    </style>


</head>

<body bgcolor="white" style="min-width: 100%">
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">@yield('title', 'Objednavka')</div>
    
    <div class="block" style="text-align: center">
        <!-- Zaciatok headra -->
        <table style="width: 100%;margin:0 auto;" bgcolor="white" cellpadding="0" cellspacing="0" border="0" >
            <tbody>
            <tr>
                <td style="width: 100%;">
                    <table style="margin:0 auto;" width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                        <tbody>
                        <!-- Medzera -->
                        <tr>
                            <td style="width: 100%;" height="5"></td>
                        </tr>
                        <!-- Medzera -->
                        <!-- Medzera -->
                        <tr>
                            <td style="width: 100%;" height="5"></td>
                        </tr>
                        <!-- Medzera -->
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="block" style="text-align: center">
        <table style="width: 100%;margin: 0 auto; text-align: center;"  bgcolor="white" cellpadding="0" cellspacing="0" border="0"  align="center">
            <tbody>
            <tr>
                <td>
                    <table style="margin:0 auto; text-align: center" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit">
                        <tbody>
                            <tr>
                                <td>
                                    <table style="margin:0 auto;" width="600" bgcolor="white" cellpadding="0" cellspacing="0" border="0" align="left" class="devicewidth">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center;padding: 20px;"><a href="{{trans('email.global.logoLink')}}">
                                                    <img src="{{asset('images/frontend/logo.png')}}" alt="" width="100" border="0" /></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    @yield('content')

</body>
</html>
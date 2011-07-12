<?php
/*
 *
  application:	FBM Calendar
  auteur: 	Stefan Meier
  version:	20110710

 *
 */
require_once('php/application/GlobalRegistry.php');
require_once('php/application/LanguageLinker.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>UNIL - FBM CALENDAR</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <link type="text/css" rel="StyleSheet" href="html/css/UNIL-FBM_default.css" />
        <link rel="stylesheet" type="text/css" href="html/css/default.css" />

        <!-- Begin JQuery -->
        <link type="text/css" rel="StyleSheet" href="html/css/jquery-ui-1.8.4.custom.css" />
        <script type="text/javascript" src="html/js/jquery.js"></script>
        <script type="text/javascript" src="html/js/jquery.ui.core.js"></script>
        <script type="text/javascript" src="html/js/jquery.validate.js"></script>


        <!-- End JQuery -->
        <script type="text/javascript" src="html/js/plugins.js"></script>
        <script type="text/javascript" src="html/js/application.js"></script>
        <script type="text/javascript">
            <!--
            function sessionTimeout(){
                window.location = "http://wwwfbm.unil.ch/calendar"
            }
            //-->
        </script>
        <link rel="icon" href="https://wwwfbm.unil.ch/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="https://wwwfbm.unil.ch/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <div id="main">
            <span style="color:red; font-weight: bold">Version de développement</span>
            <table border="0" cellpadding="0" cellspacing="0" width="1240"
                   style="margin-left: auto;
                   margin-right: auto;
                   margin-top: 20px;
                   border: 1px solid #000000;">
                <tr>
                    <td colspan="4">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td class="header">
                                        <img src="https://wwwfbm.unil.ch/html/img/head_fbm.gif" alt="Barre verticale" border="0" />
                                    </td>
                                    <td class="header" style="text-align: right; vertical-align: middle; padding: 6px;">
                                        <?php if (@!$_SERVER['HTTP_SHIB_PERSON_UID']) {
                                        ?>
                                            <a href="https://wwwfbm.unil.ch/Shibboleth.sso/DS?entityID=https%3A%2F%2Faai.unil.ch%2Fidp%2Fshibboleth&target=http%3A%2F%2Fwwwfbm.unil.ch%2Fcalendar">
                                                <img src="https://wwwfbm.unil.ch/html/img/login.gif" alt="login" align="absmiddle"/>
                                            </a>
                                        <?php } else {
                                        ?>
                                            <a href="https://wwwfbm.unil.ch/Shibboleth.sso/Logout?return=https://wwwfbm.unil.ch/calendar">
                                                <img src="https://wwwfbm.unil.ch/html/img/logout.gif" alt="logout" align="absmiddle"/>
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="10" colspan="4" class="header_title">
                        <table border="0" width="100%">
                            <tr>
                                <td><span id="page-title" style="font-weight: bold;"></span></td>
                                <td width="140">&nbsp;</td>
                                <td valign="bottom" align="right">
                                    <span id="en" class="language">English</span> | <span id="fr" class="language">Français</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" height="2" bgcolor="#f5e3c6">&nbsp;</td>
                </tr>
                <tr bgcolor="#f5e3c6" >
                    <td width="5px">&nbsp;</td>
                    <td valign="top" width="952" align="left">
                        <!-- Content -->
                        <table border="0" cellpadding="0" cellspacing="0" width="99%">
                            <tr>
                                <td height="100%" width="100%">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr valign="top" class="title">
                                            <td class="title_l">
                                                <h1>
                                                    <span id="prev"><img src="html/img/left.gif" border="0" alt="" align="absmiddle" /></span>
                                                    <span style="display:-moz-inline-block; display:-moz-inline-box; display:inline-block;width: 160px; text-align: center;">
                                                        <span id="monthname" ></span>&nbsp;<span id="yearName" ></span></span>
                                                    <span id="next"><img src="html/img/right.gif" border="0" alt="" align="absmiddle" /></span>
                                                </h1>
                                                <div id="roomName" class="V9G" >&nbsp;</div>
                                            </td>
                                            <td class="title_r">
                                                <!--<img src="html/img/today1.png" alt="Barre verticale" border="0" />-->
                                                <!--<img src="html/img/week.gif" alt="Afficher par semaine" title="Afficher par semaine" border="0"/>-->
                                                <img src="html/img/month.gif" alt="Afficher par mois" title="Afficher par mois" border="0"/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" bgcolor="#999999" id="calendar">

                                            </td>
                                        </tr>
                                    </table>
                                    <!-- End Contenu texte --->
                                </td>
                            </tr>
                        </table>
                        <!-- End Content -->
                    </td>
                    <td width="5px">&nbsp;</td>
                    <td valign="top" align="center">
                        <table border="0" cellpadding="0" cellspacing="0" width="95%">
                            <tbody>
                                <tr>
                                    <td class="calborder">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tbody><tr>
                                                    <td class="sideback"><div id="information-title" style="height:16px; font-weight: bold; padding: 3px;"></div></td>
                                                </tr>
                                                <tr>
                                                    <!-- Begin Menu -->
                                                    <td class="text" height="80" id="roomDescription">
                                                    </td>
                                                    <!-- End Menu -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://wwwfbm.unil.ch/html/img/spacer20.gif" height="15"  width="1" alt="spacer"/>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="calborder">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tbody><tr>
                                                    <td class="sideback">
                                                        <div id="calendar-choice"style="height:16px; font-weight: bold; padding: 3px;"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!-- Begin Menu -->
                                                    <td class="text" height="80">
                                                        <div id="rooms"></div>
                                                    </td>
                                                    <!-- End Menu -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://wwwfbm.unil.ch/html/img/spacer20.gif" height="15"  width="1" alt="spacer"/>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="calborder">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tbody><tr>
                                                    <td class="sideback"><div id="go-to" style="height:16px; font-weight: bold; padding: 3px;"></div></td>
                                                </tr>
                                                <tr>
                                                    <!-- Begin Menu -->
                                                    <td class="text" height="80">

                                                        <!--<span id="today"><a>Ajourd'hui</a></span>-->
                                                        <form name="monthYear" action="">
                                                            <select name="year" class="query_style" id="year">
                                                            </select>

                                                            <select name="month" class="query_style" id="month">

                                                            </select>
                                                        </form>
                                                    </td>
                                                    <!-- End Menu -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" height="20" bgcolor="#f5e3c6">&nbsp;</td>
                </tr>
                <tr>
                    <td class="footer" height="20" colspan="4">
                        <table border="0" width="100%">
                            <tr>
                                <td><img src="https://wwwfbm.unil.ch/html/img/foot_fbm.gif" alt="Barre verticale" border="0" /></td>
                                <td>&nbsp;</td>
                                <td valign="bottom" align="right"><span id="ja" class="language"><font color="#FFFFFF">&copy; 2010 - Université de Lausanne - All right reserved</font></span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

    </body>
</html>
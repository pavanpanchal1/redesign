<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../inc/includefiles.php');
include('../inc/checktype.php');
include('../inc/teamchart.php');
// if ($_GET['a_link'] == 'logout'){
//   include('../inc/logout.php');
// }

$localdate = datetimelocal('d-m-Y');
$localtime = datetimelocal('H:i:s');
$monthnum = date('n');
// logged in Users
include('../inc/membersloggedin.php');
//values for in and out time - Last Working Day
$fetch = runmysqlqueryfetch("SELECT MAX(logindate) AS yintimedate FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate <> CURDATE() AND logintype = 'IN'");
if ($fetch['yintimedate'] <> '' && $fetch['yintimedate'] <> '0000-00-00')
  $yintimedateresult = $fetch['yintimedate'];
else
  $yintimedateresult = 'NA';

$fetch = runmysqlqueryfetch("SELECT MAX(logindate) AS lastworkingday FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate <> CURDATE()");
if ($fetch['lastworkingday'] <> '' && $fetch['lastworkingday'] <> '0000-00-00')
  $ydateresult = $fetch['lastworkingday'];
else
  $ydateresult = 'NA';

$fetch = runmysqlqueryfetch("SELECT MIN(logintime) AS ylogintime FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate = '" . $ydateresult . "' AND logintype = 'IN'");
if ($fetch['ylogintime'] <> '' && $fetch['ylogintime'] <> '00:00:00')
  $yintimeresult = $fetch['ylogintime'];
else
  $yintimeresult = 'NA';

$fetch = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate = '" . $ydateresult . "' AND logintype = 'OUT' ");
$fetch1 = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate = '" . $ydateresult . "' AND logintype = 'IN' ");

if ($fetch['ylogouttime'] <> '' && $fetch['ylogouttime'] <> '00:00:00' && $fetch['ylogouttime'] > $fetch1['ylogouttime'])
  $youttimeresult = $fetch['ylogouttime'];
else
  $youttimeresult = 'NA';


//Today's In Time
$fetch = runmysqlqueryfetch("SELECT MIN(logintime) AS tlogintime FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate = CURDATE() AND logintype = 'IN'");
$tintimeresult = $fetch['tlogintime'];

// Attendance Details ------------------------------------------------------------
$year = date("Y", mktime(0, 0, 0, date('n')));
$attendanceCal = attendanceCalendardashboard(date('m'), $year, $user);

?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>
    <?php $pagetilte = getpagetitle($_GET['a_link']);
    echo ($pagetilte); ?>
  </title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet"> -->
  <?php
  include('../inc/stylesnscripts.php');
  include('../inc/navigation.php');

  ?>
  <style>
    /* Custom styles for the chart container */
    #chart_div {
      width: 100%;
      height: 400px;
      /* Set the desired height */
      background-color: #f0f0f0;
      /* Set a background color for the chart area */
      border: 1px solid #ddd;
      /* Add a border around the chart area */
    }

    /* Style for chart annotations */
    .google-visualization-tooltip-item {
      color: #333;
      font-weight: bold;
    }

    /* Style for chart axis labels */
    .google-visualization-axislabels {
      font-size: 12px;
    }

    /* Style for chart title */
    .google-visualization-chart-title {
      font-size: 18px;
      font-weight: bold;
      color: #555;
    }

    /* Style for the gridlines */
    .google-visualization-gridline {
      stroke: #ddd;
      stroke-width: 1;
    }

    /* Style for the chart legend */
    .google-visualization-table-td-legend {
      font-size: 14px;
      color: #666;
    }

    .google-visualization-chart-legend {
      /* Add your desired button color here */
      background-color: #ff9900 !important;
    }
  </style>
</head>


<body marginheight="0" marginwidth="0" onload="bodyonload();">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td colspan="2" valign="top">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">


                <tr>

                  <td valign="top" class="content-box"><input name="navigationtabcount" id="navigationtabcount"
                      type="hidden" value="<?php echo ($navigationtabcount); ?>" />

                    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
                    <script language="javascript" src="../functions/annotatedtimeline.js"
                      type="text/javascript"></script>


                    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

                    <!-- Add a div container for the chart -->

                    <table width="100%" border="0" cellspacing="0" cellpadding="4">
                      <tr>
                        <td class="content-header">Home > Dashboard</td>
                      </tr>
                      <tr>
                        <td style="padding:10">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="100%" valign="top">
                                      <table class="dashborder" width="100%" border="0" cellpadding="4" cellspacing="0">
                                        <tbody>
                                          <tr>
                                            <td valign="top" align="left">
                                              <table class="dashcontent" width="100%" border="0" cellpadding="2"
                                                cellspacing="0">
                                                <tbody>
                                                  <tr>
                                                    <td valign="top" align="left">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr style="cursor:pointer"
                                                          onclick="showhide('dash_timeline','toggleimg4');">
                                                          <td class="header-line-dash" style="padding:0">
                                                            &nbsp;<strong>&nbsp;Chart on count of Calls and
                                                              emails</strong></td>
                                                          <td align="right" class="header-line-dash">
                                                            <div align="right"><img src="../images/minus.jpg" border="0"
                                                                id="toggleimg4" name="toggleimg" align="absmiddle" />
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <tr>
                                                          <td colspan="2">
                                                            <div id="dash_timeline" style="display:block;">
                                                              <table width="100%" border="0" cellspacing="1"
                                                                cellpadding="3">
                                                                <tr>
                                                                  <td>
                                                                    <div id="chart_div"
                                                                      style="width: 100%; height: 400px;"></div>

                                                                    <br />
                                                                    <div align="right" style='width: 700px;'>
                                                                      <?php if ($usertype <> 'GUEST') { ?><a
                                                                          href="./index.php?a_link=report_statisticschart">Advanced</a>
                                                                      <?php } ?>
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                              </table>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                  <?php if ($usertype <> 'GUEST') { ?>
                                                    <tr valign="top">
                                                      <td align="left">&nbsp;</td>
                                                    </tr>
                                                    <tr valign="top">
                                                      <td align="left" style="padding:4px">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                          style="border:1px solid #F09E0A; border-top:none;">
                                                          <tr style="cursor:pointer"
                                                            onclick="showhide('dash_attendancesummary','toggleimg2');">
                                                            <td class="header-line-dash" style="padding:0">
                                                              &nbsp;<strong>&nbsp;Attendance Summary of this
                                                                Month</strong></td>
                                                            <td align="right" class="header-line-dash"
                                                              style="padding-right:7px">
                                                              <div align="right"><img src="../images/plus.jpg" border="0"
                                                                  id="toggleimg2" name="toggleimg" align="absmiddle" />
                                                              </div>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td colspan="2">
                                                              <div id="dash_attendancesummary" style="display:none;">
                                                                <table width="100%" border="0" cellspacing="0"
                                                                  cellpadding="3">
                                                                  <tr>
                                                                    <td align="center">
                                                                      <?php echo ($attendanceCal); ?>
                                                                    </td>
                                                                  </tr>
                                                                </table>
                                                              </div>
                                                            </td>
                                                          </tr>
                                                        </table>
                                                      </td>
                                                    </tr>
                                                  <?php } ?>
                                                  <tr valign="top">
                                                    <td align="left">&nbsp;</td>
                                                  </tr>
                                                  <tr valign="top">
                                                    <td align="left">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                        style="border:1px solid #F09E0A; border-top:none;">
                                                        <tr style="cursor:pointer"
                                                          onclick="showhide('dash_teamchart','toggleimg3');">
                                                          <td class="header-line-dash" style="padding:0">
                                                            &nbsp;<strong>&nbsp;Team Chart</strong></td>
                                                          <td align="right" class="header-line-dash"
                                                            style="padding-right:7px">
                                                            <div align="right"><img src="../images/plus.jpg" border="0"
                                                                id="toggleimg3" name="toggleimg" align="absmiddle" />
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <tr>
                                                          <td colspan="2">
                                                            <div id="dash_teamchart" style="display:none;">
                                                              <table width="100%" border="0" cellspacing="0"
                                                                cellpadding="3">
                                                                <tr>
                                                                  <td style="padding-left:10px; ">
                                                                    <?php
                                                                    echo ($tgrid);
                                                                    ?>
                                                                  </td>
                                                                </tr>

                                                              </table>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td valign="top" align="left">&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" style="padding:4px;">


                                                      <div class="container ">
                                                        <div class="card border ">
                                                          <div class="card-header bg-primary text-white cursor-pointer"
                                                            onclick="showhide('dash_loginsummary','toggleimg');">
                                                            <strong>Login Summary</strong>
                                                            <span class="float-right">
                                                              <img src="../images/minus.jpg" class="toggle-img"
                                                                alt="Toggle" />
                                                            </span>
                                                          </div>
                                                          <div class="card-body" id="dash_loginsummary"
                                                            style="display:none;">
                                                            <div class="row">
                                                              <div class="col-md-6">
                                                                <strong>Today -
                                                                  <?php echo (date("F j, Y", mktime(0, 0, 0, date('n')))); ?>
                                                                </strong>
                                                              </div>
                                                              <div class="col-md-6">
                                                                <strong>Last Working Day -
                                                                  <?php echo (date("d-m-Y", strtotime($ydateresult))); ?>
                                                                </strong>
                                                              </div>
                                                            </div>
                                                            <div class="row">
                                                              <div class="col-md-6">
                                                                In Time:
                                                                <?php echo ($tintimeresult); ?>
                                                              </div>
                                                              <div class="col-md-6">
                                                                In Time:
                                                                <?php echo ($yintimeresult); ?> | Out Time:
                                                                <?php echo ($youttimeresult); ?>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>



                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td valign="top" align="left">&nbsp;</td>
                                                  </tr>
                                                </tbody>


                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                    <td width="1%" valign="top">&nbsp;</td>
                                    <td width="18%" valign="top">

                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                      </tr>
                    </table>
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
</body>

</html>


<?php

include("../navigation/footer.php");

?>
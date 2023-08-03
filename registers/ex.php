<?php

include("../navigation/navigation.php");

$month = date('m');
if ($month >= '04')
    $date = '01-04-' . date('Y');
else {
    $year = date('Y') - '1';
    $date = '01-04-' . $year;


    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

?>

<div class="container-fluid header " style="position:sticky; top:60px; z-index:10;">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Registers</span>
            </li>
            <li class="breadcrumb-item active"><span>Calls</span></li>
        </ol>
    </nav>
</div>
</header>



<style>
    body {
        background-color: white;
    }

    .display {
        display: flex;
        flex-direction: row;
    }
</style>



<div class="container mt-4">
    <table class="table table-bordered" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
        <tbody class="bg-light">
            <tr onclick="showhide('maindiv','toggleimg');" class="header-line">
                <td class="bg-light">&nbsp;&nbsp;Enter the Details</td>
                <td align="right" class="bg-light">

                    <div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"
                            align="absmiddle"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="top">
                    <div id="maindiv" style="display: block;">
                        <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                            <div class="display">
                                <table class="table table-bordered table1">
                                    <tbody>
                                        <tr class="bg-white">
                                            <td valign="top">Call Type:</td>
                                            <td valign="top">


                                                <div class="form-check">
                                                    <label class="form-check-label" for="incoming">
                                                        <input class="form-check-input" type="radio" name="calltype"
                                                            id="incoming" value="incoming" checked="checked">
                                                        Incoming
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label" for="outgoing">
                                                        <input class="form-check-input" type="radio" name="calltype"
                                                            id="outgoing" value="outgoing">
                                                        Outgoing
                                                    </label>
                                                </div>



                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Anonymous:</td>
                                            <td valign="top">

                                                <div class="form-check">
    <input class="form-check-input" type="radio" name="anonymous" id="databasefield9" value="yes" onclick="formsubmitcustomer();">
    <label class="form-check-label" for="databasefield9">Yes</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="anonymous" id="databasefield10" value="no" checked="checked" onclick="formsubmitcustomer();">
    <label class="form-check-label" for="databasefield10">No</label>
</div>


                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Registered Name:</td>
                                            <td valign="top">
                                                <input name="customername" type="text" class="form-control swifttext"
                                                    id="customername" size="20" autocomplete="off" isdatepicker="true"
                                                    readonly="readonly" style="background:#FEFFE6;">
                                                <!-- <span id="getcustomerlink" style="visibility:visible;"> <a
                                                        href="javascript:void(0);"
                                                        onclick="getcustomer(); getcustomerfunc(); registernameload('call')"
                                                        style="cursor:pointer"> <img src="../images/userid-bg.gif"
                                                            width="14" height="16" border="0"
                                                            align="absmiddle" /></a></span> -->
                                                <input type="hidden" name="lastslno" id="lastslno" value="" />
                                                <input type="hidden" name="cusid" id="cusid" value="" />
                                                <input type="hidden" name="loggeduser" id="loggeduser"
                                                    value="<?php echo ($user); ?>" />
                                                <input type="hidden" name="loggedusertype" id="loggedusertype"
                                                    value="<?php echo ($usertype); ?>" />
                                                <input type="hidden" name="endtime" id="endtime" value="" />
                                                <input type="hidden" name="loggedreportingauthority"
                                                    id="loggedreportingauthority"
                                                    value="<?php echo ($reportingauthoritytype); ?>" />
                                                <input type="hidden" name="hiddenserverdate" id="hiddenserverdate"
                                                    value="<?php echo (datetimelocal('d-m-Y')); ?>" />

                                            </td>
                                        </tr>


                                        <tr class="bg-white">
                                            <td valign="top">Customer ID :</td>
                                            <td valign="top">
                                                <input name="customerid" type="text" class="form-control swifttext"
                                                    id="customerid" size="20" autocomplete="off" isdatepicker="true"
                                                    readonly="readonly" style="background:#FEFFE6;">
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Date:</td>
                                            <td valign="top">
                                                <input name="date" type="date" class="form-control swifttext" id="date"
                                                    size="20" autocomplete="off" isdatepicker="true" readonly="readonly"
                                                    style="background:#FEFFE6;">
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Time:</td>
                                            <td valign="top">
                                                <input name="time" type="time" class="form-control swifttext" id="time"
                                                    size="20" autocomplete="off" isdatepicker="true"
                                                    style="background:#FEFFE6;">
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Category:</td>
                                            <td valign="top">
                                                <input name="category" type="text" class="swifttext form-control"
                                                    id="category" size="30" autocomplete="off" readonly="readonly"
                                                    style="background:#FEFFE6;" />
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">State:</td>
                                            <td valign="top">
                                                <span id="filterprdgroupdisplay">
                                                    <select name="state" id="state"
                                                        class="swiftselect form-select form-control" autocomplete="off"
                                                        disabled="disabled" style="background:#FEFFE6;">

                                                        <?php include('../inc/state.php'); ?>
                                                    </select>
                                                    <!-- Details are in javascript.js page as a function prdgroup();-->
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Caller Type:</td>
                                            <td valign="top">
                                                <input name="callertype" type="text" class="swifttext form-control"
                                                    id="callertype" size="30" autocomplete="off" readonly="readonly"
                                                    style="background:#FEFFE6;" />
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Product group:</td>
                                            <td valign="top">
                                                <span id="filterprdgroupdisplay">
                                                    <?php include('../inc/productgroup.php');
                                                    productname('productgroup', '');
                                                    ?>
                                                    <!-- Details are in javascript.js page as a function prdgroup();-->
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Product Name(<font color="#FF0000">Optional</font>):</td>
                                            <td valign="top">
                                                <span id="filterprdgroupdisplay">
                                                    <select name="productname"
                                                        class="form-select swiftselect form-control" id="productname">
                                                        <option value="">Select a Product</option>
                                                    </select>
                                                    <!-- Details are in javascript.js page as a function prdgroup();-->
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Product version:</td>
                                            <td valign="top">
                                                <span id="filterprdgroupdisplay">
                                                    <select name="productversion" id="productversion"
                                                        class="form-select swiftselect form-control">
                                                        <option value="">Select a Product</option>
                                                    </select>
                                                    <!-- Details are in javascript.js page as a function prdgroup();-->
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Person Name:</td>
                                            <td valign="top">
                                                <input name="personname" type="text" class="swifttext form-control"
                                                    id="personname" size="30" autocomplete="off" />
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>



                                <table class="table table-bordered table2">
                                    <tbody>
                                        <tr class="bg-white">
                                            <td valign="top">Problem:</td>
                                            <td valign="top">
                                                <textarea name="problem" cols="45" class="swifttextarea form-control"
                                                    id="problem" data-gramm="false" wt-ignore-input="true"></textarea>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Status:</td>
                                            <td valign="top">

                                                <span id="filterprdgroupdisplay">
                                                    <select name="status" id="status"
                                                        class="swiftselect form-select form-control">
                                                        <option value="" selected="selected">Make A Selection</option>
                                                        <option value="solved">Solved</option>
                                                        <option value="unsolved">Un Solved</option>
                                                        <option value="transferred">Transferred</option>
                                                        <option value="registration given">Registration Given</option>
                                                    </select>

                                                    <!-- Details are in javascript.js page as a function prdgroup();-->
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Call Category:</td>
                                            <td valign="top">
                                                <select name="callcategory" id="callcategory"
                                                    class="form-select form-control swiftselect">
                                                    <?php include('../inc/callcategory.php'); ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Solved Through:</td>
                                            <td valign="top">
                                                <div class="form-check">
                                                    <input name="stremoteconnection" type="checkbox"
                                                        id="stremoteconnection" class="form-check-input" />


                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Remote Connection
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Transferred to :</td>
                                            <td valign="top">
                                                <select name="transferredto" id="transferredto"
                                                    class="form-control swiftselect">
                                                    <option value="none" selected="selected">None</option>
                                                    <?php include('../inc/useridselection.php'); ?>
                                                    <option value="registration">Registration Department</option>
                                                    <option value="others">Others</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Remarks:</td>
                                            <td valign="top">
                                                <textarea name="remarks" cols="45" class="form-control" id="remarks"
                                                    data-gramm="false" wt-ignore-input="true"></textarea>
                                            </td>
                                        </tr>
                                        <tr bgcolor="#f7faff">
                                            <td valign="top" bgcolor="#f7faff">Entered By:</td>
                                            <td valign="top" bgcolor="#f7faff">
                                                <input name="userid" type="text" class="swifttext form-control"
                                                    id="userid" size="30" readonly="readonly"
                                                    value="<? echo ($loggedusername); ?>" autocomplete="off"
                                                    style="background:#FEFFE6;" />
                                            </td>
                                        </tr>


                                        <tr class="bg-white">
                                            <td valign="top">Complaint ID:</td>
                                            <td valign="top">
                                                <input name="compliantid" type="text" class="form-control swifttext"
                                                    id="compliantid" size="30" maxlength="40" readonly="readonly"
                                                    autocomplete="off" style="background:#FEFFE6;" />
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Team Leader Remarks:</td>
                                            <td valign="top" id="teamleaderremarks">

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="container bg-light">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div id="form-error"></div>
                                    </div>
                                    <div class="col-md-4 float-right bg-light " align="right">
                                        <input name="new" type="reset" class="btn btn-secondary " id="new" value="New"
                                            onclick="setradiovalue(document.getElementById('submitform').anonymous, 'no'); newentry(); formsubmitcustomer(); clearinnerhtml();clearform();  gettime();" />
                                        <input name="save" type="submit" class="btn btn-primary" id="save" value="Save"
                                            onclick="formsubmit('save')" />
                                        <input name="delete" type="submit" class="btn btn-danger" id="delete"
                                            value="Delete" onclick="formsubmit('delete')" disabled="disabled" />
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<div class="container mt-4">
    <table class="table table-bordered" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
        <tbody>
            <tr onclick="showhide('maindiv','toggleimg');" class="header-line">
                <td class="bg-light">&nbsp;&nbsp;Filter the Data:
                <td align="right" class="bg-light">
                    <div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"
                            align="absmiddle"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="top " class="bg-light">
                    <div id="maindiv" style="display: block;">
                        <form action="" method="post" name="filterform" id="filterform" onsubmit="return false;">
                            <div class="display">
                                <table class="table table-bordered  table1">
                                    <tbody>
                                        <tr class="bg-white">
                                            <td valign="top">From Date:</td>
                                            <td valign="top">
                                                <div class="d-flex">
                                                    <input name="fromdate" type="date" class="form-control swifttext"
                                                        id="DPC_fromdate" size="30" autocomplete="off"
                                                        style="background:#FEFFE6;">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">To Date:</td>
                                            <td valign="top">
                                                <div class="d-flex">
                                                    <input name="todate" type="text" class="swifttext form-control"
                                                        id="DPC_todate" size="30" autocomplete="off"
                                                        style="background:#FEFFE6;" value="" />

                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Call Type:</td>
                                            <td valign="top">
                                                <div class="form-check">
                                                    <input name="s_calltype" type="radio" id="s_incoming"
                                                        value="incoming" class="form-check-input" />
                                                    <label class="form-check-label"
                                                        for="databasefield11">Incoming</label>
                                                    <input name="s_calltype" type="radio" id="s_outgoing"
                                                        value="outgoing" class="form-check-input" />
                                                    <label class="form-check-label"
                                                        for="databasefield12">Outgoing</label>
                                                    <input type="radio" name="s_calltype" id="s_calltypeboth"
                                                        checked="checked" value="" class="form-check-input" />
                                                    <label class="form-check-label" for="databasefield12">Both</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Anonymous:</td>
                                            <td valign="top">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="anonymous"
                                                        id="databasefield11" value="yes">
                                                    <label class="form-check-label" for="databasefield11">Yes</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="anonymous"
                                                        id="databasefield12" value="no">
                                                    <label class="form-check-label" for="databasefield12">No</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="anonymous"
                                                        id="databasefield12" value="no">
                                                    <label class="form-check-label" for="databasefield12">Both</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Customer Name:</td>
                                            <td valign="top">
                                                <input name="s_customername" type="text" class="form-control swifttext"
                                                    id="s_customername" size="30" />
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Customer ID:</td>
                                            <td valign="top">
                                                <input name="s_customername" type="text" class="form-control swifttext"
                                                    id="s_customername" size="30" />
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Category:</td>
                                            <td valign="top">
                                                <div class="form-check">
                                                    <label class="form-check-label>
                                                        <input name='categoryblr' type='checkbox' id='categoryblr'
                                                            value='' checked=" checked"
                                                        class="form-check-input" />BLR</label>
                                                    <label class="form-check-label>
                                                        <input name='categorycsd' type='checkbox' id='categorycsd'
                                                            value='' checked=" checked"
                                                        class="form-check-input" />CSD</label>
                                                    <label class="form-check-label>
                                                        <input name='categorykkg' type='checkbox' id='categorykkg'
                                                            value='' checked=" checked" class="form-check-input" />KKG
                                                    </label>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Status:</td>
                                            <td valign="top">
                                                <select name="s_state" id="s_state"
                                                    class="form-select form-control swiftselect">
                                                    <?php include('../inc/state.php'); ?>
                                                </select>

                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Call Type:</td>
                                            <td valign="top">
                                                <label class="form-check-label">
                                                    <input name='s_customer' type='checkbox' id='s_customer'
                                                        value='Customer' checked="checked" />
                                                    Customers </label><label class="form-check-label">
                                                    <input name='s_dealer' type='checkbox' id='s_dealer' value='Dealer'
                                                        checked="checked" />
                                                    Dealers</label>
                                                <label class="form-check-label">
                                                    <input name='s_employee' type='checkbox' id='s_employee'
                                                        value='employee' checked="checked" />
                                                    Employees</label><label class="form-check-label">
                                                    <input name='s_ssmuser' type='checkbox' id='s_ssmuser'
                                                        value='SSMUser' checked="checked" />
                                                    SSM Users</label>

                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Product group:</td>
                                            <td valign="top">
                                                <span id="filterprdgroupdisplay"
                                                    class="form-select form-control swiftselect">
                                                    <?php productname('s_productgroup', ''); ?>
                                                    <!-- Details are in javascript.js page as a function prdgroup();-->
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Product Name:</td>
                                            <td valign="top">
                                                <select name="s_productname"
                                                    class="form-select form-control swiftselect" id="s_productname">
                                                    <option value="">All</option>
                                                    <?php include('../inc/productfilter.php'); ?>
                                                </select>
                                            </td>

                                    </tbody>
                                </table>



                                <table class="table table-bordered table2">
                                    <tbody>
                                        <tr class="bg-white">
                                            <td valign="top">Problem:</td>
                                            <td valign="top">
                                                <input name="s_problem" type="text" class="swifttextarea" id="s_problem"
                                                    value="" size="30" class="form-control" />
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Status:</td>
                                            <td valign="top">
                                                <span id="filterprdgroupdisplay">
                                                    <select name="s_status" id="s_status"
                                                        class="form-select swiftselect form-control">
                                                        <option value="" selected="selected">All</option>
                                                        <option value="solved">Solved</option>
                                                        <option value="unsolved">Un Solved</option>
                                                        <option value="transferred">Transferred</option>
                                                        <option value="registration given">Registration Given</option>
                                                    </select>
                                                    <!-- Details are in javascript.js page as a function prdgroup();-->
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Call Category:</td>
                                            <td valign="top">
                                                <select name="s_callcategory" id="s_callcategory"
                                                    class="form-select form-control swiftselect">
                                                    <option value="" selected="selected">All</option>
                                                    <?php include('../inc/callcategory.php'); ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Transferred To:</td>
                                            <td valign="top">
                                                <select name="s_transferredto" id="s_transferredto"
                                                    class="form-select form-control swiftselect">
                                                    <option value="" selected="selected">All</option>
                                                    <option value="none" selected="selected">None</option>
                                                    <?php include('../inc/useridselection.php'); ?>
                                                    <option value="registration">Registration Department</option>
                                                    <option value="others">Others</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Entered By:</td>
                                            <td valign="top">
                                                <select name="s_userid" id="s_userid" class="form-control swiftselect">
                                                    <option value="" selected="selected">All</option>
                                                    <?php include('../inc/useridselection.php'); ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Compliant ID:</td>
                                            <td valign="top">
                                                <input name="s_compliantid" type="text" class="swifttext"
                                                    id="s_compliantid" size="30" class="form-control swiftselect"
                                                    maxlength="40" autocomplete="off" />
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Flags:</td>
                                            <td valign="top">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="flagdatabasefield"
                                                            id="flagdatabasefield0" value="yes"
                                                            class="form-check-input" />
                                                        Yes </label>
                                                    <label class="form-check-label">
                                                        <input type="radio" name="flagdatabasefield"
                                                            id="flagdatabasefield1" value="no"
                                                            class="form-check-input" />
                                                        No</label>
                                                    <label class="form-check-label">
                                                        <input type="radio" name="flagdatabasefield"
                                                            id="flagdatabasefield2" value="" class="form-check-input"
                                                            checked="checked" />
                                                        Both</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Support Unit:</td>
                                            <td valign="top">
                                                <select name="s_supportunit"
                                                    class="form-select form-control swiftselect" id="s_supportunit">
                                                    <option value="">ALL</option>
                                                    <?php include('../inc/supportunit.php'); ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td valign="top">Order By:</td>
                                            <td valign="top">
                                                <select name="orderby" class="form-select form-control swiftselect"
                                                    id="orderby">
                                                    <option value="callertype">Caller Type</option>
                                                    <option value="category">Category</option>
                                                    <option value="compliantid" selected="selected">Compliant ID
                                                    </option>
                                                    <option value="customerid">Customer ID</option>
                                                    <option value="customername">Registered Name</option>
                                                    <option value="date">Date</option>
                                                    <option value="userid">Entered By</option>
                                                    <option value="problem">Problem</option>
                                                    <option value="productgroup">Product Group</option>
                                                    <option value="productname">Product Name</option>
                                                    <option value="status">Status</option>
                                                    <option value="callcategory">Call Category</option>
                                                    <option value="transferredto">Transferred To</option>
                                                    <option value="time">Time</option>
                                                </select>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="container bg-light">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div id="form-error"></div>
                                    </div>
                                    <div class="col-md-4 float-right bg-light " align="right">

                                        <input name="view" type="submit" class="btn btn-primary " id="view" value="View"
                                            onclick="formfilter('view'); ">
                                        <input name="toexcel" type="submit" class="btn btn-warning" id="toexcel"
                                            value="To Excel" onclick="formfilter('toexcel');">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>



    <div class="col-md-12">

        <div id="wrapper" class="table-container"></div>
    </div>
</div>
<?php

include("../navigation/footer.php");

?>
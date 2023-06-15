<?php include 'config.php' ?>
<?php
class Login extends DBConnection
{
    private $settings;
    public function __construct()
    {
        global $_settings;
        $this->settings = $_settings;

        parent::__construct();
        ini_set('display_error', 1);
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<style>
    .main_menu {
        float: left;
        width: 227px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        color: black !important;
        border-right: solid 3px white;
    }

    .main_menu:hover {
        border-bottom: solid 2px blue;
        background-color: #E8E8E8;
    }

    #container {
        margin-right: auto;
        margin-left: auto;
        width: 100%;
        position: relative;
        padding-left: 250px;
        padding-right: 250px;
        background-color: transparent;
    }

    #logs-link {
        border-bottom: solid 2px blue;
        background-color: #E8E8E8;
    }

    .nav-logs {
        background-color: #007bff;
        color: white !important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-logs:hover {
        background-color: #007bff !important;
    }
    .form_cont {
        padding: 10px;
        background-color: #F5F5F5;
        margin: 5px;
        padding-bottom: -5% !important;
        border-radius: 5px;
    }
    .footer {
        width: auto;
        margin-left: -250px !important;
    }
</style>

<?php require_once('admin/inc/header.php') ?>

<body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs"
    data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto;" onload="hideDiv()">
    <div class="wrapper">
        <?php require_once('admin/inc/topBarNav.php') ?>
        <?php $usertype = $_settings->userdata('user_type'); ?>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-blue elevation-4 sidebar-no-expand">
            <!-- Brand Logo -->
            <a href="<?php echo base_url ?>admin" class="brand-link bg-blue text-sm">
                <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8;
                    width: 30px;
                    height: 30px;
                    max-height: unset;
                    background: white;">
                <span class="brand-text font-weight-light"><b>
                        <?php echo $_settings->info('short_name') ?>
                    </b></span>
            </a>
            <!-- Sidebar -->
            <div
                class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
                <div class="os-resize-observer-host observed">
                    <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
                </div>
                <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
                    <div class="os-resize-observer"></div>
                </div>
                <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
                <div class="os-padding">
                    <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                        <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                            <!-- Sidebar user panel (optional) -->
                            <div class="clearfix"></div>
                            <!-- Sidebar Menu -->
                            <nav class="mt-4">
                                <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child"
                                    data-widget="treeview" role="menu" data-accordion="false">
                                    <li class="nav-item dropdown">
                                        <a href="./" class="nav-link ">
                                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                            <p>
                                                Dashboard
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a href="<?php echo base_url ?>admin/?page=sales/client"
                                            class="nav-link nav-client">
                                            <i class="nav-icon fas fa-plus"></i>
                                            <p>
                                                New Client
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a href="<?php echo base_url ?>admin/?page=ra" class="nav-link nav-ra">
                                            <i class="nav-icon fas fa-th-list"></i>
                                            <p>
                                                Master List
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a href="<?php echo base_url ?>admin/?page=inventory/lot-list"
                                            class="nav-link nav-inventory">
                                            <i class="nav-icon fas fa-cube"></i>
                                            <p>
                                                Inventory
                                            </p>
                                        </a>
                                    </li>
                                    <?php if ($usertype == "IT Admin" || $usertype == 'Cashier'): ?>
                                        <li class="nav-item dropdown">
                                            <a href="<?php echo base_url ?>or_logs.php" class="nav-link nav-logs">
                                                <i class="nav-icon fas fa-book"></i>
                                                <p>
                                                    OR Logs
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a href="<?php echo base_url ?>admin/?page=clients/av_logs" class="nav-link nav-av">
                                            <i class="nav-icon fas fa-receipt"></i>
                                                <p>
                                                AV Logs
                                                </p>
                                            </a>
                                        </li> 
                                    <?php endif; ?>

                                    <li class="nav-header">Others</li>
                                    <li class="nav-item dropdown">
                                        <a href="<?php echo base_url ?>admin/?page=loan-calcu"
                                            class="nav-link nav-loan-calcu">
                                            <i class="nav-icon fas fa-calculator"></i>
                                            <p>
                                                Loan Calculator
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url ?>admin/?page=journals" class="nav-link nav-journals">
                                            <i class="nav-icon fas fa-folder"></i>
                                            <p>
                                            Journal Entries
                                            </p>
                                        </a>
                                        </li>  



                                        <li class="nav-item dropdown">
                                        <a href="<?php echo base_url ?>admin/?page=groups" class="nav-link nav-groups">
                                            <i class="nav-icon fas fa-th-list"></i>
                                            <p>
                                            Group List
                                            </p>
                                        </a>
                                        </li>

                                        <li class="nav-item dropdown">
                                        <a href="<?php echo base_url ?>admin/?page=accounts" class="nav-link nav-accounts">
                                            <i class="nav-icon fas fa-table"></i>
                                            <p>
                                            Accounts List
                                            </p>
                                        </a>
                                        </li>
                                        <br />

                                    <?php if ($usertype == "IT Admin"): ?>
                                        <li class="nav-item dropdown">
                                            <a href="<?php echo base_url ?>admin/?page=agents/agents_list"
                                                class="nav-link nav-agents">
                                                <i class="nav-icon fa fa-id-card"></i>
                                                <p>
                                                    Agent List
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user">
                                                <i class="nav-icon fas fa-user-circle"></i>
                                                <p>
                                                    User List
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a href="<?php echo base_url ?>admin/?page=system_info"
                                                class="nav-link nav-system_info">
                                                <i class="nav-icon fas fa-cogs"></i>
                                                <p>
                                                    Settings
                                                </p>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </nav>
                            <!-- /.sidebar-menu -->
                        </div>
                    </div>
                </div>
                <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                    <div class="os-scrollbar-track">
                        <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
                    </div>
                </div>
                <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
                    <div class="os-scrollbar-track">
                        <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
                    </div>
                </div>
                <div class="os-scrollbar-corner"></div>
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper" style="min-height: 567.854px;">
            <div class="card-body">
                <div class="card card-outline rounded-0 card-maroon" style="padding-bottom:20px;">
                    <div class="card-header">
                        <h3 class="card-title"><b><i>OR Logs</b></i></h3>
                    </div>
                    <div class="container-fluid">
                        <div class="form_cont">
                            <form action="" method="GET">
                                <table width="100%;">
                                    <tr>
                                        <td width="8%;text-align:center;"><label
                                                style="text-align:center;width:100%;">Date From: </label></td>
                                        <td width="15%;text-align:center;"><input type="date" name="from_date" value="<?php if (isset($_GET['from_date'])) {
                                            echo $_GET['from_date'];
                                        } ?>"
                                                style="padding:3px;border-radius:3px;border:0px;border:1px solid gainsboro;width:100%;">
                                        </td>
                                        <td width="8%;text-align:center;"><label
                                                style="text-align:center;width:100%;">Date To: </label></td>
                                        <td width="15%;text-align:center;"><input type="date" name="to_date" value="<?php if (isset($_GET['to_date'])) {
                                            echo $_GET['to_date'];
                                        } ?>"
                                                style="padding:3px;border-radius:3px;border:0px;border:1px solid gainsboro;width:100%;">
                                        </td>
                                        <td width="8%;text-align:center;"><label
                                                style="text-align:center;width:100%;">Preparer: </label></td>
                                        <td width="14%;text-align:center;"><input type="text" name="preparer"
                                                id="preparer" value="<?php if (isset($_GET['preparer'])) {
                                                    echo $_GET['preparer'];
                                                } ?>"
                                                style="padding:3px;border-radius:3px;border:0px;border:1px solid gainsboro;width:100%;">
                                        </td>

                                        <td width="14%;text-align:center;"><button type="submit"
                                                class="btn btn-flat btn-sm btn-info" style="width:100%;font-size:14px;margin-left:5px;"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter</button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Property ID</th>

                                    <th>OR No.</th>
                                    <th>Pay Date</th>
                                    <th>Amt Paid</th>
                                    <th>Preparer</th>
                                    <th>Date Prepared</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $con = mysqli_connect("localhost", "root", "", "alscdb");

                                if (isset($_GET['from_date']) && isset($_GET['to_date']) && isset($_GET['preparer'])) {

                                    $from_date = $_GET['from_date'];
                                    $to_date = $_GET['to_date'];
                                    $preparer = $_GET['preparer'];

                                    $query = "SELECT * FROM or_logs WHERE user = '$preparer' AND status = 0 AND gen_time BETWEEN '$from_date' AND '$to_date'";
                                    //$query1 = "SELECT or_id,property_id,or_no,pay_date,user,gen_time,amount_paid, SUM(amount_paid) as amt_paid FROM or_logs WHERE user = '$preparer' AND gen_time BETWEEN '$from_date' AND '$to_date' GROUP BY $preparer";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $i++; ?>
                                                </td>
                                                <td>
                                                    <?= $row['property_id']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['or_no']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['pay_date']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['amount_paid']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['user']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['gen_time']; ?>
                                                </td>
                                                <td>
                                                    <a href="/ALSC//report/print_soa.php?id=<?php echo $row["or_id"]; ?>" ,
                                                        target="_blank" class="btn btn-flat btn-primary btn-sm" style="width:100%;font-size:14px;"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print
                                                        OR</a>
                                                </td>
                                            </tr>
                                            <?php

                                        }
                                    } else {
                                        echo "<div class='nr' style='position:absolute;margin-top:50px;font-weight:bold;padding-left:10px;padding-top:5px;'>No Record Found</div>";
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                    $lname = "";
                    $fname = "";
                    $username = "";
                    $amt_pd=0;
                ?>
                <div class="card card-outline rounded-0 card-maroon" id="div_tally">
                    <div class="card-body">
                        <div class="container-fluid">
                            <table class="table table-bordered table-stripped" id="data-table"
                                style="text-align:center;">
                                <?php
                                $query1 = "SELECT or_id,property_id,or_no,pay_date,user,gen_time,amount_paid, SUM(amount_paid) as amt_paid FROM or_logs WHERE user = '$preparer' AND status = 1 AND gen_time BETWEEN '$from_date' AND '$to_date' GROUP BY '$preparer'";
                                $query_run1 = mysqli_query($con, $query1);
                                while ($row1 = mysqli_fetch_assoc($query_run1)) {
                                    $amt_pd = number_format($row1['amt_paid'], 2) . '<br>';
                                }

                                ?>
                                <?php
                                $query2 = "SELECT * FROM users WHERE username = '$preparer'";
                                $query_run2 = mysqli_query($con, $query2);
                                while ($row2 = mysqli_fetch_assoc($query_run2)) {
                                    $lname = $row2['lastname'];
                                    $fname = $row2['firstname'];
                                    $username = $row2['username'];
                                }
                                ;

                                ?>
                                <label style="text-align:center;width:100%;">CASHIER SALES TALLY</label>
                                <br>
                                <hr style="height:1px;border-width:0;color:gray;background-color:gray">
                                <table class="table table-bordered table-stripped" id="data-table"
                                    style="text-align:center;">
                                    <tr>
                                        <td style="width:50%;"><label>Username:</label></td>
                                        <td>
                                            <?php echo $username; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;"><label>Full Name:</label></td>
                                        <td>
                                            <?php echo $fname; ?>
                                            <?php echo $lname; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;"><label>TOTAL COLLECTION:</label></td>
                                        <td>
                                            <?php echo $amt_pd; ?>
                                        </td>
                                    </tr>
                                </table>
                                <label style="text-align:center;width:100%;">COLLECTION PERIOD</label>
                                <br>
                                <hr style="height:1px;border-width:0;color:gray;background-color:gray">
                                <table class="table table-bordered table-stripped" id="data-table"
                                    style="text-align:center;">
                                    <tr>
                                        <td style="width:50%;"><label>Date From: </label></td>
                                        <td>
                                            <?php echo $from_date; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;"><label>Date To: </label></td>
                                        <td>
                                            <?php echo $to_date; ?>
                                        </td>
                                    </tr>
                                </table>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- /.content-wrapper -->
        </div>
        <script>
            $(document).ready(function () {
                var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
                var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
                page = page.split('/');
                page = page[0];
                if (s != '')
                    page = page + '_' + s;

                if ($('.nav-link.nav-' + page).length > 0) {
                    $('.nav-link.nav-' + page).addClass('active')
                    if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
                        $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
                        $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
                    }
                    if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
                        $('.nav-link.nav-' + page).parent().addClass('menu-open')
                    }
                }
            })
            function hideDiv() {
                var div = document.getElementById("div_tally");
                var prep = document.getElementById("preparer").value;
                if (prep == "") {
                    div.style.color = "#F5F5F5";
                    div.style.display = "none";

                } else {
                    div.style.display = "block";
                }
            }
        </script>
    </div>
    <?php require_once('admin/inc/footer.php') ?>
</body>

</html>
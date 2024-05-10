<style>
.nav-home:hover{
  background-color:#007bff;
	color:black!important;
	box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
}


</style>
<?php $usertype = $_settings->userdata('user_type'); 
$level = $_settings->userdata('type'); 
?>
<!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-blue elevation-4 sidebar-no-expand">
        <!-- Brand Logo -->
        <a href="<?php echo base_url ?>" class="brand-link bg-blue text-sm">
        <img src="<?php echo base_url ?>/images/logo.jpg" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;
            width: 30px;
            height: 30px;
            max-height: unset;
            background: white;">
        <span class="brand-text font-weight-light"><b><?php echo $_settings->info('short_name') ?></b></span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
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
                   <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item dropdown">
                      <a href="./" class="nav-link nav-home">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li> 
                    <b><i><div style="background-color:gainsboro;"><li class="nav-header">Purchasing Order</li></div></b></i>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/cashier/?page=goods_receiving/received_items_status" class="nav-link nav-gr">
                      <i class="nav-icon fas fa-check-square"></i>
                        <p>
                          Goods Receiving
                        </p>
                      </a>
                    </li> 
                    <b><i><div style="background-color:gainsboro;"><li class="nav-header">Reservation Application</li></div></b></i>
                    <!-- <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/coo/?page=sm_sales" class="nav-link nav-sm_sales">
                      <i class="nav-icon fas fa-clock"></i>
                        <p>
                           Pendings
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/coo/?page=sm_ra" class="nav-link nav-sm_ra">
                      <i class="nav-icon fas fa-thumbs-up"></i>
                        <p>
                           Approved
                        </p>
                      </a>
                    </li>  -->
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/cashier/?page=cashier_reservation" class="nav-link nav-cashier_res">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                           Reservations
                        </p>
                      </a>
                    </li> 
                    <!-- <b><i><div style="background-color:gainsboro;"><li class="nav-header">Inventory</li></div></b></i>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/coo/?page=inventory/lot-list" class="nav-link nav-inventory">
                      <i class="nav-icon fas fa-cube"></i>
                        <p>
                          Lot Inventory 
                        </p>
                      </a>
                    </li>  -->
                    <div style="background-color:gainsboro;">
                      <li class="nav-header">
                        <b><i>Banking and General Ledger</i></b>
                      </li>
                    </div>
                    <!-- <div style="background-color:gainsboro;" class="nav-check nav-check">
                      <li class="nav-header">
                        <a href="<?php echo base_url ?>employee/accounting/?page=cv/manage_check_voucher">
                          <b><i>Create Check Voucher Setup</i></b>
                        </a>
                      </li>
                    </div> -->
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/cashier/?page=cv/manage_check_voucher" class="nav-link nav-check">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                        Create Check Voucher Setup
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/cashier/?page=cv" class="nav-link nav-maincv">
                      <i class="nav-icon fas fa-file"></i>
                        <p>
                          Check Voucher Entries
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/cashier/?page=journals/check_list" class="nav-link nav-cl">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                        Checks List
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/cashier/?page=rfp/rfp_list" class="nav-link nav-rfp">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                        Request for Payment List
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/cashier/?page=tba/tba_list" class="nav-link nav-tba">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                        TBA List
                        </p>
                      </a>
                    </li> 
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
      <script>
    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      page = page.split('/');
      page = page[0];
      if(s!='')
        page = page+'_'+s;

      if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

      }
     
    })
  </script>

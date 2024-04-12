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
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li> 
                    
                    <b><i><div style="background-color:gainsboro;"><li class="nav-header">Reservation Application</li></div></b></i>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=fa_list" class="nav-link nav-cfo_fa">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                        Pendings
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=fm_ra" class="nav-link nav-cfo_ra">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                           Approved
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=fm_revision" class="nav-link nav-cfo_revision">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                           For Revision
                        </p>
                      </a>
                    </li> 
                    <b><i><div style="background-color:gainsboro;"><li class="nav-header">Inventory</li></div></b></i>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=fm_inventory/lots_list" class="nav-link nav-lot">
                      <i class="nav-icon fas fa-cube"></i>
                        <p>
                          Lot Inventory 
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=fm_inventory/models_list" class="nav-link nav-models">
                      <i class="nav-icon fas fa-home"></i>
                        <p>
                          House Models List 
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=fm_inventory/projects_list" class="nav-link nav-projects">
                      <i class="nav-icon fas fa-cube"></i>
                        <p>
                          Project Sites List
                        </p>
                      </a>
                    </li> 
                    <b><i><div style="background-color:gainsboro;"><li class="nav-header">Purchasing Order</li></div></b></i>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=fm_purchase_orders" class="nav-link nav-cpo">
                      <i class="nav-icon fas fa-file"></i>
                        <p>
                          POs List
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=fm_goods_receiving/received_items_status" class="nav-link nav-gr">
                      <i class="nav-icon fas fa-check-square"></i>
                        <p>
                          Goods Receiving
                        </p>
                      </a>
                    </li> 
                    <div style="background-color:gainsboro;">
                      <li class="nav-header">
                        <b><i>Banking and General Ledger</i></b>
                      </li>
                    </div>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=rfp/rfp_list" class="nav-link nav-rfp">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                        Request for Payment List
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=journals/gl/gl" class="nav-link nav-gl">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                        General Ledger
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=journals/gl/tran_details" class="nav-link nav-tran">
                      <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                        Transaction Details
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=journals/jv/manage_jv" class="nav-link nav-jv">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                        Journal Voucher
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=journals/check_list" class="nav-link nav-cl">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                        Checks List
                        </p>
                      </a>
                    </li> 
                    <div style="background-color:gainsboro;">
                      <li class="nav-header" onclick="toggleNavList()">
                        <b><i>Create Voucher Setup</i></b>
                      </li>
                    </div>

                      <li class="nav-item">
                        <a href="<?php echo base_url ?>employee/finance_manager/?page=journals/vs/m_agent_voucher" class="nav-link nav-agent">
                          <i class="nav-icon fas fa-id-card"></i>
                          <p>Agents</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo base_url ?>employee/finance_manager/?page=journals/vs/m_employee_voucher" class="nav-link nav-emp">
                          <i class="nav-icon fas fa-id-badge"></i>
                          <p>Employees</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo base_url ?>employee/finance_manager/?page=journals/vs/m_client_voucher" class="nav-link nav-client">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Clients</p>
                        </a>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link nav-sup">
                              <i class="nav-icon fa fa-truck"></i>
                              <p>Suppliers</p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="<?php echo base_url ?>employee/finance_manager/?page=journals/vs/m_supplier_voucher" class="nav-link">
                                      <i class="nav-icon fa fa-file"></i>
                                      <p>PO</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="<?php echo base_url ?>employee/finance_manager/?page=journals/vs/m_nonpo_supplier_voucher" class="nav-link">
                                      <i class="nav-icon fa fa-times"></i>
                                      <p>Non-PO</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                    <div style="background-color:gainsboro;" class="nav-check nav-check">
                      <li class="nav-header">
                          <b><i>Voucher Entries</i></b>
                      </li>
                    </div>
                    <li class="nav-item">
                      <a href="<?php echo base_url ?>employee/finance_manager/?page=journals" class="nav-link nav-journal">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                          Voucher Setup Entries
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

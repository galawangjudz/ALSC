<style>
.nav-home:hover{
  background-color:#007bff;
	color:black!important;
	box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
}

</style>
<?php $usertype = $_settings->userdata('user_type'); ?>
<!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-blue elevation-4 sidebar-no-expand">
        <!-- Brand Logo -->
        <a href="<?php echo base_url ?>admin" class="brand-link bg-blue text-sm">
        <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;
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
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=sales/client" class="nav-link nav-client">
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
                      <a href="<?php echo base_url ?>admin/?page=inventory/lot-list" class="nav-link nav-inventory">
                      <i class="nav-icon fas fa-cube"></i>
                        <p>
                          Inventory
                        </p>
                      </a>
                    </li> 

                    <li class="nav-header">Report</li>

                    <?php if ($usertype == "IT Admin" || $usertype == 'Cashier'): ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/av_logs" class="nav-link nav-av">
                      <i class="nav-icon fas fa-receipt"></i>
                        <p>
                          AV Logs
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/or_logs" class="nav-link nav-or">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                          OR Logs
                        </p>
                      </a>
                    </li> 

                    

                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=loan-calcu" class="nav-link nav-loan-calcu">
                        <i class="nav-icon fas fa-calculator"></i>
                        <p>
                          Loan Calculator
                        </p>
                      </a>
                    </li>
                    <?php endif ; ?>

                    <li class="nav-item">
                      <a href="<?php echo base_url ?>admin/?page=journals" class="nav-link nav-journals">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                          Journal Entries
                        </p>
                      </a>
                    </li> 

                    

                    

                    <li class="nav-header">Maintenance</li>
                  
                  
                    <?php if ($usertype == "IT Admin"): ?>


                    


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
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=agents_list/list" class="nav-link nav-agents_list">
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
                      <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
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


<?php $usertype = $_settings->userdata('user_type'); 
$level = $_settings->userdata('type'); 
?>
      <aside class="main-sidebar sidebar-light-blue elevation-4 sidebar-no-expand">
        <a href="<?php echo base_url ?>" class="brand-link bg-blue text-sm">
        <img src="<?php echo base_url ?>/images/logo.jpg" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;
            width: 30px;
            height: 30px;
            max-height: unset;
            background: white;">
        <span class="brand-text font-weight-light"><b><?php echo $_settings->info('short_name') ?></b></span>
        </a>
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
                <div class="clearfix"></div>
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
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>agent_user/?page=agent_sales/client" class="nav-link nav-client">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>
                          New Client
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>agent_user/?page=agent_sales/create" class="nav-link nav-create">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>
                          Create New RA
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>agent_user/?page=agent_ra" class="nav-link nav-ra">
                      <i class="nav-icon fas fa-book"></i>
                        <p>
                          Reservation Application
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>agent_user/?page=agent_inventory/lots_list" class="nav-link nav-inventory">
                      <i class="nav-icon fas fa-cube"></i>
                        <p>
                          Inventory
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>agent_user/?page=agent_inventory/additional_inv" class="nav-link nav-add-inv">
                      <i class="nav-icon fas fa-cube"></i>
                        <p>
                          Privilege List
                        </p>
                      </a>
                    </li> 
                   
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>agent_user/?page=agent_loan_calcu" class="nav-link nav-loan">
                        <i class="nav-icon fas fa-calculator"></i>
                        <p>
                          Loan Calculator
                        </p>
                      </a>
                    </li>
                  </ul>
                </nav>
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

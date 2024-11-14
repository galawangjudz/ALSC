<style>
.nav-home:hover{
  background-color:#007bff;
	color:black!important;
	box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
}
.active-button {
        background-color: #ccc; 
    }

</style>
<?php $usertype = $_settings->userdata('user_type'); 
$level = $_settings->userdata('type'); 
$position = $_settings->userdata('position'); 
$department = $_settings->userdata('department'); 
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
                    <div class="accordion" id="salesAccordion" style="margin-bottom:5px;">
                      <button class="btn btn-link" type="button" data-target="#collapseSales" aria-expanded="true" aria-controls="collapseSales" style="background-color:gainsboro;width:270px;height:30px;padding-top:0; display: inline-block;text-align:left;">
                          <b><i><li class="nav-header" style="margin-left:-10px">Sales</li></i></b>
                      </button>
                      <div id="collapseSales" aria-labelledby="salesHeading" data-parent="#salesAccordion">
                          <div style="margin-left:15px">
                              <ul class="nav flex-column">
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
                                    <i class="nav-icon fas fa-book"></i>
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
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="accordion" id="purchasingAccordion" style="margin-bottom:5px;">
                      <button class="btn btn-link" type="button" data-target="#collapsePurchase" aria-expanded="true" aria-controls="collapsePurchase" style="background-color:gainsboro;width:270px;height:30px;padding-top:0; display: inline-block;text-align:left;">
                        <b><i><li class="nav-header" style="margin-left:-10px">Purchasing Order</li></b></i>
                      </button>
                      <div id="collapsePurchase" aria-labelledby="purchaseHeading" data-parent="#purchasingAccordion">
                        <div style="margin-left:15px">
                          <ul class="nav flex-column">
                            <li class="nav-item dropdown">
                              <a href="<?php echo base_url ?>admin/?page=po/po_purchase_orders/" class="nav-link nav-cpo">
                                <i class="nav-icon fas fa-file"></i> POs List
                              </a>
                            </li>
                            <li class="nav-item dropdown">
                              <a href="<?php echo base_url ?>admin/?page=po/po_suppliers" class="nav-link nav-suppliers">
                                <i class="nav-icon fas fa-truck"></i> Suppliers List
                              </a>
                            </li>
                            <li class="nav-item dropdown">
                              <a href="<?php echo base_url ?>admin/?page=po/po_items" class="nav-link nav-items">
                                <i class="nav-icon fas fa-th-list"></i> Items List
                              </a>
                            </li>
                            <li class="nav-item dropdown">
                              <a href="<?php echo base_url ?>admin/?page=po/po_goods_receiving/received_items_status" class="nav-link nav-gr">
                              <i class="nav-icon fas fa-check-square"></i>
                                <p>
                                  Goods Receiving
                                </p>
                              </a>
                            </li> 

                            <li class="nav-item dropdown">
                              <a href="<?php echo base_url ?>admin/?page=po/po_goods_receiving/po_status" class="nav-link nav-monitoring">
                              <i class="nav-icon fas fa-search"></i>
                                <p>
                                  PO Monitoring
                                </p>
                              </a>
                            </li> 
                          </ul>
                        </div>
                      </div>
                  </div>
                 
                  <div class="accordion" id="fileManagerAccordion" style="margin-bottom:5px;">
                      <button class="btn btn-link" type="button" data-target="#collapseFileManager" aria-expanded="true" aria-controls="collapseFileManager" style="background-color:gainsboro;width:270px;height:30px;padding-top:0; display: inline-block;text-align:left;">
                        <b><i><li class="nav-header" style="margin-left:-10px">File Manager</li></b></i>
                      </button>
                      <div id="collapseFileManager" aria-labelledby="fileManagerHeading" data-parent="#fileManagerAccordion">
                        <div style="margin-left:15px">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=accounts/" class="nav-link nav-acc">
                                <i class="nav-icon fas fa-file"></i> Chart of Accounts
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=groups/">
                                <i class="nav-icon fas fa-file"></i> Groups List
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=customers_profile/">
                                <i class="nav-icon fas fa-file"></i> Customers' Profile
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                  </div>
                 
                  <div class="accordion" id="bGAccordion" style="margin-bottom:5px;">
                      <button class="btn btn-link" type="button" data-target="#collapseBG" aria-expanded="true" aria-controls="collapseBG" style="background-color:gainsboro;width:270px;height:30px;padding-top:0; display: inline-block;text-align:left;">
                        <b><i><li class="nav-header" style="margin-left:-10px">Banking And General Ledger</li></b></i>
                      </button>
                      <div id="collapseBG" aria-labelledby="accountsPayableHeading" data-parent="#bGAccordion">
                        <div style="margin-left:15px">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=journals">
                                <i class="nav-icon fas fa-folder"></i> Request for Payment List
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=po/cv/">
                                <i class="nav-icon fas fa-file"></i> General Ledger
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=po/cv/">
                                <i class="nav-icon fas fa-file"></i> Transaction Details
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=po/cv/">
                                <i class="nav-icon fas fa-file"></i> Journal Voucher
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=po/cv/">
                                <i class="nav-icon fas fa-file"></i> Checks List
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                  </div>

                  <div class="accordion" id="accountsPayableAccordion" style="margin-bottom:5px;">
                      <button class="btn btn-link" type="button" data-target="#collapseAccountsPayable" aria-expanded="true" aria-controls="collapseAccountsPayable" style="background-color:gainsboro;width:270px;height:30px;padding-top:0; display: inline-block;text-align:left;">
                        <b><i><li class="nav-header" style="margin-left:-10px">Voucher Setup Entries</li></b></i>
                      </button>
                      <div id="collapseAccountsPayable" aria-labelledby="accountsPayableHeading" data-parent="#accountsPayableAccordion">
                        <div style="margin-left:15px">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=journals">
                                <i class="nav-icon fas fa-folder"></i> Voucher Setup Entries
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=po/cv/">
                                <i class="nav-icon fas fa-file"></i> Check Voucher Entries
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=po/cv/">
                                <i class="nav-icon fas fa-file"></i> Journal Voucher Entries
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                  </div>

                  <div class="accordion" id="CreateVouchAccordion" style="margin-bottom:5px;">
                      <button class="btn btn-link" type="button" data-target="#collapseCreateVouch" aria-expanded="true" aria-controls="collapseCreateVouch" style="background-color:gainsboro;width:270px;height:30px;padding-top:0; display: inline-block;text-align:left;">
                        <b><i><li class="nav-header" style="margin-left:-10px">Create Voucher Setup</li></b></i>
                      </button>
                      <div id="collapseCreateVouch" aria-labelledby="CreateVouchHeading" data-parent="#CreateVouchAccordion">
                        <div style="margin-left:15px">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=journals">
                                <i class="nav-icon fas fa-folder"></i> Agents
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=po/cv/">
                                <i class="nav-icon fas fa-file"></i>Employees
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=po/cv/">
                                <i class="nav-icon fas fa-file"></i> Clients
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=po/cv/">
                                <i class="nav-icon fas fa-file"></i> Clients
                              </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-sup">
                                    <i class="nav-icon fa fa-truck"></i>
                                    <p>Suppliers</p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url ?>employee/accounting/?page=journals/vs/m_supplier_voucher" class="nav-link">
                                            <i class="nav-icon fa fa-file"></i>
                                            <p>PO</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url ?>employee/accounting/?page=journals/vs/m_nonpo_supplier_voucher" class="nav-link">
                                            <i class="nav-icon fa fa-times"></i>
                                            <p>Non-PO</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                          </ul>
                        </div>
                      </div>
                  </div>
                
                  <div class="accordion" id="reportAccordion" style="margin-bottom:5px;">
                      <button class="btn btn-link" type="button" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseReport" style="background-color:gainsboro;width:270px;height:30px;padding-top:0; display: inline-block;text-align:left;">
                        <b><i><li class="nav-header" style="margin-left:-10px">Report</li></b></i>
                      </button>
                      <div id="collapseReport" aria-labelledby="reportHeading" data-parent="#reportAccordion">
                      <div style="margin-left:15px">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=clients/av_logs/av_list">
                                <i class="nav-icon fas fa-receipt"></i> AV Logs
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=reports/or_logs">
                                <i class="nav-icon fas fa-book"></i> OR Logs
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=clients/credit-memo/cm_list">
                                <i class="nav-icon fa fa-credit-card"></i> Credit/Debit Memo
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=clients/restructuring/restructuring_list">
                                <i class="nav-icon fas fa-redo"></i> Restructuring
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=loan-calcu">
                                <i class="nav-icon fas fa-calculator"></i> Loan Calculator
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                  </div>
                 
                  <div class="accordion" id="maintenanceAccordion" style="margin-bottom:5px;">
                      <button class="btn btn-link" type="button" data-target="#collapseMaintenance" aria-expanded="true" aria-controls="collapseMaintenance" style="background-color:gainsboro;width:270px;height:30px;padding-top:0; display: inline-block;text-align:left;">
                        <b><i><li class="nav-header" style="margin-left:-10px">Maintenance</li></b></i>
                      </button>
                      <div id="collapseMaintenance" aria-labelledby="maintenanceHeading" data-parent="#maintenanceAccordion">
                      <div style="margin-left:15px">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=agents_list/list">
                                <i class="nav-icon fa fa-id-card"></i> Agents List
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=user/list">
                                <i class="nav-icon fas fa-user-circle"></i> Users List
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=system_info">
                                <i class="nav-icon fas fa-cogs"></i> Settings
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                  </div>

        </div>
      </aside>

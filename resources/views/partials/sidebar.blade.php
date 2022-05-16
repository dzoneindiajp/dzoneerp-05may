
 <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
                <div class="sidebar-brand-icon ">
                    <img src="{{ asset('public/img/dzone.jpeg') }}" style="height: 35px" alt="">
                    {{-- <i class="fas fa-laugh-wink"></i> --}}

                </div>
                <div class="sidebar-brand-text mx-3">Dzone ERP <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span> Admin Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa fa-users fa-cog"></i>
                    <span>User Management</span>
                </a>
                <div id="collapseOne" class="collapse {{ Request::is("admin/permissions*")? "show" : "" }}  {{ Request::is("admin/roles*")? "show" : "" }}  {{ Request::is("admin/users*")? "show" : "" }}  {{ Request::is("admin/suppliers*")? "show" : "" }}  {{ Request::is("admin/staffs*")? "show" : "" }}  {{ Request::is("admin/vendors*")? "show" : "" }}" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('admin/permissions')? "active" : "" }}" href="{{ route("admin.permissions.index") }}"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;Permission</a>
                        <a class="collapse-item {{ Request::is('admin/roles')? "active" : "" }}" href="{{ route("admin.roles.index") }}"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;Roles</a>
                        <a class="collapse-item {{ Request::is('admin/users')? "active" : "" }}" href="{{ route("admin.users.index") }}"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;Users</a>
                        <a class="collapse-item {{ Request::is('admin/suppliers*')? "active" : "" }}" href="{{ route("admin.suppliers.index") }}"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;Suppliers</a>
                        <a class="collapse-item {{ Request::is('admin/staffs*')? "active" : "" }}" href="{{ route("admin.staffs.index") }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Staffs</a>
                        <a class="collapse-item {{ Request::is('admin/vendors*')? "active" : "" }}" href="{{ route("admin.vendors.index") }}"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Vendors</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingFour" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa-fw nav-icon fas fa-money"></i>
                    <span>Purchase</span>
                </a>
                <div id="collapseFour" class="collapse {{ Request::is("admin/purchases*")? "show" : "" }}  {{ Request::is("admin/returnpurchases*")? "show" : "" }}  {{ Request::is("admin/damagepurchases*")? "show" : "" }}  {{ Request::is("admin/purchaseinventory*")? "show" : "" }} "  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('admin/purchases*')? "active" : "" }}" href="{{ route("admin.purchases.index") }}"><i class="fas fa-shopping-basket" aria-hidden="true"></i>&nbsp;Purchases</a>
                        <a class="collapse-item {{ Request::is('admin/returnpurchases*')? "active" : "" }}" href="{{ route("admin.returnpurchases.index") }}"><i class="fas fa-refresh" aria-hidden="true"></i>&nbsp;Return Purchases</a>
                        <a class="collapse-item {{ Request::is('admin/damagepurchases*')? "active" : "" }}" href="{{ route("admin.damagepurchases.index") }}"><i class="fas fa-trash-alt" aria-hidden="true"></i>&nbsp;Damage Purchases</a>
                        <a class="collapse-item {{ Request::is('admin/purchaseinventory*')? "active" : "" }}" href="{{ route("admin.purchaseinventory.index") }}"><i class="fas fa-boxes" aria-hidden="true"></i>&nbsp;Purchases Inventory</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingTwo" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa-fw nav-icon fas fa-shopping-bag"></i>
                    <span>Product</span>
                </a>
                <div id="collapseTwo" class="collapse {{ Request::is("admin/products*")? "show" : "" }} {{ Request::is("admin/processings*")? "show" : "" }} {{ Request::is("admin/finished*")? "show" : "" }} "  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.categories.index") }}"><i class="fas fa-plus-circle" aria-hidden="true"></i>&nbsp;Category</a>
                        <a class="collapse-item"  href="{{ route("admin.subcategory.index") }}"><i class="fas fa-fill-drip" aria-hidden="true"></i>&nbsp;Sub Category</a>
                        <a class="collapse-item {{ Request::is('admin/products*')? "active" : "" }}" href="{{ route("admin.products.index") }}"><i class="fas fa-shopping-bag" aria-hidden="true"></i>&nbsp;Products</a>
                        <a class="collapse-item {{ Request::is('admin/processings*')? "active" : "" }}" href="{{ route("admin.processings.index") }}"><i class="fas fa-tools" aria-hidden="true"></i>&nbsp;Processing</a>
                        <a class="collapse-item {{ Request::is('admin/finished*')? "active" : "" }}" href="{{ route("admin.finished.index") }}"><i class="fas fa-server" aria-hidden="true"></i>&nbsp;Finished</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingThree" data-target="#collapsethree" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa-fw nav-icon fas fa-cogs"></i>
                    <span>Attribute Management</span>
                </a>
                <div id="collapsethree" class="collapse {{ Request::is("admin/colors*")? "show" : "" }}  {{ Request::is("admin/sizes*")? "show" : "" }}  {{ Request::is("admin/units*")? "show" : "" }}"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('admin/sizes')? "active" : "" }}" href="{{ route("admin.sizes.index") }}"><i class="fas fa-plus-circle" aria-hidden="true"></i>&nbsp;Size Manager</a>
                        <a class="collapse-item {{ Request::is('admin/colors')? "active" : "" }}"  href="{{ route("admin.colors.index") }}"><i class="fas fa-fill-drip" aria-hidden="true"></i>&nbsp;Color Manager</a>
                        <a class="collapse-item {{ Request::is('admin/units')? "active" : "" }}" href="{{ route("admin.units.index")  }}"><i class="fas fa-weight" aria-hidden="true"></i>&nbsp;Unit Manager</a>
                        {{-- <a class="collapse-item {{ Request::is('admin/showrooms')? "active" : "" }}" href="{{ route("admin.showrooms.index")  }}"><i class="fas fa-weight" aria-hidden="true"></i>&nbsp;Showroom</a> --}}
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapsef" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa nav-icon fa-file"></i>
                  <span>Reports</span>
              </a>
              <div id="collapsef" class="collapse {{ Request::is("admin/reports/purchase*")? "show" : "" }}"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item {{ Request::is('admin/reports/purchase')? "active" : "" }}"  href="{{ route("admin.reports.purchase.index") }}"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Purchase Reports</a>
                      {{-- <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>&nbsp;Balance Sheet</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Financial Analysis</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Use Access Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Sale Registers</a>
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Financial Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Sale Challan Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Scheme Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Order Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Agent Wise Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Item Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Stock Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Excise Reports</a> --}}

                  </div>
              </div>
            </li>

               {{-- <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingThree" data-target="#collapsethree" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-truck"></i>
                    <span>Ordes Management</span>
                </a>
                <div id="collapsethree" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#"><i class="fas fa-archive" aria-hidden="true"></i>Sale Order</a>
                        <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Cancel Sale Order</a>
                        <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i> Pending Sale Order</a>
                        <a class="collapse-item"  href="#"><i class="fas fa-bookmark" aria-hidden="true"></i> Adjust Sale Orders Against Sale</a>
                        <a class="collapse-item"  href="#"><i class="far fa-folder floatRight" aria-hidden="true"></i> Purchase Order</a>
                        <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i> Delete Pending</a>


                    </div>
                </div>
              </li> --}}

              {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapsefour" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-cubes"></i>
                  <span>Set Up</span>
              </a>
              <div id="collapsefour" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fas fa-archive" aria-hidden="true"></i>Setup Accounts</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Setup Items</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i> Set Other Item Details</a>
                      <a class="collapse-item"  href="#"><i class="fas fa-bookmark" aria-hidden="true"></i>Setup Taxes</a>
                      <a class="collapse-item"  href="#"><i class="far fa-folder floatRight" aria-hidden="true"></i> Party Wise Setting</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i> Set Other Account Details</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i> Configurations</a>



                  </div>
              </div>
            </li> --}}


            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapsefive" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-money-bill"></i>
                  <span>Accounts</span>
              </a>
              <div id="collapsefive" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>A/C Vouchers</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Continuous Printing </a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i> Utilities</a>
                  </div>
              </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapsesix" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-credit-card"></i>
                  <span>Purchase</span>
              </a>
              <div id="collapsesix" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>Purchase Voucher</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Purchase Challan</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Rejection/Replacements Items</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Purchase Return</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Purchase Return Consignment</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Stock Receipt Consignment</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Stock Adjustment</a>

                  </div>
              </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapseseven" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-building"></i>
                  <span>Inventory</span>
              </a>
              <div id="collapseseven" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>Stock Receipt-Production </a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Overwrite Lot No.s/Rates</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Hide Lots</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Issue Register</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Receipt Register</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Generate Lot Numbers</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Assembling</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Stock Transfer-Godown wise</a>

                  </div>
              </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapseA" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-shopping-cart"></i>
                  <span>Billing</span>
              </a>
              <div id="collapseA" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>Sale Bill</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Sale Challan</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Sales Return</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Stock Transfer-Out</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Convert Cash Bills to Credit</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Enter G.R Details</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Missing Bill No</a>

                  </div>
              </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapseB" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-shopping-cart"></i>
                  <span>Production </span>
              </a>
              <div id="collapseB" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>Production Setups</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Production Vouchers</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Raw Material Processing</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Production Reports/Queries</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Production Utilities</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Raw Material Processing</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Washing And Printing Stock</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Cutting Stock</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Sewing Processing Stock</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Finishing Goods</a>
                  </div>
              </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapseC" aria-expanded="true" aria-controls="collapseOne">
                  <i class="far fa-folder"></i>
                  <span>Payroll Setups </span>
              </a>
              <div id="collapseC" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>Setup Allowance/Deduction</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Setup Grades</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Setup Leaves Type</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Setup Grade + Leave Types</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Setup Holidays</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Setup Payrole Time Period</a>

                  </div>
              </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapsed" aria-expanded="true" aria-controls="collapseOne">
                  <i class="far fa-folder"></i>
                  <span>Payroll Entry</span>
              </a>
              <div id="collapsed" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>Enter Opening Balance of Leaves</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Attendance Register</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Attendance Register Month Wise</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Worker Wise Loan Entry</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Payroll Re-Calculation</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Payrole Generation</a>

                  </div>
              </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapsee" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fas fa-users"></i>
                  <span>Payroll Reports</span>
              </a>
              <div id="collapsee" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>Attendance Status Report</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Attendance Summary Report</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Payroll Summary Report</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Employee Register</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Register of Leaves with Wages</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Employee Loan Report</a>

                  </div>
              </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapsef" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-file"></i>
                  <span>Reports/Queries</span>
              </a>
              <div id="collapsef" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>Financial Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Balance Sheet</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Financial Analysis</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Use Access Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Sale Registers</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Sale Challan Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Scheme Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Order Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Agent Wise Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Purchase Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Item Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Stock Reports</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Excise Reports</a>

                  </div>
              </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapseh" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-briefcase"></i>
                  <span>Utilities</span>
              </a>
              <div id="collapseh" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>Export/import Data Branch wise</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Import Masters/Transactions</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Billing Utilities</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-bars" aria-hidden="true"></i>Export Utilities for Third Parties</a>

                  </div>
              </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapsek" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fa fa-lock"></i>
                  <span>User Access</span>
              </a>
              <div id="collapsek" class="collapse"  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>Approval System</a>
                      <a class="collapse-item"  href="#"><i class="fa fa-car" aria-hidden="true"></i>Audit System</a>

                  </div>
              </div>
            </li> --}}


               {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-labelledby="headingfour" data-target="#collapsefour" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-truck"></i>
                    <span>Report Manager</span>
                </a>
                <div id="collapsefour" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#"><i class="fas fa-archive" aria-hidden="true"></i>Sales Report</a>
                        <a class="collapse-item"  href="#"><i class="fas fa-store" aria-hidden="true"></i>Order Report</a>
                        <a class="collapse-item"  href="#"><i class="fa fa-money-bill" aria-hidden="true"></i>Payment Report</a>
                    </div>
                </div>
               </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider">

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

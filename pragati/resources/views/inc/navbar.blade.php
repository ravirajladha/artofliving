<style>
  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .simplebar-offset {
    height: calc(100vh - 0px) !important;
  }
</style>

<div class="sidebar-wrapper">
  <div>
    <div class="logo-wrapper">
      <center><a href="#"><img class="img-fluid for-light" src="/assets/images/logo/small-logo.png" alt=""><img class="img-fluid for-dark" src="/assets/images/logo/small-white-logo.png" alt=""></a></center>

      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="#"><img class="img-fluid" src="/assets/images/logo-icon.png" alt=""></a></div>
    <hr style="color: #bbb;">

    <?php if ((session('rexkod_apex_user_status') != 0) && (session('rexkod_apex_user_status') != 2)) { ?>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn"><a href="#"><img class="img-fluid" src="/assets/images/logo-icon.png" alt=""></a>
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"> </i></div>
            </li>
            <li class="sidebar-list text-center">
              <a class="" href="">
                <span class="lan-3"><?php  echo session('rexkod_apex_user_name'); ?> </span></a>
            </li>
            <li class="sidebar-list text-center">
              <a class="" href="">
                <span class="lan-3"><?php  echo strtoupper(session('rexkod_apex_user_type')); ?> </span></a>
            </li>
            <hr style="color:black;margin:5px 0 5px 0;">
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title" href="/index">
                <i class="fa fa-home"></i> <span class="lan-3">Dashboard </span></a>

            </li>

            <?php if (session('rexkod_apex_user_type') == "trustee" || session('rexkod_apex_user_type') == "hq") { ?>

              <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="/search">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span class="lan-6">Reports</span></a>

              </li>
            <?php } ?>

            <?php if (session('rexkod_apex_user_type') == "hq") { ?>

              <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="/add_user">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span class="lan-6">Add User</span></a>

              </li>
            <?php } ?>
            <?php if (session('rexkod_apex_user_type') == "hq" || session('rexkod_apex_user_type') == "trustee" || session('rexkod_apex_user_type') == "coordinator" || session('rexkod_apex_user_type') == "director") { ?>


              <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g>
                    <g>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                  </g>
                </svg><span class="lan-6">Back Office</span></a>
              <ul class="sidebar-submenu">
                <li><a href="/users/trustee">Trustees</a></li>
                <li><a href="/users/director">Directors</a></li>
                <li><a href="/users/coordinator">Coordinators</a></li>
              </ul>
            </li>
            <?php  } ?>
            @if (Session::get('rexkod_apex_user_type') !== 'tdc' && Session::get('rexkod_apex_user_type') !== 'ddc' && Session::get('rexkod_apex_user_type') !== 'vdc' && Session::get('rexkod_apex_user_type') !== 'administrator' && Session::get('rexkod_apex_user_type') !== 'apex')

            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g>
                  <g>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                  </g>
                </g>
              </svg><span class="lan-6">Front Office</span></a>
                <ul class="sidebar-submenu">
                  <li><a href="/users/apex">Apex Members</a></li>
                  <li><a href="/users/administrator">State Administrators</a></li>
                  <li><a href="/users/accountant">Accountants</a></li>
                  <li><a href="/users/ddc">DDCs</a></li>
                  <li><a href="/users/tdc">TDCs</a></li>
                  <li><a href="/users/vdc">VDCs</a></li>
                </ul>
             </li>

@endif


            <?php if (session('rexkod_apex_user_type') == "hq" || session('rexkod_apex_user_type') == "trustee" || session('rexkod_apex_user_type') == "coordinator" || session('rexkod_apex_user_type') == "director") { ?>


              <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span class="lan-6">Bank Accounts</span></a>
                <ul class="sidebar-submenu">
                  <?php if (session('rexkod_apex_user_type') == "hq") { ?>
                    <li><a href="/add_bank">New Bank Account</a></li>
                  <?php } ?>
                  <li><a href="/banks">All Bank Accounts</a></li>
                </ul>
              </li>

            <?php } ?>

            <?php if (session('rexkod_apex_user_type') == "hq" || session('rexkod_apex_user_type') == "trustee" || session('rexkod_apex_user_type') == "coordinator" || session('rexkod_apex_user_type') == "director") { ?>


              <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span class="lan-6">Projects</span></a>
                <ul class="sidebar-submenu">
                  <?php if (session('rexkod_apex_user_type') == "hq") { ?>
                    <li><a href="/add_project">New Project</a></li>
                  <?php } ?>
                  <li><a href="/projects">All Projects</a></li>
                </ul>
              </li>

            <?php } ?>


            <?php if (session('rexkod_apex_user_type') == "hq" || session('rexkod_apex_user_type') == "trustee" || session('rexkod_apex_user_type') == "coordinator" || session('rexkod_apex_user_type') == "director") { ?>

              <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span class="lan-6">Requests</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="/request_document">New Request</a></li>
                    <li><a href="/all_requests">All Requests</a></li>
                  </ul>
              </li>
            <?php } else { ?>

              <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span class="lan-6">Requests</span></a>
                <ul class="sidebar-submenu">
                  <li><a href="/request_document">New Request</a></li>
                  <li><a href="/requests">All Requests</a></li>
                </ul>
              </li>

            <?php  } ?>





            <?php if (session('rexkod_apex_user_type') == "hq") { ?>
              <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="/datasets">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span class="lan-6">Data Sets</span></a>

              </li>
            <?php } ?>



            <?php if (session('rexkod_apex_user_type') == "apex" || session('rexkod_apex_user_type') == "ddc" || session('rexkod_apex_user_type') == "tdc" || session('rexkod_apex_user_type') == "vdc" || session('rexkod_apex_user_type') == "accountant" || session('rexkod_apex_user_type') == "administrator") { ?>
              <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="id/<?php echo session('rexkod_apex_user_id'); ?>" target="_BLANK">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span class="lan-6">My ID</span></a>

              </li>

            <?php } ?>


            <?php if (session('rexkod_apex_user_type') == "apex" || session('rexkod_apex_user_type') == "ddc" || session('rexkod_apex_user_type') == "tdc" || session('rexkod_apex_user_type') == "vdc" || session('rexkod_apex_user_type') == "accountant" || session('rexkod_apex_user_type') == "administrator") { ?>
              <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="/notifications">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span class="lan-6">Notifications</span></a>

              </li>

            <?php } ?>


            <?php if (session('rexkod_apex_user_type') == "hq" || session('rexkod_apex_user_type') == "trustee" || session('rexkod_apex_user_type') == "coordinator" || session('rexkod_apex_user_type') == "director") { ?>
              <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span class="lan-6">Notifications</span></a>
                <ul class="sidebar-submenu">
                  <li><a href="/add_notification">New Notification</a></li>
                  <li><a href="/all_notifications">All Notifications</a></li>
                </ul>
              </li>




            <?php } ?>

          </ul>

        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    <?php } ?>
  </div>
</div>

<?php $priviliges = session('rexkod_apex_user_priviliges');
$user_priviliges = explode(',',$priviliges);  ?>



<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <center><a href="/index"><img class="img-fluid for-light" src="/assets/images/logo/small-logo.png"
                        alt=""><img class="img-fluid for-dark" src="/assets/images/logo/small-white-logo.png"
                        alt=""></a></center>

            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="/index"></a></div>
        <hr style="color: #bbb;">
        <nav class="sidebar-main" >
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu" style="max-height: 200px !important;y-overflow:scroll">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="/index"></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"> </i></div>
                    </li>
                    <li class="sidebar-list text-center">
                        <a class="" href="">
                            <span class="lan-3">{{ session('rexkod_apex_user_name') }}</span></a>
                    </li>
                    <li class="sidebar-list text-center">
                        <a class="" href="">

                            <span class="lan-3"></span><?php echo $type=strtoupper(session('rexkod_apex_user_type'))  ?></a>
                    </li>
                    <hr style="color:black;margin:5px 0 5px 0;">
                    <?php if(session('rexkod_apex_user_type') == "itadmin"  || session('rexkod_apex_user_type') == "hq" ) {?>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="/index">
                            <i class="fa fa-home"></i> <span class="lan-3">Dashboard</span></a>

                    </li>
                    <?php } ?>

                    {{-- if( in_array(session()->get('rexkod_admin_user_id'),$event_apex) ) --}}

                    <?php if(session('rexkod_apex_user_type') != "hq") {?>


                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="/user/<?php echo Session('rexkod_apex_user_id');?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Profile</span></a>

                    </li>
                    <?php } ?>

                    {{-- <?php if(session('rexkod_apex_user_type') == "hq" || session('rexkod_apex_user_type') == "apex" ) {?> --}}
                        <?php if(in_array(1, $user_priviliges) || in_array(2, $user_priviliges) || in_array(3, $user_priviliges) || in_array(4, $user_priviliges)) {?>


                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Users</span></a>
                        <ul class="sidebar-submenu">
                            {{-- <?php //if(session('rexkod_apex_user_type') == "hq") {?> --}}
                            <?php if(in_array(1, $user_priviliges)) {?>

                            <li><a href="/add_user">New User</a></li>
                            <?php } ?>

                            <?php if(in_array(2, $user_priviliges) || in_array(3, $user_priviliges)) {?>
                            <li><a href="/users">All Users</a></li>
                            <?php } ?>

                        </ul>
                    </li>
                    <?php } ?>



                    {{-- <?php //if(session('rexkod_apex_user_type') == "hq" || session('rexkod_apex_user_type') == "apex" ) {?> --}}
                    <?php if(in_array(5, $user_priviliges) || in_array(6, $user_priviliges) || in_array(7, $user_priviliges)) {?>



                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Locations</span></a>
                        <ul class="sidebar-submenu">
                            <?php if(in_array(5, $user_priviliges)) {?>

                            <li><a href="/add_location">New Location</a></li>
                            <?php } ?>


                            <?php if(in_array(6, $user_priviliges) || in_array(7, $user_priviliges)) {?>

                            <li><a href="/locations">All Locations</a></li>
                            <?php } ?>

                        </ul>
                    </li>
                    <?php } ?>



                     <?php 
                    //  if(session('rexkod_apex_user_type') == "itadmin" || session('rexkod_apex_user_type') == "hq" || session('rexkod_apex_user_type') == "apex" || session('rexkod_apex_user_type') == "owner") {
                        
                        ?> 
                    <?php if(in_array(8, $user_priviliges) || in_array(9, $user_priviliges) || in_array(10, $user_priviliges)) {?>


                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Assets</span></a>
                        <ul class="sidebar-submenu">
                            <?php if(in_array(8, $user_priviliges)) {?>

                            <li><a href="/add_asset_select">New Asset</a></li>
                            <?php } ?>

                            <?php if(in_array(9, $user_priviliges) || in_array(10, $user_priviliges)) {?>

                            <li><a href="/all_assets">All Assets</a></li>
                            <?php } ?>

                        </ul>
                    </li>
                    <?php } ?>
                    {{-- <?php if(session('rexkod_apex_user_permission') && session('rexkod_apex_user_type') != "itadmin"){ ?> --}}
                    <?php if(in_array(11, $user_priviliges) || in_array(12, $user_priviliges) || in_array(13, $user_priviliges)) {?>



                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Properties <span
                                    style="font-size:10px"></span></span></a>
                        <ul class="sidebar-submenu">
                            <?php if(in_array(11, $user_priviliges)) {?>

                            <li><a href="/add_property">New Property</a></li>
                    <?php } ?>
                    <?php if(in_array(12, $user_priviliges) || in_array(13, $user_priviliges)) {?>

                            <li><a href="/properties">All Properties</a></li>
                    <?php } ?>


                        </ul>
                    </li>
                    <?php } ?>
                    <?php if(in_array(14, $user_priviliges) || in_array(15, $user_priviliges) || in_array(16, $user_priviliges) || in_array(17, $user_priviliges) || in_array(18, $user_priviliges) || in_array(19, $user_priviliges) || in_array(20, $user_priviliges) || in_array(21, $user_priviliges)) {?>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Audits</span></a>
                        <ul class="sidebar-submenu">

                            <?php if(in_array(14, $user_priviliges)) {?>
                            <li><a href="/add_asset_audit/0">New Asset Audit</a></li>
                            <?php } ?>

                            <?php if(in_array(15, $user_priviliges) || in_array(16, $user_priviliges) || in_array(17, $user_priviliges)) {?>
                            <li><a href="/asset_audits">All Asset Audits</a></li>
                            <?php } ?>

                            <?php if(in_array(18, $user_priviliges)) {?>
                            <li><a href="/add_property_audit/0">New Property Audit</a></li>
                            <?php } ?>

                            <?php if(in_array(19, $user_priviliges) || in_array(20, $user_priviliges) || in_array(21, $user_priviliges)) {?>
                            <li><a href="/property_audits">All Property Audit</a></li>
                            <?php } ?>

                        </ul>
                    </li>
                    <?php } ?>



                    <?php if(in_array(22, $user_priviliges)) {?>

                    <li class="sidebar-list"><a class="sidebar-link sidear-title" href="/transfers">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Transfers</span></a>

                    </li>
                    <?php } ?>



                    <?php if(in_array(23, $user_priviliges)) {
                        if(session('rexkod_apex_user_id') != 79){
                        ?>

                    <li class="sidebar-list"><a class="sidebar-link sidbar-title" href="/tickets">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Tickets</span></a>

                    </li>
                    <?php } } ?>



                    <?php if(in_array(25, $user_priviliges)) {
                           if(session('rexkod_apex_user_id') != 79){
                            ?>


                    <li class="sidebar-list"><a class="sidebar-link sidear-title" href="/incidents">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Incidents</span></a>

                    </li>
                    <?php } } ?>

                    <?php if(in_array(27, $user_priviliges)) {?>


                    <li class="sidebar-list"><a class="sidebar-link sidear-title" href="/datasets">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Data Sets</span></a>

                    </li>
                    <?php } ?>


                        <?php if(in_array(35, $user_priviliges)) {?>

                    <li class="sidebar-list"><a class="sidebar-link sidear-title" href="/reports">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Reports</span></a>

                    </li>
                    <?php } ?>

                    <?php 
                        
                        if(Session('rexkod_apex_user_type')=='manager'){
                            
                        ?>

                    <li class="sidebar-list"><a class="sidebar-link sidear-title" href="/team_assigns">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Manager Asset</span></a>

                    </li>
                    <?php } ?>


                    <?php if(in_array(37, $user_priviliges)) {?>

                    <li class="sidebar-list"><a class="sidebar-link sidear-title" href="/notifications">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="lan-6">Notifications</span></a>

                    </li>
                    <?php } ?>

                </ul>

            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>

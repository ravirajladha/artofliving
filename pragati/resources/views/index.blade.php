<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\State;
use App\Models\Document;
use App\Models\Apex_bodie;
?>
@include('inc.header')
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<style>
    .widget-joins .widget-card .widget-icon {
    width: 50px;
    height: 50px;
    }
    .widget-joins .widget-card {
    padding: 15px;
}
</style>


<?php if(Session::get('rexkod_apex_user_status') != 2){?>
{{-- == --}}
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>
                     Welcome,
                     @if(null!==(Session::get('rexkod_apex_user_name')))
                         {{Session::get('rexkod_apex_user_name')}}
                     @endif
                     </h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="home-item" href="index"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
           <!-- Container-fluid starts-->
           <?php if(Session::get('rexkod_apex_user_status') != 0){?>
            <div class="container-fluid ecommerce-dash">
          <?php if(Session::get('rexkod_apex_user_type') == "hq" || Session::get('rexkod_apex_user_type') == "trustee" || Session::get('rexkod_apex_user_type') == "coordinator" || Session::get('rexkod_apex_user_type') == "director"){?>

            <div class="row">
              <div class="col-md-12">
                <div class="cad sales-state">
                  <div class="row m-0">
                  <div class="col-md-3">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Apex Members</h6>
                        <h4 class="mb-0 counter"><?php echo $data['all_apex'];?></h4>
                      </div>
                      <svg class="fill-primary" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                        <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                        <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                      </svg>
                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">DDC</h6>
                        <h4 class="mb-0 counter"><?php echo $data['all_ddc'];?></h4>
                      </div>
                      <svg class="fill-success" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                        <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                        <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                      </svg>

                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-success" role="progressbar" style="width: 60%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>





              <div class="col-md-3">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">TDC</h6>
                        <h4 class="mb-0 counter"><?php echo $data['all_tdc'];?></h4>
                      </div>
                      <svg class="fill-danger" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                        <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                        <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                      </svg>
                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-danger" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">VDC</h6>
                        <h4 class="mb-0 counter"><?php echo $data['all_vdc'];?></h4>
                      </div>
                      <svg class="fill-warning" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                        <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                        <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                      </svg>

                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-primary" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                  </div>
                </div>



              </div>






              <div class="col-xl-12">







              <div class="col-xl-12 xl-100 box-col-12" style="padding:10px">
                <div class="widget-joins card">

                  <div class="card-body">
                           <!-- <h6 style="color:#666">Tickets</h6> -->
                    <div class="row gy-4">
                      <div class="col-sm-3">
                        <div class="widget-card">
                          <div class="media align-self-center">
                            <div class="widget-icon bg-light-primary">
                              <svg style="width:25px;height:25px" class="fill-primary" width="110" height="105" viewBox="0 0 110 105" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                  <path d="M56.4571 104.995C56.4571 100.722 56.4571 96.6523 56.4571 92.5829C56.4596 79.9804 56.4645 67.3755 56.4547 54.773C56.4547 54.0685 56.5307 53.5801 57.3208 53.1997C74.5917 44.9155 91.8454 36.5959 109.104 28.2835C109.318 28.1802 109.543 28.0956 109.914 27.9407C109.943 28.3938 109.985 28.7555 109.985 29.1171C109.987 45.479 109.982 61.8386 110.002 78.2005C110.002 78.9472 109.828 79.3746 109.067 79.7409C91.9092 87.9759 74.7708 96.2437 57.625 104.505C57.3036 104.655 56.9675 104.779 56.4571 104.995Z"></path>
                                  <path d="M0.0819734 27.9477C0.543251 28.1426 0.911292 28.2788 1.26216 28.4479C7.06002 31.2375 12.8481 34.0482 18.6607 36.8096C19.4262 37.1736 19.7059 37.5822 19.6985 38.4087C19.6568 43.9645 19.6765 49.5202 19.6765 55.0759C19.6765 55.5033 19.6765 55.933 19.6765 56.5482C21.7645 56.5482 23.7936 56.6257 25.8154 56.52C27.0765 56.4543 27.9353 56.8511 28.799 57.7082C30.8821 59.7816 33.078 61.7494 35.3427 63.8674C35.3427 57.5391 35.3427 51.3095 35.3427 44.8967C36.3487 45.364 37.1878 45.7397 38.0147 46.1365C42.8655 48.4706 47.7089 50.814 52.567 53.1363C53.1927 53.4369 53.573 53.7234 53.573 54.5124C53.5411 71.0621 53.546 87.6119 53.5411 104.162C53.5411 104.387 53.5117 104.613 53.4822 104.998C51.3476 103.976 49.3111 103.011 47.282 102.032C31.8562 94.6 16.4377 87.1587 0.999622 79.7456C0.280715 79.4004 -0.00390273 79.0459 -0.00144913 78.2522C0.0255405 61.8198 0.0181797 45.3874 0.0206333 28.9551C0.0230869 28.6615 0.0574374 28.361 0.0819734 27.9477Z"></path>
                                  <path d="M36.9977 42.4758C41.7184 40.0572 46.2846 37.7137 50.8507 35.3773C63.131 29.0936 75.4162 22.8194 87.6842 16.5146C88.4105 16.1412 88.965 16.1248 89.6986 16.484C95.5578 19.3371 101.437 22.1478 107.308 24.975C107.595 25.1135 107.86 25.2873 108.277 25.5244C107.531 25.9001 106.906 26.2265 106.268 26.5318C89.5661 34.5789 72.8596 42.619 56.1677 50.6849C55.3653 51.0723 54.747 51.1217 53.9128 50.7107C48.6866 48.1348 43.4261 45.6223 38.1779 43.0863C37.8245 42.9149 37.4786 42.7247 36.9977 42.4758Z"></path>
                                  <path d="M1.65613 25.5056C5.03965 23.8736 8.20725 22.3426 11.3749 20.8163C25.5665 13.9785 39.7606 7.1454 53.94 0.28645C54.7129 -0.086906 55.3042 -0.100995 56.0795 0.279406C61.2763 2.8248 66.5024 5.31854 71.7163 7.83341C72.0697 8.00483 72.4083 8.20677 72.9162 8.4815C72.0868 8.9253 71.3949 9.3104 70.6883 9.67202C54.5509 17.9305 38.416 26.1889 22.264 34.4239C21.8223 34.6493 21.1083 34.8231 20.7182 34.6376C14.4198 31.6648 8.15573 28.6334 1.65613 25.5056Z"></path>
                                </g>
                              </svg>
                            </div>
                            <div class="media-body">
                              <h6>Active</h6>
                              <h4>0</h4>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="widget-card">
                          <div class="media align-self-center">
                            <div class="widget-icon bg-light-warning">
                              <svg style="width:20px;height:20px" class="fill-warning" width="98" height="98" viewBox="0 0 98 98" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.35 84H12.25V77.1167C12.25 61.5883 25.4677 49 41.7725 49C25.4677 49 12.25 36.4117 12.25 20.8833V14H7.35C3.29525 14 0 10.8617 0 7C0 3.13833 3.29525 0 7.35 0H90.65C94.7047 0 98 3.13833 98 7C98 10.8617 94.7047 14 90.65 14H85.75V20.8833C85.75 36.4117 72.5323 49 56.2275 49C72.5323 49 85.75 61.5883 85.75 77.1167V84H90.65C94.7047 84 98 87.1383 98 91C98 94.8617 94.7047 98 90.65 98H7.35C3.29525 98 0 94.8617 0 91C0 87.1383 3.29525 84 7.35 84ZM77.0893 22.6567C77.1505 22.0733 77.175 21.4783 77.175 20.8833V14H20.825V20.8833C20.825 21.4783 20.8495 22.0733 20.9108 22.6567C25.48 27.51 36.3335 30.9167 49 30.9167C61.6665 30.9167 72.52 27.51 77.0893 22.6567ZM56.2275 57.1667H41.7725C30.2207 57.1667 20.825 66.115 20.825 77.1167V77.9567C25.3575 72.9517 36.26 69.4167 49 69.4167C61.74 69.4167 72.6425 72.9517 77.175 77.9567V77.1167C77.175 66.115 67.7793 57.1667 56.2275 57.1667Z"></path>
                              </svg>
                            </div>
                            <div class="media-body">
                              <h6>Resolved</h6>
                              <h4>0</h4>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="widget-card">
                          <div class="media align-self-center">
                            <div class="widget-icon bg-light-success">
                             <i class="fa fa-list" style="color:green;font-size:18px"></i>
                            </div>
                            <div class="media-body">
                              <h6>Total</h6>
                              <h4>0</h4>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="widget-card">
                          <div class="media align-self-center">
                            <div class="widget-icon bg-light-danger">
                              <svg class="fill-danger" width="98" height="98" viewBox="0 0 98 98" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M49.1914 0C22.2778 0 0 21.895 0 48.8086C0 75.7222 22.2778 98 49.1914 98C76.105 98 98 75.7222 98 48.8086C98 21.895 76.105 0 49.1914 0ZM73.3507 64.8465C75.5902 67.086 75.5902 70.7284 73.3507 72.9698C71.1285 75.1901 67.486 75.2265 65.2274 72.9698L49.1914 56.9281L32.7707 72.9717C30.5312 75.2112 26.8888 75.2112 24.6474 72.9717C22.4079 70.7323 22.4079 67.0898 24.6474 64.8484L40.6872 48.8086L24.6474 32.7687C22.4079 30.5274 22.4079 26.8849 24.6474 24.6455C26.8888 22.406 30.5312 22.406 32.7707 24.6455L49.1914 40.6891L65.2274 24.6455C67.463 22.4098 71.1055 22.4022 73.3507 24.6455C75.5902 26.8849 75.5902 30.5274 73.3507 32.7687L57.3109 48.8086L73.3507 64.8465Z"></path>
                              </svg>
                            </div>
                            <div class="media-body">
                              <h6>Rejected</h6>
                              <h4>0</h4>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



            <!--
              <script src="http://maps.google.com/maps/api/js?key=AIzaSyDQ69wZR1GPEeLAxyu-vkSSo_dzpZTOV2c"
                      type="text/javascript"></script>

              <div id="map" style="width: 100%; height: 400px;"></div>

              <script type="text/javascript">
                var locations = [
                  ['Bangaluru', 12.925000, 77.482681, 4],
                  ['chennai', 23.259933, 77.412613, 4],
                  ['Delhi', 28.704060, 77.102493, 4],

                ];

                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 4,
                  center: new google.maps.LatLng(23.259933, 77.412613),
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                var infowindow = new google.maps.InfoWindow();

                var marker, i;

                for (i = 0; i < locations.length; i++) {
                  marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                  });

                  google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                      infowindow.setContent(locations[i][0]);
                      infowindow.open(map, marker);
                    }
                  })(marker, i));
                }
              </script>
              -->
              </div></div>
              <div class="row">
              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <div class="card-header card-no-border">
                    <div class="media media-dashboard">
                      <div class="media-body">
                        <h5 class="mb-0">Projects</h5>
                      </div>

                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                    <table class="table display" id="basic-1">
                        <thead>
                           <tr style="text-align:left;">

                            <th>Project Name</th>
                            <th>Address</th>
                            <th>Start Date</th>
                            <th style="text-align:center;">End Date</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data['projects'] as $project){

                          ?>
                          <tr style="text-align:left;">

                            <td style="padding: 10px 18px;"><?php echo $project->project_name; ?></td>
                            <td style="padding: 10px 18px;"><?php echo $project->project_address; ?></td>
                            <td style="padding: 10px 18px;"><?php echo $project->project_start_date; ?></td>
                             <td style="text-align:center; padding: 10px 18px;"><?php echo $project->project_end_date; ?></td>


                          </tr>
                        <?php } ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          <?php } else { ?>

            <div class="row">

              <div class="col-xl-12">


            <?php
            if(Session::get('rexkod_apex_user_type') == "apex"){
            $user = User::where('id',Session::get('rexkod_apex_user_id'))->first();
            if(isset($user->apex_states)){
              $states = explode(',', $user->apex_states);
            }

            $people = User::all();
            $apex_admins = 0;
            $apex_ddc = 0;
            $apex_vdc = 0;
            $apex_tdc = 0;

          if(isset($states)){
            foreach($states as $state){
              $apex_body = Apex_bodie::where('state_id',$state->id)->first();
              foreach($people as $person){
                $they = User::where('id',$person->id)->first();
                if($person->type == "administrator" && $they->apex_body_id == $user->apex_body_id){
                  $apex_admins++;
                }
                else if($person->type == "ddc" && $they->apex_body_id == $user->apex_body_id){
                  $apex_ddc++;
                }else if($person->type == "vdc" && $they->apex_body_id == $user->apex_body_id){
                  $apex_vdc++;
                }else if($person->type == "tdc" && $they->apex_body_id == $user->apex_body_id){
                  $apex_tdc++;
                }
              }
            }
          }
            ?>

              <div class="row">
              <div class="col-md-12">
                <div class="cad sales-state">
                  <div class="row m-0">
                  <div class="col-md-3">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Apex Admins</h6>
                        <h4 class="mb-0 counter"><?php echo $apex_admins;?></h4>
                      </div>
                      <svg class="fill-primary" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                        <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                        <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                      </svg>
                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">DDC</h6>
                        <h4 class="mb-0 counter"><?php echo $data['all_ddc'];?></h4>
                      </div>
                      <svg class="fill-success" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                        <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                        <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                      </svg>

                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-success" role="progressbar" style="width: 60%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">VDC</h6>
                        <h4 class="mb-0 counter"><?php echo $data['all_vdc'];?></h4>
                      </div>
                      <svg class="fill-warning" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                        <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                        <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                      </svg>

                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-primary" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">TDC</h6>
                        <h4 class="mb-0 counter"><?php echo $data['all_tdc'];?></h4>
                      </div>
                      <svg class="fill-danger" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                        <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                        <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                      </svg>
                    </div>
                    <div class="progress-widget">
                      <div class="progress sm-progress-bar progress-animate">
                        <div class="progress-gradient-danger" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                  </div>
                </div>



              </div>




            </div>
            <?php } else {

            $user = User::where('id',Session::get('rexkod_apex_user_id'))->first();
           if(isset($user->apex_body_id)){
            $apex_body =  Apex_bodie::where('id',$user->apex_body_id)->first();
           }


            if(isset($apex_body->state_id)){
            $state =  State::where('id',$apex_body->state_id)->first();
            }

            $trustees = User::where('type','trustee')->get();

            foreach($trustees as $trustee){
              $cur =  User::where('id',$trustee->id)->first();

              $states = explode(',', $cur->trustee_states);
                if(isset($state->id)){
                  if(in_array($state->id,$states)){
                    break;
                  }
                }
            }

              ?>
              {{-- <div class="col-xl-12 xl-100 box-col-12" style="padding:10px">
                <div class="widget-joins card">

                  <div class="card-body">
                           <!-- <h6 style="color:#666">Tickets</h6> -->
                    <div class="row gy-4">
                      <div class="col-sm-4">
                        <div class="widget-card">
                          <div class="media align-self-center">
                            <div class="widget-icon bg-light-primary">

                            </div>
                            <div class="media-body">
                              <h6>Trustee</h6>
                              <h4><?php if(isset($trustee)){ echo $trustee->name;} ?></h4>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="widget-card">
                          <div class="media align-self-center">
                            <div class="widget-icon bg-light-warning">

                            </div>
                            <div class="media-body">
                              <h6>Apex</h6>
                              <h4><?php if(isset($state->name)){echo $state->name;} ?></h4>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="widget-card">
                          <div class="media align-self-center">
                            <div class="widget-icon bg-light-success">

                            </div>
                            <div class="media-body">
                              <h6>Apex Body</h6>
                              <h4><?php if(isset($apex_body->name)){echo $apex_body->name;} ?></h4>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div> --}}
{{-- =========================================== SOMS ================================================ --}}
              <div class="row">
                <div class="col-md-12">
                  <div class="cad sales-state">
                    <div class="row m-0">
                        @if (Session::get('rexkod_apex_user_type') === 'administrator')


                    <div class="col-md-3">
                  <div class="card o-hidden">
                    <div class="card-body">
                      <div class="media static-widget">
                        <div class="media-body">
                          <h6 class="font-roboto">Administrator</h6>
                          <h4 class="mb-0 counter"><?php echo $data['all_apex'];?></h4>
                        </div>
                        <svg class="fill-primary" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                          <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                          <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                          <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                        </svg>
                      </div>
                      <div class="progress-widget">
                        <div class="progress sm-progress-bar progress-animate">
                          <div class="progress-gradient-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif

                @if (Session::get('rexkod_apex_user_type') === 'ddc')

                <div class="col-md-3">
                  <div class="card o-hidden">
                    <div class="card-body">
                      <div class="media static-widget">
                        <div class="media-body">
                          <h6 class="font-roboto">DDC</h6>
                          <h4 class="mb-0 counter"><?php echo $data['all_ddc'];?></h4>
                        </div>
                        <svg class="fill-success" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                          <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                          <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                          <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                        </svg>

                      </div>
                      <div class="progress-widget">
                        <div class="progress sm-progress-bar progress-animate">
                          <div class="progress-gradient-success" role="progressbar" style="width: 60%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @endif



                @if (Session::get('rexkod_apex_user_type') === 'tdc')

                <div class="col-md-3">
                  <div class="card o-hidden">
                    <div class="card-body">
                      <div class="media static-widget">
                        <div class="media-body">
                          <h6 class="font-roboto">TDC</h6>
                          <h4 class="mb-0 counter"><?php echo $data['all_tdc'];?></h4>
                        </div>
                        <svg class="fill-danger" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                          <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                          <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                          <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                        </svg>
                      </div>
                      <div class="progress-widget">
                        <div class="progress sm-progress-bar progress-animate">
                          <div class="progress-gradient-danger" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @if (Session::get('rexkod_apex_user_type') === 'vdc')

                <div class="col-md-3">
                  <div class="card o-hidden">
                    <div class="card-body">
                      <div class="media static-widget">
                        <div class="media-body">
                          <h6 class="font-roboto">VDC</h6>
                          <h4 class="mb-0 counter"><?php echo $data['all_vdc'];?></h4>
                        </div>
                        <svg class="fill-warning" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                          <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                          <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                          <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                        </svg>

                      </div>
                      <div class="progress-widget">
                        <div class="progress sm-progress-bar progress-animate">
                          <div class="progress-gradient-primary" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif

                    </div>
                  </div>

                </div>


                <div class="col-xl-12">



                </div></div>
            <?php } ?>

{{-- =========================================== SOMS ================================================ --}}



            <!--
              <script src="http://maps.google.com/maps/api/js?key=AIzaSyDQ69wZR1GPEeLAxyu-vkSSo_dzpZTOV2c"
                      type="text/javascript"></script>

              <div id="map" style="width: 100%; height: 400px;"></div>

              <script type="text/javascript">
                var locations = [
                  ['Bangaluru', 12.925000, 77.482681, 4],
                  ['chennai', 23.259933, 77.412613, 4],
                  ['Delhi', 28.704060, 77.102493, 4],

                ];

                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 4,
                  center: new google.maps.LatLng(23.259933, 77.412613),
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                var infowindow = new google.maps.InfoWindow();

                var marker, i;

                for (i = 0; i < locations.length; i++) {
                  marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                  });

                  google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                      infowindow.setContent(locations[i][0]);
                      infowindow.open(map, marker);
                    }
                  })(marker, i));
                }
              </script>
              -->
              </div></div>
              <div class="row">
              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <div class="card-header card-no-border">
                    <div class="media media-dashboard">
                      <div class="media-body">
                        <h5 class="mb-0">Requests</h5>
                      </div>

                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>Request ID</th>
                            <th>Requested By</th>
                            <th>Document Type</th>
                            <th>Request Remark</th>
                            <th>Document</th>
                            <th>Response Remark</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data['requests'] as $request){
                          $status = $request->status;
                          $user= User::where('id',$request->request_user_id)->first();

                          $document =Document::where('id',$request->document_type)->first();
                          ?>
                          <tr>
                            <td><?php echo $request->id; ?></td>
                            <td><?php echo $user->name; ?></td>
                            <td><?php echo $document->name; ?></td>
                            <td><?php echo $request->request_remark; ?></td>
                            <td><?php
                             if($request->document && $status == "3"){
                              echo "<a href='{{url('storage/'.$request->document)}}' target='_BLANK'>View</a>";
                            }else if(Session::get('rexkod_apex_user_type') == "hq"){
                              echo "<a href='/send_document/$request->id'>Send Response</a>";
                            } else {echo "Pending"; }
                             ?></td>
                            <td><?php echo $request->response_remark; ?></td>

                          </tr>
                        <?php } ?>

                        </tbody>
                      </table>

                  </div>
                  </div>
                </div>
              </div>

            </div>

          <?php } ?>
          </div>
          <?php }
          else { ?>

            <div class="row">
              <div class="col-md-12">
                <div class="card sales-state">
                  <div class="row m-0">
                    <div class="col-12 p-0">
                      <div class="card bg-primary">
                        <div class="card-header card-no-border bg-primary">
                          <div class="media media-dashboard">
                            <div class="media-body">
                              <h5 class="mb-0 text-light">Account Inactive</h5>
                            </div>

                          </div>
                        </div>
                        <div class="card-body p-0">
                          <div id="saes-state-chart"></div>
                        </div>
                      </div><p>. Your account is not active. Please contact AOL HQ for account activation.</p>
                    </div>

                  </div>
                </div>
              </div>
          </div>
          <?php } ?>
          <!-- Container-fluid Ends-->
        </div>

        {{-- === --}}
        <?php }
        else {  ?>



<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>
             Welcome,
             @if(null!==(Session::get('rexkod_apex_user_name')))
                 {{Session::get('rexkod_apex_user_name')}}
             @endif
             </h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="home-item" href="index"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>

          </ol>
        </div>
      </div>
    </div>
  </div>

         <div class="row">
          <div class="col-md-12">
            <div class="card sales-state">
              <div class="row m-0">
                <div class="col-12 p-0">
                  <div class="card bg-primary">
                    <div class="card-header card-no-border bg-primary">
                      <div class="media media-dashboard">
                        <div class="media-body">
                          <h5 class="mb-0 text-light">Account Inactive</h5>
                        </div>

                      </div>
                    </div>
                    <div class="card-body p-0">
                      <div id="saes-state-chart"></div>
                    </div>
                  </div><p>. Your account is not active. Please contact AOL HQ for account activation.</p>
                </div>

              </div>
            </div>
          </div>
      </div>
</div>
      <?php } ?>

        @include('inc.footer')



        <script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>

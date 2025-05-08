<?php namespace App\Http\Controllers;
use App\Models\User;
?>
@include("inc.header")
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Notifications</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">
                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Notifications</li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">

              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-request recent-orders">
                  <br>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                          <tr>
                          <th>ID</th>
                          <th>To</th>
                            <th>Notification</th>
                            <th>Notification Document</th>
                            <th>Datetime</th>
                          </tr>
                        </thead>
                        <tbody>
                          <<?php 
                          foreach($data['notifications'] as $notification) {
                            $user = User::where('id', $notification->to_id)->first();
                            if(isset($user)) {
                              $modalId = 'notification-modal-' . $notification->id;
                          ?>
                          <tr>
                            <td><?php echo $notification->id; ?></td>
                            <td><?php echo $user->name; ?></td> 
                            <td>
                              <?php echo substr($notification->notification, 0, 10); ?>
                              <?php if(strlen($notification->notification) > 10) { ?>
                              <a type="button" class="text-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>" data-notification="<?php echo $notification->notification; ?>">
                                read more
                              </a>
                              <?php } ?>
                            </td>
                            @if (!empty($notification->document))
                            <td><a href="/uploads/<?php echo $notification->document;?>" target="_blank"><i class="fa fa-eye"></i></a></td>
                            @else
                            <td></td>
                            @endif
                            <td><?php echo date('M jS Y - h:m A', strtotime($notification->datetime)); ?></td>
                          </tr>
                          
                          <!-- Modal -->
                          <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="<?php echo $modalId; ?>-label" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="<?php echo $modalId; ?>-label">Notification</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <?php echo $notification->notification; ?>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <?php 
                            }
                          }
                          ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
{{-- ============================= modal ================================ --}}



        @include("inc.footer")

<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/datatable/datatables/datatable.custom.js"></script>




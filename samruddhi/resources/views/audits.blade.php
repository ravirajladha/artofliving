@include('inc.header')


<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Audits</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item active"> Audits</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts         -->
  <div class="container-fluid card">
    <div class="row card-body">

      <div class="col-xl-12 xl-100 box-col-7">
        <div class="row">

          <table class="table table-striped" id="basic-1">
            <thead>
              <tr>
                <th> <span>ID</span></th>
                <th> <span>Auditor Id</span></th>
                <th> <span>Start Date</span></th>
                <th> <span>End Date</span></th>
                <th> <span>Location</span></th>
                <th> <span>Status</span></th>
               
              </tr>
            </thead>
            <tbody>
              <?php
             // foreach ($data['audits'] as $audit) {

              ?>


                <tr>
                  <td>
                    <?php //echo $audit->id ?>
                  </td>
                  <td class="img-content-box">
                    <?php //$get_user = $pageMod->get_user($audit->auditor_id) ?>
                    <h6><?php //echo ucwords($get_user->name); ?></h6>
                  </td>
                  <td>
                  <h6><?php //echo date("d-m-Y", strtotime($audit->start_date));  ?></h6>
                  </td>
                  <td>
                  <h6><?php// echo date("d-m-Y", strtotime($audit->end_date));  ?></h6>
                  
                  </td>
<td>  <h6><?php 
//$get_location = $pageMod->get_location($audit->location_id);
//echo ucwords($get_location->name);?></h6></td>
                  <td>
                    <?php// if ($audit->status == "0") { ?>
                      <h6 class="font-roboto"><a href="/pages/change_audit_status/<?php //echo $audit->id;?>"><button class="btn btn-xs btn-success" style="padding:2px;font-size:11px">Start</button></a></h6>
                    <?php //} elseif (($audit->status == "1") ||  ($audit->status == "2")){ ?>
                      <h6 class="font-roboto"><a href="/pages/pending_audits/<?php //echo $audit->id;?>"><button class="btn btn-xs btn-info" style="padding:2px;font-size:11px">Pending</button></a>
                     <a href="/pages/processing_audits/<?php //echo $audit->id;?>"><button class="btn btn-xs btn-primary" style="padding:2px;font-size:11px">Processing</button></a></h6>
                    <?php //}  ?>

                  </td>


                </tr>




              <?php// }  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>

@include('inc.footer')



<script>
  $('input[type="checkbox"]').on('change', function() {
    $('input[type="checkbox"]').not(this).prop('checked', false);
  });
</script>










<div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Asset</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="" action="/pages/assign_asset" method="POST">
          <div class="row g-2">

            <div class="col-md-12">
              <label for="exampleInputname1">Select User</label>
              <select name="user_id" class="form-select">
                <?php //foreach ($data['users'] as $user) { ?>
                  <option value="<?php// echo $user->id; ?>"><?php //echo $user->name; ?></option>
                <?php //} ?>
              </select>
            </div>

          </div>

          <div class="col-md-12 mt-0 m-b-20">
            <label for="con-mail">Enter Remark</label>
            <input name="remark" class="form-control" id="con-mail" type="text" required="" autocomplete="off">
          </div>
          <div class="col-md-12 mt-0 m-b-20" style="display:none">
            <label for="con-mail">Enter Remark</label>
            <input class="form-control" id="asset_id_val" name="asset_id" type="text" autocomplete="off">
          </div>

      </div>
      <input id="index_var" type="hidden" value="5">
      <button class="btn btn-secondary">Assign</button>

      </form>
    </div>
  </div>
</div>
</div>



<script>
  function assign_asset(id) {

    $('#asset_id_val').val(id);
  }
</script>



<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/datatable/datatables/datatable.custom.js"></script>
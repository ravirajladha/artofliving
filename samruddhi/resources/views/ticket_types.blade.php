@include('inc.header')



<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Ticket Types</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                  <li class="breadcrumb-item "> <a  href="/datasets">Datasets</a></li>
                  <li class="breadcrumb-item active"> <a  href="#">Ticket Types</a></li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->





          <div class="container-fluid general-widget">



          <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form projectcreate">
                    <form action="/create_ticket_types" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label>Ticket Type</label>
                            <input class="form-control" type="text" name="ticket_type" placeholder="Enter Ticket Type *" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="text-end">
                            <a href="/datasets" class="btn btn-secondary me-3">Cancel</a><button type="submit" class="btn btn-secondary me-3">Add</button></div>
                            
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            <div class="row">


              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <div class="card-header card-no-border">
                    <div class="media media-dashboard">
                      <div class="media-body">
                        <h5 class="mb-0">All Ticket Types</h5>
                      </div>

                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                      {{-- <table class="table table-bordernone"> --}}
                        <table class="table table-bordernone" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                        <thead>
                          <tr>
                            <th> <span>ID</span></th>
                            <th> <span>Name</span></th>
                            <th> <span>Action</span></th>
                            <th> <span>Status</span></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data['ticket_types'] as $ticket){?>
                          <tr>
                            <td> <h6><?php echo $ticket->id; ?></h6> </td>
                            <td> <h6><?php echo $ticket->name; ?></h6> </td>
                            <td>
                            <h6>
                              <button title="Edit" class="btn btn-xs btn-info"
                                            data-bs-toggle="modal" onclick="ticket_update(<?php echo $ticket->id; ?>,'<?php echo $ticket->name; ?>')"
                                            data-bs-target="#exampleModal"style="font-size:12px;padding:2px 5px">
                                            <i class='fa fa-pencil'></i></button>

                                            {{-- <a href="/delete_ticket/<?php echo $ticket->id; ?>">
                            <button style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-danger">
                            <i class='fa fa-trash'></i></button></a> --}}
                          </h6>
                            </td>

                            <td>
                              <?php if ($ticket->active_status == 0) { ?>
                              <a href="/change_status_ticket/<?php echo $ticket->id; ?>/1">
                                  <span style="font-size:10px" >

                                      <button style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-warning">Deactivate</button>
                                  </span>
                              </a>
                              <?php } else { ?>
                              <a href="/change_status_ticket/<?php echo $ticket->id; ?>/0">
                                  <span style="font-size:10px" >

                                      <button style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-warning">Activate</button>
                                  </span>
                              </a>
                              <?php } ?>

                          

                          </td>

                          </tr>
                       <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- Container-fluid Ends-->

          <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Ticket</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="" action="/update_ticket" method="POST">
                    @csrf


                    <div class="col-md-12 mt-0 m-b-20">
                    <label>Ticket Name</label>
                            <input class="form-control" type="text" name="name" id="ticket_name_val" placeholder="Enter Ticket Name">
                            <input class="form-control" name="id"  id="ticket_id_val" type="hidden" placeholder="Value *" readonly>
                    </div>


            </div>
            <!-- <input id="index_var" type="hidden" value="5"> -->
            <button class="btn btn-secondary">Update</button>

            </form>
        </div>
    </div>
</div>

        </div>

        <script>
function ticket_update(id, name) {

    $('#ticket_id_val').val(id);
    $('#ticket_name_val').val(name);
    // document.getElementById('category_id_val').value = id;
    // document.getElementById('category_name_val').value = name;
}

</script>
@include('inc.footer')


{{-- =================================== import and export table data =================================== --}}
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/1.12.1/css/dataTables.responsive.css">
<script type="text/javascript" src="//cdn.datatables.net/responsive/1.12.1/js/dataTables.responsive.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">


<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
{{-- =================================== import and export table data =================================== --}}

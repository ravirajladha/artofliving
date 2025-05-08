@include('inc.header')
<?php $priviliges = session('rexkod_apex_user_priviliges');
$user_priviliges = explode(',',$priviliges);  ?>

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Locations</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">All Locations</a></li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">


            <div class="container-fluid card">
            <div class="row card-body">
                    {{-- <table class="display table table-bordernone" id="basic-1"> --}}
                        <table class="table table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Location Name</th>
                            <th>Address</th>
                            <th>Lat Lon</th>
                            <?php if(in_array(7, $user_priviliges)) {?>

                            <th>Action</th>
                        <?php } ?>

                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data['locations'] as $location){

                          ?>
                          <tr>
                            <td><?php echo $location->id; ?></td>
                            <td><?php echo $location->type; ?></td>
                            <td><?php echo $location->name; ?></td>
                            <td><?php echo $location->address; ?></td>
                            <td><?php echo $location->latlon; ?></td>

                            <?php if(in_array(7, $user_priviliges)) {?>
                            <td><a href="/edit_location/<?php echo $location->id; ?>"><button title="Edit" style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-info"><i class='fa fa-pencil'></i></button></a></td>
                            <?php } ?>


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
        </div>


        @include('inc.footer')


<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>


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

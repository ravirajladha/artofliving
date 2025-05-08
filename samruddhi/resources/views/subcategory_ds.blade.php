<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Assets;
use App\Models\Notifications;
?>
@include('inc.header')

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">

<style>
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    border: none;
    margin-top: 5px !important;
}

.table table-bordernone {
 
  overflow-y: auto;
}
</style>


<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Subcategory</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                  <li class="breadcrumb-item "> <a  href="/datasets">Datasets</a></li>
                  <li class="breadcrumb-item active"> <a  href="#">Subcategory</a></li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->





          <div class="container-fluid general-widget">



          <div class="col-sm-12">
                <div class="card">
                <div class="card-body"><h5 style="font-weight:bold;font-size:16px">Add Sub-Category</h5><hr>
                    <div class="form theme-form projectcreate">
                    <form action="/create_subcategory" method="POST">
                      @csrf
                      <div class="row">
​
                      <div class="col-md-6">
                          <div class="mb-3">
                            <label>Select Category</label>
                            <select class="form-select" name="category_id">
                            <?php foreach($data['category'] as $category){?>
                            <option value="<?php echo $category->id;?>"><?php echo $category->name; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>
​

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Sub-Category Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Sub Category Name *" required>
                          </div>
                        </div>

							          </div>
                        <div class="row">
                                    <div class="col">
                                    <div class="mb-3">
                                    <label for="exampleInutname1">Assign Fields</label>
                                    <select name="fields[]" multiple class="js-example-placeholder-multiple col-sm-12" style="height:200px !important">
                                    <?php foreach($data['fields'] as $field){
                                     if($field->COLUMN_NAME != "id" && $field->COLUMN_NAME != "type" && $field->COLUMN_NAME != "category_id" && $field->COLUMN_NAME != "subcategory_id" && $field->COLUMN_NAME != "image" && $field->COLUMN_NAME != "user_id" && $field->COLUMN_NAME != "owner_id" && $field->COLUMN_NAME != "temp_id" && $field->COLUMN_NAME != "datetime" && $field->COLUMN_NAME != "code" && $field->COLUMN_NAME != "code" && $field->COLUMN_NAME != "name" && $field->COLUMN_NAME != "qr"){
                                    ?>
                                    <option selected value="<?php echo $field->COLUMN_NAME;?>"><?php echo $field->COLUMN_NAME; ?></option>
                                    <?php }} ?>
                                    </select>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col">
                                    <div class="mb-3">
                                    <label for="">Assign Compliances</label>
                                    <select name="compliances[]" multiple class="js-example-placeholder-multiple col-sm-12" >
                                    <?php foreach($data['compliances'] as $compliance){?>
                                    <option value="<?php echo $compliance->id;?>"><?php echo $compliance->name; ?></option>
                                    <?php } ?>
                                    </select>
                                      </div>
                                    </div>

                                  </div>
                        <div class="col-md-12"> 
                                      <div class="mb-3" style="text-align:right">
                                      <label><span style="color:#fff">.</span></label>
                                      <a href="/datasets" class="btn btn-secondary me-3">Cancel</a>
                          <button type="submit" class="btn btn-secondary me-3">Add</button>
                                      </div>
                                    </div>


            ​
​
                    </form>
                    </div>
                  </div>
                </div>



            <div class="row">


              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <div class="card-header card-no-border">
                    <div class="media media-dashboard">
                      <div class="media-body">
                        <h5 class="mb-0">All Subcategories</h5>
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
                            <th> <span>Subcategory Name</span></th>
                            <th> <span>Category</span></th>
                            {{-- <th style="width: 100px !important"> <span>Fields</span></th> --}}
                            <th> <span>Action</span></th>
                            <th> <span>Status</span></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data['subcategory'] as $subcategory){
                              $category= Category::where('id',$subcategory->category_id)->first();
                          
                          ?>
                          <tr>
                            <td> <h6><?php echo $subcategory->id; ?></h6> </td>
                            <td> <h6><?php echo $subcategory->name; ?></h6> </td>
                            <td> <h6><?php echo $category->name; ?></h6> </td> 
                            {{-- <td style="width: 100px !important"> <h6><?php //echo $subcategory->fields; ?></h6> </td> --}}
                            <td> <h6>
                              {{-- <button title="Edit" class="btn btn-xs btn-info"
                                            data-bs-toggle="modal" onclick="subcategory_update(<?php echo $subcategory->id; ?>,'<?php echo $subcategory->name; ?>','<?php echo json_encode($category->fields)?>')"
                                            data-bs-target="#exampleModal" style="font-size:12px;padding:2px 5px">
                                            <i class='fa fa-pencil'></i></button> --}}

                              <a title="Edit" href="/edit_subcategory_ds/<?php echo $subcategory->id;  ?>">
                            <button style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-info">
                            <i class='fa fa-pencil'></i></button></a>


                                            {{-- <a href="/delete_subcategory/<?php echo $subcategory->id; ?>">
                            <button style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-danger">
                            <i class='fa fa-trash'></i></button></a> --}}
                          </h6></td>

                          <td>
                            <?php if ($subcategory->active_status == 0) { ?>
                            <a href="/change_status_subcat/<?php echo $subcategory->id; ?>/1">
                                <span style="font-size:10px" >

                                    <button style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-warning">Deactivate</button>
                                </span>
                            </a>
                            <?php } else { ?>
                            <a href="/change_status_subcat/<?php echo $subcategory->id; ?>/0">
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Subcategory</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="" action="/update_subcategory" method="POST">
                    @csrf


                    <div class="col-md-12 mt-0 m-b-20">
                    <label>Subcategory Name</label>
                            <input class="form-control" type="text" name="name" id="subcategory_name_val" placeholder="Enter Category Name">
                            <input class="form-control" name="id"  id="subcategory_id_val" type="hidden" placeholder="Value *" readonly>  <br>
                            <label>Fields</label>
                            <input class="form-control" name="subcategory_fields_val"  id="subcategory_fields_val" type="text" placeholder="Value *" >
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
function subcategory_update(id, name, fields) {

    $('#subcategory_id_val').val(id);
    $('#subcategory_name_val').val(name);
    $('#subcategory_fields_val').val(fields);
    fields = JSON.parse(fields);
    for (var i = 0; i < fields.length; i++) {
      document.getElementById('field_' + i).value = fields[i];
    }

}

</script>

@include('inc.footer')

<script src="/assets/js/select2/select2.full.min.js"></script>
    <script src="/assets/js/select2/select2-custom.js"></script>

​

    <script>
       $(".tenure2").hide();



          function valueChanged()
          {
              if($('#tenure1_check').is(":checked"))
                  $(".tenure2").show();
              else
                  $(".tenure2").hide();
          }

    </script>


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

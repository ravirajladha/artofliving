@include("inc_sanidhya.header")

<style>
  .swal2-popup {
  font-size: 10px !important;
  width:300px;
}
</style>

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>All Volunteers</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">                                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Users</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <?php
          $url =  "{$_SERVER['REQUEST_URI']}";
          $url = explode('/', $url);
          ?>
          <div class="container-fluid card">
            <div class="row card-body">
             

<table class="display table table-bordernone" id="basic-1">
                        <thead>
                          <tr>
                            <th>ID</th>
                          <th>User Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Event</th>
                            
                          </tr>
                         </thead>
                          <tbody>
                          <?php foreach($data['users'] as $user): 
              if($user->status=="1"){$status="Active";}else if($user->status=="2"){$status="Inactive";} else {$status="On Hold";}
              //$event = $pageMod->event($user->event_id);
              $event = App\Models\Events::where('id', $user->event_id)->first();
              ?>
                  
                 
                
                
                
                      
                          <tr>
                          <td><?php echo $user->id; ?></td>
                          <td>
                            <img width="20" class="rounded-circle" src="/assets/user.webp" alt=""> 
                            <?php echo $user->name; ?>
                          </td>
                          <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->phone; ?></td>
                            <td>Vigyan BHairav 2</td>
                            
                          </tr>

                          <?php endforeach; ?>

                                    
                                    
                          </tbody>
                  </table>


             

            
            </div>
          </div>
        </div>
        @include("inc_sanidhya.footer")


   
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(!empty(session()->get('success'))) { ?>
 <script type="text/javascript">
 Swal.fire({
  icon: 'success',
  title: '{{ session()->get('success') }}',
  showConfirmButton: false,
  timer: 2000,
  
})
 </script>
<?php } session()->forget('success'); ?>
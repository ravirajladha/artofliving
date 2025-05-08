@include('inc.header')


     
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Properties</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/pages/index">                                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Properties</li>
                  
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
                    <form action="/pages/create_document" method="POST" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Property Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Property Name *" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Document Type</label>
                            <select class="form-select" name="type">
                            <?php foreach($data['document_types'] as $document_type){?>
                            <option value="<?php echo $document_type->id;?>"><?php echo $document_type->name; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Upload Document</label>
                            <input class="form-control" type="file" name="file" placeholder="Enter  ">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Document URL</label>
                            <input class="form-control" type="text" name="url" placeholder="Enter URL">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="text-end"><button type="submit" class="btn btn-secondary me-3">Add</button></div>
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
                        <h5 class="mb-0">All Document</h5>
                      </div>
                   
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                      <table class="table table-bordernone">
                        <thead> 
                          <tr> 
                            <th> <span>ID</span></th>
                            <th> <span>Name</span></th>
                            <th> <span>Category</span></th>
                            <th> <span>File</span></th>
                            <th> <span>Action</span></th>
                          </tr>
                        </thead>
                        <tbody> 
                        <?php foreach($data['documents'] as $document){
                        $type = $pageMod->get_document_type($document->type);
                        ?>
                          <tr>
                            <td> <h6><?php echo $document->id; ?></h6> </td>
                            <td> <h6><?php echo $document->name; ?></h6> </td>
                            <td> <h6><?php echo $type->name; ?></h6> </td>
                            <td>
                                <?php if($document->file){ 
                                  ?>
                                <h6><a href="/uploads/<?php echo $document->file; ?>" target="_BLANK">View File</a><br></h6> 
                                <?php } ?>
                                <?php  if($document->url){?>
                                <h6><a href="<?php echo $document->url; ?>" target="_BLANK">Visit URL</a></h6> 
                                <?php } ?>
                            </td>
                            <td> </td>
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

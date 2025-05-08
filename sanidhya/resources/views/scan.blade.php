@include("inc_sanidhya.header")

<link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
 <style>

    .swal2-popup {
    font-size: 10px !important;
    width:300px;
    }

    #html5-qrcode-anchor-scan-type-change{
        display: none !important;
    }
    #html5-qrcode-button-camera-start{
    background-color: #555;
    border-color: #fff;
    position: relative;
    z-index: 9;
    overflow: hidden;
    color:#fff;
    text-transform: uppercase;
  padding: 10px 20px;
  color: white;
  cursor: pointer;
  border-radius: 100px;
    }

    #html5-qrcode-button-camera-stop {
        background-color: #555;
    border-color: #fff;
    position: relative;
    z-index: 9;
    overflow: hidden;
    color:#fff;
    text-transform: uppercase;
  padding: 10px 20px;
  color: white;
  cursor: pointer;
  border-radius: 100px;
    }
    </style>    
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                        <div class="col-12 col-sm-6">
                        <h3>QR</h3>
                        </div>
                        <div class="col-12 col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">                                       
                            <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">QR Read</li>
                        
                        </ol>
                        </div>
                </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget card">
            <div class="row card-body">

                <div id="reader" style="width:600px"></div>
                <div id="result"></div>

            </div>
          </div>

          <div class="container-fluid general-widget card">
            <div class="row card-body">

                
                <div class="row">
                    <div class="col-9">
                            <input type="number" id="pass_val" class="form-control" placeholder="Enter Pass ID">
                    </div>
                    <div class="col-3">
                       <button class="btn btn-success" onclick="pass_verify()" >Submit</button>
                </div>
                </div>
                
            </div>
          </div>

</div>
      

@include("inc_sanidhya.footer")

<script>
    function pass_verify(){
    var val = document.getElementById("pass_val").value;
    window.location = "/verify/"+val;
}
</script>

<script src="assets/js/qr.js"></script>
<script>
var scanned = "not";
const scanner = new Html5QrcodeScanner('reader', {
qrbox: {
width: 250,
height: 250,
},
fps: 20,
});
scanner.render(success, error);
function success(result) {
  if(scanned == "not"){
  window.location = "verify/"+result;
  scanned = "done";
  }
}
function error(err) {
console.error(err);
}


</script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(!empty(session()->get('success'))) { ?>
 <script type="text/javascript">
 Swal.fire({
  icon: 'success',
  title: '{{ session()->get('success') }}',
  html: '<span style="font-size:15px">{{ session()->get('success2') }}<br><br>{{ session()->get('success3') }}</span>',
  confirmButtonText: 'Next',
  showConfirmButton: true,
  timer: 10000,
  
})
 </script>
<?php } session()->forget('success'); session()->forget('success2'); session()->forget('success3'); ?>


<?php if(!empty(session()->get('failed'))) { ?>
  <script type="text/javascript">
  Swal.fire({
   icon: 'warning',
   title: '{{ session()->get('failed') }}',
   showConfirmButton: false,
   timer: 2000
 })
  </script>
 <?php } session()->forget('failed'); ?>


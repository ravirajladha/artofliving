@include("inc_sanidhya.header")

<link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
 <style>
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
                        <h3>Verify</h3>
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
              <div class="col-12">Name: <b>{{$data['user']->first_name." ".$data['user']->last_name}}</b></div>

              <div class="col-12">Email: <b>{{$data['user']->email}}</b></div>
           
              <div class="col-12">Phone: <b>{{$data['user']->phone}}</b><hr></div>

              <?php if(isset($data['user']->category)){ $category = $data['user']->category; } ?>
              <div class="col-12">Category: <b>{{$category}}</b></div>
              <?php if(isset($data['user']->seat_number)){ $seat_number = $data['user']->seat_number; } ?>
              <div class="col-12">Seat: <b>{{$seat_number}}</b><hr></div>
         
            </div><div class="row">

              <div class="col-3"></div>

              <div class="col-4"><a href="/verified/{{$data['pass']->id}}"><button class="btn-sm btn btn-success">Verify</button></a></div>
              <div class="col-4"><a href="/scan"><button class="btn-sm btn btn-warning">Reject</button></a></div>
           
          
            </div>
            <br>
          </div>

          

</div>
      

@include("inc_sanidhya.footer")


<script src="assets/js/qr.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
const scanner = new Html5QrcodeScanner('reader', {
qrbox: {
width: 250,
height: 250,
},
fps: 20,
});
scanner.render(success, error);
function success(result) {
document.getElementById('result').innerHTML = `
<h2>Success!</h2>
<p><a href="${result}">${result}</a></p>
`;
scanner.clear();
document.getElementById('reader').remove();
}
function error(err) {
console.error(err);
}
</script>
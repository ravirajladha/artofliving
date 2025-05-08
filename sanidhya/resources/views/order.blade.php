<!DOCTYPE html>
<html lang="en">
<?php

// Get the order_id from the URL parameters
$order_id = $_GET['order_id'] ?? '';
// Your other code here...
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <form method="POST" action="{{ route('fetch-order') }}" id="fetch-form">
        @csrf
        <input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id; ?>" required>
        </form>
    @if(isset($orderData))
    <center>
<div class="container py-5">
<div class="card" style="width: 50%;">
  <div class="card-header">
   <img src="/assets/images/artofliving.png" alt="" style="width: 200px; height: 100px;" class="img-responsive">
  </div>
  <div class="card-body">
    <p class="text">Transaction Status : {{ $orderData['status'] }}</p>
    <p class="text">Transaction Id : {{ $orderData['order_id'] }}</p>
    <p class="text">Transaction Amount : {{ $orderData['amount'] }}</p>
     <p>{{ $orderData['date_created'] }}</p>
     <a href="/index">
<button class="btn btn btn-success">Back To Event</button></a></div>
</div>
    @elseif(isset($error))
    <p>{{ $error }}</p>
    @endif
    </div>
    @if(isset($orderData))
    <form method="post" action="{{ route('save-payment') }}" id="data-form">
    @csrf
    <input type="hidden" name="email" value="{{ $orderData['customer_email'] }}" >
    <input type="hidden" name="amount" value="{{ $orderData['amount'] }}">
    <input type="hidden" name="phone" value="{{ $orderData['customer_phone'] }}">
    <input type="hidden" name="status_id" value="{{ $orderData['status_id'] }}">
    <input type="hidden" name="merchant_id" value=" {{ $orderData['merchant_id'] }}">
    <input type="hidden" name="currency" value="{{ $orderData['currency'] }}">
    <input type="hidden" name="status" value="{{ $orderData['status'] }}">
    <input type="hidden" name="order_id" value="{{ $orderData['order_id'] }}">
    <input type="hidden" name="payment_method_type" value="{{ $orderData['payment_method_type'] }}">
    <input type="hidden" name="date_created" value="{{ $orderData['date_created'] }}">
    <input type="hidden" name="category" value="{{ $orderData['udf1'] }}">
    <input type="hidden" name="multiples" value="{{ $orderData['udf2'] }}">
    <input type="hidden" name="seat_number" value=" {{ $orderData['udf3'] }}">
    <input type="hidden" name="payment_mode" value="{{ $orderData['udf4'] }}">
    <input type="hidden" name="event_id" value="{{ $orderData['udf5'] }}" >
    <input type="hidden" name="gender" value="{{ $orderData['udf6'] }}">
    <input type="hidden" name="event_name" value="{{ $orderData['udf7'] }}">
    <input type="hidden" name="first_name" value="{{ $orderData['udf8'] }}">
    <input type="hidden" name="last_name" value="{{ $orderData['udf9'] }}">
    <input type="hidden" name="user_id" value="{{ $orderData['udf10'] }}">
    <input type="hidden" name="transaction_status" value="{{ $orderData['status'] }}">
   
    <button type="button" class="btn btn-info" onclick="window.print()" >Print</button> </center> 

    <!-- <button type="submit" class="btn btn-info"   >save</button> -->
 

    </form>
    @elseif(isset($error))
    <h2>Error:</h2>
    <p>{{ $error }}</p>
    @endif
   
    </body>

    <script>
    const orderIDInput = document.getElementById("order_id");
function autoload() {
    const orderIDInput = document.getElementById("order_id");
    if (orderIDInput.value.trim() !== "") {
        // Automatically submit the form when the order ID is provided
        document.getElementById("fetch-form").submit();
    }
}

// Call the "autoload" function when the page loads
window.addEventListener("load", autoload);
        // Check if the data matches a specific condition
        @if(isset($orderData))
    // Display a SweetAlert success notification with an image
    Swal.fire({
        imageUrl: '/assets/images/artofliving.png', // Replace with the actual image path
        imageWidth: 370, // Adjust the width of the image as needed
        imageHeight: 200, // Adjust the height of the image as needed
        imageAlt: 'Custom Image', // Replace with a description of the image
        @if($orderData['status']==='CHARGED')
        icon: 'success',
        title: '{!! $orderData['status'] !!}<br>Amount: {!! $orderData['amount'] !!}',
        html: 'Dear {{ $orderData['udf8'] }}, {{ $orderData['bank_error_message'] }}<br><br>Transaction Id: {{ $orderData['order_id'] }} <br><br>{{ $orderData['date_created'] }}',
        @else
        icon: 'error',
        title: '{!! $orderData['status'] !!}<br>Amount: {!! $orderData['amount'] !!}',
        html: 'Dear {{ $orderData['udf8'] }}, {{ $orderData['bank_error_message'] }}<br><br>Transaction Id: {{ $orderData['order_id'] }}<br><br>{{ $orderData['date_created'] }}',
        @endif
    });
@endif


    </script>
 <script>
    // Function to automatically submit the form when the page loads
    window.onload = function () {
        const formData = new FormData(document.getElementById('data-form'));
        fetch(document.getElementById('data-form').action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log('Data saved:', data);
            // You can also add code here to display a success message or perform other actions
        })
        .catch(error => {
            console.error('Error saving data:', error);
            // Handle errors here
        });
    };
</script>
</html>

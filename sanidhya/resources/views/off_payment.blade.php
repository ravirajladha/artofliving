<?php
$events = $data['events'];
$event_id = $events['id'];
$event_name = $events['event_name'];
$categories = $data['categories'];
?>
@include("inc_sanidhya.header")

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">
<link rel="stylesheet" type="text/css" href="/path/to/sweetalert2.css">


<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Payment</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Event Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="edit-profile">
            <!-- <form action="/off_transaction/{{$event_id}}" method="POST" enctype="multipart/form-data"> -->
            <form id="payment_form" method="POST" enctype="multipart/form-data">

            @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form theme-form Cubiclecreate">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Event ID</label>
                                                <input class="form-control" name="user_id" type="hidden" placeholder="Value " value="{{session('rexkod_admin_user_id')}}" readonly>
                                                <input type="hidden" value="CHARGED" name="transaction_status">
                                                <input class="form-control" name="event_id" type="text" placeholder="Value " value="{{$event_id}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Name of the Event</label>
                                                <input class="form-control" name="event_name" type="text" placeholder="Value " value="{{$event_name}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Phone Number*<span style="font-size:10px">(10 digits)</span></label>
                                                <input class="form-control" name="phone_number" type="text" placeholder="Value " onkeyup="handlePhoneNumberInput(this.value)" maxlength="10"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>First Name</label>
                                                <input class="form-control" name="first_name" type="text" placeholder="Value " value=""  id="comm_first_p" readonly>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Email Id</label>
                                                <input class="form-control" name="email" type="text" placeholder="Value " value=""  id="comm_email_p" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Category*</label>
                                                <select name="category" class="form-control" onchange="updateAmount(this)">
                                                    <option value="" selected disabled>Select Category</option>
                                                    <?php foreach ($categories as $category => $amount) : ?>
                                                        <option value="<?= $category ?>"><?= $category ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Multiples*</label>
                                                <input class="form-control" name="multiples" type="number" placeholder="Value " onchange="updateAmount(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Amount</label>
                                                <input id="amount" class="form-control" name="amount" type="number" placeholder="Value " readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Seat*</label>
                                                <input class="form-control" name="seat_number" type="text" placeholder="Value " required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
    <div class="mb-3">
        <label>Payment Mode*</label>
        <select id="payment_mode" name="payment_mode" class="form-control" onchange="toggleFormAction()" >
            <option value="0" selected disabled>Select Mode of Payment</option>
            <option value="Cheque">Cheque</option>
            <option value="Other">Other</option>
            <option value="Online">Online</option>
        </select>
    </div>
</div>
<div class="row" id="chequeFields" style="display: none;">
    <div class="col-md-6">
        <div class="mb-3">
            <label>Create Transaction ID*</label>
            <input id="transaction_id" class="form-control" name="transaction_id" type="text" placeholder="Value" readonly required>
            <input type="button" id="generateButton" value="Generate" class="btn btn-info">
        </div>
    </div>
</div>
<div class="row" id="chequeDetails" style="display: none;">
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="img">Image</label>
            <input class="form-control" type="file" name="transaction_img" id="img" accept=".png, .jpeg, .jpg, .webp">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="img">Cheque number/Transaction ID*</label>
            <input class="form-control" type="text" name="cheque_details">
        </div>
    </div>
</div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" name="description" placeholder="Value "  rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row card-f-end">
                                        <div class="col">
                                            <hr>
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-secondary me-3">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <input name="type" type="text" placeholder="Value *" id="comm_type_p" hidden>
                <!-- <input name="first_name" type="text" placeholder="Value *" id="comm_first_p" hidden> -->
                <input name="last_name" type="text" placeholder="Value *" id="comm_last_p" hidden>
                <!-- <input name="email" type="text" placeholder="Value *" id="comm_email_p" hidden> -->
                <input name="gender" type="text" placeholder="Value *" id="comm_gender_p" hidden>
                <input name="age" type="text" placeholder="Value *" id="comm_age_p" hidden>
                <input name="pan" type="text" placeholder="Value *" id="comm_pan_p" hidden>
                <input name="aadhaar" type="text" placeholder="Value *" id="comm_aadhaar_p" hidden>

        </div>
        </form>
    </div>
</div>
</div>

@include("inc_sanidhya.footer")

<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function updateAmount(element) {
        var category = $('select[name="category"]').val();
        var multiples = $('input[name="multiples"]').val();

        if (category && multiples) {
            var amount = parseInt(multiples) * parseInt(<?= json_encode($categories) ?>[category]);
            $('#amount').val(amount);
        } else {
            $('#amount').val('');
        }
    }
</script>

<script>
    document.getElementById("generateButton").addEventListener("click", function() {
        var transactionIdInput = document.getElementById("transaction_id");
        var generatedId = generateUniqueIdWithDate();
        transactionIdInput.value = generatedId;
    });

    function generateUniqueIdWithDate() {
        var currentDate = new Date();
        var datePart = currentDate.toISOString().slice(0, 10).replace(/-/g, "");
        var timePart = currentDate.getTime().toString().slice(-6);
        var randomPart = generateRandomString(4);
        var uniqueId = datePart + timePart + randomPart;
        return uniqueId;
    }

    function generateRandomString(length) {
        var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var randomString = "";
        for (var i = 0; i < length; i++) {
            var randomIndex = Math.floor(Math.random() * chars.length);
            randomString += chars[randomIndex];
        }
        return randomString;
    }
</script>



    <!--Phone Validation -->
    <script>
    function handlePhoneNumberInput(phone) {
    checkPhoneNumber(phone);
    find_phone_p(phone);
}
// 
function setValues(detail, fieldIds) {
    for (let i = 0; i < fieldIds.length; i++) {
        const field = document.getElementById(fieldIds[i]);
        if (detail[i]) {
            field.value = detail[i];
        } else {
            field.value = "";
        }
    }
}

function find_phone_p(phone) {
    const fieldIds = [
        "comm_type_p",
        "comm_first_p",
        "comm_last_p",
        "comm_email_p",
        "comm_age_p",
        "comm_gender_p",
        "comm_pan_p",
        "comm_aadhaar_p"
    ];

    if (phone.length === 10) {
        $.ajax({
            url: '/check_phone_details/' + phone,
            type: 'GET',
            success: function(res) {
                console.log(res);
                const detail = res.split(',');
                setValues(detail, fieldIds);
            }
        });
    } else {
        setValues([], fieldIds);
    }
}
function checkPhoneNumber(phn) {
        if (phn.length === 10) {
            $.ajax({
                url: '/checkPhoneNumber',
                type: 'GET',
                data: {
                    phone_number: phn
                },
                success: function(response) {
                    if (response) {
                        // Set input field values using response data
                        Swal.fire({
                            icon: 'success',
                            title: 'Your data avialable and autofilling started',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $('#phone').val(response.phone);
                        // Set other input field values similarly
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Number not registered!',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = '/add_doners';
                        });
                    }
                }
            });
        }
    }

    </script>
<script>
    function toggleFormAction() {
        var paymentMode = document.getElementById("payment_mode");
        var chequeFields = document.getElementById("chequeFields");
        var chequeDetails = document.getElementById("chequeDetails");
        var form = document.getElementById("payment_form"); // Assuming you have a form with id="payment_form"

        if (paymentMode.value === "Cheque" || paymentMode.value==='Other' ) {
            chequeFields.style.display = "block";
            chequeDetails.style.display = "block";
            form.action = "/off_transaction/{{$event_id}}"; // Change the action URL for Cheque
        } else if (paymentMode.value === "Online") {
            chequeFields.style.display = "none";
            chequeDetails.style.display = "none";
            form.action = "/create_online_donation/{{$event_id}}"; // Change the action URL for Online
        } else {
            // If no valid option is selected, prevent form submission
            // alert("Please select a valid payment option.");
            return false;
        }
    }

    // Attach the function to the form submission event
    document.getElementById("payment_form").onsubmit = function() {
        return toggleFormAction();
    };

    // Initial call to set initial state
    toggleFormAction();
</script>



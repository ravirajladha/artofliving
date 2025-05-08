 
          <!-- footer start-->
          <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2023 © Art of Living  </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="/assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="/assets/js/scrollbar/simplebar.js"></script>
    <script src="/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="/assets/js/sidebar-menu.js"></script>
    <script src="/assets/js/chart/chartjs/chart.min.js"></script>
    <script src="/assets/js/chart/chartist/chartist.js"></script>
    <script src="/assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="/assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="/assets/js/prism/prism.min.js"></script>
    <script src="/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="/assets/js/counter/counter-custom.js"></script>
    <script src="/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="/assets/js/owlcarousel/owl-custom.js"></script>
    <script src="/assets/js/dashboard/dashboard_2.js"></script>
    <script src="/assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/assets/js/script.js"></script>
  </body>
</html>




<link rel="stylesheet" type="text/css" href="/assets/css/vendors/dropzone.css">
    <script src="/assets/js/dropzone/dropzone.js"></script>
    <script src="/assets/js/dropzone/dropzone-script.js"></script>

    <script>
  $(document).ready(function() {
    $("#add_row").on("click", function() {
      // Dynamic Rows Code

      // Get max row id and set new id
      var newid = 0;
      $.each($("#tab_logic tr"), function() {
        if (parseInt($(this).data("id")) > newid) {
          newid = parseInt($(this).data("id"));
        }
      });
      newid++;

      var tr = $("<tr></tr>", {
        id: "addr" + newid,
        "data-id": newid
      });

      // loop through each td and create new elements with name of newid
      $.each($("#tab_logic tbody tr:nth(0) td"), function() {
        var td;
        var cur_td = $(this);

        var children = cur_td.children();

        // add new td and element if it has a nane
        if ($(this).data("name") !== undefined) {
          td = $("<td></td>", {
            "data-name": $(cur_td).data("name")
          });

          var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");

          c.appendTo($(td));
          td.appendTo($(tr));
        } else {
          td = $("<td></td>", {
            'text': $('#tab_logic tr').length
          }).appendTo($(tr));
        }
      });
      $(tr).appendTo($('#tab_logic'));

      $(tr).find("td button.row-remove").on("click", function() {
        $(this).closest("tr").remove();
      });
    });

    // Sortable Code
    var fixHelperModified = function(e, tr) {
      var $originals = tr.children();
      var $helper = tr.clone();

      $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width())
      });

      return $helper;
    };

    $(".table-sortable tbody").sortable({
      helper: fixHelperModified
    }).disableSelection();

    $(".table-sortable thead").disableSelection();



    $("#add_row").trigger("click");
  });

</script>
<script>
  // avatar pic display on upload
  $(document).ready(function() {


    var readURL = function(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('.avatar').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }


    $(".file-upload").on('change', function() {
      readURL(this);
    });
  });


//   function validatePan() {
//     var panInput = document.getElementById("panNumber");
//     var panErrorDiv = document.getElementById("panErrorMessage");

//     var panNumber = panInput.value;
//     var errorMessage = "";

//     // Check if PAN card number is provided
//     if (panNumber.trim() === "") {
//       errorMessage = "Please enter a valid PAN card number.";
//     } else {
//       // Check if it is a valid PAN card number
//       var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;
//       if (panRegex.test(panNumber)) {
//         // It is a valid PAN card number, no need to check further
//         panErrorDiv.textContent = "";
//         return;
//       }

//       // Invalid PAN card number
//       errorMessage = "Please enter a valid PAN card number.";
//     }

//     // Display the error message in the panErrorDiv element
//     panErrorDiv.textContent = errorMessage;
//   }

//   function validateAadhaar() {
//     var aadhaarInput = document.getElementById("aadhaarNumber");
//     var aadhaarErrorDiv = document.getElementById("aadhaarErrorMessage");

//     var aadhaarNumber = aadhaarInput.value;
//     var errorMessage = "";

//     // Check if Aadhaar card number is provided
//     if (aadhaarNumber.trim() === "") {
//       errorMessage = "Please enter a valid Aadhaar card number.";
//     } else {
//       // Check if it is a valid Aadhaar card number
//       var aadhaarRegex = /^[2-9]\d{3}\s\d{4}\s\d{4}$/;
//       if (aadhaarRegex.test(aadhaarNumber)) {
//         // It is a valid Aadhaar card number, no need to check further
//         aadhaarErrorDiv.textContent = "";
//         return;
//       }

//       // Invalid Aadhaar card number
//       errorMessage = "Please enter a valid Aadhaar card number.";
//     }

//     // Display the error message in the aadhaarErrorDiv element
//     aadhaarErrorDiv.textContent = errorMessage;
//   }

//   var panInput = document.getElementById("panNumber");
//   panInput.addEventListener("blur", validatePan);
//   panInput.addEventListener("input", clearPanErrorMessage);

//   var aadhaarInput = document.getElementById("aadhaarNumber");
//   aadhaarInput.addEventListener("blur", validateAadhaar);
//   aadhaarInput.addEventListener("input", clearAadhaarErrorMessage);

//   function clearPanErrorMessage() {
//     var panErrorDiv = document.getElementById("panErrorMessage");
//     panErrorDiv.textContent = "";
//   }

//   function clearAadhaarErrorMessage() {
//     var aadhaarErrorDiv = document.getElementById("aadhaarErrorMessage");
//     aadhaarErrorDiv.textContent = "";
//   }


//   function validateCompanyPan() {
//     var companyPanInput = document.getElementById("companyPanNumber");
//     var companyPanErrorDiv = document.getElementById("companyPanErrorMessage");

//     var companyPanNumber = companyPanInput.value;
//     var errorMessage = "";

//     // Check if Company PAN card number is provided
//     if (companyPanNumber.trim() === "") {
//       errorMessage = "Please enter a valid Company PAN card number.";
//     } else {
//       // Check if it is a valid PAN card number
//       var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;
//       if (panRegex.test(companyPanNumber)) {
//         // It is a valid PAN card number, no need to check further
//         companyPanErrorDiv.textContent = "";
//         return;
//       }

//       // Invalid PAN card number
//       errorMessage = "Please enter a valid Company PAN card number.";
//     }

//     // Display the error message in the companyPanErrorDiv element
//     companyPanErrorDiv.textContent = errorMessage;
//   }

//   function validateCompanyAadhaar() {
//     var companyAadhaarInput = document.getElementById("companyAadhaarNumber");
//     var companyAadhaarErrorDiv = document.getElementById("companyAadhaarErrorMessage");

//     var companyAadhaarNumber = companyAadhaarInput.value;
//     var errorMessage = "";

//     // Check if Company Aadhaar card number is provided
//     if (companyAadhaarNumber.trim() === "") {
//       errorMessage = "Please enter a valid Company Aadhaar card number.";
//     } else {
//       // Check if it is a valid Aadhaar card number
//       var aadhaarRegex = /^[2-9]\d{3}\s\d{4}\s\d{4}$/;
//       if (aadhaarRegex.test(companyAadhaarNumber)) {
//         // It is a valid Aadhaar card number, no need to check further
//         companyAadhaarErrorDiv.textContent = "";
//         return;
//       }

//       // Invalid Aadhaar card number
//       errorMessage = "Please enter a valid Company Aadhaar card number.";
//     }

//     // Display the error message in the companyAadhaarErrorDiv element
//     companyAadhaarErrorDiv.textContent = errorMessage;
//   }

//   var companyPanInput = document.getElementById("companyPanNumber");
//   companyPanInput.addEventListener("blur", validateCompanyPan);
//   companyPanInput.addEventListener("input", clearCompanyPanErrorMessage);

//   var companyAadhaarInput = document.getElementById("companyAadhaarNumber");
//   companyAadhaarInput.addEventListener("blur", validateCompanyAadhaar);
//   companyAadhaarInput.addEventListener("input", clearCompanyAadhaarErrorMessage);

//   function clearCompanyPanErrorMessage() {
//     var companyPanErrorDiv = document.getElementById("companyPanErrorMessage");
//     companyPanErrorDiv.textContent = "";
//   }

//   function clearCompanyAadhaarErrorMessage() {
//     var companyAadhaarErrorDiv = document.getElementById("companyAadhaarErrorMessage");
//     companyAadhaarErrorDiv.textContent = "";
//   }
//   console.log("confirm");
// </script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(!empty(session()->get('success'))) { ?>
<script type="text/javascript">
Swal.fire({
  icon: 'success',
  title: '{{ session()->get('success') }}',
  showConfirmButton: false,
  timer: 3000,

})
</script>
<?php } session()->forget('success'); ?>


<?php if(!empty(session()->get('failed'))) { ?>
  <script type="text/javascript">
  Swal.fire({
  icon: 'warning',
  title: '{{ session()->get('failed') }}',
  showConfirmButton: false,
  timer: 3000
})
  </script>
<?php } session()->forget('failed'); ?>



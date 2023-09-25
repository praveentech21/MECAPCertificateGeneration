<?php
session_start();
if (!isset($_SESSION['supid'])) header("location: login.php");

include "connect.php";

if(isset($_POST['addnewstudent'])){
    $name = $_POST['sname'];
    $dept = $_POST['dept'];
    $title = $_POST['title'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $batch = $_POST['batch'];
    $sql = "INSERT INTO `members`(`name`, `department`, `title`, `mobile`, `email`, `particapation`) VALUES ('$name','$dept','$title','$mobile','$email','$batch')";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "<script>alert('Data Inserted Successfully')</script>";
    }
    else{
        echo "<script>alert('Data Not Inserted')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="Bhavani/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Campus Online Admin</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="Bhavani/img/cup.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="Bhavani/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="Bhavani/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="Bhavani/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="Bhavani/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="Bhavani/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="Bhavani/vendor/libs/apex-charts/apex-charts.css" />

  <script src="Bhavani/vendor/js/helpers.js"></script>

  <script src="Bhavani/js/config.js"></script>
</head>

<body>

  <!-- Sidebar Starts Here Shiva -->
  <?php include 'header.php'; ?>
  <!-- Sidebar Ends Here Shiva -->

  <!-- Content Starts Here Shiva-->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">MECAP SRKR</span> REGISTRATIONS</h4>

    <div class="row">


      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">New Participation Registration</h5>
            <!-- <small class="text-muted float-end">Default label</small> -->
          </div>
          <div class="card-body">
            <form method="post" action="#" >
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="sname">Name</label>
                <div class="col-sm-10">
                  <input type="text" required class="form-control" autocomplete="off" id="sname" autofocus name="sname" placeholder="participant Name" />
                  <div id="name-error" class="error"></div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="dept">Department</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input type="text" required autocomplete="off" class="form-control" id="dept" name="dept" placeholder="Department belongs to " />
                  </div>
                  <!-- <div class="form-text">For Juniours use their dept and remaning are last digits of mobile number must be length 10</div> -->
                  <div id="regno-error" class="error"></div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="title">Title</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input type="text" required autocomplete="off" class="form-control" id="title" name="title" placeholder="Topic title " />
                  </div>
                  <!-- <div class="form-text">For Juniours use their dept and remaning are last digits of mobile number must be length 10</div> -->
                  <div id="regno-error" class="error"></div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="email">Email</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input type="email" name="email" id="email" autocomplete="off" class="form-control" placeholder="Participent Email" aria-label="john.doe" aria-describedby="basic-default-email2" required />
                  </div>
                  <div id="email-error" class="error"></div>
                  <!-- <div class="form-text">You can use letters, numbers & periods</div> -->
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="mobile">Mobile No</label>
                <div class="col-sm-10">
                  <input type="text" id="mobile" autocomplete="off" name="mobile" class="form-control phone-mask" placeholder="905 272 7402" aria-label="905 272 7402" aria-describedby="basic-default-phone" />
                  <div id="mobile-error" class="error"></div>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="batch">Participation</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <select class="form-select" id="batch" name="batch" aria-label="Default select example">
                      <option selected value="">Select type of Participation</option>
                      <option value="chaired">CHAIRED</option>
                      <option value="participat">PARTICIPAT</option>
                      <option value="oralpresen">ORALPRESEN</option>
                      <option value="invitedtal">INVITEDTAL</option>
                    </select>
                    <div id="batch-error" class="error"></div>
                  </div>
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" name="addnewstudent" class="btn btn-primary">Send</button>
                </div>
              </div>
              <!-- Error placeholders for other fields -->
            </form>
          </div>
        </div>
      </div>
      <!-- Basic with Icons -->

    </div>
  </div>
  <!-- Content Ends Here Shiva -->

  <!-- Footer Starts Here Shiva-->
  <?php include 'footer.php'; ?>
  <!-- Footer Ends Here Shiva-->
  <script>
    // Function to validate before allowing "Allow to Play" checkbox
    function validateAllowToPlay() {
      var paymentConfirmationCheckbox = document.getElementById("defaultCheck1");
      var allowToPlayCheckbox = document.getElementById("defaultCheck2");
      var paymentInfoError = document.getElementById("allowtoplay-error");

      // Check if Payment Confirmation checkbox is not selected
      if (!paymentConfirmationCheckbox.checked) {
        paymentInfoError.textContent = "Please confirm payment first.";
        return false; // Prevent checking "Allow to Play" checkbox
      } else {
        paymentInfoError.textContent = ""; // Clear error message
        return true; // Allow checking "Allow to Play" checkbox
      }
    }

    // Attach the validation function to the "Allow to Play" checkbox
    var allowToPlayCheckbox = document.getElementById("defaultCheck2");
    allowToPlayCheckbox.addEventListener("click", validateAllowToPlay);
  </script>



</body>

</html>
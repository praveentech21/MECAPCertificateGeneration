<?php
session_start();
if (!isset($_SESSION['supid']))
    header('location: login.php');

include 'connect.php';

$studentdetails = mysqli_query($conn, 'SELECT * FROM `members`');

?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="Bhavani/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>EDIT Members - MECAP SRKR</title>

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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>

    <!-- Sidebar Starts Here Shiva -->
    <?php include 'header.php'; ?>
    <!-- Sidebar Ends Here Shiva -->

    <!-- Content Starts Here Shiva-->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <!-- Bordered Table -->
            <div class="card">
                <h5 class="card-header">Edit Student Details</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered" id="registrationTable">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>DEPARTMENT</th>
                                    <th>Participation</th>
                                    <th>Title</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>EDIT</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($studentdetails)) { ?>
                                    <tr title="<?php echo $row['name'] ?>">
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['department'] ?></td>
                                        <td><?php echo $row['particapation'] ?></td>
                                        <td><strong><?php echo $row['title'] ?></strong></td>
                                        <td><?php echo $row['mobile'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><button type="button" class="btn btn-primary edit-button" data-pid="<?php echo $row['mobile']; ?>">Edit Details</button></td>
                                        <td><button type="button" class="btn btn-danger delete-button" data-pid="<?php echo $row['mobile']; ?>"> Delete</button></td>
                                    </tr>

                                    <!-- Edit Modal for This Person Starts Here Shiva -->

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Student Details</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editForm">
                                                        <!-- Input fields for editing details -->
                                                        <input type="hidden" id="editStudentID" />
                                                        <div class="form-group">
                                                            <label for="editName">Name</label>
                                                            <input type="text" class="form-control" id="editName" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editDept">Department</label>
                                                            <input type="text" class="form-control" id="editDept" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editTitle">Title</label>
                                                            <input type="text" class="form-control" id="editTitle" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editMobile">Mobile Number</label>
                                                            <input type="text" class="form-control" id="editMobile" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editEmail">Email</label>
                                                            <input type="text" class="form-control" id="editEmail" />
                                                            <input type="hidden" id="pid">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editSection">Participation</label>
                                                            <select class="form-select" id="editSection" name="editSection" aria-label="Default select example">
                                                                <option selected value="">Select Participant Section</option>
                                                                <option value="participat">participat</option>
                                                                <option value="oralpresen">oralpresen</option>
                                                                <option value="invitedtal">invitedtal</option>
                                                                <option value="chaired">chaired</option>
                                                            </select>
                                                        </div>
                                                        <!-- Add more input fields for other details -->
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary update-btn" >Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Edit Modal for a person ends here shiva -->


                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->


        </div>
    </div>
    <!-- Content Ends Here Shiva -->

    <!-- Footer Starts Here Shiva-->
    <?php include 'footer.php'; ?>
    <!-- Footer Ends Here Shiva-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".edit-button").click(function() {
                // Get the student ID from the data attribute
                var studentID = $(this).data("pid");

                // Make an AJAX request to fetch student details
                $.ajax({
                    type: "POST",
                    url: "update.php", // Replace with your PHP script to fetch details
                    data: {
                        pid: studentID,
                        work: 'edit'
                    },
                    dataType: "json",
                    success: function(data) {
                        // Populate modal input fields with retrieved data
                        $("#editName").val(data.name);
                        $("#editDept").val(data.dept);
                        $("#editTitle").val(data.title);
                        $("#editMobile").val(data.mobile);
                        $("#editEmail").val(data.email);
                        $("#pid").val(data.mobile);
                        $("#editSection").val(data.particapation);
                        // Populate other input fields similarly
                    },
                    error: function() {
                        console.error("Error fetching student details.");
                    }
                });

                // Show the edit modal
                $("#editModal").modal("show");

            });

            $(".delete-button").click(function() {
                // Get the student ID from the data attribute
                var studentID = $(this).data("pid");

                // Make an AJAX request to fetch student details
                $.ajax({
                    type: "POST",
                    url: "update.php", // Replace with your PHP script to fetch details
                    data: {
                        pid: studentID,
                        work: 'delete'
                    },
                    dataType: "json",
                    success: function(data) {
                        // Populate modal input fields with retrieved data
                        alert("Deleted Successfully");
                        // Populate other input fields similarly
                    },
                    error: function() {
                        console.error("Error fetching student details.");
                    }
                });
                window.location.reload();

                // Show the edit modal

            });


            $(".close-btn").click(function() {
                $("#editModal").modal("hide");

            });

            // Handle the "Update" button click
            $(".update-btn").click(function() {
                // Collect edited data from input fields
                var updatedData = {
                    name: $("#editName").val(),
                    department: $("#editDept").val(),
                    title: $("#editTitle").val(),
                    mobile: $("#editMobile").val(),
                    pid: $("#pid").val(),
                    email: $("#editEmail").val(),
                    particapation: $("#editSection").val(),
                    work: 'update'

                };

                // Make an AJAX request to update student details
                $.ajax({
                    type: "POST",
                    url: "update.php", // Replace with your PHP script to update details
                    data: updatedData,
                    success: function(response) {
                        // Handle success, e.g., display a success message
                       window.location.reload();

                        // Close the modal
                        $("#editModal").modal("hide");
                        // Optionally, reload or update the displayed data on your page
                    },
                    error: function() {
                        console.error("Error updating student details.");
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Cache the table rows for better performance
            var rows = $("#registrationTable tr");

            // Bind the input field's keyup event
            $("#searchInput").keyup(function() {
                var searchText = $(this).val().toLowerCase();

                // Iterate through each table row
                rows.each(function() {
                    var name = $(this).find("td:nth-child(1)").text().toLowerCase();
                    var regno = $(this).find("td:nth-child(2)").text().toLowerCase();
                    var department = $(this).find("td:nth-child(3)").text().toLowerCase();

                    // Check if the search text matches any of the row data
                    if (
                        name.includes(searchText) ||
                        regno.includes(searchText) ||
                        department.includes(searchText)
                    ) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>



</body>

</html>
                                                                                                                                                                                                  <?php
session_start();
error_reporting(0);
include('tmpls/db_connect.php');
// Code Material Requisition key in by users - clients
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $created = $_POST['created'];
    $status = $_POST['status'];
    
    $query = mysqli_query($conn, "insert into events (id, title, description, start_date, end_date, created, status) values('$id','$title','$description', '$start_date', '$end_date', '$created','$status')");
    if ($query) {
        echo "<script>alert('Event Created.');</script>";
    } else {
        echo "<script>alert('Event went wrong, Please try again!');</script>";
    }
}
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        
        <title>Add Event Calendar</title>
      

    </head>

    

    <body><br><br>


        <!-- The Contact Section -->
        <div class="container"> 

            <h1 class="w3-wide w3-center">Event</h1>

            <p class="w3-opacity"><i>Create Event</i></p>
         
             

                        <form class="register-form outer-top-xs" role="form" method="post" name="register">
                          

                            <div class="form-group">
                                <label class="info-title" for="staff_id">Event ID <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="id" name="id" required="required">
                            </div>
                            
                             <div class="form-group">
                                <label class="info-title" for="staff_id">Event Title <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="title" name="title" required="required">
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="description">Description <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="description" name="description" required="required">
                               
                            </div>
                            
                            <div class="form-group">
                                <label class="info-title" for="type">Start Date <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="start_date" name="start_date" required="required">
                               
                            </div>                                                 
                            
                            <div class="form-group">
                                <label class="info-title" for="status">End Date <span></span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="end_date" name="end_date" required="required">
                               
                            </div>
                                                       
                            <div class="form-group">
                                <label class="info-title" for="status">Created <span></span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="created" name="created">
                               
                            </div>
                                 <div class="form-group">
                                <label class="info-title" for="status">Status <span></span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="status" name="status">
                               
                            </div>

                            
                            <button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button" id="submit">Create</button>

                            
                        </form>

            </div>
        </div>

    </div>


</body>
<?php include('tmpls/footer.php'); ?>
</html>

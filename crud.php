<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  
</head>
<body>
    
    <div class="container">
        
        <div class="row"> <!-- heading row -->
            
            <div class="col-md-12">
                <h1 class="text-primary text-center text-uppercase">CRUD APPLICATION USING JQUERY AJAX</h1>
            </div>
            
        </div>
        
        <div class="row">
            
            <div class="col-md-12">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Insert Data</button>
            
            <!-- The Insert Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">INSERT FORM</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <div class="form-group">
            <input type="text" class="form-control" name="" id="fname" placeholder="Enter First Name">
        </div>
        
        <div class="form-group">
            <input type="text" class="form-control" name="" id="lname" placeholder="Enter Last Name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="" id="age" placeholder="Enter Age">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="" id="desig" placeholder="Enter Designation">
        </div>
        
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="add()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
           
           
           <!-- The Update Modal -->
<div class="modal" id="UpdateModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">UPDATE FORM</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <div class="form-group">
            <input type="text" class="form-control" name="" id="update_fname" placeholder="Enter First Name">
        </div>
        
        <div class="form-group">
            <input type="text" class="form-control" name="" id="update_lname" placeholder="Enter Last Name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="" id="update_age" placeholder="Enter Age">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="" id="update_desig" placeholder="Enter Designation">
        </div>
        
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="UpdateUser()">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id="hidden_UserId">
      </div>

    </div>
  </div>
</div>
           
           
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <h3>All Records</h3>
                <div id="records">
                    
                </div>
            </div>
        </div>
        
        
    </div>
  
    
    <script type="text/javascript">
    
        function add()
          {
              var fname = $('#fname').val();
              var lname = $('#lname').val();
              var age = $('#age').val();
              var desig = $('#desig').val();
          
              if(fname == "" || lname == "" || age == "" || desig == "")
                 {
                    alert('All fields are required..');
                 }
              else
                  {
              $.ajax({
                  url:'data.php',
                  type:'post',
                  data:{fname:fname,
                       lname:lname,
                       age:age,
                       desig:desig},
                  success:function(data,status)
                  {
                      readRecords();
                      alert('Data inserted..');
                      $("#myModal input").val("");
                      $("#myModal").modal("hide");
                  }
              });
                  }
          }
        
        function readRecords()
          {
              var rd = 'rd';
              $.ajax({
                  url:'data.php',
                  type:'post',
                  data:{rd:rd},
                    success:function(data,status)
                      {
                        $('#records').html(data);
                      }
              });
          }
        
        // DELETE RECORDS

function DeleteUser(UserId)
          {
              var conf = confirm("Are You Sure ??");
              if(conf==true)
                 {
                 $.ajax({
                     url:'data.php',
                     type:'post',
                     data:{UserId:UserId},
                     success:function()
                     {
                         readRecords();
                     }
                 });
                 }
          }
        
        function GetUserDetails(userId)
          {
              $('#hidden_UserId').val(userId);
              
              $.post(
                    "data.php",
                    {userId:userId},
                    function(data,status)
                  {
                      var user = JSON.parse(data);
                      $('#update_fname').val(user.fname);
                      $('#update_lname').val(user.lname);
                      $('#update_age').val(user.age);
                      $('#update_desig').val(user.desig);
                  }
              );
              
              $('#UpdateModal').modal("show");
          }
        
//UPDATE DATA CODE

function UpdateUser()
          {
              var update_fname = $('#update_fname').val();
              var update_lname = $('#update_lname').val();
              var update_age = $('#update_age').val();
              var update_desig = $('#update_desig').val();
              
              var update_hidden_id = $('#hidden_UserId').val();
              
              if(update_fname == "" || update_lname == "" || update_age == "" || update_desig == "")
                 {
                    alert('All fields are required..');
                 }
              else
                  {
              $.post(
                    "data.php",
                    {
                        update_hidden_id:update_hidden_id,
                        update_fname:update_fname,
                        update_lname:update_lname,
                        update_age:update_age,
                        update_desig:update_desig
                    },
                  function(data,status)
                  {
                      $('#UpdateModal').modal('hide');
                      readRecords();
                  }
              );
                  }
          }
        
    </script>
    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
  
    <!--READ RECORDS ON PAGE LOAD-->

<script type="text/javascript">
    $(document).ready(function()
          {
              readRecords();
          });
   
    </script>
  
</body>
</html>
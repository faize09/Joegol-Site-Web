function addRecord() {
    var first_name = $("#first_name").val();
    first_name = first_name.trim();
    var last_name = $("#last_name").val();
    last_name = last_name.trim();
    var email = $("#email").val();
    email = email.trim();

    if (first_name == "") {
        alert("First name field is required!");
    }
    else if (last_name == "") {
        alert("Last name field is required!");
    }
    else if (email == "") {
        alert("Email field is required!");
    }
    else {
      
        $.post("create.php", {
            first_name: first_name,
            last_name: last_name,
            email: email
        }, function (data, status) {
         
            $("#add_new_record_modal").modal("hide");

            readRecords();

          
            $("#first_name").val("");
            $("#last_name").val("");
            $("#email").val("");
        });
    }
}



function readRecords() {
    $.get("read.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function GetUserDetails(id) {
    
    $("#hidden_user_id").val(id);
    $.post("details.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assign existing values to the modal popup fields
            $("#update_first_name").val(user.first_name);
            $("#update_last_name").val(user.last_name);
            $("#update_email").val(user.email);
        }
    );
  
    $("#update_user_modal").modal("show");
}



function UpdateUserDetails() {

    var first_name = $("#update_first_name").val();
    first_name = first_name.trim();
    var last_name = $("#update_last_name").val();
    last_name = last_name.trim();
    var email = $("#update_email").val();
    email = email.trim();

    if (first_name == "") {
        alert("First name field is required!");
    }
    else if (last_name == "") {
        alert("Last name field is required!");
    }
    else if (email == "") {
        alert("Email field is required!");
    }
    else {
   
        var id = $("#hidden_user_id").val();

      
        $.post("update.php", {
                id: id,
                first_name: first_name,
                last_name: last_name,
                email: email
            },
            function (data, status) {
               
                $("#update_user_modal").modal("hide");
          
                readRecords();
            }
        );
    }
}


function DeleteUser(id) {
    var conf = confirm("Are you sure, do you really want to delete User?");
    if (conf == true) {
        $.post("delete.php", {
                id: id
            },
            function (data, status) {
             
                readRecords();
            }
        );
    }
}


$(document).ready(function () {
   
    readRecords(); 
});
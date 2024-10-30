<?php
    ob_start();
	session_start();

	$pageTitle = 'Table Management';

	if(isset($_SESSION['username_restaurant_qRewacvAqzA']) && isset($_SESSION['password_restaurant_qRewacvAqzA']))
	{
		include 'connect.php';
  		include 'Includes/functions/functions.php'; 
		include 'Includes/templates/header.php';
		include 'Includes/templates/navbar.php';

        ?>

            <script type="text/javascript">
                var vertical_menu = document.getElementById("vertical-menu");
                var current = vertical_menu.getElementsByClassName("active_link");

                if(current.length > 0) {
                    current[0].classList.remove("active_link");   
                }
                
                vertical_menu.getElementsByClassName('table_management_link')[0].className += " active_link";
            </script>

            <style type="text/css">
                .tables-table {
                    -webkit-box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important;
                    box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important;
                    text-align: center;
                    vertical-align: middle;
                }
            </style>

        <?php
            
            $stmt = $con->prepare("SELECT * FROM tables");
            $stmt->execute();
            $tables = $stmt->fetchAll();

        ?>
            <div class="card">
                <div class="card-header">
                    <?php echo $pageTitle; ?>
                </div>
                <div class="card-body">

                	<!-- ADD NEW TABLE BUTTON -->
                	<button class="btn btn-success btn-sm" style="margin-bottom: 10px;" type="button" data-toggle="modal" data-target="#add_new_table" data-placement="top">
                    	<i class="fa fa-plus"></i> 
                    	Add Table
                	</button>

                    <!-- Add New Table Modal -->
                    <div class="modal fade" id="add_new_table" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Table</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="table_number">Table Number</label>
                                        <input type="text" id="table_number_input" class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/g,'');" placeholder="Table Number" name="table_number">
                                        <div id='required_table_number' class="invalid-feedback">
                                            <div>Table number is required!</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-info" id="add_table_bttn">Add Table</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TABLES MANAGEMENT TABLE -->
                    <table class="table table-bordered tables-table">
                        <thead>
                            <tr>
                                <th scope="col">Table ID</th>
                                <th scope="col">Table Number</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($tables as $table)
                                {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $table['table_id'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $table['table_number'];
                                        echo "</td>";
                                        echo "<td>";
                                            $delete_data = "delete_".$table["table_id"];
                                            ?>
                                                <ul class="list-inline m-0">
                                                    <!-- DELETE BUTTON -->
                                                    <li class="list-inline-item" data-toggle="tooltip" title="Delete">
                                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $delete_data; ?>" data-placement="top">
                                                        	<i class="fa fa-trash"></i>
                                                        </button>

                                                        <!-- Delete Modal -->
		                                                <div class="modal fade" id="<?php echo $delete_data; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $delete_data; ?>" aria-hidden="true">
		                                                    <div class="modal-dialog" role="document">
		                                                        <div class="modal-content">
		                                                            <div class="modal-header">
		                                                                <h5 class="modal-title">Delete Table</h5>
		                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                                                    <span aria-hidden="true">&times;</span>
		                                                                </button>
		                                                            </div>
		                                                            <div class="modal-body">
		                                                                Are you sure you want to delete Table "<?php echo $table['table_number']; ?>"?
		                                                            </div>
		                                                            <div class="modal-footer">
		                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		                                                                <button type="button" data-id="<?php echo $table['table_id']; ?>" class="btn btn-danger delete_table_bttn">Delete</button>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
                                                    </li>
                                                </ul>
                                            <?php
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>  
                </div>
            </div>
        <?php

        include 'Includes/templates/footer.php';

    }
    else
    {
        header('Location: index.php');
        exit();
    }

?>

<!-- JS SCRIPTS -->

<script type="text/javascript">

	// When add table button is clicked
    $('#add_table_bttn').click(function() {
        var table_number = $("#table_number_input").val();
        var do_ = "Add";

        if($.trim(table_number) == "") {
            $('#required_table_number').css('display','block');
        } else {
            $.ajax({
                url:"ajax_files/tables_management_ajax.php",
                method:"POST",
                data:{table_number:table_number,do:do_},
                dataType:"JSON",
                success: function (data) {
                    if(data['alert'] == "Warning") {
                        swal("Warning",data['message'], "warning").then((value) => {});
                    }
                    if(data['alert'] == "Success") {
                        swal("New Table",data['message'], "success").then((value) => {
                            window.location.replace("tables_management.php");
                        });
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error has been encountered while trying to execute your request');
                }
            });
        }
    });

	// When delete table button is clicked
    $('.delete_table_bttn').click(function() {
        var table_id = $(this).data('id');
        var do_ = "Delete";

        $.ajax({
            url:"ajax_files/tables_management_ajax.php",
            method:"POST",
            data:{table_id:table_id,do:do_},
            success: function (data) {
                swal("Delete Table","The table has been deleted successfully!", "success").then((value) => {
                    window.location.replace("tables_management.php");
                });
            },
            error: function(xhr, status, error) {
                alert('An error has been encountered while trying to execute your request');
            }
          });
    });

</script>

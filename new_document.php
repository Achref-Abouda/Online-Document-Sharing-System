<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-upload">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Title</label>
							<input type="text" class="form-control form-control-sm" name="title" value="<?php echo isset($ftitle) ? $ftitle : '' ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							<label for="" class="control-label">Description (Optional)</label>
							<textarea name="description" id="" cols="30" rows="10" class="summernote form-control"> 
								<?php echo isset($description) ? $description : '' ?>
							</textarea> 
						</div>
            <?php
// Include the database connection file
include 'db_connect.php';

// Select all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
?>

<!-- Display "Show All Users" text with a click event -->
<div id="showAllUsers" style="cursor: pointer; text-decoration: underline; color: blue;">Show All Users</div>

<!-- Display checkboxes for each user (initially hidden) -->
<div id="userCheckboxes" style="display: none;">
    <?php while ($row = $result->fetch_assoc()) : ?>
        <?php
        // Check if the user is the current user
        $isCurrentUser = ($row["id"] == $_SESSION['login_id']);
        
        // Skip displaying the current user in the checkboxes
        if (!$isCurrentUser):
        ?>
            <input type="checkbox" id="user<?= $row["id"] ?>" name="user_ids[]" value="<?= $row["id"] ?>" onclick="updateSelectedUsers()">
            <label for="user<?= $row["id"] ?>"><?php echo $row["firstname"] . " " . $row["lastname"]; ?></label><br>
        <?php endif; ?>
    <?php endwhile; ?>
</div>

<!-- Display the result dynamically as a read-only input text -->
Selected Users  <input type="text" id="selectedUsersResult" name="selectedUsersResult" readonly value="public"><br><br>

<script>
    // Function to toggle the visibility of checkboxes
    function toggleUserCheckboxes() {
        var checkboxesDiv = document.getElementById("userCheckboxes");
        checkboxesDiv.style.display = (checkboxesDiv.style.display === 'none') ? 'block' : 'none';
    }

    // Function to update selected users
    function updateSelectedUsers() {
        // Get all checked checkboxes
        var checkboxes = document.querySelectorAll('input[name="user_ids[]"]:checked');

        // Initialize a string to store selected user IDs
        var selectedUserIds = [];

        // Loop through checked checkboxes and add user IDs to the array
        checkboxes.forEach(function (checkbox) {
            var userId = checkbox.value;
            selectedUserIds.push(userId);
        });

        // If no checkboxes are checked, set default value
        if (selectedUserIds.length === 0) {
            selectedUserIds = ["public"];
        }

        // Update the input text element with the selected user IDs
        document.getElementById("selectedUsersResult").value = selectedUserIds.join(', ');
    }

    // Attach click event to "Show All Users" text
    document.getElementById("showAllUsers").addEventListener("click", toggleUserCheckboxes);
</script>

<?php
} else {
    echo "0 results";
}
// Close the database connection
$conn->close();
?>


					</div>
				</div>
				<div id="f-inputs" class="d-none"></div>
			<div class="callout callout-info">
            <div id="actions" class="row">
              <div class="col-lg-6">
                <div class="btn-group w-100" id="upload_btns">
                  <span class="btn btn-success btn-flat col-sm-4 col fileinput-button dz-clickable">
                    <i class="fas fa-plus"></i>
                    <span>Add files</span>
                  </span>
                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center">
                <div class="fileupload-process w-100">
                  <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table table-striped files" id="previews">
              <div id="template" class="row mt-2">
                <div class="col-auto">
                    <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                </div>
                <div class="col d-flex align-items-center">
                    <p class="mb-0">
                      <span class="lead" data-dz-name></span>
                      (<span data-dz-size></span>)
                    </p>
                    <strong class="error text-danger" data-dz-errormessage></strong>
                </div>
                <div class="col-4 d-flex align-items-center">
                    <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                </div>
                <div class="col-auto d-flex align-items-center">
                  <div class="btn-group">
                  	  <button class="btn btn-primary start d-none">
                      <i class="fas fa-upload"></i>
                      <span>Start</span>
                    </button>
                    <button  class="btn btn-danger delete">
                      <i class="fas fa-trash"></i>
                      <span>Delete</span>
                    </button>
                  </div>
                </div>
              </div>
              <div id="default-preview">
          <?php
            if(isset($file_json) && !empty($file_json)):
              foreach(json_decode($file_json) as $k => $v):
                if(is_file('assets/uploads/'.$v)):
                $_f = file_get_contents('assets/uploads/'.$v);
                $dname = explode('_', $v);
           ?>
           <div class="def-item">
            <input type="hidden" class="inp-file" name="fname[]" value="<?php echo $v ?>" data-uuid="<?php echo $k ?>">
                  <div id="" class="row mt-2 dz-processing dz-success dz-complete">
                      <div class="col-auto">
                          <span class="preview"><img src="data:," alt="" data-dz-thumbnail=""></span>
                      </div>
                      <div class="col d-flex align-items-center">
                          <p class="mb-0">
                            <span class="lead"><?php echo $dname[1] ?></span>
                            (<span><strong><?php echo filesize('assets/uploads/'.$v) ?></strong> Bytes</span>)
                          </p>
                          <strong class="error text-danger" data-dz-errormessage=""></strong>
                      </div>
                      <div class="col-4 d-flex align-items-center">
                          <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
                          </div>
                
                        <div class="btn-group">
                          <button class="btn btn-danger delete" type="button" data-uuid="<?php echo $k ?>">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                          </button>
                        </div>
                      </div>
                    </div>
              </div>
         <?php endif; ?>
         <?php endforeach; ?>
         <?php endif; ?>
            </div>
            </div>
          </div>
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-upload" id="save-btn">Save</button>
          <button class="btn btn-flat bg-gradient-secondary mx-2" type="button" id="cancel-btn">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
$('#default-preview .delete').click(function(){
    var uuid = $(this).attr('data-uuid');
    var _this = $(this);
    start_load();
    
    if($('.inp-file[data-uuid="'+uuid+'"]').length > 0){
        // Remove the file from Dropzone
        var file = myDropzone.getQueuedFiles().find(f => f.upload.uuid === uuid);
        if (file) {
            myDropzone.removeFile(file);
        }
        
        $('.inp-file[data-uuid="'+uuid+'"]').remove();
        _this.closest('.def-item').remove();
        end_load();
    }
});

$(function () {
    Dropzone.autoDiscover = false;
    var previewNode = document.querySelector("#template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var myDropzone = new Dropzone(document.body, {
        url: "ajax.php?action=upload_file",
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        acceptedFiles: '.pdf, .doc, .docx, .txt, .png, .jpg, .jpeg, .gif, .mp3, .mp4, .zip, .rar, .csv, .xls, .xlsx, .ppt, .pptx',
        autoQueue: true,
        previewsContainer: "#previews",
        clickable: ".fileinput-button"
    });

    myDropzone.on("addedfile", function(file) {
        document.querySelector("#total-progress .progress-bar").style.width = "0%";
        setTimeout(function(){
            myDropzone.enqueueFile(file);
        }, 500);

        file.previewElement.querySelector(".delete").onclick = function() {
            start_load();
            var uuid = file.upload.uuid;
            // Remove the file from Dropzone
            myDropzone.removeFile(file);
            
            if($('.inp-file[data-uuid="'+uuid+'"]').length > 0){
                $('.inp-file[data-uuid="'+uuid+'"]').remove();
                end_load();
            }
        };

        myDropzone.on("error", function(resp){
            console.log(resp);
        });

        myDropzone.on("totaluploadprogress", function(progress) {
            console.log(progress);
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });
    });

    myDropzone.on("sending", function(file) {
        document.querySelector("#total-progress").style.opacity = "1";
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
    });

    myDropzone.on("success", function(file, resp) {
        if (resp) {
            resp = JSON.parse(resp);
            if (resp.status == 1) {
                if ($('.inp-file[data-uuid="' + file.upload.uuid + '"]').length === 0) {
                    var inp = $('<input type="hidden" class="inp-file" name="fname[]" value="' + resp.fname + '" data-uuid="' + file.upload.uuid + '">');
                    $('#f-inputs').append(inp);
                }
            }
        }
    });

    $('#manage-upload').submit(function(e){
        e.preventDefault();
        
        // Validate title and files
        var title = $('input[name="title"]').val();
        if (!title || myDropzone.files.length === 0) {
            alert('You need to upload at least one file, and the title cannot be empty.');
            return;
        }

        start_load();
        $.ajax({
            url: 'ajax.php?action=save_upload',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp){
                if(resp == 1){
                    alert_toast('Data successfully saved', "success");
                    setTimeout(function(){
                        location.href = 'index.php?page=document_list';
                    }, 2000);
                }
            }
        });
    });
});
$('#cancel-btn').click(function() {
        alert_toast('Data successfully cancelled');
        $('#save-btn').prop('disabled', true);
        setTimeout(function(){
                            location.href = 'index.php?page=document_list';
                        }, 2000);
    });
</script>
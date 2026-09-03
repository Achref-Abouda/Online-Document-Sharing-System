<?php include 'db_connect.php' ?>

<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_document">
                    <i class="fa fa-plus"></i> Add New
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="list">
                <colgroup>
                    <col width="10%">
                    <col width="25%">
                    <col width="35%">
                    <col width="20%">
                    <col width="10%">
                </colgroup>

                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $user_info = [];

                    // Fetch user information for all users
                    $user = $conn->query("SELECT * FROM users");
                    while ($row = $user->fetch_assoc()) {
                        $user_info[$row['id']] = ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']);
                    }

                    // Fetch all documents based on user type
                    if ($_SESSION['login_type'] == 1) {
                        // Administrator - fetch all documents
                        $qry = $conn->query("SELECT * FROM documents ORDER BY unix_timestamp(date_created) DESC");
                    } else {
                        // Normal user - fetch documents where user ID is in Doc_To
                        $userId = $_SESSION['login_id'];
                        $qry = $conn->query("SELECT * FROM documents WHERE user_id = '$userId' OR FIND_IN_SET('$userId', Doc_To) OR Doc_To='public' ORDER BY unix_timestamp(date_created) DESC");
                    }

                    while ($row = $qry->fetch_assoc()):
                        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                        $desc = strtr(html_entity_decode($row['description']), $trans);
                        $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
                    ?>
                        <tr>
                            <th class="text-center"><?php echo $i++ ?></th>
                            <td><b><?php echo ucwords($row['title']) ?></b></td>
                            <td><b class="truncate"><?php echo strip_tags($desc) ?></b></td>
                            <td><?php echo isset($user_info[$row['user_id']]) ? $user_info[$row['user_id']] : "Deleted User" ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <?php if ($_SESSION['login_type'] == 1 || $_SESSION['login_id'] == $row['user_id']) { ?>
                                        <a href="./index.php?page=edit_document&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-flat delete_document" data-id="<?php echo $row['id'] ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php } ?>
                                    <a href="./index.php?page=view_document&id=<?php echo md5($row['id']) ?>" class="btn btn-info btn-flat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#list').dataTable();

        $('.delete_document').click(function () {
            _conf("Are you sure to delete this document?", "delete_document", [$(this).attr('data-id')]);
        });
    });

    function delete_document($id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_file',
            method: 'POST',
            data: { id: $id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }
</script>

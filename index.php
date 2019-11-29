<?php
    include('setting.php');
    include('upload.php');
    include('parsing.php');
    include('syncronize.php');
?>
<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" type="text/css" href="jquery.dataTables.css">

<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="src/bootstrap.min.css">
</head>
<body>
    <div class="container">
        
        <div class="row">
            <h2>Upload your file here.!</h2>
        </div>

        <div class="row">
            <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="csv">Pilih Jenis Produk</label>
                    <select class="form-control" name="tipe-produk">
                      <!-- <option value="tb_health">Health</option> -->
                      <option value="tb_ul_tl">Unit Link / Telemarketing</option>
                    </select>    
                </div>
                <div class="form-group">
                    <label for="csv">Pilih File CSV</label>
                    <input type="file" class="form-control-file" name="file" id="file" accept=".csv">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="parsing-data">
                    <label class="form-check-label" for="uid">Parsing Data</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="create-uid">
                    <label class="form-check-label" for="uid">Generated UID</label>
                </div>
                <button type="submit" class="btn btn-primary" name="import" id="submit">Submit</button>
            </form>
        </div>
        <div class="row row-offset-2">
             <?php $result_ultl =  $pdo->query("SELECT * FROM tb_data_zurcih "); ?>
            <table id='table_id'  class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Nomor Polis</th>
                    <th scope="col">Url</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1;
                while ($row = $result_ultl->fetch()) { ?>
                <tr>
                    <td scope="row"><?php  echo $no++; ?></td>
                    <td><?php  echo $row['POLICY_HOLDER_NAME']; ?></td>
                    <td><?php  echo $row['POLICY_NUMBER']; ?></td>
                    <td><a href="<?php echo $row['LANDING_PAGE'];?>" target="_blank"><?php  echo $row['LANDING_PAGE']; ?></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </div>
    
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="jquery.dataTables.js"></script>
<script src="jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#table_id').DataTable();
    $(document).ready( function () {
    
    $("#frmCSVImport").on("submit", function () {

        $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";    $('#userTable').DataTable();
    } );
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
                $("#response").addClass("error");
                $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>

</body>

</html>
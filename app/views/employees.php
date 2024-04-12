<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    

<body>
<?php
if($_GET['success']=='add'){
    echo "<h4 class='text-success text-center'>Bạn đã thêm thành công</h4>";
}else if($_GET['success']=='false') {
    echo "<h4 class='text-danger text-center'>Bạn đã thêm thất bại</h4>";
}else if($_GET['success']=='save') {
    echo "<h4 class='text-success text-center'>Bạn đã chỉnh sửa thành công</h4>";
}else if($_GET['success']=='delete') {
    echo "<h4 class='text-success text-center'>Bạn đã xóa thành công</h4>";
}
?>

    <div class="main mx-auto" style="max-width: 980px">
        <div class="header d-flex justify-content-between mt-4">
            <h4 class="text-primary">list of employees</h4>
            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalAdd">+ Add New Employee</button>
            <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- head -->
                        <div class="modal-header">
                            <div>
                                <h2 class="modal-title" id="exampleModalLabel">ADD NEW PROFILE</h2>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- body -->
                        <div class="modal-body">
                            <form action="index.php?c=employee&a=add" method="post" class="my-3" style="max-width: 28rem; width: 100%">
                                <input type="text" class="form-control my-3" placeholder="Enter name" name="txtName"/>
                                <input type="text" class="form-control my-3" placeholder="Enter address" name="txtAddress"/>
                                <input type="number" class="form-control my-3" placeholder="Enter salary" name="txtSalary"/>


                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-success btn-lg">SAVE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="employ-table">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Salary</th>
                    <th scope="col" class="text-center" colspan="3">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($employees as $row){
                    ?>
                    <tr>
                        <th scope="row"><?= $row->getId();?></th>
                        <td><?= $row->getName()?></td>
                        <td><?= $row->getAddress();?></td>
                        <td><?= $row->getSalary();?></td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#<?='modalDetail'.$row->getId()?>">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <div class="modal fade" id="<?='modalDetail'.$row->getId()?>" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <!-- head -->
                                        <div class="modal-header">
                                            <div>
                                                <h2 class="modal-title" id="exampleModalLabel">Detail profile</h2>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- body -->
                                        <div class="modal-body">
                                            <form action="index.php?c=employee&a=edit" method="post" class="my-3" style="max-width: 28rem; width: 100%">
                                                <input type="text" class="form-control" value="<?=$row->getId();?>" name="txtId" readonly>
                                                <input type="text" class="form-control my-3" value="<?=$row->getName();?>" name="txtName" readonly>
                                                <input type="text" class="form-control my-3" value="<?=$row->getAddress();?>" name="txtAddress" readonly>
                                                <input type="number" class="form-control my-3" value="<?=$row->getSalary();?>" name="txtSalary" readonly>


                                                <div class="text-center mt-3 row">
                                                    <button type="button" class="btn btn-success btn-lg col w-1" data-bs-toggle="modal" data-bs-target="#<?='modalEdit'.$row->getId()?>">EDIT</button>
                                                    <button type="button" class="btn btn-danger btn-lg col" data-bs-toggle="modal" data-bs-target="#<?='modalDel'.$row->getId()?>">DELETE</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#<?='modalEdit'.$row->getId()?>">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <div class="modal fade" id="<?='modalEdit'.$row->getId()?>" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <!-- head -->
                                        <div class="modal-header">
                                            <div>
                                                <h2 class="modal-title" id="exampleModalLabel">Edit profile</h2>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- body -->
                                        <div class="modal-body">
                                            <form action="index.php?c=employee&a=edit" method="post" class="my-3" style="max-width: 28rem; width: 100%">
                                                <input type="text" class="form-control" value="<?=$row->getId();?>" name="txtId" readonly>
                                                <input type="text" class="form-control my-3" value="<?=$row->getName();?>" name="txtName">
                                                <input type="text" class="form-control my-3" value="<?=$row->getAddress();?>" name="txtAddress">
                                                <input type="number" class="form-control my-3" value="<?=$row->getSalary();?>" name="txtSalary">


                                                <div class="text-center mt-3">
                                                    <button type="submit" class="btn btn-success btn-lg">SAVE</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#<?='modalDel'.$row->getId()?>">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                            <div class="modal fade" id="<?='modalDel'.$row->getId()?>" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <!-- head -->
                                        <div class="modal-header">
                                            <div>
                                                <h2 class="modal-title" id="exampleModalLabel">Delete profile</h2>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- body -->
                                        <div class="modal-body">
                                            <form action="index.php?c=employee&a=delete" method="post" class="my-3" style="max-width: 28rem; width: 100%">
                                                <input type="text" class="form-control" value="<?=$row->getId();?>" name="txtId" readonly>
                                                <input type="text" class="form-control my-3" value="<?=$row->getName();?>" name="txtName" readonly>
                                                <input type="text" class="form-control my-3" value="<?=$row->getAddress();?>" name="txtAddress" readonly>
                                                <input type="number" class="form-control my-3" value="<?=$row->getSalary();?>" name="txtSalary" readonly>


                                                <div class="text-center mt-3">
                                                    <button type="submit" class="btn btn-danger btn-lg">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
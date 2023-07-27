<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karakter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <style>
        .container{
            max-width: 800px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- CONTAINER -->
    <div class="container">
        <!-- CARD -->
        <div class="card">
            <div class="card-header bg-info text-white">
                DATA KARAKTER
            </div>
            <div class="card-body">
                <!-- LOKASI TEXT PENCARIAN-->
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="<?php echo $katakunci ?>" name="katakunci" placeholder="Masukkan Kata Kunci" aria-label="Masukkan Kata Kunci" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                    </div>
                </form>
                <!-- MODAL -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Tambah Data Karakter
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Karakter</h5>
                                <button type="button" class="btn-close tombol-tutup" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- KALAU ERROR -->
                                <div class="alert alert-danger error" role="alert" style="display: none;">
                                </div>
                                <!-- KALAU SUKSES -->
                                <div class="alert alert-primary sukses" role="alert" style="display: none;">
                                </div>
                                <!-- FORM INPUT DATA -->
                                <input type="hidden" id="inputID">
                                <div class="mb-3 row">
                                    <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNama">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEmail">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputBidang" class="col-sm-2 col-form-label">Bidang</label>
                                    <div class="col-sm-10">
                                        <select id="inputBidang" class="form-select">
                                            <option value="Ninja">Ninja</option>
                                            <option value="Samurai">Samurai</option>
                                            <option value="Tensen">Tensen</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputAlamat">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary" id="tombolSimpan">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Bidang</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($dataKarakter as $k => $v ){
                            $nomor = $nomor +1;
                        ?>
                            <tr>
                                <td><?php echo $nomor ?></td>
                                <td><?php echo $v['Nama'] ?></td>
                                <td><?php echo $v['Email'] ?></td>
                                <td><?php echo $v['Bidang'] ?></td>
                                <td><?php echo $v['Alamat'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="edit(<?php echo $v['ID']?>)">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapus(<?php echo $v['ID'] ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                $linkPagination = $pager->links();
                $linkPagination = str_replace('<li class="active">', '<li class="page-item active">', $linkPagination);
                $linkPagination = str_replace('<li>', '<li class="page-item">', $linkPagination);
                $linkPagination = str_replace("<a", "<a class='page-link'", $linkPagination);
                echo $linkPagination;
                ?>
            </div>
        </div>
    </div>
    <!-- SCRIPT JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script>
        function hapus($ID){
            var result = confirm('Konfirmasi untuk hapus');
            if(result){
                window.location = "<?php echo site_url("Karakter/hapus") ?>/" + $ID;
            }

        }
        function edit($ID){
            $.ajax({
                url:"<?php echo site_url("Karakter/edit") ?>/" + $ID,
                type:"get",
                success:function(hasil){
                    var $obj = $.parseJSON(hasil);
                    if($obj.ID != ''){
                        $('#inputID').val($obj.ID);
                        $('#inputNama').val($obj.Nama);
                        $('#inputEmail').val($obj.Email);
                        $('#inputBidang').val($obj.Bidang);
                        $('#inputAlamat').val($obj.Alamat);
                    }
                }
            });

        }
        function bersihkan(){
          $('#inputID').val('');
          $('#inputNama').val('');
          $('#inputEmail').val('');
          $('#inputAlamat').val('');
        }
        $('.tombol-tutup').on('click', function(){
            if($('.sukses').is(":visible")){
                window.location.href = "<?php echo current_url()."?".$_SERVER['QUERY_STRING'] ?>"; 
            }
            $('.alert').hide();
            bersihkan();
        });
        $('#tombolSimpan').on('click', function(){
            var $ID = $('#inputID').val();
            var $Nama = $('#inputNama').val();
            var $Email = $('#inputEmail').val();
            var $Bidang = $('#inputBidang').val();
            var $Alamat = $('#inputAlamat').val();

            $.ajax({
                url: "<?php echo site_url("Karakter/simpan") ?>",
                type:"POST",
                data:{
                    ID:$ID,
                    Nama:$Nama,
                    Email:$Email,
                    Bidang:$Bidang,
                    Alamat:$Alamat
                },
                success: function(hasil){
                    var $obj = $.parseJSON(hasil);
                    if($obj.sukses == false){
                       $('.sukses').hide();
                       $('.error').show();
                       $('.error').html($obj.error);
                    }else{
                       $('.error').hide();
                       $('.sukses').show();
                       $('.sukses').html($obj.sukses);
                    }
                }
            });
            bersihkan();
        });
    </script>
    
</body>

</html>
<!DOCTYPE html>
<html>


      <?php $this->load->view("admin/part/headcrud.php") ?>
   
<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php $this->load->view("admin/part/navbar.php") ?>
    <div class="container">
    <h2>Tambah Data - Pesanan</h2>
    <h4>Data Pelanggan</h4>
    <br>
<form method="POST" action="<?php echo base_url(). 'addxsy/simpan'; ?>">
    <div class="form-group">
      <label for="kodepesanan">Kode Pesanan:</label>
      <input type="text" class="form-control" id="kodepesanan" name="kodepesanan" value="PS<?php echo sprintf("%04s", $kodepesanan) ?>" readonly>
    </div>
    <div class="form-group">
      <label for="namaitem">Nama Pelanggan:</label>
       <select name="namaitem" id="namaitem" style="width: 200px;">
					<option value="">Pilih</option>
					
					<?php
					foreach($barangs as $data){ // Lakukan looping pada variabel siswa dari controller
						echo "<option value='".$data->namaitem."'>".$data->namaitem."</option>";
					}
					?>
				</select>
    </div>
    <div class="form-group">
      <label for="kode_item">Kode Pelanggan:</label>
      <input type="text" class="form-control" id="kode_item" placeholder="Enter kode_item" name="kode_item" readonly>
    </div>
    <div class="form-group">
      <label for="hargajual">hargajual:</label>
      <input type="text" class="form-control" id="hargajual" placeholder="Enter hargajual" name="hargajual" readonly>
    </div>

    <input class="btn btn-primary" type="submit" value="Simpan">
        <input class="btn btn-primary" type="reset" value="Reset">
  </form>

</div>

<script type="text/javascript" src="<?php echo base_url().'ass/dd/js/jquery.js'?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			 $('#namaitem').on('input',function(){
                
                var namaitem=$(this).val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('addxsy/get_barang')?>",
                    dataType : "JSON",
                    data : {namaitem: namaitem},
                    cache:false,
                    success: function(data){
                        $.each(data,function(namaitem, kode_item, hargajual){
                            $('[name="kode_item"]').val(data.kode_item);
                            $('[name="hargajual"]').val(data.hargajual);
                           
                            
                        });
                        
                    }
                });
                return false;
           });

		});
  </script>
  
</body>
</html>
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
<form method="POST" action="<?php echo base_url(). 'addxs/simpan'; ?>">
    <div class="form-group">
      <label for="kodepesanan">Kode Pesanan:</label>
      <input type="text" class="form-control" id="kodepesanan" name="kodepesanan" value="PS<?php echo sprintf("%04s", $kodepesanan) ?>" readonly>
    </div>
    <div class="form-group">
      <label for="namacustomer">Nama Pelanggan:</label>
       <select name="namacustomer" id="namacustomer" style="width: 200px;">
					<option value="">Pilih</option>
					
					<?php
					foreach($customers as $data){ // Lakukan looping pada variabel siswa dari controller
						echo "<option value='".$data->namacustomer."'>".$data->namacustomer."</option>";
					}
					?>
				</select>
			
    </div>
    <div class="form-group">
      <label for="kodecustomer">Kode Pelanggan:</label>
      <input type="text" class="form-control" id="kodecustomer" placeholder="" name="kodecustomer" readonly>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat:</label>
      <input type="text" class="form-control" id="alamat" placeholder="" name="alamat" readonly>
    </div>
    <div class="form-group">
      <label for="nohp">No telepon:</label>
      <input type="nohp" class="form-control" id="nohp" placeholder="" name="nohp" readonly>
    </div>
	<script type="text/javascript" src="<?php echo base_url().'ass/dd/js/jquery.js'?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			 $('#namacustomer').on('input',function(){
                
                var namacustomer=$(this).val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('addxs/get_barang')?>",
                    dataType : "JSON",
                    data : {namacustomer: namacustomer},
                    cache:false,
                    success: function(data){
                        $.each(data,function(namacustomer, kodecustomer, alamat, nohp){
                            $('[name="kodecustomer"]').val(data.kodecustomer);
                            $('[name="alamat"]').val(data.alamat);
                            $('[name="nohp"]').val(data.nohp);
                            
                        });
                        
                    }
                });
                return false;
           });

		});
  </script>
	

    <div class="form-group">
      <label for="namaitem">Nama Barang:</label>
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
      <label for="kode_item">Kode Barang:</label>
      <input type="text" class="form-control" id="kode_item" placeholder="" name="kode_item" readonly>
    </div>
    <div class="form-group">
      <label for="hargajual">Harga:</label>
      <input type="text" class="form-control" id="hargajual" placeholder="" name="hargajual" readonly>
    </div>
    <div class="form-group">
      <label for="jumlah">Jumlah:</label>
      <input type="number" class="form-control" id="jumlah" placeholder="" name="jumlah">
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
                    url  : "<?php echo base_url('addxs/get_barangg')?>",
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
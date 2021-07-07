<?php
	//koneksi database
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "arkademy";

	$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

	if(isset($_POST['bsubmit']))
	{
		if($_GET['hal'] == "edit")
		{
			$edit = mysqli_query($koneksi, "UPDATE produk set
												nama_produk = '$_POST[tnamaProduk]',
												keterangan = '$_POST[tketerangan]',
												harga = '$_POST[tharga]',
												jumlah = '$_POST[tjumlah]'
											WHERE id_produk = '$_GET[id]'
			                                         ");
			if($edit)
			{
				echo "<script>
						alert('Edit data suksess!!');
						document.location='crud_web.php';
				      </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='crud_web.php';
				      </script>";
			}
		}
		else
		{
			$simpan = mysqli_query($koneksi, "INSERT INTO produk(nama_produk, keterangan, harga, jumlah)
			                                  VALUES('$_POST[tnamaProduk]',
			                                         '$_POST[tketerangan]',
			                                         '$_POST[tharga]',
			                                         '$_POST[tjumlah]')
			                                         ");
			if($simpan)
			{
				echo "<script>
						alert('Simpan data suksess!!');
						document.location='crud_web.php';
				      </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='crud_web.php';
				      </script>";
			}
		}


		
	}

	if(isset($_GET['hal'])){
		if($_GET['hal'] == "edit")
		{
			$tampil = mysqli_query($koneksi, "SELECT * from produk WHERE id_produk = '$_GET[id]'");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				$vnamaProduk = $data['nama_produk'];
				$vketerangan = $data['keterangan'];
				$vharga = $data['harga'];
				$vjumlah = $data['jumlah'];
			}
		}
		else if($_GET['hal'] == "delete")
		{
			$hapus = mysqli_query($koneksi, "DELETE from produk WHERE id_produk = '$_GET[id]'");
			if($hapus)
			{
				echo "<script>
						alert('Hapus data suksess!!');
						document.location='crud_web.php';
				      </script>";
			}
		}
	}

?>
<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<title>CRUD Applications</title>
	</head>
	<body>
		<div class="container">
			<div class="main-header text-center">
				<h1>CRUD Website</h1>
				<h2>by Abiel</h2>
			</div>
			
			<!--form isi-->
			<div class="card mt-3">
			  <div class="card-header text-light bg-primary">
			    Input Data Section
			  </div>
			  <div class="card-body">
				    <form method="post" action="">
				    	<div class="form-group">
				    		<input type="text" name="tnamaProduk" value="<?=@$vnamaProduk?>" class="form-control" placeholder="Nama Produk" required>
				    	</div>
                        <div></div>
				    	<div class="form-group">
				    		<textarea class="form-control" name="tketerangan" placeholder="Keterangan" required><?=@$vketerangan?></textarea>
				    	</div>
                        <div></div>
				    	<div class="form-group">
				    		<input type="text" name="tharga" value="<?=@$vharga?>" class="form-control" placeholder="Harga" required>
				    	</div>
                        <div></div>
                        <div class="form-group">
				    		<input type="text" name="tjumlah" value="<?=@$vjumlah?>" class="form-control" placeholder="Jumlah" required>
				    	</div>
                        <div></div>

				    	<button type="submit" class="btn btn-success mt-3" name="bsubmit">Submit</button>
				    	<button type="reset" class="btn btn-danger mt-3" name="breset">Clear</button>
				    </form>
			  </div>
			</div>


			<!--Tabel-->
			<div class="card mt-3">
			  <div class="card-header text-light bg-success">
			    Daftar Produk
			  </div>
			  <div class="card-body">
				    <table class="table table-bordered table-striped">
				    	<tr>
				    		<th>No.</th>
				    		<th>Nama Produk</th>
				    		<th>Keterangan</th>
				    		<th>Harga</th>
				    		<th>Jumlah</th>
				    		<th>Action</th>
				    	</tr>
				    	<?php
				    		$no = 1;
				    		$tampil = mysqli_query($koneksi, "SELECT * from produk order by id_produk desc");
				    		while($data = mysqli_fetch_array($tampil)) :
				    	?>
				    	<tr>
				    		<td><?=$no++?></td>
				    		<td><?=$data['nama_produk']?></td>
				    		<td><?=$data['keterangan']?></td>
				    		<td><?=$data['harga']?></td>
				    		<td><?=$data['jumlah']?></td>
				    		<td>
				    			<a class="btn btn-warning" href="crud_web.php?hal=edit&id=<?=$data['id_produk']?>">Edit</a>
				    			<a class="btn btn-danger"href="crud_web.php?hal=delete&id=<?=$data['id_produk']?>" onclick="return confirm('Apakah yakin menghapus data ini??')"	>Delete</a>
				    		</td>
				    	</tr>
				    <?php endwhile; ?>
				    </table>
			  </div>
			</div>


		</div>
	</body>
</html>
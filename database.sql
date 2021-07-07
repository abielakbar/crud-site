CREATE TABLE `produk` (
  `id_produk` int(50) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `keterangan` varchar(300) NOT NULL,
  `harga` int(16) NOT NULL,
  `jumlah` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

ALTER TABLE `produk`
  MODIFY `id_produk` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

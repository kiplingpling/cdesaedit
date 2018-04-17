     <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="81">NO KOHIR :</td>
          <td width="521" align="left"><strong><?php echo $row_Recordset2['no']; ?></strong></td>
          <td width="170">Nama Wajib Pajak : <?php echo $row_Recordset2['namapemilik']; ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
<?php if ($totalRows_Recordset3 > 0) { // Show if recordset not empty ?>
  <table border="1" cellpadding="3" cellspacing="0" width="100%">
    <tr>
      <td rowspan="2" bgcolor="#CCCCCC">No Asset</td>
      <td rowspan="2" bgcolor="#CCCCCC">No Persil</td>
      <td rowspan="2" bgcolor="#CCCCCC">Kelas Desa</td>
      <td rowspan="2" bgcolor="#CCCCCC">Luas Yang Dipindah</td>
      <td colspan="7" bgcolor="#CCCCCC">Sebab dan Waktu Perubahan</td>
      <td rowspan="2" bgcolor="#CCCCCC">Klasifikasi</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC">Metode</td>
      <td bgcolor="#CCCCCC">Tahun</td>
      <td bgcolor="#CCCCCC">Dari C</td>
      <td bgcolor="#CCCCCC">Dari No Urut</td>
      <td bgcolor="#CCCCCC">Dari Nama</td>
      <td bgcolor="#CCCCCC">Dari Ke No Urut</td>
      <td bgcolor="#CCCCCC">Dari Ke Nama</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset4['k_id']; ?></td>
        <td><?php echo $row_Recordset4['no_persil']; ?></td>
        <td><?php echo $row_Recordset4['kelas_desa']; ?></td>
        <td><?php echo $row_Recordset4['luas_terpindah']; ?></td>
        <td><?php echo $row_Recordset4['metode']; ?></td>
        <td><?php echo $row_Recordset4['tahun']; ?></td>
        <td><a href="http://localhost/cDesa/tampilCariMultipleNomor.php?keyword=<?php echo $row_Recordset4['nocdesa']; ?>"/><?php echo $row_Recordset4['nocdesa']; ?></a></td>
        <td><?php echo $row_Recordset4['dari_no']; ?></td>
        <td><?php echo $row_Recordset4['dari_nama']; ?></td>
        <td><?php echo $row_Recordset4['ke_no']; ?></td>
        <td><?php echo $row_Recordset4['ke_nama']; ?></td>
        <td><?php echo $row_Recordset4['klasifikasi']; ?></td>
      </tr>
      <?php } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
  </table>
        <p align="right"><a href="cetakperubahanasset.php?id=<?php echo $_GET[id]; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','img/btn/print-btn2.png',1)"><img src="img/btn/print-btn1.png" alt="" name="Image3" width="100" height="36" border="0" id="Image3" /></a></p>
  <?php } // Show if recordset not empty ?>
		<?php
   			$fileXml = "metadata/".$_SESSION["fileXMl"];
    		$mythme = simplexml_load_file($fileXml);
			echo "<h3>".$_SESSION["fileXMl"]."</h3>";
		?>
		<input name="XML_FILE" type="hidden" value="<?php echo $_SESSION["fileXMl"]; ?>" />
		<div class="form-group">
  			 <label>Nama Peta</label>
  			 <input name="NAMA" id="NAMA" class="form-control" type="text" value="<?php echo $mythme->Esri[0]->DataProperties->itemProps->itemName; ?>" placeholder="Nama Peta" size="50" maxlength="50" />
		</div>
		<div class="form-group">
   			<label>Nama Peta</label>
   			<input name="JUDUL" id="JUDUL" class="form-control" type="text" value="<?php echo $row_RstKatalog['NAMA']; ?>" placeholder="Nama Peta" size="50" maxlength="50" />
		</div>
		<div class="form-group">
   			<label>Summary</label>
  			<textarea name="SUMMARY" id="SUMMARY" cols="50" class="form-control" placeholder="Ringkasan Peta"><?php echo $row_RstKatalog['SUMMARY']; ?></textarea>
		</div>
		<div class="form-group">
  			<label>Abstrak</label>
    		<textarea name="ABSTRAK" cols="50" rows="5" class="form-control" placeholder="Abstrak"><?php echo $row_RstKatalog['ABSTRAK']; ?></textarea>
		</div>
		<div class="form-group">
    		<label>Sumber Data</label>
    		<input name="SMB_DATA" id="SMB_DATA" class="form-control" type="text" value="<?php  echo $smbDt = $mythme->dataIdInfo[0]->idCredit; ?>" placeholder="Sumber Data" size="50" maxlength="255" />
		</div>
		<!--------------------------------------------- -->
		<div class="col-lg-4 text-left">
			<div class="form-group">
    			<label>Bujur Barat</label>
    			<input type="text" name="BB" id="BB" class="form-control" value="<?php echo $row_RstKatalog['BB']; ?>" />
			</div>
        	<div class="form-group">
    			<label>Bujur Timur</label>
    			<input type="text" name="BT" id="BT" class="form-control" value="<?php echo $row_RstKatalog['BL']; ?>" />
			</div>
        	<div class="form-group">
    			<label>Lintang Utara</label>
    			<input type="text" name="LU" id="LU" class="form-control" value="<?php echo $row_RstKatalog['LU']; ?>" />
			</div>
        	<div class="form-group">
    			<label>Lintang Selatan</label>
    			<input type="text" name="LS" id="LS" class="form-control" value="<?php echo $row_RstKatalog['LS']; ?>"  />
      		</div>                    
		</div>
		<!--------------------------------------------- -->    
		<div class="col-lg-8 text-left">
      		<div class="form-group">
    			<label>Type Koordinat</label>
    			<input name="TYPE" id="TYPE" type="text" class="form-control" value="<?php echo $mythme->Esri[0]->DataProperties->coordRef->type; ?>" />
      		</div> 
      		<div class="form-group">
    			<label>Georeferensi</label>
    			<input type="text" name="GEO_REFERENCE" id="GEO_REFERENCE" class="form-control" value="<?php echo $mythme->Esri[0]->DataProperties->coordRef->geogcsn; ?>" />
      		</div> 
      		<div class="form-group">
    			<label>Max Skala</label>
    			<input id="MAX_SKALA" name="MAX_SKALA" type="text" class="form-control" value="<?php echo $mythme->Esri[0]->scaleRange->minScale; ?>" />
      		</div> 
      		<div class="form-group">
    			<label>Min Skala</label>
    			<input id="MIN_SKALA" name="MIN_SKALA" type="text" class="form-control" value="<?php echo $mythme->Esri[0]->scaleRange->maxScale; ?>"/>
      		</div>                  
		</div>
		<div class="form-group">
    		<label>Keyword</label>
    		<input name="MAP_TAG" type="text" id="MAP_TAG" class="form-control" value="<?php echo $mythme->dataIdInfo[0]->searchKeys->keyword[0]; ?>,<?php echo $mythme->dataIdInfo[0]->searchKeys->keyword[1]; ?>,<?php echo $mythme->dataIdInfo[0]->searchKeys->keyword[2]; ?>, <?php echo $mythme->dataIdInfo[0]->searchKeys->keyword[3]; ?>" size="35" />
		</div>
		<div class="form-group">
    		<label>ID Record</label>
    		<input type="text" name="ID_REC" id="ID_REC" class="form-control" value="<?php echo $mythme->mdFileID[0]; ?>" size="35" />
		</div>
		<?php  
			$str1=$mythme->Esri[0]->CreaDate; 
			$tgl = substr($str1, 6,2);
			$bln = substr($str1, 4,2);
			$thn = substr($str1, 0,4);
	
			$str2=$mythme->Esri[0]->ModDate;
			$tgl2 = substr($str2, 6,2);
			$bln2 = substr($str2, 4,2);
			$thn2 = substr($str2, 0,4); 
		?>
    		<!--------------------------------------------- -->
               <div class="col-lg-6 text-left">
				<div class="form-group">
                    <label>Tanggal:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="TANGGAL" id="TANGGAL" placeholder="Tanggal Pembuatan" class="form-control" value="<?php echo $thn."-".$bln."-".$tgl;  ?>" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="">
                    </div><!-- /.input group -->
                  </div>
               </div>
              <!--------------------------------------------- -->
               <div class="col-lg-6 text-left">
                  <div class="form-group">
                    <label>Update Terakhir:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="TGL_UPDATE" id="TGL_UPDATE" placeholder="Tanggal Update" class="form-control" value="<?php echo $thn2."-".$bln2."-".$tgl2;  ?>" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="">
                    </div><!-- /.input group -->
                  </div>
  				 </div>
              <!--------------------------------------------- -->
				<img name="Img" src="data:image/jpeg;base64,<?php echo $mythme->Binary[0]->Thumbnail->Data; ?>" width="450"  alt="">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="page-header">
  <h2>Data Karyawan <small>[no description]</small></h2>
</div>
</div>
<div class="row">
<div class="col-md-12">
<a href="" class="rekam"><button class="btn btn-default">Rekam</button></a>
</div>
<div id="message" class="alert alert-info" role="alert" style="display:none;position:absolute;top:30%;left:40%;z-index:999999;font-family:Lato"><span></span></div>
</div>
<div class="row">
<div class="col-sm-12">
<table id="t_table" class="table table-condensed table-hover table-striped">
<thead>
<th data-column-id="no">#</th>
<th data-column-id="id" data-visible="false" data-identifier="false" >id</th>
<th data-column-id="nama" data-formatter="nama" data-sortable="true">Nama</th>
<th data-column-id="open" data-formatter="open" data-sortable="false"></th>
<th data-column-id="no_induk">No Induk</th>
<th data-column-id="jabatan" data-sortable="true">Sebagai</th>
<th data-column-id="aktif" data-visible="false" data-sortable="true">aktif</th>
<th data-column-id="aksi" data-formatter="commands" data-sortable="false">Aksi</th>
</thead>
<tbody>
<?php
$no = 0;
foreach($this->kars as $key=>$value) {
?>
<tr>
<td><?php echo ++$no; ?></td>
<td><?php echo $value['id']; ?></td>
<td><?php echo $value['nama']; ?></td>
<td>
	<a>
		<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" data-toggle="tooltip" data-placement="right" title="Detail">
			<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
		</button>
	</a>
</td>
<td></td>
<td><?php echo $value['jabatan'];?></td>
<td><?php echo $value['aktif'];?></td>
<td>
	<a>
		<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" data-toggle="tooltip" data-placement="right" title="Ubah">
			<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
		</button>
	</a>
	<a href="<?php echo URL; ?>kar/remove_kar/<?php echo $value['id'];?>" class="confirm">
		<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" data-toggle="tooltip" data-placement="right" title="Hapus">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
		</button>
	</a>
	<a>
		<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" data-toggle="tooltip" data-placement="left" title="Rekam sebagai guru">
			<span class="glyphicon glyphicon-education" aria-hidden="true"></span>
		</button>
	</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<script src="public/js/bootstrap/bootstrap-datetimepicker.min.js"></script>
<script src="public/js/bootstrap/tooltip.js"></script>
<script src="public/js/bootstrap/tab.js"></script>
<script src="public/js/app.js"></script>
<script src="public/js/karyawan.js"></script>
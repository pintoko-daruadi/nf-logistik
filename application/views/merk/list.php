<?php echo $breadcrumb; ?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-table"></i>
		Daftar Merk
		&nbsp<a href="<?php echo base_url();?>merk/tambah" class="btn-sm btn-success"><i class="fa fa-fw fa-plus-square"></i>Tambah</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nama</th>
						<th>Kode</th>
						<th>Action</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Nama</th>
						<th>Kode</th>
						<th>Action</th>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach($merks as $key => $value): ?>
					<tr>
						<td><?php echo $value->id;?></td>
						<td><?php echo $value->nama;?></td>
						<td><?php echo !empty($value->kode) ? $value->kode : '<i>(not set)</i>';?></td>
						<td>
							<a href="<?php echo base_url().'merk/ubah/'.$value->id;?>" class="btn-sm btn-warning"><i class="fa fa-fw fa-pencil-square-o"></i></a>
							<a href="<?php echo base_url().'merk/hapus/'.$value->id;?>" onclick="return confirm('Hapus merk <?php echo $value->nama;?> ?');" class="btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

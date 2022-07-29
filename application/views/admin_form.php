<div class="col-md-6 offset-md-3 p-0 mb-4">
	<div class="card">
		<div class="card-header">
			Form Aplikasi
			<a href="<?php echo site_url('/admin'); ?>" class="btn btn-outline-primary btn-sm btn-header">
				<i class="ti ti-back-left"></i> Kembali
			</a>
		</div>
		<div class="card-body">
			<?php if ($this->session->flashdata('status_simpan') == 'ok'): ?>
			<div class="alert alert-success">Data berhasil disimpan.</div>
			<?php endif; ?>
			
			<?php if ($this->session->flashdata('status_simpan') == 'tidak_lengkap'): ?>
			<div class="alert alert-danger"><?php echo $this->session->flashdata('validation_errors'); ?></div>
			<?php endif; ?>
			
			<form method="post" action="<?php echo $url_aksi; ?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php if ($data != null) echo $data->id; ?>">
				<div class="form-group row">
					<label class="col-sm-4 col-form-label pr-sm-0 text-sm-right">
						<span class="text-danger">*</span> Nama Aplikasi
					</label>
					<div class="col-sm-6 pr-sm-0">
						<input type="text" class="form-control" name="nama" value="<?php if ($data != null) echo $data->nama; ?>">
					</div>
				</div>
                <div class="form-group row">
					<label class="col-sm-4 col-form-label pr-sm-0 text-sm-right">
						<span class="text-danger">*</span> Alamat URL
					</label>
					<div class="col-sm-6 pr-sm-0">
						<input type="text" class="form-control" name="alamat" value="<?php if ($data != null) echo $data->alamat; ?>">
					</div>
				</div>
                <div class="form-group row">
					<label class="col-sm-4 col-form-label pr-sm-0 text-sm-right">
						<span class="text-danger"></span> Icon
					</label>
					<div class="col-sm-6 pr-sm-0">
						<input type="file" onchange="readURL(this);" accept="image/*" id="imgasal" class="form-control" name="icon"><br>
                        <center>
                            <img id="imgprev" src="<?=base_url()?>assets/img/<?php if ($data != null) {echo $data->icon; }else{echo 'noimage.png';}?>" alt="" style="width:250px;height:250px;">
                        </center>
                    </div>
				</div>
                <div class="form-group row">
					<label class="col-sm-4 col-form-label pr-sm-0 text-sm-right">
						<span class="text-danger"></span> Keterangan
					</label>
					<div class="col-sm-6 pr-sm-0">
						<textarea name="keterangan" id="" cols="30" rows="10" class="form-control"><?php if ($data != null) echo $data->keterangan; ?></textarea>
					</div>
				</div>
                
				<div class="form-group row">
					<label class="col-sm-4 col-form-label pr-sm-0 text-sm-right">&nbsp;</label>
					<div class="col-sm-6 pr-sm-0">
						<button type="submit" class="btn btn-primary">Simpan Data</button>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgprev').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
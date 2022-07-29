
<div class="col-12 p-0 mb-4">
	<div class="card">
		<div class="card-header">
			List Aplikasi
            <a href="<?=base_url()?>admin/tambah" class="btn btn-primary btn-sm btn-header">
				<i class="ti ti-write"></i> Tambah Data
			</a>
		</div>
		
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-striped table table-bordered">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Aplikasi</td>
                            <td>Alamat URL</td>
                            <td>Icon/Gambar</td>
                            <td>Keterangan</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                   
                        <?php
                        if(!empty($data)){
                            $no=1;
                            foreach($data as $d){
                        ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$d->nama?></td>
                            <td>
                            <a href="<?=$d->alamat?>" target="_blank"><?=$d->alamat?></a>
                            </td>
                            
                            <td>
                                <center><img src="<?=base_url()?>assets/img/<?=$d->icon?>" alt="<?=$d->icon?>" style="width:80px;height:100px;"></center>
                            </td>
                            <td><?=$d->keterangan?></td>
                            <td>
                                <a class="btn btn-action btn-primary" href="<?=base_url()?>admin/ubah/<?=$d->id?>">
                                    <i class="ti ti-pencil-alt"></i>
                                </a>
                                <a class="btn btn-action btn-danger btn-delete" href="<?=base_url()?>admin/hapus/<?=$d->id?>">
                                    <i class="ti ti-trash"></i>
                                </a>    
                            </td>
                            
                        </tr>
                        <?php
                            }
                        }
                        ?>
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>


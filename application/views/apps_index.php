
<div class="row">
    <div class="col-md-12">
    
        <div class="card">
            <div class="card-header">
                <h3><strong>List Aplikasi</strong></h3>
               
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    if(!empty($data)){
                        foreach($data as $d){
                    ?>
                    <div class="col-lg-3 col-sm-6">
                        <a href="<?=$d->alamat?>" target="_blank">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><center><?=$d->nama?></center></h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <img src="<?=base_url()?>assets/img/<?=$d->icon?>" alt="<?=$d->icon?>" style="width:200px;height:250px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <center>
                                        <a href="<?=$d->alamat?>" target="_blank" class="btn btn-sm btn-danger" style="margin-bottom:30px;">Kunjungi</a>
                                    </center>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                    
                    
                </div>
                
                
            </div>
        </div>
    </div>
</div>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" action="<?php echo $url_aksi; ?>">
				
				<div class="form-group row">
					<label class="col-sm-4 col-form-label pr-sm-0 text-sm-right">
						<span class="text-danger">*</span> Nama Pengguna
					</label>
					<div class="col-sm-6 pr-sm-0">
						<input type="text" class="form-control" name="nama">
					</div>
				</div>
                <div class="form-group row">
					<label class="col-sm-4 col-form-label pr-sm-0 text-sm-right">
						<span class="text-danger">*</span> Password
					</label>
					<div class="col-sm-6 pr-sm-0">
						<input type="password" class="form-control" name="password">
					</div>
				</div>
                
                
				<div class="form-group row">
					<label class="col-sm-4 col-form-label pr-sm-0 text-sm-right">&nbsp;</label>
					<div class="col-sm-6 pr-sm-0">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</div>
			</form>
            </div>
        </div>
    </div>
</div>

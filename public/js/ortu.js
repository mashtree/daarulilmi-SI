//grid table
$(function () {
	var grid = $("#t_table").bootgrid({
		/*ajax: true,
		post: function ()
		{
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		url: "http://localhost/daarulilmi-SI/ortu/databasic/json",*/
		formatters: {
			"nm_ortu_wali": function(column,row)
			{
				return "<button type=\"button\" class=\"btn btn-default btn-xs command-open blue\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"Detil\"><span class=\"glyphicon glyphicon-folder-open\" aria-hidden=\"true\"></span></button> "+row.nm_ortu_wali;
			},
			"commands": function(column, row)
			{
				var action = "<div class=\"btn-group\" role=\"group\" aria-label=\"...\">";
					action += "<button type=\"button\" class=\"btn btn-default btn-xs command-contact\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"Kontak\"><span class=\"glyphicon glyphicon-phone-alt\" aria-hidden=\"true\"></span></button> ";
					action += "<button type=\"button\" class=\"btn btn-default btn-xs command-edit green\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"Ubah\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span></button> ";
					action += "<button type=\"button\" class=\"btn btn-default btn-xs command-delete red\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"Hapus\" class=\"confirm\" dilink=\"ortu/remove_ortu/"+row.id+"\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></button> ";
					action += "</div>";

					return action;
			}
		}
	}).on("loaded.rs.jquery.bootgrid", function()
	{
		/* Executes after data is loaded and rendered */
		grid.find(".command-edit").on("click", function(e) //edit data
		{
			//alert("You pressed edit on row: " + $(this).data("row-id"));
			e.preventDefault(); 
			edit($(this));
			
		}).end().find(".command-delete").on("click", function(e)
		{
			var link = $(this).attr("dilink"); // "get" the intended link in a var
			console.log(link);
			e.preventDefault();    
			bootbox.confirm("Anda yakin akan menghapus data ini?", function(result) {    
				if (result) {
					document.location.href = link;  // if result, "set" the document location					
				}    
			});
		}).end().find(".command-contact").on("click",function(e){
			e.preventDefault();
			contact($(this));
		})
		.end().find(".command-open").on("click",function(e){
			e.preventDefault();
			detil($(this));
		});
	});
	$('[data-toggle="tooltip"]').tooltip();
});

//create data
$(document).on("click",".rekam",function(e){
	e.preventDefault();    
	rekam();
		
});

// form rekam
var rekam = function(){
	bootbox.dialog({
        title: "Rekam Data Orang Tua Wali",
        size:'large',
        message: '<form class="form-horizontal" id="rekam" enctype="multipart/form-data"> ' +
        	'<div class="row" id="modal">  ' +
            '<div class="col-md-6"> ' +
            
            '<div class="form-group">'+
			'<label class="col-md-4 control-label" for="kat_ortu_wali">Kategori</label> ' +
            '<div class="col-md-6"> ' +
            '<select id="kat_ortu_wali" name="kat_ortu_wali" class="form-control input-md">' +
			
			'</select>' +
			'</div>' +
			'</div>' +
            '<div class="form-group"> ' +
            '<label class="col-md-4 control-label" for="nm_ortu_wali">Nama</label> ' +
            '<div class="col-md-8"> ' +
            '<input id="nm_ortu_wali" name="nm_ortu_wali" type="text" placeholder="Nama" class="form-control input-md"> </div>' +
            //'<span class="help-block">Here goes your name</span> </div> ' +
            '</div> ' +
            '<div class="form-group"> ' +
            '<label class="col-md-4 control-label" for="nik">NIK</label> ' +
            '<div class="col-md-8"> ' +
            '<input id="nik" name="nik" type="text" placeholder="Nomor Induk Kependudukan" class="form-control input-md"> </div>' +
            //'<span class="help-block">Here goes your name</span> </div> ' +
            '</div> ' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="tmp_lahir">Tempat Lahir</label> ' +
            '<div class="col-md-6"> ' +
            '<input id="tmp_lahir" name="tmp_lahir" type="text" placeholder="Tempat Lahir" class="form-control input-md"> </div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="tgl_lahir">Tanggal Lahir</label> ' +
            '<div class="col-md-4"> ' +
            '<input id="tgl_lahir" name="tgl_lahir" type="text" placeholder="Tanggal Lahir" class="form-control input-md" readonly> </div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="alamat_rumah">Alamat</label> ' +
            '<div class="col-md-8"> ' +
            '<textarea id="alamat_rumah" name="alamat_rumah" placeholder="Alamat" class="form-control input-md" rows="6"></textarea> </div>' +
			'</div>' +
			'</div>' + //end of left side form
			'<div class="col-md-6"> ' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="agama">Agama</label> ' +
            '<div class="col-md-6"> ' +
            '<select id="agama" name="agama" class="form-control input-md">' +
			
			'</select>' +
			'</div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="asal_daerah_suku">Suku</label> ' +
            '<div class="col-md-8"> ' +
            '<input id="asal_daerah_suku" name="asal_daerah_suku" type="text" placeholder="Asal Daerah / Suku" class="form-control input-md" > </div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="bahasa">Bahasa</label> ' +
            '<div class="col-md-8"> ' +
            '<input id="bahasa" name="bahasa" type="text" placeholder="Tanggal Lahir" class="form-control input-md"> </div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="pendidikan">Pendidikan</label> ' +
            '<div class="col-md-6"> ' +
            '<select id="pendidikan" name="pendidikan" class="form-control input-md">' +
			
			'</select>' +
			'</div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="pekerjaan">Pekerjaan</label> ' +
            '<div class="col-md-6"> ' +
            '<select id="pekerjaan" name="pekerjaan" class="form-control input-md">' +
			
			'</select>' +
			'</div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="foto">File Foto</label> ' +
            '<div class="col-md-6"> ' +
            '<input id="foto" name="foto" type="file" placeholder="Foto" class="form-control input-md"> </div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="sebagai"></label> ' +
			'<div class="col-md-6"> ' +
			'<button type="button" class="btn btn-primary save pull-right">Save</button>&nbsp;&nbsp;<button type="button" class="btn btn-danger cancel pull-right">Cancel</button>' +
			'</div>' +
			'</div></div>  </div>' +
            '</form> ',
            /*buttons: {
                success: {
                    label: "Save",
                    className: "btn-success save",
                    callback: function () {
                        var name = $('#name').val();
                        //var answer = $("input[name='awesomeness']:checked").val()
                        Message.show("<b>Rekam data " + name + " berhasil! </b>");
                    }
                }
            },*/
			onEscape : true
		});

		$.get('ortu/get_referensi',function(data){
			var data = $.parseJSON(data); console.log(data);
			var kategori = data.kategori;
			var agama = data.agama;
			var pendidikan = data.pendidikan;
			var pekerjaan = data.pekerjaan;
			$.each(kategori, function(key,val){
				$("#kat_ortu_wali").append("<option value="+val.id+">"+val.kat+"</option>");
			});

			$.each(agama, function(key,val){
				$("#agama").append("<option value="+val.id+">"+val.agama+"</option>");
			});

			$.each(pendidikan, function(key,val){
				$("#pendidikan").append("<option value="+val.id+">"+val.pend+"</option>");
			});

			$.each(pekerjaan, function(key,val){
				$("#pekerjaan").append("<option value="+val.id+">"+val.kerja+"</option>");
			});
		});

		$('#tgl_lahir').datetimepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
			//viewMode: 'day',
			viewSelect:"day"
		});

		$(document).on('click','.cancel',function(e){
			var form = $('#rekam');
			form.parents('.bootbox').modal('hide');
		});
} //end of rekam function

//save data create
$(document).on('click','.save', function() {
	var $form = $('#rekam');
	var name = $form.find('[name="name"]').val();
	console.log(name);
	$.ajax({
		url: 'ortu/create',
		method: 'POST',
		data: $form.serialize()
	}).success(function(response) {
		console.log($.parseJSON(response).success);
		//var name = $('#name').val();
		//var answer = $("input[name='awesomeness']:checked").val()
		$form.parents('.bootbox').modal('hide');
		if($.parseJSON(response).success==true){
			Message.show("<b>Rekam data " + name + " berhasil! </b>");
			setTimeout(function(){
			   window.location.reload(1);
			}, 5000);
		}else{
			Message.show("<b style='color:red'>Rekam data " + name + " gagal! periksa kembali isian! </b>");
		}
	});
}); // end of save data create

// form Ubah
var edit = function(row){
	var idortu = row.data("row-id");
	var kategori,nama,nik,tmp_lahir,tgl_lahir,alamat,agama,suku,bahasa,pendidikan,pekerjaan;
	var url = 'ortu/get_by_id/'+idortu; 
	$.ajax({
		url: url,
		method:'POST'
	}).success(function(response){
		var tmp =$.parseJSON(response)[0];
		kategori = tmp.kat_ortu_wali;
		nama = tmp.nm_ortu_wali;
		nik = tmp.nik;
		tmp_lahir = tmp.tmp_lahir;
		tgl_lahir = tmp.tgl_lahir;
		alamat = tmp.alamat_rumah;
		agama = tmp.agama;
		suku = tmp.asal_daerah_suku;
		bahasa = tmp.bahasa;
		pendidikan = tmp.pendidikan;
		pekerjaan = tmp.pekerjaan;
		bootbox.dialog({
			size:'large',
			title: "Ubah Data Orang Tua Wali",
			message: '<form class="form-horizontal" id="ubah" enctype="multipart/form-data"> ' +
			'<input type="hidden" name="id" value="'+tmp.id+'">' +
        	'<div class="row" id="modal">  ' +
            '<div class="col-md-6"> ' +
            '<div class="form-group">'+
			'<label class="col-md-4 control-label" for="kat_ortu_wali">Kategori</label> ' +
            '<div class="col-md-6"> ' +
            '<select id="kat_ortu_wali" name="kat_ortu_wali" class="form-control input-md">' +
			
			'</select>' +
			'</div>' +
			'</div>' +
            '<div class="form-group"> ' +
            '<label class="col-md-4 control-label" for="nm_ortu_wali">Nama</label> ' +
            '<div class="col-md-8"> ' +
            '<input id="nm_ortu_wali" name="nm_ortu_wali" type="text" placeholder="Nama" class="form-control input-md" value="'+nama+'"> </div>' +
            //'<span class="help-block">Here goes your name</span> </div> ' +
            '</div> ' +
            '<div class="form-group"> ' +
            '<label class="col-md-4 control-label" for="nik">NIK</label> ' +
            '<div class="col-md-8"> ' +
            '<input id="nik" name="nik" type="text" placeholder="Nomor Induk Kependudukan" class="form-control input-md" value="'+nik+'"> </div>' +
            //'<span class="help-block">Here goes your name</span> </div> ' +
            '</div> ' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="tmp_lahir">Tempat Lahir</label> ' +
            '<div class="col-md-6"> ' +
            '<input id="tmp_lahir" name="tmp_lahir" type="text" placeholder="Tempat Lahir" class="form-control input-md" value="'+tmp_lahir+'"> </div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="tgl_lahir">Tanggal Lahir</label> ' +
            '<div class="col-md-4"> ' +
            '<input id="tgl_lahir" name="tgl_lahir" type="text" placeholder="Tanggal Lahir" class="form-control input-md"  value="'+tgl_lahir+'" readonly> </div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="alamat_rumah">Alamat</label> ' +
            '<div class="col-md-8"> ' +
            '<textarea id="alamat_rumah" name="alamat_rumah" placeholder="Alamat" class="form-control input-md" rows="6">"'+alamat+'"</textarea> </div>' +
			'</div>' +
			'</div>' + //end of left side form
			'<div class="col-md-6"> ' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="agama">Agama</label> ' +
            '<div class="col-md-6"> ' +
            '<select id="agama" name="agama" class="form-control input-md">' +
			
			'</select>' +
			'</div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="asal_daerah_suku">Suku</label> ' +
            '<div class="col-md-8"> ' +
            '<input id="asal_daerah_suku" name="asal_daerah_suku" type="text" placeholder="Asal Daerah / Suku" class="form-control input-md"  value="'+suku+'"> </div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="bahasa">Bahasa</label> ' +
            '<div class="col-md-8"> ' +
            '<input id="bahasa" name="bahasa" type="text" placeholder="Bahasa" class="form-control input-md" value="'+bahasa+'"> </div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="pendidikan">Pendidikan</label> ' +
            '<div class="col-md-6"> ' +
            '<select id="pendidikan" name="pendidikan" class="form-control input-md">' +
			
			'</select>' +
			'</div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="pekerjaan">Pekerjaan</label> ' +
            '<div class="col-md-6"> ' +
            '<select id="pekerjaan" name="pekerjaan" class="form-control input-md">' +
			
			'</select>' +
			'</div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="foto">File Foto</label> ' +
            '<div class="col-md-6"> ' +
            '<input id="foto" name="foto" type="file" placeholder="Foto" class="form-control input-md"> </div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="sebagai"></label> ' +
			'<div class="col-md-6"> ' +
			'<button type="button" class="btn btn-primary save_edit pull-right">Save</button>' +
			'</div>' +
			'</div></div>  </div>' +
            '</form> ',
			/*buttons: {
				success: {
					label: "Save",
					className: "btn-success save",
					callback: function () {
						var name = $('#name').val();
						//var answer = $("input[name='awesomeness']:checked").val()
						Message.show("<b>Rekam data " + name + " berhasil! </b>");
					}
				}
			},*/
			onEscape : true
		});
		
		$.get('ortu/get_referensi',function(data){
			var data = $.parseJSON(data); //console.log(data);
			var kategoris = data.kategori;
			var agamas = data.agama;
			var pendidikans = data.pendidikan;
			var pekerjaans = data.pekerjaan;
			$.each(kategoris, function(key,val){
				var option = "<option value="+val.id;
				if(val.id==kategori) option += " selected";
				option += ">"+val.kat+"</option>";
				$("#kat_ortu_wali").append(option);
			});

			$.each(agamas, function(key,val){
				var option = "<option value="+val.id;
				if(val.id==agama) option += " selected";
				option += ">"+val.agama+"</option>";
				$("#agama").append(option);
			});

			$.each(pendidikans, function(key,val){
				var option = "<option value="+val.id;
				if(val.id==pendidikan) option += " selected";
				option += ">"+val.pend+"</option>";
				$("#pendidikan").append(option);
			});

			$.each(pekerjaans, function(key,val){
				var option = "<option value="+val.id;
				if(val.id==pekerjaan) option += " selected";
				option += ">"+val.kerja+"</option>";
				$("#pekerjaan").append(option);
			});
		});

		$('#tgl_lahir').datetimepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
			viewMode: 'years',
		});
	});
} // end of form ubah

//save data update
$(document).on('click','.save_edit', function() {
	var $form = $('#ubah');
	var id = $form.find('[name="id"]').val();
	var name = $form.find('[name="nm_ortu_wali"]').val();
	$.ajax({
		url: 'ortu/update/'+id,
		method: 'POST',
		data: $form.serialize()
	}).success(function(response) {
		console.log($.parseJSON(response));
		//var name = $('#name').val();
		//var answer = $("input[name='awesomeness']:checked").val()
		$form.parents('.bootbox').modal('hide');
		if($.parseJSON(response).success==true){
			Message.show("<b>Ubah data " + name + " berhasil! </b>");
			setTimeout(function(){
			   window.location.reload(1);
			}, 5000);
		}else{
			Message.show("<b style='color:red'>Ubah data " + name + " gagal! periksa kembali isian! </b>");
		}
	});
}); //end of save data update

// dialog detil ortu
var detil = function(row){
	var idortu = row.data('row-id');
	var url = 'ortu/get_detil_ortu/'+idortu;
	$.ajax({
		url:url,
		method:'POST'
	}).success(function(response){
		var tmp= $.parseJSON(response);
		var data = tmp.data.data; console.log(data);
		var kontak = ''; 
		$.each(tmp.kontak.data,function(key,val){
			kontak += '<li class="list-group-item"><i class="fa fa-'+val.tipe.tipe+' "></i> '+val.kontak+'</li>';
		});

		var siswa = '';
		$.each(tmp.siswa.data,function(key,val){
			siswa += '<li class="list-group-item"><i>nama : </i><b>'+val.nm_lengkap+'</b> <i>kelas : </i>'+val.nm_kelas+'</li>';
		});
		
		bootbox.dialog({
			size:'large',
			title:'Data Orang Tua Wali',
			message: '<div class="row">  ' +
				'<div class="col-md-4">'+
				'<ul class="list-group">' +
				'<li class="list-group-item active">' +
			    '<h4 class="list-group-item-heading">Foto</h4>' +
			  	'</li>' +
			  	'<li class="list-group-item">' +
				'<img src="'+data.foto+'" alt="..." class="img-thumbnail">'+
				'</li>' +
				'</ul>' +
				'</div>' +
				'<div class="col-md-8">'+
					'<ul class="list-group">' +
					'<li class="list-group-item active">' +
				    '<h4 class="list-group-item-heading">Data Orang Tua / Wali</h4>' +
				  	'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Nama</span>'+data.nm_ortu_wali+'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Status</span>'+data.kat_ortu_wali.kat+'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Tempat Lahir</span>'+data.tmp_lahir+'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Tanggal Lahir</span>'+data.tgl_lahir+'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Alamat</span>'+data.alamat_rumah+'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Pendidikan</span>'+data.pendidikan.pend+'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Pekerjaan</span>'+data.pekerjaan.kerja+'</li>' +
		            '</ul>' +
				'</div>' +
				'</div>' +
				'<div class="row" style="margin-top:10px">  ' +
				'<div class="col-md-6">' +
					'<ul class="list-group">' +
					'<li class="list-group-item active">' +
				    '<h4 class="list-group-item-heading">Data Siswa</h4>' +
				  	'</li>' + siswa +
		            '</ul>' +
				'</div> ' +
				'<div class="col-md-6">' +
					'<ul class="list-group">' +
					'<li class="list-group-item active">' +
				    '<h4 class="list-group-item-heading">Kontak</h4>' +
				  	'</li>' + kontak +
		            '</ul>' +
				'</div>' +
				'</div>',
			buttons: {
				success: {
					label: "OK",
					className: "btn-primary",
					callback: function () {
						//
					}
				}
			},
			onEscape:true
		});
	});
} // end of detil row

// dialog contact
var contact = function(row){
	var idortu = row.data("row-id");
	var url = 'ortu/get_contacts/'+idortu; 
	$.ajax({
		url: url,
		method:'POST'
	}).success(function(response){
		var tmp =$.parseJSON(response)[0];
		//console.log(tmp);
		var kontak = '<li class="list-group-item" style="cursor:pointer"><i class="fa fa-plus-circle blue rekam_contact"  idcontact='+idortu+'></i>Tambah</li>';
		$.each(tmp,function(key,val){
			kontak += '<li class="list-group-item"><i class="fa fa-'+val.tipe.tipe+' green econtact"  style="cursor:pointer"  idcontact='+val.id+'></i> <i class="fa fa-trash red dcontact"  style="cursor:pointer"  idcontact='+val.id+'></i> '+val.kontak+'</li>';
		});
		bootbox.dialog({
			size:'small',
			title: "Data Kontak Orang Tua Wali",
			message: '<div class="row" id="modal-contact">  ' +
            '<div class="col-md-12"> ' +
            '<ul class="list-group">' +
            kontak +
            '</ul>' +
            '</div>  </div>',
			buttons: {
				success: {
					label: "OK",
					className: "btn-primary",
					callback: function () {
						//
					}
				}
			},
			onEscape : true
		});

		//create contacts
		$('.rekam_contact').on("click",function(e){
			e.preventDefault();
			var idcontact = $(this).attr('idcontact');
			//console.log(idcontact);    
			rekam_contact(idcontact);
				
		});

		//edit contacts
		$('.econtact').click(function(e){
			e.preventDefault();
			var idcontact = $(this).attr('idcontact');
			edit_contact(idcontact);
		});

		//delete contact
		$('.dcontact').click(function(e){
			e.preventDefault();
			var id = $(this).attr('idcontact');
			var form = $('#modal-contact');
			var url = 'ortu/delete_contact/'+id;
			bootbox.confirm('Anda yakin akan menghapus data ini?',function(result){
				if(result){
					$.get(url,function(data){
						var result = $.parseJSON(data);
						console.log(result);
						if(result.success==true){
							form.parents('.bootbox').modal('hide');
							Message.show("<b>Hapus data kontak berhasil! </b>");
						}
					})
				}
			});
		})
		
	});
} // end of form ubah


//dialog rekam kontak
var rekam_contact = function(idowner){
	var url = 'ortu/get_referensi';
	var $form = $('#modal-contact');
	
	bootbox.dialog({
		size:'small',
		title:'Rekam Kontak',
		message: '<div class="row">' +
            '<div class="col-md-12">' +
            '<form class="form-vertical" id="rekam_contact" > ' +
        	'<input class="form-control input-md" type="hidden" name="id" value='+idowner+'>' +
            '<div class="form-group">'+
			'<label class="control-label" for="tipe">Kategori</label> ' +
            '<select id="tipe" name="tipe" class="form-control input-md">' +
			
			'</select>' +
			'</div>' +
			'<div class="form-group">' +
			'<label class="control-label" for="val">Kontak</label> ' +
			'<input class="form-control input-md" type="text" name="kontak" placeholder="Nomor ">' +
			'</div>' +
			'<hr/>' +
			'<button type="button" class="btn btn-primary save_contact pull-right">Save</button>' +
			
            '</form> ' +
            '</div></div>',
		
		onEscape:true
	});

	$form.parents('.bootbox').modal('hide');

	$.get(url,function(data){
		var data = $.parseJSON(data); //console.log(data);
		var kontak = data.kontak;
		
		$.each(kontak, function(key,val){
			$("#tipe").append("<option value="+val.id+">"+val.tipe+"</option>");
		});
	});
}

$(document).on('click','.save_contact',function(e){
	e.preventDefault();
	var url = 'ortu/create_contact';
	var $form = $('#rekam_contact');
	$.ajax({
		url:url,
		method:'POST',
		data:$form.serialize()
	}).success(function(response){
		var data = $.parseJSON(response);
		$form.parents('.bootbox').modal('hide');
		if($.parseJSON(response).success==true){
			Message.show("<b>Tambah data kontak berhasil! </b>");
		}else{
			Message.show("<b style='color:red'>Tambah data kontak gagal! </b>");
		}
	});
});

//dialog edit kontak
var edit_contact = function(idcontact){
	var url = 'ortu/get_referensi';
	var url_data = 'ortu/get_contact/'+idcontact;
	var $form = $('#modal-contact');
	
	$.ajax({
		url:url_data,
		method:'POST'
	}).success(function(response){
		var datakontak = $.parseJSON(response);
		//console.log(data);
		bootbox.dialog({
			size:'small',
			title:'Ubah Kontak',
			message: '<div class="row">' +
	            '<div class="col-md-12">' +
	            '<form class="form-vertical" id="ubah_contact" > ' +
	        	'<input class="form-control input-md" type="hidden" name="id" value='+idcontact+'>' +
	            '<div class="form-group">'+
				'<label class="control-label" for="tipe">Kategori</label> ' +
	            '<select id="tipe" name="tipe" class="form-control input-md">' +
				
				'</select>' +
				'</div>' +
				'<div class="form-group">' +
				'<label class="control-label" for="val">Kontak</label> ' +
				'<input class="form-control input-md" type="text" name="kontak" placeholder="Nomor " value="'+datakontak.kontak+'">' +
				'</div>' +
				'<hr/>' +
				'<button type="button" class="btn btn-primary save_edit_contact pull-right">Save</button>' +
				
	            '</form> ' +
	            '</div></div>',
			
			onEscape:true
		});

		$form.parents('.bootbox').modal('hide');

		$.get(url,function(data){
			var data = $.parseJSON(data); //console.log(data);
			var kontak = data.kontak;
			
			$.each(kontak, function(key,val){
				var option = "<option value="+val.id;
				if(val.id==datakontak.tipe_kontak) option += " selected";
				option += ">"+val.tipe+"</option>"
				$("#tipe").append(option);
			});
		});

		$(document).on('click','.save_edit_contact',function(e){
			var form = $('#ubah_contact');
			var data = form.serialize();
			var id = form.find('[name=id]').val();
			var url = 'ortu/update_contact/'+id;
			$.ajax({
				url:url,
				method:'POST',
				data:data
			}).success(function(response){
				form.parents('.bootbox').modal('hide');
				if($.parseJSON(response).success==true){
					Message.show("<b>Ubah data kontak " + name + " berhasil! </b>");
				}else{
					Message.show("<b style='color:red'>Ubah data kontak " + name + " gagal! periksa kembali isian! </b>");
				}
			});
		})
	})
}
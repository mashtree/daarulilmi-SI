
//create data
$(document).on("click",".rekam",function(e){
	e.preventDefault();    
	rekam();
		
});

//save data create
$(document).on('click','.save', function() {
	var $form = $('#rekam');
	var name = $form.find('[name="name"]').val();
	console.log(name);
	$.ajax({
		url: 'kar/create_kar',
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
});

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
		url: "http://localhost/daarulilmi-SI/kar/databasic/json",*/
		formatters: {
			"nama": function(column,row)
			{
				return "<button type=\"button\" class=\"btn btn-default btn-xs command-open blue\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"Detil\"><span class=\"glyphicon glyphicon-folder-open\" aria-hidden=\"true\"></span></button> "+row.nama;
			},
			"commands": function(column, row)
			{
				var action = "<div class=\"btn-group\" role=\"group\" aria-label=\"...\">";
					action += "<button type=\"button\" class=\"btn btn-default btn-xs command-contact\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"Kontak\"><span class=\"glyphicon glyphicon-phone-alt\" aria-hidden=\"true\"></span></button> ";
					action += "<button type=\"button\" class=\"btn btn-default btn-xs command-edit green\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"Ubah\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span></button> ";
					action += "<button type=\"button\" class=\"btn btn-default btn-xs command-delete red\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"Hapus\" class=\"confirm\" dilink=\"kar/remove_kar/"+row.id+"\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></button> ";
					if(row.jabatan!='guru'){
						action += "<button type=\"button\" class=\"btn btn-default btn-xs command-guru\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"Rekam sebagai guru\" dilink=\"kar/update_kar_guru/"+row.id+"\"><span class=\"glyphicon glyphicon-education\" aria-hidden=\"true\"></span></button> ";
					}
					if(row.aktif=='0'){
						action += "<button type=\"button\" class=\"btn btn-default btn-xs command-aktif red\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"tidak aktif\" dilink=\"kar/kar_aktif/"+row.id+"\" diaktif="+row.aktif+"><span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span></button> ";
					}else{
						action += "<button type=\"button\" class=\"btn btn-default btn-xs command-aktif blue\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"aktif\" dilink=\"kar/kar_aktif/"+row.id+"\"  diaktif="+row.aktif+"><span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span></button> ";
					}
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
		}).end().find(".command-guru").on("click",function(e)
		{
			var link = $(this).attr("dilink"); // "get" the intended link in a var
			console.log(link);
			e.preventDefault();    
			bootbox.confirm("Anda yakin akan mencatat karyawan ini dalam jabatan Guru?", function(result) {    
				if (result) {
					document.location.href = link;  // if result, "set" the document location					
				}    
			});
		}).end().find(".command-open").on("click",function(e){
			e.preventDefault(); 
			open($(this));
		}).end().find(".command-aktif").on("click",function(e){
			var aktif = $(this).attr("diaktif");console.log(aktif);
			var link = $(this).attr("dilink");console.log(link);
			var message = "";
			e.preventDefault();
			if(aktif==0){
				message = "Karyawan ini akan diaktifkan?";
			}else{
				message = "Karyawan ini akan dinonaktifkan?";
			}
			bootbox.confirm(message, function(result) {    
				if (result) {
					document.location.href = link;  // if result, "set" the document location					
				}    
			});
		}).end().find(".command-contact").on("click",function(e){
			e.preventDefault();
			contact($(this));
		});
	});
	$('[data-toggle="tooltip"]').tooltip();
});

//save data update
$(document).on('click','.save_edit', function() {
	var $form = $('#ubah');
	var id = $form.find('[name="id"]').val();
	var name = $form.find('[name="name"]').val();
	$.ajax({
		url: 'kar/update_kar/'+id,
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
});

var rekam = function(){
	bootbox.dialog({
        title: "Rekam Karyawan",
        message: '<div class="row" id="modal">  ' +
            '<div class="col-md-12"> ' +
            '<form class="form-horizontal" id="rekam" enctype="multipart/form-data"> ' +
            '<div class="form-group"> ' +
            '<label class="col-md-4 control-label" for="name">Name</label> ' +
            '<div class="col-md-6"> ' +
            '<input id="name" name="name" type="text" placeholder="Nama Karyawan" class="form-control input-md"> </div>' +
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
			'<label class="col-md-4 control-label" for="tgl_lahir">Tanggal Lahir</label> ' +
            '<div class="col-md-8"> ' +
            '<textarea id="alamat" name="alamat" placeholder="Alamat" class="form-control input-md" rows="6"></textarea> </div>' +
			'</div>' +
			'<div class="form-group">'+
			'<label class="col-md-4 control-label" for="sebagai">Jabatan</label> ' +
            '<div class="col-md-6"> ' +
            '<select id="sebagai" name="sebagai" class="form-control input-md">' +
			
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
			'<div class="col-md-12"> ' +
			'<button type="button" class="btn btn-primary save pull-right">Save</button>' +
			'</div>' +
			'</div>' +
            '</form> </div>  </div>',
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
		$.get('kar/get_jabatan',function(data){
			var data = $.parseJSON(data);
			$.each(data, function(key,val){
				$("#sebagai").append("<option value="+val.id+">"+val.jab+"</option>");
			});
		});
		$('#tgl_lahir').datetimepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
			//viewMode: 'day',
			viewSelect:"day"
	});
}

var edit = function(row){
	var idkar = row.data("row-id");
	var nama,tmp_lahir, tgl_lahir, alamat, sebagai;
	var url = 'kar/get_by_id/'+idkar;
	$.ajax({
		url: url,
		method:'POST'
	}).success(function(response){
		var tmp =$.parseJSON(response)[0];
		nama = tmp.nm_karyawan;
		tmp_lahir = tmp.tmp_lahir;
		tgl_lahir = tmp.tgl_lahir;
		alamat = tmp.alamat;
		sebagai = tmp.sebagai;
		bootbox.dialog({
			title: "Ubah Data Karyawan",
			message: '<div class="row">  ' +
				'<div class="col-md-12"> ' +
				'<form class="form-horizontal" id="ubah" enctype="multipart/form-data"> ' +
				'<div class="form-group">'+
				'<div class="col-md-6"> ' +
				'<input id="id" name="id" type="hidden" class="form-control input-md" value="'+tmp.id+'"> </div>' +
				'</div>' +
				'<div class="form-group"> ' +
				'<label class="col-md-4 control-label" for="name">Name</label> ' +
				'<div class="col-md-6"> ' +
				'<input id="name" name="name" type="text" placeholder="Nama Karyawan" class="form-control input-md" value="'+nama+'"> </div>' +
				'</div> ' +
				'<div class="form-group">'+
				'<label class="col-md-4 control-label" for="tmp_lahir">Tempat Lahir</label> ' +
				'<div class="col-md-6"> ' +
				'<input id="tmp_lahir" name="tmp_lahir" type="text" placeholder="Tempat Lahir" class="form-control input-md" value="'+tmp_lahir+'"> </div>' +
				'</div>' +
				'<div class="form-group">'+
				'<label class="col-md-4 control-label" for="tgl_lahir">Tanggal Lahir</label> ' +
				'<div class="col-md-4"> ' +
				'<input id="tgl_lahir" name="tgl_lahir" type="text" placeholder="Tanggal Lahir" class="form-control input-md" readonly  value="'+tgl_lahir+'"> </div>' +
				'</div>' +
				'<div class="form-group">'+
				'<label class="col-md-4 control-label" for="tgl_lahir">Tanggal Lahir</label> ' +
				'<div class="col-md-8"> ' +
				'<textarea id="alamat" name="alamat" placeholder="Alamat" class="form-control input-md" rows="6">'+alamat+'</textarea> </div>' +
				'</div>' +
				'<div class="form-group">'+
				'<label class="col-md-4 control-label" for="sebagai">Jabatan</label> ' +
				'<div class="col-md-6"> ' +
				'<select id="sebagai" name="sebagai" class="form-control input-md">' +
				
				'</select>' +
				'</div>' +
				'</div>' +
				'<div class="form-group">'+
				'<label class="col-md-4 control-label" for="foto">File Foto</label> ' +
				'<div class="col-md-6"> ' +
				'<input id="foto" name="foto" type="file" placeholder="Foto" class="form-control input-md"> </div>' +
				'</div>' +
				'<div class="form-group">'+
				'<label class="col-md-4 control-label" for="submit"></label> ' +
				'<div class="col-md-12">' +
				'<button type="button" class="btn btn-primary save_edit pull-right">Save</button>' +
				'</div>' +
				'</div>' +
				'</form> </div>  </div>',
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
		$.get('kar/get_jabatan',function(data){
			var data = $.parseJSON(data);
			$.each(data, function(key,val){
				var option = "<option value="+val.id+"";
				if(sebagai==val.id) option +=" selected";
				option += ">"+val.jab+"</option>"
				$("#sebagai").append(option);
			});
		});
		$('#tgl_lahir').datetimepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
			viewMode: 'years',
		});
	});
}

var open = function(row){
	 
	var idkar = row.data("row-id");
	var nama,tmp_lahir, tgl_lahir, alamat, sebagai;
	var url = 'kar/get_by_id/'+idkar;
	$.ajax({
		url: url,
		method:'POST'
	}).success(function(response){
		var tmp =$.parseJSON(response)[0];
		var detgur = '';
		if(tmp.sebagai==2){
			//detgur= //'<div class="row">  ' +
				//'<div class="col-md-3"></div> ' +
				//'<div class="col-md-6">'
			detgur=	'<a class="detgur" style="cursor:pointer" idkar='+idkar+' nmkar='+tmp.nm_karyawan+'><span>[data guru]</span></a>'; //'</div>' +
				//'<div class="col-md-3"></div>' +
				//'</div>';
		}
		var message = '<div class="row">  ' +
				'<div class="col-md-4">' +
				'<ul class="list-group">' +
				'<li class="list-group-item active">' +
			    '<h4 class="list-group-item-heading">Foto</h4>' +
			  	'</li>' +
			  	'<li class="list-group-item">' +
				'<img src="public/image/nopict.jpg" alt="..." class="img-thumbnail">'+
				'</li>' +
				'</ul>' + 
				'</div>' +
				'<div class="col-md-8"' +
				'<ul class="list-group">' +
					'<li class="list-group-item active">' +
				    '<h4 class="list-group-item-heading">Data Karyawan</h4>' +
				  	'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Nama</span>'+tmp.nm_karyawan+'</li>' +
		            '<li class="list-group-item"><span class="dlabel">No Induk</span>'+tmp.no_induk+'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Tempat Lahir</span>'+tmp.tmp_lahir+'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Tanggal Lahir</span>'+tmp.tgl_lahir+'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Alamat</span>'+tmp.alamat+'</li>' +
		            '<li class="list-group-item"><span class="dlabel">Jabatan</span>'+tmp.jabatan+' '+detgur +'</li>' +
	            '</ul>' +
				'</div>' +
				'</div>';
		bootbox.dialog({
			size:'large',
			title: "Detil Karyawan",
			message: message,
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
		
		$(".detgur").on("click",function(e){
			e.preventDefault();
			var idkar = $(this).attr("idkar");
			var nmkar = $(this).attr("nmkar");
			dataguru(idkar,nmkar);
		})
	});
}

var dataguru = function(idkar,nmkar){
	$.ajax({
		url:"kar/get_detil_guru/"+idkar,
		method:'POST',
	}).success(function(response){
		var tmp = $.parseJSON(response);
		var pendidikan,pengalaman, wali,pengampu;
		if(tmp.pendidikan.size>0) {
			pendidikan = '<ul class="list-group">'
			for(var i in tmp.pendidikan.data){
				pendidikan += '<li class="list-group-item">'+i.tingkat+' '+i.nm_lembaga+' '+i.thn_lulus+'</li>';
			}
			pendidikan += '</ul>';
		}else{
			pendidikan = '<span style="text-align:center">DATA TIDAK DITEMUKAN</span>';
		}

		if(tmp.pengalaman.size>0) {
			pengalaman = '<ul class="list-group">'
			for(var i in tmp.pengalaman.data){
				pengalaman += '<li class="list-group-item">'+i.lembaga+' '+i.thn_awal+' '+i.thn_akhir+' '+i.jabatan+'</li>';
			}
			pengalaman += '</ul>';
		}else{
			pengalaman = '<span style="text-align:center">DATA TIDAK DITEMUKAN</span>';
		}

		if(tmp.wali.size>0) {
			wali = '<ul class="list-group">'
			for(var i in tmp.wali.data){
				wali += '<li class="list-group-item">'+i.nm_kelas+'</li>';
			}
			wali += '</ul>';
		}else{
			wali = '<span style="text-align:center">DATA TIDAK DITEMUKAN</span>';
		}

		if(tmp.pengampu.size>0) {
			pengampu = '<ul class="list-group">'
			for(var i in tmp.pengampu.data){
				pengampu += '<li class="list-group-item">'+i.mapel+' '+i.nm_kelas+'</li>';
			}
			pengampu += '</ul>';
		}else{
			pengampu = '<span style="text-align:center">DATA TIDAK DITEMUKAN</span>';
		}

		var message = '<div class="rinci_guru">' +
				//'<div class="col-md-12">'
				  '<!-- Nav tabs -->'+
				  '<ul class="nav nav-tabs" role="tablist">'+
				    '<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Penugasan</a></li>'+
				    '<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>'+
				  '</ul>'+

				  '<!-- Tab panes -->'+
				  '<div class="tab-content">'+
				    '<div role="tabpanel" class="tab-pane active" id="home">' +
					    '<div class="row">'+
					    '<div class="col-md-6">' +
					    	'<ul class="list-group">'+
					    	'<li class="list-group-item active">Wali Kelas</li>' +
						    	wali +
						    '</ul>'+
					    '</div>'+
					    '<div class="col-md-6">'+
					    	'<ul class="list-group">'+
					    	'<li class="list-group-item active">Pengampu</li>' +
						    	pengampu +
						    '</ul>'+
					    '</div>'+
					  	'</div>'+ //row
					  	
					'</div>'+ //tabpanel
					'<div role="tabpanel" class="tab-pane" id="profile">'+
					    '<div class="row">'+
					    '<div class="col-md-6">'+
					    '<ul class="list-group">'+
					    	'<li class="list-group-item active">Pendidikan</li>' +
						    	pendidikan +
						    
					    '</ul>'+
					    '</div>' +
					    '<div class="col-md-6">'+
					    	'<ul class="list-group">'+
					    	'<li class="list-group-item active">Pengalaman Kerja</li>' +
						    	pengalaman +
						    
					    '</ul>'+
					    '</div>'+ 
					  	'</div>'+ //row
				  	
				    '</div>'+ //tabpanel
				 '</div>'+ //tab content
			  	//	'</div>'+ 
				//'</div>' +
				'<div class="row">'+
				'<div class="col-md-12">' +
				'<button class="btn btn-primary ok pull-right">OK</button>'
				'</div>'+
				'</div>'+
				'</div>';
		bootbox.dialog({
			title:"Data Guru : "+nmkar,
			message:message,
			size:"large",
			button:{
				success:{
					label:"OK",
					className:"btn-primary",
					callback:function(){
						//
					}
				}
			},
			onEscape:true
		});

		$(document).on('click','.ok',function(e){
			e.preventDefault();
			$div = $('.rinci_guru');
			$div.parents('.bootbox').modal('hide');
		});
	});
}

//kontak

// dialog contact
var contact = function(row){
	var idkar = row.data("row-id");
	var url = 'kar/get_contacts/'+idkar; 
	$.ajax({
		url: url,
		method:'POST'
	}).success(function(response){
		var tmp =$.parseJSON(response)[0];
		//console.log(tmp);
		var kontak = '<li class="list-group-item" style="cursor:pointer"><i class="fa fa-plus-circle blue rekam_contact"  idcontact='+idkar+'></i>Tambah</li>';
		$.each(tmp,function(key,val){
			kontak += '<li class="list-group-item"><i class="fa fa-'+val.tipe.tipe+' green econtact"  style="cursor:pointer"  idcontact='+val.id+'></i> <i class="fa fa-trash red dcontact"  style="cursor:pointer"  idcontact='+val.id+'></i> '+val.kontak+'</li>';
		});
		bootbox.dialog({
			size:'small',
			title: "Data Kontak Karyawan",
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
			var url = 'kar/delete_contact/'+id;
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
	var url = 'kar/get_referensi';
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
	var url = 'kar/create_contact';
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
	var url = 'kar/get_referensi';
	var url_data = 'kar/get_contact/'+idcontact;
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
			var url = 'kar/update_contact/'+id;
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


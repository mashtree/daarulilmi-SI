<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="opiq">
	<meta name="description" content="Organize Project in Queue">
	<title>Cak Opiq</title>
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="css/demo.css">
	
	<style type="text/css">
	#fm{
		margin:0;
		padding:10px 30px;
	}
	.ftitle{
		font-size:14px;
		font-weight:bold;
		padding:5px 0;
		margin-bottom:10px;
		border-bottom:1px solid #ccc;
	}
	.fitem{
		margin-bottom:5px;
	}
	.fitem label{
		display:inline-block;
		width:80px;
	}
	.datagrid-val.Remark_Progress{
		white-space: pre-line;
	}
	.datagrid-key{
	border-style: solid;
	border-width: thin;
	font-weight: bold;
	background-color: rgb(255, 231, 231);
	}
		
	.datagrid-val{
	  border-style: solid;
	  border-width: thin;
	  background-color: rgb(255, 255, 255);
	}
		
	#rowdetail{
	background-color: #C2FCF7;
	font-style: italic;
	border-radius: 8px;
	padding: 2px;
	}
	
	.tombol{
	  padding: 4px;
	  border: antiquewhite;
	  border-style: solid;
	  border-radius: 10px;
	  background-color: rgb(255, 10, 10);
	  font-weight: bold;
	  color: white;
	}
    </style>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
        <script type="text/javascript" src="http://www.jeasyui.com/easyui/plugins/jquery.datebox.js"></script>
	<script type="text/javascript" src="js/columnView.js"></script>
	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>

</head>


<body>
    <table id="tt" class="easyui-datagrid" style="width:98%;"
            url="dg_siswa/ds_siswa"
            title="Belajar Bersama Orang Tua | Sekolah Daarul Ilmi Depok" iconCls="icon-search" toolbar="#tb"
            rownumbers="true" pagination="true">
        <thead frozen="true">
            <tr>
                <th field="id_bbo" width="80">ID_BBO</th>
		<th field="id_cost_ctgr" width="80">category</th>
                <th field="judul" width="280">Judul</th>
            </tr>
        </thead>
        <thead>
            <tr>
		<th field="descr" width="280">Deskripsi</th>
		<th field="durasi" width="80">Durasi</th>
                <th field="Lokasi" width="80" align="center"> Lokasi</th>
                <th field="tgl_plan" width="75" align="center" > Tanggal rencana </th>
                <th field="tgl_executed" width="80" > Tgl Exekusi</th>
                <th field="start_time" width="80" >Tgl Mulai Pakai</th>
                <th field="end_time" width="80" > Tgl Akhir Pakai</th>
                <th field="tgl_commit" width="75" align="center" >tgl di commit</th>
                <th field="tgl_expired" width="80" > Tgl Expired</th>
                <th field="bobot" width="80" > Kriteria Bobot</th>
                <th field="nilai" width="80" > Kriteria Nilai</th>
                <th field="creator" width="135" align="center" sortable="true">pembuat</th>
                <th field="approved" width="80" align="center"> Disetujui</th>
                <th field="color" width="75" > Warna</th>
                <th field="Remark" width="105"> Keterangan</th>
            </tr>
        </thead>
    </table>
	<div style="padding-top:10px">
	<table id="trackerList"  style="width:98%; "
	title="Track Record List for expanded row" rownumbers="true" pagination="true">

	<thead>
            <th field="tracker">Tracker</th>
            <th field="subject">Subject</th>
            <th field="deskripsi">Description</th>
            <th field="start_date">START_date</th>
            <th field="status">Status</th>
            <th field="pemain">Assignees</th>
            <th field="remind_at">Created_on</th>
	</thead>
	</table>
	
	
    <div id="tb" style="padding:3px">

        <div style="padding:5px;border:1px solid #ddd">
            <a href="#" class="easyui-linkbutton" data-options="plain:true">OPiQ</a>
            <a href="#" class="easyui-menubutton" data-options="menu:'#mm10'">View</a>
            <a href="#" class="easyui-menubutton" data-options="menu:'#mm7',iconCls:'icon-edit'">on Multiple Selection</a>
            <a href="javascript:void();" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="drawTable()" id="property"> Detail Info </a>
            <a href="login_hop.php?logout" class="easyui-linkbutton">Logout</a>
            <a href="#" class="easyui-menubutton" data-options="menu:'#mm2',iconCls:'icon-help'">Help</a>
        </div>
        
        <div id="mm7" style="width:150px;">
            <div onclick="drawonmap()">Draw on Map</div>
            <div>Get Calendar</div>
            <div>Assign view to: </div>

            <div class="menu-sep"></div>
            <div>
                <span>Set Gap Analysis</span>
                <div style="width:250px;">
                    <div onclick="multiSet('siswa','status','aman1')">Status: Comcase</div>
                    <div onclick="multiSet('siswa','status','aman2')">Access: Permit</div>
                    <div onclick="multiSet('siswa','status','aman3')">Access: NIW</div>
                    <div onclick="multiSet('siswa','status','aman4')">Access: TLP - CAF Approval</div>
                    <div onclick="multiSet('siswa','status','aman5')">Access: TMG - TSSR Approval</div>
                    <div onclick="multiSet('siswa','status','aman6')">CME: Not RFI</div>
                    <div onclick="multiSet('siswa','status','aman7')">CME: Strengthenning</div>
                    <div onclick="multiSet('siswa','status','aman8')">CME: Proposed Drop</div>
                    <div class="menu-sep"></div>
                    <div>New Toolbar...</div>
                </div>
            </div>
            <div>
                <span>set Row Color</span>
                <div style="width:250px;">
                    <div onclick="setProgressColor('Blue')">Blue</div>
                    <div onclick="setProgressColor('Orange')">Orange</div>
                    <div onclick="setProgressColor('Red')">Red</div>
                    <div onclick="setProgressColor('Yellow')">Yellow</div>
                    <div onclick="setProgressColor('Pink')">Pink</div>
                    <div onclick="setProgressColor('Black')">Black</div>
                </div>
            </div>
            <div>
                <span>set Map Line Color</span>
                <div style="width:250px;">
                    <div onclick="setStrokeColor('Blue')">Blue</div>
                    <div onclick="setStrokeColor('Orange')">Orange</div>
                    <div onclick="setStrokeColor('Red')">Red</div>
                    <div onclick="setStrokeColor('Yellow')">Yellow</div>
                    <div onclick="setStrokeColor('Pink')">Pink</div>
                    <div onclick="setStrokeColor('Black')">Black</div>
                </div>
            </div>


        </div>

        <div id="mm10" style="width:200px;">
            <div><a href="calendar">Kalender</a></div>
            <div onclick="open_chart()">Summary Last Milestone Distribution Chart</div>
            <div><a href="stacked_bar">Stacked Bar Chart of Progress</a></div>
            <div><a href="running_act">Running Rate Actifity Chart</a></div>
            <div onclick="">Graph Trend of Daily Progress</div>
            <div class="menu-sep"></div>
            <div><a href="csv_export">CSV file exporter</a></div>
            <div class="menu-sep"></div>
            <div><a href="general_info">General Info</a></div>
            <div><a href="RiskRegister.html">RISK Register</a></div>
	    <!-- div><a href="gantt">GANTT Chart</a></div -->
		 
            <div>
                <span>Change Column View</span>
                <div style="width:150px;">
                    <div onclick="changeBaseline()">View Baseline</div>
                    <div onclick="changecolumnMaterial()">View Material</div>
                </div>
            </div>
        </div>

        <div id="mm2" style="width:180px;">
            <div>Help</div>
            <div><a href="manual">Petunjuk Pemakaian</a></div>
            <div><a href="video">Video pemakaian sitem TI</a></div>
            <div>About</div>
        </div>
	
	<div class="menu-sep"></div>

        <!--span>Nama Barang:</span-->
        Kelas:<input class="easyui-combobox"  style="width:50px"
        id="filtergrp"
        data-options="
                valueField:'value',
                textField:'label',
                multiple:true,
                panelHeight:'auto',
                data: [{
			label: 'Kls 1',
			value: '1'
		},{
			label: 'Kls 2',
			value: '2'
		},{
			label: 'Kls 3',
			value: '3'
		},{
			label: 'TK-A',
			value: 'TKA'
		},{
			label: 'TK-B',
			value: 'TKB'
		}]
        "></input>
        <!--span>Nama Barang:</span-->
        SP Team:<input class="easyui-combobox"  style="width:75px"
        id="filterspteam"
        data-options="
                url:'ds/combo_team',
                method:'get',
                valueField:'text',
                textField:'text',
                multiple:true,
                panelHeight:'auto'
        "></input>
		
		        <!--span>Nama Barang:</span-->
        LastStatus:<input class="easyui-combobox"  style="width:75px"
        id="filterlstatus"
        data-options="
                url:'ds/combo_status',
                method:'get',
                valueField:'text',
                textField:'text',
                multiple:true,
                panelHeight:'auto'
        "></input>
        <input class="easyui-combobox"  style="width:125px"
        id="filterprogap"
        data-options="
                url:'ds/combo_text',
                method:'get',
                valueField:'text',
                textField:'text',
                multiple:true,
                panelHeight:'auto'
        ">
        <input id="searchfor" class="easyui-searchbox" data-options="prompt:'Cari Nama',searcher:doSearch" style="width:200px">
        <input id="searchmehub" class="easyui-searchbox" data-options="prompt:'Cari apa yah',searcher:doSearch" style="width:200px">
	</div>

    <div id="dlg_login" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
            closed="true" buttons="#dlg_login_buttons">
        <div class="ftitle">User Information</div>
        <form id="fm_login" method="post" novalidate>
            <div class="fitem">
                <label>Email:</label>
                <input name="email" class="easyui-textbox" style="width:100%;height:40px;padding:12px"  validType="email" data-options="prompt:'email address',iconCls:'icon-man',iconWidth:38" required="true">
            </div>
            <div class="fitem">
                <label>Password:</label>
                <input type="password" name="passcode" class="easyui-textbox" style="width:100%;height:40px;padding:12px" data-options="prompt:'Password',iconCls:'icon-lock',iconWidth:38" required="true">
            </div>

        </form>
    </div>
    <div id="dlg_login_buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Login</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_login').dialog('close');$('#fm_login').clear();">Cancel</a>
    </div>
    
	<div id="dlg_createUser" class="easyui-dialog" style="width:400px; padding:10px 20px"
            closed="true" buttons="#dlg-createUser-buttons">
        <div class="ftitle">Create User Baru</div>
        <form id="fm_create_user" method="post" novalidate>
            <div class="fitem">
                <label>Email:</label>
                <input name="email" class="easyui-textbox" style="width:100%; height:40px; padding:12px"  validType="email" data-options="prompt:'email address',iconCls:'icon-man',iconWidth:38" required="true">
            </div>
            <div class="fitem">
                <label>Ketik ur Password:</label>
                <input type="password" name="passcode" class="easyui-textbox" style="width:100%; height:40px; padding:12px" data-options="prompt:'Password',iconCls:'icon-lock',iconWidth:38" required="true">
            </div>
            <div class="fitem">
                <label>Ketik ulang ur Password:</label>
                <input type="password" name="repasscode" class="easyui-textbox" style="width:100%; height:40px; padding:12px" data-options="prompt:'Password',iconCls:'icon-lock',iconWidth:38" required="true">
            </div>
            <div class="fitem">
                <label>Kode Validasi:</label>
                <input name="validasi" class="easyui-textbox" style="width:100%; height:40px; padding:12px" data-options="prompt:'kode validasi, tanya supervisor',iconCls:'icon-man',iconWidth:38" required="true">
            </div>
        </form>
    </div>
    <div id="dlg-createUser-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="CreateUser()">Create User</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_createUser').dialog('close');">Cancel/Close</a>
    </div>
    
    <div id="dlg_create_issue" class="easyui-dialog" style="width:700px; padding:10px 20px"
            closed="true" buttons="#create_issue_buttons">
        <div class="ftitle">Menambahkan tracker untuk siswa yg dipilih</div>

        <form id="fm_create_issue" method="post" novalidate>
            <input type="hidden" id="project_id" name="id_siswa" value="English">
            <input type="hidden" id="issueID" name="id_tracker" value="English">
            <div class="fitem">
                <label>Tracker Type:</label>
                <select name="tracker" id="cb_tracker" class="easyui-combobox" required="true">
                    <option value="Peminjaman">Peminjaman</option>
                    <option value="Koreksi">Koreksi</option>
                    <option value="Link">Link pustaka</option>
                    <option value="Peringatan">Peringatan</option>
                    <option value="Masalah">Masalah</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="fitem">
                <label>Subject:</label>
                <input name="subject" id="subject" class="easyui-validatebox" required="true" style="width:600px;">
            </div>
            <div class="fitem">
                <label>Description:</label>
                    <textarea class="keterangan" id="keterangan" name="description"></textarea>
            </div>
            <div class="fitem">
                <label>date</label>
                <input id="track_start_date" name="date" class="easyui-datebox" required style="width:200px">
                <label>Due Date:</label>
                <input id="track_due_date" name="duedate" class="easyui-datebox" style="width:200px">
            </div>
            <div class="fitem">
                <label>Status</label>
                <select id="cc" class="easyui-combobox" name="status" style="width:200px;">
                    <option value="Create">Create</option>
                    <option>Open</option>
                    <option>suspended</option>
                    <option>Blocking</option>
                    <option>Closed</option>
                </select>
            </div>
        </form>
    </div>
    
    
    <div id="create_issue_buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" id="createissue" iconCls="icon-ok" onclick="save_issue('create')">Create</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" id="updateissue" iconCls="icon-ok" onclick="save_issue('update')">Update</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_create_issue').dialog('close'); $('#keterangan').val('').empty();">Cancel</a>
    </div>
	
    <div id="dlg_create_comment" class="easyui-dialog" style="width:700px; padding:10px 20px"
            closed="true" buttons="#create_comment_buttons">
        <div class="ftitle">Create Comment</div>

        <form id="fm_create_comment" method="post" novalidate>
            <input type="hidden" id="issueid" name="id_tracker">
            <input type="hidden" id="CommentID" name="id_comment">
            <div class="fitem">
                <label>Comment:</label>
                    <textarea class="keterangan" id="comment" name="description"></textarea>
            </div>

        </form>
    </div>
    
    
    <div id="create_comment_buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" id="createcomment" iconCls="icon-ok" onclick="save_comment('create')">Create</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" id="updatecomment" iconCls="icon-ok" onclick="save_comment('update')">Update</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_create_comment').dialog('close'); $('#commentDescr').val('');">Cancel</a>
    </div>


    <div id="dlg-cell-edit" class="easyui-dialog" style="width:700px;height:350px;padding:10px 20px"
            closed="true" buttons="#dlg-cell-edit-buttons">
        <div class="ftitle">CELL Edit</div>
        <div id="someDivId1">  </div>
    </div>
    <div id="dlg-cell-edit-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="updateCell()">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-cell-edit').dialog('close')">Cancel</a>
    </div>

<div id="someDivId">Klik kanan di header untuk show/hide kolom <br/> Double click di Cell untuk edit <br/> Tidak akan mengubah isi kecuali logged-in membolehkan update cell tersebut</div><br/>
<div id=tabelproperty></div>

</body>
<script type="text/javascript">
$(function(){

    $('#tt').datagrid({
        view: detailview,
        detailFormatter:function(index,rowddv){
            return '<span> <a href="javascript:void(0);" class="tombol" onclick="javascript:create_issue1(' + rowddv.progress_id + ')"> Post New tracker</a></span>';

    },

	onHeaderContextMenu: function(e, field){
		e.preventDefault();
		if (!cmenu){
			createColumnMenu();
		}
		cmenu.menu('show', {
			left:e.pageX,
			top:e.pageY
		});
	},

    rowStyler:function(index,row){
        if (row.Progress_Color=='Yellow'){
            return 'color:yellow;font-weight:bold;';
        } else
        if (row.Progress_Color=='Orange'){
            return 'color:rgb(255, 136, 0);font-weight:bold;';
        } else 
		if (row.Progress_Color=='Blue'){
            return 'color:blue; font-weight:bold;';
        } else
        if (row.Progress_Color=='Red'){
            return 'color:red; font-weight:bold;';
        } 

    },

	onDblClickCell: function(index,field,value){
            $("#someDivId1").empty();
            var form = $("<form/>",{id:'form-cell-upd', method:'post'});
            var getdata = $(this).datagrid('getData');

            var datefield = ["Forecast_On_Air","Forecast_RFS","Actual_RFS","MR_Date_Plan","MOS_Plan","MOS","NMS"];

            form.append($("<input/>", { type:'hidden', name:'id_siswa', value:getdata.rows[index].id_siswa}));
            form.append($("<input/>", { type:'hidden', name:'nisn', value:getdata.rows[index].NISN}));
            form.append($("<input/>", { type:'hidden', name:'nisl', value:getdata.rows[index].NISL}));
            form.append($("<input/>", { type:'text', name:field, id:'fieldinput'}));
//                form.append($("<input/>", { type:'text', name:'fieldtgl', id:'fieldtgl'}));

            $("#someDivId1").append(form);
            $('#dlg-cell-edit').dialog('open').dialog('setTitle', field);

            if(jQuery.inArray(field,datefield) >=0 ){
                $('#fieldinput').datebox({});
                var cellDateval = '';
                switch(field) {
                    case 'tgl_lahir':
                            cellDateval = getdata.rows[index].tgl_lahir;
                            break;
                    }
                var dateString   = cellDateval.replace(/(\d{4})\-(\d{2})\-(\d{2})/, "$2/$3/$1");
    //          $('#fieldinput').datebox({required:true});
                $('#fieldinput').datebox('setValue', dateString);
            } 
            else {
                    $('#fieldinput').val(value);
                    $("#fieldinput").textbox({multiline:true, height:200, widht:450});
              }
        },

	onRowContextMenu: function(e,index,row){

		console.log(this);
	},




        onExpandRow: function(index,rowddv){
			$('#trackerList').datagrid({url:'dg_siswa/ds_siswa_tracker'});
			$('#trackerList').datagrid('load',{id_siswa:rowddv.id_siswa});         
        },
		onSelect: function(index,rowddv){
			$('#trackerList').datagrid('load',{id_siswa:rowddv.id_siswa});         
        }
    });
	
	$('#trackerList').datagrid({
        view: detailview,
        detailFormatter:function(index,rowddv){
//            return '<div style="padding:2px"><table class="ddv" id="ddv-' + rowddv.progress_id + '"></table></div>';
            return '<div style="padding:2px"><table class="ddvcomment"></table></div>';

		},
		onDblClickRow:function(index,row){
                    var getdataIssue = $(this).datagrid('getData');
                    var dateString    = row.start_date.replace(/(\d{4})\-(\d{2})\-(\d{2})/, "$2/$3/$1");
                    var datejava = new Date(dateString).toString();
                    console.log('datejava: ' + datejava);
                    console.log('dateString: ' + dateString + '\r\n');
                    var dt = new Date(dateString);
                    console.log('dt: ' + dt + '\r\n');
                    //console.log('getdataIssue:\r\n' + getdataIssue);
                    //console.log('index ke:\r\n' + index);
                    $('#project_id').val(row.id_siswa);
                    $('#cb_tracker').combobox('setValue',row.tracker);                        
                    $('#issueID').val(row.id_tracker);
                    $('#subject').val(row.subject);
                    $('#track_start_date').datebox('setValue', dateString);
                    $('#dlg_create_issue').dialog('open').dialog('setTitle',row.id_tracker);
                    $('#updateissue').show();
                    $('#createissue').hide();
                    $.each(tinyMCE.editors, function(index, editor){
                            editor.setContent(row.description);
                            }
                    );
        },
		onExpandRow: function(index,rowddv){
            var ddvcomment = $(this).datagrid('getRowDetail',index).find('table.ddvcomment');
            ddvcomment.datagrid({
               // url:'dg_siswa/ds_siswa_comment.php?issue_id='+rowddv.issue_id,
		 url:'dg_siswa/ds_siswa_tracker_comment',
		queryParams: {id_tracker: rowddv.id_tracker},
                fitColumns:true,
                singleSelect:true,
                rownumbers:true,
                loadMsg:'Sedang Ambil Daftar Issue',
                height:'auto',
                columns:[[
                    {field:'comment',title:'comment', width:800},
                    {field:'create_on',title:'create_on'},
                    {field:'last_update',title:'last_update',width:100,align:'left'},
                    {field:'id_user',title:'user',width:100,align:'left'},
                    {field:'action',title:'Action',width:70,align:'center',
                        formatter:function(value,row,index){
                                return '<a href="#" onclick="javascript:deleteComment(' + row.id_tracker + ')">Delete</a>';
                        }
                    }
                ]],

                onDblClickRow:function(index,row){
                    $('#issueid').val(row.id_tracker);
                    $('#CommentID').val(row.id_comment);
                    $('#dlg_create_comment').dialog('open').dialog('setTitle',row.id_tracker);
                    $('#createcomment').hide();
                    $('#updatecomment').show();
                    $.each(tinyMCE.editors, function(index, editor){
                        editor.setContent(row.comment);
                        }
                    );
                },
                
                onResize:function(){
                    $('#trackerList').datagrid('fixDetailRowHeight',index);
                },
                onLoadSuccess:function(){
                    setTimeout(function(){
                        $('#trackerList').datagrid('fixDetailRowHeight',index);
                    },0);
                }
            });
            $('#trackerList').datagrid('fixDetailRowHeight',index);
        }
	});
    
    $("a.btn_external").click(function() {
        url_to_open = $(this).attr("href");
        window.open(url_to_open, '_blank');
        return false;
    });
	
	tinymce.init({
	plugins: ["table, image, link, emoticons, code "],
	entity_encoding: 'raw',
	selector:'.keterangan'});
	
});
</script>
    
<script type="text/javascript">

var url;
function newUser(){
    $('#dlg').dialog('open').dialog('setTitle','New User');
    $('#fm_login').form('clear');
    url = 'auth/loginJson';
}

function create_issue1(val){
    var progid = val;
    console.log(progid);    
    $('#dlg_create_issue').dialog('open');
    $('#dlg_create_issue').dialog('setTitle',progid);
    $('#updateissue').hide();
    $('#createissue').css("display","");
    $('#fm_create_issue').form('clear');
    tinymce.activeEditor.setContent('');
    $('#project_id').val(val);
}

function create_comment(val,title){
    var progid = val;    
    $('#dlg_create_comment').dialog('open').dialog('setTitle',progid);
    $('#updatecomment').hide();
    $('#createcomment').show();
    $('#fm_create_issue').form('clear');
    tinymce.activeEditor.setContent('');
    $('#issueid').val(val); 
}

function save_comment(action){
    var url='';
    if(action=='create'){url='dg_siswa/create_comment';}
    if(action=='update'){url='dg_siswa/update_comment';}
    $('#fm_create_comment').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.success){
                $.messager.show({title: 'Sukses', msg: result.Msg});
                $('#dlg_create_comment').dialog('close');
				} else {
				$.messager.show({title: 'Error', msg: result.Msg});
            }
        }
    });	
}

function save_issue(action){
	var url='';
	if(action=='create'){url='dg_siswa/create_tracker';}
	if(action=='update'){url='dg_siswa/update_tracker';}
    $('#fm_create_issue').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            //var result = eval('['+result+']');
            var resulted = $.parseJSON(result);
            if (resulted.error){
                $.messager.show({'title': 'Error', 'msg': resulted.Msg});
                $('#dlg_create_issue').dialog('close');
            } 
            else {
                $.messager.show({'title': 'Sukses', 'msg': resulted.Msg});
                $('#dlg_create_issue').dialog('close');        // close the dialog
                $('#trackerList').datagrid('reload'); 
            }
        }
    });
}

function deleteIssue(val){
        var win = $.messager.confirm('Confirm','Are you sure you want to destroy this Issue?',function(r){
            if (r){
                $.post('dg_siswa/del_tracker',{id:val},function(result){
                    if (result.success){
                        $.messager.show({title: 'Sukses', msg: result.Msg});
                        $('#trackerList').datagrid('reload');    // reload the user data
                    } else {
                        $.messager.show({title: 'Error', msg: result.Msg});
                    }
                },'json');
            }
        });
	win.window('move',{top:100});
}


function deleteComment(val){
        var win = $.messager.confirm('Confirm','Are you sure you want to destroy this Comment?',function(r){
            if (r){
                $.post('dg_siswa/del_comment',{id:val},function(result){
                    if (result.success){
                        $.messager.show({title: 'Sukses', msg: result.Msg});
                        $('#trackerList').datagrid('reload');    // reload the user data
                    } else {
                        $.messager.show({    // show error message
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                },'json');
            }
        });
	win.window('move',{top:100});
}


function saveUser(){
    $('#fm_login').form('submit',{
        url: 'auth/login',
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.success){
                $.messager.show({title: 'Error', msg: result.succesMsg});
				$('#dlg_login').dialog('close');
            } else {
                $.messager.show({title: 'salah', msg: result.errorMsg});
                $('#dlg_login').dialog('close');        // close the dialog
            }
            $('#tt').datagrid('reload');
        }
    });
}

function CreateUser(){
    $('#fm_create_user').form('submit',{
        url: 'auth/create_account',
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.success){
                $.messager.show({title: 'success', msg: result.succesMsg});
            } else {
                $.messager.show({title: 'salah', msg: result.errorMsg});
            }
            $('#dlg_createUser').dialog('close');
        }
    });
}

function del_single(table, field, value){
    if (row){
        $.messager.confirm('Confirm','Benar mau Hapus siswa ini?',function(r){
            if (r){
                $.post('dg_siswa/del_siswa',{table:table, field:field, value:value},function(result){
                    if (result.success){
                        $.messager.show({    // show error message
                            title: 'Sukses',
                            msg: result.Msg
                        });
                    }
                },'json');
            }
        });
    }
}

function doSearch(value){
    var opts_grp = $('#filtergrp').combobox('options');
    var opts_spteam = $('#filterspteam').combobox('options');
    var opts_lstatus = $('#filterlstatus').combobox('options');
    var opts_progap = $('#filterprogap').combobox('options');

    var pilihan ='', pilihan1 ='', pilihan2 ='', pilihan3 ='', pilihan4 ='', pilihan5 ='';

    if (opts_grp.multiple){ pilihan2 = $('#filtergrp').combobox('getValues').join("','");    }
    if (opts_spteam.multiple){ pilihan3 = $('#filterspteam').combobox('getValues').join("','");    }
    if (opts_lstatus.multiple){ pilihan4 = $('#filterlstatus').combobox('getValues').join("','");    }
    if (opts_progap.multiple){ pilihan5 = $('#filterprogap').combobox('getValues').join("','");    }

    $('#tt').datagrid('load',{nama: value, grp: pilihan2, spteam: pilihan3, lstatus: pilihan4, progap: pilihan5});
}

function updateCell(){
    $('#form-cell-upd').form('submit',{
        url: 'dg_siswa/updateCell',
        success: function(result){
            var result = eval('('+result+')');
            if (result.success){
                $.messager.show({title: 'Error', msg: result.Msg + result.sql + ' | ' + result.allow + ' to edit this.'});
                $('#dlg-cell-edit').dialog('close');
                $('#tt').datagrid('reload');
            } else {
                $.messager.show({title: 'You Are', msg: result.Msg});
                $('#dlg-cell-edit').dialog('close');        // close the dialog
//                $('#tt').datagrid('reload');    // reload the user data
            }
        }
    });
}

function drawTable(){
        var row = $('#tt').datagrid('getSelected');
        if (row){
            $('#tabelproperty').html(simpleArray2d(row));	       
        }
}

function multiSet(table,field,val){
        var ids = [];
        var rows = $('#tt').datagrid('getSelections');
        for(var i=0; i<rows.length; i++){
                ids.push(rows[i].id_siswa);
        }
	if (rows){
        $.messager.confirm('Confirm','Bener nih mau ganti?<br> Would like to change?',function(r){
            if (r){
                $.post('dg_siswa/multiset_field',{table:table, field:field, ids:ids, value:val},function(result){
                    if (result.success){
                        $.messager.show({title: 'Sukses', msg: result.Msg});
                        $('#tt').datagrid('reload');    // reload the user data
                    } else {
                        $.messager.show({title: 'Error', msg: result.Msg});
                    }
                },'json');
            }
        });
    }
}


function drawonmap(){
        var ids = [];
        var rows = $('#tt').datagrid('getSelections');
        for(var i=0; i<rows.length; i++){
                ids.push(rows[i].progress_id);
        } 
	url="drawonmap?id=" + ids.join("','");
	window.open(url);
}

function fmtNodeid(val,row){
        return '<a href=\'?nodeid=' + val + '\'>' + val + '</a>';
}

function fmtcoordinate(val,row){
        return '<a href=https://www.google.com/maps?t=m&output=classic&q=' + val + '>' + val + '</a>';
}

function getproperty(){
        var row = $('#tt').datagrid('getData');
        if (row){
		console.log(row);
		var isi = 
		$('#tabelproperty').append(simpleArray(row.rows));	       
        }
}

function simpleArray(target){
    var arr = '';
    $.each(target, function(i, e){
        arr += '<tr>';
        $.each(e, function(key, val){
            arr += '<td ' + 'class="' + key + '">' + val + '</td>';
        });
        arr += '</tr>';
    });
    return arr;
}

function simpleArray2d(target){
    var arr = '<table>';
	var i=0;
        $.each(target, function(key, val){
	if( i%2 == 0){
		arr += '<tr>';
	}
            arr += '<td class="datagrid-key">' + key + '</td>';
            arr += '<td class="datagrid-val ' + key + '">' + val + '</td>';
        if( i%2 == 1){
		arr += '</tr>';
	}
       i++; 

	});
	arr += '</table>';

    return arr;
}


var cmenu;
function createColumnMenu(){
	cmenu = $('<div/>').appendTo('body');
	cmenu.menu({
		onClick: function(item){
			if (item.iconCls == 'icon-ok'){
				$('#tt').datagrid('hideColumn', item.name);
				cmenu.menu('setIcon', {
					target: item.target,
					iconCls: 'icon-empty'
				});
			} else {
				$('#tt').datagrid('showColumn', item.name);
				cmenu.menu('setIcon', {
					target: item.target,
					iconCls: 'icon-ok'
				});
			}
		}
	});
	var fields = $('#tt').datagrid('getColumnFields');
	for(var i=0; i<fields.length; i++){
		var field = fields[i];
		var col = $('#tt').datagrid('getColumnOption', field);
		cmenu.menu('appendItem', {
			text: col.title,
			name: field,
			iconCls: 'icon-ok'
		});
	}
}



</script>
	

</html>

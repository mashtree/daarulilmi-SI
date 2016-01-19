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
			"nama": function(column,row)
			{
				return "<button type=\"button\" class=\"btn btn-default btn-xs command-open blue\" data-row-id=\"" + row.id + "\"  data-toggle=\"tooltip\" data-placement=\"right\" title=\"Detil\"><span class=\"glyphicon glyphicon-folder-open\" aria-hidden=\"true\"></span></button> "+row.nama;
			},
			"commands": function(column, row)
			{
				var action = "<div class=\"btn-group\" role=\"group\" aria-label=\"...\">";
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

//form rekam

var rekam = function(){
	
}
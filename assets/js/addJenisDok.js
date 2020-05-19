/**
 * File : addJenisDok.js
 * 
 * File ini berisi validasi form pada tambah Jenis Dokumen
 * 
 * Menggunakan validasi plugin : jquery.validate.js
 * 
 * @author Fani Fatina
 */

$(document).ready(function(){
	
	var addJenisDokForm = $("#addJenisDok");
	
	var validator = addJenisDokForm.validate({
		
		rules:{
			kode : { required : true },
			nama : { required : true },
		},
		messages:{
			kode :{ required : "Field ini diperlukan" },
			nama :{ required : "Field ini diperlukan" },
		}
	});
});

/**
 * File : editJenisDok.js
 * 
 * File ini berisi validasi form pada ubah jenis dokumen
 * 
 * Menggunakan validasi plugin : jquery.validate.js
 * 
 * @author Fani Fatina
 */

$(document).ready(function(){
	
	var editJenisDokForm = $("#editJenisDok");
	
	var validator = editJenisDokForm.validate({
		
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

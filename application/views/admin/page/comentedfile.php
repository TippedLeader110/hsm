for (var i = 0 ; i < NPegawai.length; i++) {
		var json = "";

		json = '{"nama" : "'+NPegawai[i].nama+'", "id" : '+NPegawai[i].id+'';

		if (DPegawai.length==0) {
			
			for (var iii = 0; iii < rowNilai.length ; iii++) {
				json = json + ', "'+rowNilai[iii].id+'" : 0';
				
			}
		}else{
			for (var ii = 0 ; ii < DPegawai.length; ii++) {

				
				if (DPegawai[ii].id_pegawai == NPegawai[i].id) {

					console.log(DPegawai[ii].id_pegawai + ' = ' + NPegawai[i].id);

					for (var iii = 0; iii < rowNilai.length ; iii++) {

						if (rowNilai[iii].id == DPegawai[ii].id_kriteria) {

							json = json + ', "'+rowNilai[iii].id+'" : '+ DPegawai[ii].nilai;

						}				
						
					}

					console.log(json);


				}else{

				
					for (var iii = 0; iii < rowNilai.length ; iii++) {
						json = json + ', "'+rowNilai[iii].id+'" : 0';
						
					}
					
				}

			}	

		}
		json = json + '}';
		FPegawai.push(json);
		
	}
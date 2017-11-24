var Script = function () {
	$.validator.setDefaults({
        submitHandler: function() { alert("submitted!"); }
    });
	
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#register_form").validate({
            rules: {
                nama_barang: {
                    required: true,
					maxlenght : 50
                },
                kode_barang: {
                    required: true,
					maxlenght : 14
                },
                satuan: {
                    required: true,
					maxlenght : 7
                },
                harga_k: {
                    required: true,
					maxlenght : 20
                },
                harga_ahs: {
                    required: true,
					maxlenght : 20
                },
                agree: "required"
            },
            messages: {                
                nama_barang: {
                    required: "Masukkan Nama Bahan Baku.",
                    maxlength: "Maks 30 karakter."
                },
                kode_barang: {
                    required: "Masukkan Kode Bahan Bahan.",
                    maxlength: "Maks 14 karakter."
                },
                satuan: {
                    required: "Masukkan Satuan untuk Bahan Baku.",
                    maxlength: "Maks 7 karakter."
                },
                harga_k: {
                    required: "Masukkan harga-k ."
                }
				harga_ahs: {
                    required: "Masukkan harga ahs."
                }
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();
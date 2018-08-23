Dropzone.autoDiscover = false;

$(function() {
	$(".select2").select2();

  new Dropzone('#dropzone_client' ,{
    url: "/upload_sign",
    paramName: 'signature_boss',
    autoProcessQueue: false,
    acceptedFiles:'image/*',
    maxFilesize: 1,
    maxFiles: 1,
    addRemoveLinks: true,
    uploadMultiple: true,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dictDefaultMessage: 'Arrastra la imagen para subirla',
    init: function() {
      var myDropzone = this;
      // this.on("addedfile", function(file) { menssage_toast('Mensaje', '4', 'Imagen cargada con exito' , '3000'); });
      // this.on("complete", function(file) {  myDropzone.removefile(file); });
      // this.on("errormultiple", function (file) { myDropzone.removefile(file); }););
      this.on("maxfilesexceeded", function(file){
        menssage_toast('Mensaje', '3', 'Se cambio la imagen anterior por la actual' , '3000');
        myDropzone.removeAllFiles();
        myDropzone.addFile(file);
      });
      this.on('error', function(file, response) {
      	//console.log(response);
        myDropzone.removeFile(file);
      });
      var submitImgClient = document.getElementById('cargarsignboss');
      submitImgClient.addEventListener("click", function(e) {
        // Make sure that the form isn't actually being sent.
        e.preventDefault();
        e.stopPropagation();
        myDropzone.processQueue();
      });
      //send all the form data along with the files:
      this.on("sendingmultiple", function(data, xhr, formData) {
          formData.append("select_one_type", $('#select_one_type').val());
      });
      this.on("successmultiple", function(files, response) {
        // Gets triggered when the files have successfully been sent.
        // Redirect user or notify of success
        //console.log(response);
        if (response == '0') {
          myDropzone.removeAllFiles();
          menssage_toast('Mensaje', '2', 'Operation Abort' , '3000');
        }
        else {
          myDropzone.removeAllFiles();
          $('#form_img_upload_sign')[0].reset();
          $('#select_one_type').prop('selectedIndex',0);
          $("#select_one_type").select2({placeholder: "Elija"});
          menssage_toast('Mensaje', '4', 'Imagen cargada con exito' , '3000');
        }
      });
    }
  });

});
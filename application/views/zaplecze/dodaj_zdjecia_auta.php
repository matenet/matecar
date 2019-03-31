
   <h2>Dodaj zdjęcia auta</h2>
    <div>
         <section class="uploaded-images-form-wrapper">
             <p>Maksymalny rozmiar pliku to: 1024 KB.<br>Maksymalna rozdzielczość zdjęcia to: 1024x768px</p>
            <div class="upload-images-form">
                <label for="files" class="custom-file-upload">
                    <i style="font-size:20px; margin-top: 0; margin-right: 5px;" class="fas fa-cloud-upload-alt"></i> Wybierz zdjęcia z dysku
                </label>
                 <input type="file" name="files" id="files"  multiple />
             </div>
             <div id="uploaded_images">
             </div>
        </section>
    
     </div>
      </div>
 <script>  
 $(document).ready(function(){
      $('#files').change(function(){
      var files = $('#files')[0].files;
      var error = '';
      var form_data = new FormData();
      for(var count = 0; count<files.length; count++)
      {
        var name = files[count].name;
        var extension = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(extension, ['jpg','jpeg']) == -1)
        {
            error += "Wybrano nieprawidłowy format plików.\nObsługiwane formaty to: .jpg i .jpeg."
        }
        else
        {
            form_data.append("files[]", files[count]);
        }
      }
      if(error == '')
      {
          $.ajax({
              url:"<?php echo base_url(); ?>zaplecze/upload/<?php echo $id_auta; ?>",
              method:"POST",
              data:form_data,
              contentType:false,
              cache:false,
              processData:false,
              beforeSend:function()
              {
                $('#uploaded_images').html("Trwa wczytywanie zdjęć...");
              },
              success:function(data)
              {
                $('upload-images-form').hide();
                $('#uploaded_images').html(data);
                $('#files').val(''); 
              }
          })
      }
      else
      {
          alert(error);
      }
     }); 
 });  
</script>

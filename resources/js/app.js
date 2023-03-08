import Dropzone from 'dropzone';

Dropzone.autoDiscover = false

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage : 'Suba aqui su imagen',
    acceptedFiles : '.png, .jpg ,.jpge, .gif',
    addRemoveLinks : true,
    dictRemoveFile : 'Borrar Archivo',
    maxFiles : 1,
    uploadMultiple : false,

    init: function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imgpublicada = {};
            imgpublicada.size = 1234;
            imgpublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this,imgpublicada);
            this.options.thumbnail.call(this,imgpublicada,`/uploads/${imgpublicada.name}`);
            
            imgpublicada.previewElement.classList.add('dz-success','dz-complete');
        }
    }
});

// dropzone.on('sending',function(file, xhr, formData){
//     console.log(formData);
// });

dropzone.on('success',function(file,response){
    document.querySelector('[name="imagen"]').value = response.imagen;
});

// dropzone.on('error',function(file,message){
//     console.log(message);
// });

dropzone.on('removedfile',function(){
    document.querySelector('[name="imagen"]').value = "";
    fetch('/imagen/delete').then((res) => res.json());
});

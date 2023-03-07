import Dropzone from 'dropzone';

Dropzone.autoDiscover = false

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage : 'Suba aqui su imagen',
    acceptedFiles : '.png, .jpg ,.jpge, .gif',
    addRemoveLinks : true,
    dictRemoveFile : 'Borrar Archivo',
    maxFiles : 1,
    uploadMultiple : false
});


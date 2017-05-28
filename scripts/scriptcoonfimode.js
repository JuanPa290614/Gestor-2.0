function previewFile() {
    
 var preview = document.querySelector('#fto');
  var file    = document.querySelector('#img').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}
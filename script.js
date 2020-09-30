function showname () {
      var image = document.getElementById('file-input');
      document.getElementById('imageposted').innerHTML=image.files.item(0).name+" uploaded";
    };

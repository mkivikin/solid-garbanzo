
/*function onDrag(event, target) {
  event.preventDefault();
  let drop = document.getElementById(target.id);
  drop.className = 'dropfileOver';
  return false;
}

function onLeave(event, target) {
  event.preventDefault();
  let drop = document.getElementById(target.id);
  drop.className = 'dropfile';
  return false;
}

function onLeave(event, target) {
  event.preventDefault();
  let drop = document.getElementById(target.id);
  drop.className = 'dropfile';
  return false;
}

function displayUploads(data) {
  var uploaded = document.getElementById('dropfiles'),
  anchor,
  x;
  for(x = 0; x < data.length; x++) {
    anchor = document.createElement('a');
    anchor.href = data[x].file;
    anchor.innerText = data[x].name;
    uploaded.appendChild(anchor);
  }

}
function upload(event, target) {
  event.preventDefault();
  //console.log(event.dataTransfer.files[0].name);
  target.className = 'dropfile';
  let formData = new FormData(),
  xhr = new XMLHttpRequest(),
  x;
  let files = event.dataTransfer.files;
  for(x = 0; x < files.length; x++) {
    formData.append('file[]', files[x]);
  }

  function delete() {

  }


  xhr.onload = function() {
    let data = JSON.parse(this.responseText);
    displayUploads(data);

  }
  xhr.open('post', 'uploadFunctions.php');
  xhr.send(formData);
}

<script>

var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

myInput.onkeyup = function() {
	
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) { 
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) { 
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) { 
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

function checkPassword() {

		let pw = document.getElementById('password').value;
		let confirmedPw = document.getElementById('cpassword').value;
		
		if(pw == confirmedPw) {
			//alert("Paroolid kattuvad
			document.getElementById('span2').innerHTML="<div style='color:#2FC0AE'>Paroolid kattuvad</div>";
		} else {
			//alert("Paroolid ei kattu");
			document.getElementById('span2').innerHTML="<div style='color:#E74C3C'>Paroolid ei kattu</div>";
		}
}

function validate() {
        let name = document.getElementById('username').value;
		if(name > 5){
			document.getElementById('span1').innerHTML="<div style='color:#2FC0AE'>Kasutajatunnus on sobilik</div>";
        } else {
           document.getElementById('span1').innerHTML="<div style='color:#2FC0AE'>Kasutajatunnus peab olema vähemalt 6 tähemärki pikk</div>";
        }
    }

</script>
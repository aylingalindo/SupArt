/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/JavaScript.js to edit this template
 */
(function () {
  'use strict'
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')
  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if ((!form.checkValidity()) || (!checkPass())) {
        event.preventDefault()
        event.stopPropagation()
        showInvalidRegister()
      }
      form.classList.add('was-validated')
    }, false)
  })
  
  ///const form = forms[0];
  //Array.from(form.elements).forEach((input) => {
  //  form.addEventListener('input', event => {
  //    event.classList.add('was-validated')
  //  }, false)
  //})
})()

const openSignUpBtn = document.querySelectorAll('[data-modal-target]')
const closeSignUpBtn = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')


// date validation
function dateValidation() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    } 
    
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("fechaID").setAttribute("max", today);

}

// para que el boton de sign up abra la ventana pop up
openSignUpBtn.forEach(button => {  
    button.addEventListener('click', () => { // evento que va a correr cada que se seleccione un boton con data modal target
        const modal = document.querySelector(button.dataset.modalTarget)   // si se le hace un click se obtiene el elemento del que es target
        openModal(modal)
    })
})
function openModal(modal) { 
    if(modal==null) return
    modal.classList.add('active')
    overlay.classList.add('active')
}

function openEditModal(){
    const modal = document.getElementById("popupEditPost")   // si se le hace un click se obtiene el elemento del que es target
    openModal(modal);
}

function openDeleteModal(){
    const modal = document.getElementById("popupDeletePost")   // si se le hace un click se obtiene el elemento del que es target
    openModal(modal);
}

// para que la tachita cierre la ventana pop up
closeSignUpBtn.forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.card')
        closeModal(modal)
    })
})

function closeModal(modal) {
    if(modal==null) return
    modal.classList.remove('active')
    overlay.classList.remove('active')
}

//para que el confirmar contraseña coincida con contraseña 
/*function checkPass() {
    var pass = document.getElementById("pass")
    var confirmPass = document.getElementById("passConfirm")
    
    if (pass.value != confirmPass.value) {
        confirmPass.setCustomValidity("Invalid field.");
        alert("no coinciden")
        console.log("NO")
        return false;
    }else {
        confirmPass.setCustomValidity("");
        alert("si coinciden")
        console.log("SI")
        return true;
    }
}*/

function showInvalidRegister() {
   document.getElementById("invalidPersonalizado").style.display = 'none'
   alert("funcion")
}

function showImageRegister(){
    //var archivos = $("#inptImg")[0].files;
    //const primerArchivo = archivos[0];
    
    //let url = URL.createObjectURL(primerArchivo);
    //const img = document.getElementById('pfpRegistroSrc');
    //img.src = url;
    const url = document.getElementById('pfpRegistroSrc').value;
    alert("url: " + url);
    document.getElementById('pfpRegistroSrc').setAttribute("src", url);
}

function showImageEdit(){
    //var archivos = $("#inptImg")[0].files;
    //const primerArchivo = archivos[0];
    
    //let url = URL.createObjectURL(primerArchivo);
    //const img = document.getElementById('pfpRegistroSrc');
    //img.src = url;
    const url = document.getElementById('pfpUserProfileEdit').value;
    alert("url: " + url);
    document.getElementById('pfpUserProfileEdit').setAttribute("src", url);
}


const cat = document.querySelector('.cat');

const product_imgMain = document.querySelector('.product-imgMain')
const product_imgThmb = document.querySelectorAll('.product-imgThmb')

product_imgThmb.forEach(img => {
    img.addEventListener('click', function(){
      const activo = document.querySelector('.activo')
      activo.classList.remove('activo')
      this.classList.add('activo')
      product_imgMain.src = this.src
    })

})

cat.onclick = () => {
    alert("boton presionado");
}

/*
//#region Registro
$("#btnSignUp").click(function (event) {
    //var signup = registerValidation();
    event.preventDefault(); // Evita la navegación
    alert("registrado");

    //if (!resultado) {
       // alert("Registro invalido.");
    //}
});

function registerValidation() {
    //USUARIO - minimo 3 caracteres
    var username = $("#username").val();
    if (username.length <= 3) {
        alert("El nombre de usuario debe ser más de 3 caracteres");
        return false;
    }

    //CONTRASEÑA - min 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.
    var password = $("#username").val();
    var msj = validatePassword(password);
    if (msj !== true) {
        alert(msj);
        return false;
    }


    return true;
}
/*
function validatePassword(password) {
    var requisitos = [
        { regex: /(?=.{8,})/, mensaje: "La contraseña debe tener al menos 8 caracteres" },
        { regex: /(?=.*[A-Z])/, mensaje: "Debe contener al menos una letra mayúscula" },
        { regex: /(?=.*[a-z])/, mensaje: "Debe contener al menos una letra minúscula" },
        { regex: /(?=.*\d)/, mensaje: "Debe contener al menos un número" },
        { regex: /(?=.*[\W_])/, mensaje: "Debe contener al menos un carácter especial" }
    ];

    for (var i = 0; i < requisitos.length; i++) {
        if (!requisitos[i].regex.test(password)) {
            return requisitos[i].mensaje;
        }
    }
    return "Contraseña válida";
}

function emptyInputs(input) {
    var empty = $("#nombre").val().trim() == "" ? false : true;
    $("#")
}*/

//#endregion
*/
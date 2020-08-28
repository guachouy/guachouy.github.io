$(function() {
  // Validate the contact form
  $('#contactform').validate({
	errorPlacement: function(error, element) {
		error.insertBefore(element);
	},
    rules: {
		nombre: {
		  required: true,
		  minlength: 2
		},
		apellido: {
		  minlength: 2
		},
		asunto: {
		  required: true,
		  minlength: 2
		},
		email: {
		  required: true,
		  email: true
		},
		mensaje: {
		  required: true,
		  minlength: 10
		}
	},
	messages: {
		nombre: {
		  required: "Necesitamos que nos dejes tu nombre",
		  minlength: jQuery.validator.format("Al menos {0} caracteres requeridos!")
		},
		apellido: {
			minlength: jQuery.validator.format("Al menos {0} caracteres requeridos!")
		},
		asunto: {
		  required: "Necesitamos que nos dejes el asunto de tu mensaje",
		  minlength: jQuery.validator.format("Al menos {0} caracteres requeridos!")
		},
		email: {
			required: "Necesitamos que nos dejes tu mail para contactarte",
			email: "Ingrese un mail válido, por favor.."
		},
		mensaje: {
			required: "Necesitamos que nos dejes tu mensaje antes de clickear en enviar",
			minlength: "Al menos {0} caracteres requeridos!"
		}
		
	},
    // Use Ajax to send everything to processForm.php
    submitHandler: function(form) {
    // $("#send").attr("value", "Sending..."); -- cambia el boton de enviar a enviando
      $(form).ajaxSubmit({
        target: "#response",
        success: function(responseText, statusText, xhr, $form) {
          $(form).slideUp("fast");
          $(".response").html(responseText).hide().slideDown("fast");
        }
      });
      return false;
    }
  });
});
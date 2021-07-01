$('#serverName').on('blur', function() {
  if(this.value == ""){
    if(!($('#serverName').hasClass('is-invalid'))){
      $('#serverName').addClass('is-invalid');
      if(!($('#serverName').hasClass('is-valid'))){
        $('#serverName').removeClass('is-valid');
      }
    }
    return false;
  }else {
    $('#serverName').removeClass('is-invalid');
    if(!($('#serverName').hasClass('is-valid'))){
      $('#serverName').addClass('is-valid');
      if(!($('#serverName').hasClass('is-invalid'))){
        $('#serverName').removeClass('is-invalid');
      }
    }
  }
 })

 $('#inviteLink').on('blur', function() {
   if(this.value == ""){
     if(!($('#inviteLink').hasClass('is-invalid'))){
       $('#inviteLink').addClass('is-invalid');
       if(!($('#inviteLink').hasClass('is-valid'))){
         $('#inviteLink').removeClass('is-valid');
       }
     }
     return false;
   }else {
     $('#inviteLink').removeClass('is-invalid');
     if(!($('#inviteLink').hasClass('is-valid'))){
       $('#inviteLink').addClass('is-valid');
       if(!($('#inviteLink').hasClass('is-invalid'))){
         $('#inviteLink').removeClass('is-invalid');
       }
     }
   }
  })

  $('#description').on('blur', function() {
    if(this.value == ""){
      if(!($('#description').hasClass('is-invalid'))){
        $('#description').addClass('is-invalid');
        if(!($('#description').hasClass('is-valid'))){
          $('#description').removeClass('is-valid');
        }
      }
      return false;
    }else {
      $('#description').removeClass('is-invalid');
      if(!($('#description').hasClass('is-valid'))){
        $('#description').addClass('is-valid');
        if(!($('#description').hasClass('is-invalid'))){
          $('#description').removeClass('is-invalid');
        }
      }
    }
   })

   $('#language').on('blur', function() {
     if(this.value == ""){
       if(!($('#language').hasClass('is-invalid'))){
         $('#language').addClass('is-invalid');
         if(!($('#language').hasClass('is-valid'))){
           $('#language').removeClass('is-valid');
         }
       }
       return false;
     }else {
       $('#language').removeClass('is-invalid');
       if(!($('#language').hasClass('is-valid'))){
         $('#language').addClass('is-valid');
         if(!($('#language').hasClass('is-invalid'))){
           $('#language').removeClass('is-invalid');
         }
       }
     }
    })

    $('#type').on('blur', function() {
      if(this.value == ""){
        if(!($('#type').hasClass('is-invalid'))){
          $('#type').addClass('is-invalid');
          if(!($('#type').hasClass('is-valid'))){
            $('#type').removeClass('is-valid');
          }
        }
        return false;
      }else {
        $('#type').removeClass('is-invalid');
        if(!($('#type').hasClass('is-valid'))){
          $('#type').addClass('is-valid');
          if(!($('#type').hasClass('is-invalid'))){
            $('#type').removeClass('is-invalid');
          }
        }
      }
     })

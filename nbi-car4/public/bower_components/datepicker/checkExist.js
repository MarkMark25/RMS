
$(document).ready(function(){

    $('#docketnumber').blur(function(){
     var docket_number = '';
     var docketnumber = $('#docketnumber').val();
      $.ajax({
       url:"{{ route('validateData.check') }}",
       method:"POST",
       data:{dockectnumber:dockectnumber},
       success:function(result)
       {
        if(result == 'unique')
        {
         $('#docket_number').html('<label class="text-success">Docket number Available</label>');
         $('#docketnumber').removeClass('has-error');
         $('#submit').attr('disabled', false);
        }
        else
        {
         $('#docket_number').html('<label class="text-danger">Docket number not Available</label>');
         $('#docketnumber').addClass('has-error');
         $('#submit').attr('disabled', 'disabled');
        }
       }
      })

    });

   });

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            
        
        $('#storeform').submit(function(e){
            e.preventDefault();
            let form = $(this);
       // console.log(data);
           $.ajax({ 
               url: form.attr('action'),
               type : form.attr('method'),
               data: form.serialize(),
               dataType:'json',
               success:function(response){
                   console.log(response);
                   if(response.status == 400){
                       $('#showerrors').empty();   
                       $('#showerrors').addClass('alert alert-danger');
                       $.each(response.errors,function(key,value){
                           $('#showerrors').append('<li>'+value+'</li>')
                       });
                   }
                   else{
                       $("#showerrors").empty();
                       $("#showerrors").addClass('alert alert-success');
                       $("#showerrors").text(response.message);
                       // $('#exampleModal').modal('toggle'); //or  $('#IDModal').modal('hide');
                       window.location.reload();
                       console.log(response.message);
                       return false;
                    }
                },
           });
       });

    });
</script>
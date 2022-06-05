<script>
    $(document).ready(function(){
        
        $('#editform').submit(function(e){
            e.preventDefault();
        

        var id = $('#edit').val();
        $.ajax({
            url : $("form#editform").attr('action') + id,
            type: $("form#editform").attr('method'),
            data: $("form#editform").serialize(),
            dataType:'json',
            success:function(response){
            console.log(response.status);
            if(response.status == 200){
                $('#editexampleModal').modal('toggle');
                $('#showediterrors').empty();   
                $('#showediterrors').addClass('alert alert-success');
                $("#showediterrors").append("<div>"+response.message+"</div>");
            }
                else{
                    $.each(response.errors,function(key,value){
                        $('#showediterrors').empty();   
                        $('#showediterrors').addClass('alert alert-danger');
                        $("#showediterrors").append("<div>"+value+"</div>");
                    });
            }
        },
        });
    });
});
</script>

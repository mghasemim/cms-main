
$(document).ready(function(){
   



    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
        console.error( error );
    
    });
       


    
    $('#selectAllBoxes').click(function(event){
    
        if(this.checked){
    $('.checkBoxes').each(function(){
                this.checked = true;
    
            });
            
        }else{
    
    $('.checkBoxes').each(function(){
                    this.checked = false;
    
                });
        }
    
    });
    

// var div_box = "<div id='load-screen'><div id='loading'></div></div>";   

// $("body").prepend(div_box);

// $('#load-screen').delay(700).fadeOut(600, function(){
//     $(this).remove();
// });


    
});


function countUsersOnline(){

    $.get("/demo/cms/admin/includes/admin_functions.php?onlineusers=result", function(data){

        $(".usersOnline").text(data);

    });
}
setInterval(function(){

    countUsersOnline();

},500);




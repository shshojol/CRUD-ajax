<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    #message_success{
      position:absolute;
      right:15px;
      top:15px;
      color:green;
      background: blue;
    }
    #message_error{
      position:absolute;
      right:15px;
      top:15px;
      color:red;
      background: blue;
    }
    #modal{
      background:rgba(0, 0, 0, 0.7);
      position: fixed;
      left:0;
      right:0;
      top:0;
      height:100%;
      width:100%;
      display:none;
    }
    #modal-form {
    background: white;
    width: 40%;
    position: absolute;
    top: 20%;
    left: 30%;
    height: 40%;
    }
    #close-btn {
    background: red;
    color: white;
    padding: 5px;
    border-radius: 40%;
    display: inline-block;
    cursor: pointer;
    position: absolute;
    right: -10px;
    top: -10px;
    line-height: 1;
}
#serch-btn{
  text-align:right;
}
  </style>
</head>
<body>

<div class="container">
  <h2>Basic Table</h2>
  <p>The .table class adds basic styling (light padding and horizontal dividers) to a table:</p> 
  <div id='serch-btn'>
    <label>Search</label>
    <input type='text' id='search'/>
  </div>


  <div id="input">
    <form id='addform'>
      <label>First  Name</label>
      <input type='text'  id='fname'><br>
      <label>Last  Name</label>
      <input type='text'  id='lname'>
      <input type='submit' value='submit'  id='send'><br>
    </form>
  </div>
  <div id='message_success'></div>           
  <div id='message_error'></div>           
  <div id='modal'>
    <div id='modal-form'>
     <h2>Update form</h2>
     <form>
     </form> 
      
      <div id='close-btn'>X</div>
    </div>   
  </div>           

  <div id= 'test'></div>
</div>
<script>
  $(document).ready(function(){
    //load table ajax
    function loadtable(){
      $.ajax({
        url: "ajax.php",
        type: 'post',
        success: function(data){
          $('#test').html(data);
        }
      });
    }
    loadtable();

    //insert data
    $('#send').on('click', function(e){
      e.preventDefault();
      var fname = $('#fname').val();
      var lname = $('#lname').val();

      if(fname == "" || lname == "")
      {
        $('#message_error').html('All field are required').slideDown();
        $('#message_success').slideUp();
      }
      else{
          $.ajax({
          url : 'ajax_insert.php',
          type: 'post',
          data : {first_name: fname, last_name: lname},
          success : function(data)
          {
            if(data == 1)
            {
              loadtable();
              $('#addform').trigger('reset');
              $('#message_success').html('save data').slideDown();
              $('#message_error').slideUp();
            }
            else{
              $('#message_error').html('Cant save data').slideDown();
              $('#message_success').slideUp();
            } 
          }
        });
      }

      
    })

    //delete data
    $(document).on('click', '.delete-btn', function(){
      var studentid = $(this).data('id');
      var element = this;

      $.ajax({
        url: 'ajax_delete.php',
        type: "POST",
        data: {id: studentid},
        success: function(data)
        {
          if(data == 1)
          {
            $(element).closest("tr").fadeOut();
          }else{
            $('#message_error').html('cannot delete this record').slideDown();
            $('#message_success').slideUp();
          }
        }
      });
    });

    //show modal box
    $(document).on('click', '.edit-btn', function(){
      $('#modal').show();
      var studentid = $(this).data('eid');
      
      $.ajax({
        url: 'load-update-form.php',
        type: 'POST',
        data:{id: studentid},
        success: function(data)
        {
          $('#modal-form form').html(data);
        }

      });
    });

    //close modal box
    $('#close-btn').on('click', function(){
      $('#modal').hide();
    });

    //update modal box
    $(document).on('click', '#update', function(){
      var stu_id = $('#up-id').val(); 
      var stu_fname = $('#up-fname').val(); 
      var stu_lname = $('#up-lname').val(); 

      $.ajax({
        url: 'ajax-update.php',
        type: 'POST',
        data: {id:stu_id, first_name:stu_fname, last_name:stu_lname},
        success: function(data)
        {
          if(data == 1){
            $('#modal').hide();
          }
         
        }

      });
    });

    //live serch
    $('#search').on('keyup', function(){
      var search_term = $(this).val();

      $.ajax({
        url: "ajax-live-search.php",
        type: 'POST',
        data: {search: search_term},
        success: function(data)
        {
          $('#test').html(data);
        }

      });
    });
  });
</script>
</body>
</html>

view home.php:-
<!DOCTYPE html>
 <html>
 <head>
      <title></title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 </head>
 <body>
      <div class="container">
           <br /><br /><br />

           <form method="post" id="upload_form" align="center" enctype="multipart/form-data">
                <input type="file" name="pic" id="pic" />
                <br />
                <br />
                <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />
           </form>
           <br />
           <br />
           <div id="uploaded_image">
           </div>
      </div>
 </body>
 </html>
 <script>
 $(document).ready(function(){
      $('#upload_form').on('submit', function(e){
           e.preventDefault();
           if($('#pic').val() == '')
           {
                alert("Please Select the File");
           }
           else
           {
                $.ajax({
                     url:"<?php echo base_url(); ?>Home/ajax_upload",
                     //base_url() = http://localhost/tutorial/codeigniter
                     method:"POST",
                     data:new FormData(this),
                     contentType: false,
                     cache: false,
                     processData:false,
                     success:function(data)
                     {
                          $('#uploaded_image').html(data);
                     }
                });
           }
      });
 });
 </script>











/////////////////////////////////
controller Home.php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
		 //functions
		 function index()
		 {
					$data['title'] = "Upload Image using Ajax JQuery in CodeIgniter";
					$this->load->view('home', $data);
		 }
		 function ajax_upload()
		 {
					if(isset($_FILES["pic"]["name"]))
					{
							 $config['upload_path'] = './img/';
							 $config['allowed_types'] = 'jpg|jpeg|png|gif';
							 $this->load->library('upload', $config);
							 if(!$this->upload->do_upload('pic'))
							 {
										echo $this->upload->display_errors();
							 }
							 else
							 {
										$data = $this->upload->data();
										print_r($data);
										echo '<img src="'.base_url().'img/'.$data["file_name"].'" width="300" height="225" class="img-thumbnail" />';
							 }
					}
		 }
}

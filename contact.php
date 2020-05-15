<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>p1web.site</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="" />


<link href="<?= base_url('asset/web/css/font-awesome.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('asset/web/css/bootstrap.min.css') ?>">

<script type="text/javascript">
var base_url = '<?= base_url() ?>';
</script>
</head>

<body>

	<div id="colorlib-blog">
		<div class="container">
			<div class="row">
					
				<h3>Contact Information</h3>
				<div class="row contact-info-wrap">
					<div class="col-md-6">
						
						<p><span><i class="icon-location-2"></i></span> Flat No. T-6 Asma Complex, Berasia Road Bhopal</p>
					</div>
					<div class="col-md-3">
						<p><span><i class="icon-phone3"></i></span> <a href="tel://9300366312">+91 9300366312</a></p>
					</div>
					<div class="col-md-3">
						<p><span><i class="icon-paperplane"></i></span> <a href="mailto:info@hamdard.org">info@hamdard.org</a></p>
					</div>
					<!-- <div class="col-md-4">
						<p><span><i class="icon-globe"></i></span> <a href="#">hamdard.org</a></p>
					</div> -->
				</div>
				<div class="card mb-3">
				<div class="card-header"><h3>Get In Touch</h3></div>
				<div class="card-body">
				<form action="#" id="contactForm">
					<div class="row form-group">
						<div class="col-md-6">
							<label>First Name</label>
							<input type="text" name="fname" id="fname" class="form-control" placeholder="Your firstname">
						</div>
						<div class="col-md-6">
							<label>Last Name</label>
							<input type="text" name="lname" id="lname" class="form-control" placeholder="Your lastname">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<label>Email</label>
							<input type="text" name="email" id="email" class="form-control" placeholder="Your email address">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<label>Subject</label>
							<input type="text" id="subject" name="subject" class="form-control" placeholder="Your subject of this message">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<label for="message">Message</label>
							<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Say something about us"></textarea>
						</div>
					</div>
					<div class="form-group text-center">
						<input type="submit" value="Send Message" class="btn btn-primary">
					</div>

				</form>
				<div id="error_message"></div>
			
				</div>
				</div>


				<div id="map" class="colorlib-map">
					<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJjbOaMz5ofDkRUFjngVDsBlo&key=AIzaSyCaSIsq3EL36m9TmYPoxZYK3SwdASf-m_Y" allowfullscreen></iframe>
				</div>					
				
			</div>
		</div>
	</div>

</body>
<script src="<?= base_url('asset/web/js/jquery.min.js') ?>"></script> 
<script src="<?= base_url('asset/web/js/bootstrap4.min.js') ?>"></script>


   <!--/.Main layout-->


   <script type="text/javascript">
   	$("#contactForm").submit(function(e){
         e.preventDefault();

        var formData = new FormData(this);
        if(confirm("Do you want to send your contact detail?")==true){

        
           $.ajax({
              url:base_url+"ContactController/send_mail",
              type:'POST',
              dataType:'json',
              data:  new FormData(this),
              cache: false,
              contentType: false,
              processData:false,
              success:function(data){
              	// console.log(data);
                    $('#contactForm')[0].reset();
                    $("#error_message").fadeIn(1000, function(){
				      	$(this).html(data['message']);
					});
                  
	              }
           });
        }else{ alert('cancelled'); }
    });
   </script>
	

</html>

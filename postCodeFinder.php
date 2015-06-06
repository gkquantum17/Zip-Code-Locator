<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Zip Code Locator </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		html, body {
			height: 100%;
			padding: 0;
			margin: 0;
		}
		.container{
			background-image: url("pcb.jpg");
			width: 100%;
			height: 100%; 
			background-size: cover; 
			background-position: center;
			padding-top: 100px;
		}
		.center{
			text-align: center;
		}
		.grey{
			color: white;
		}
		p{
			padding-top: 15px;
			padding-bottom: 15px;
		}
		button{
			margin-top: 15px;
		}
		.alert{
			margin-top: 20px;
			display: none;
		}
		#textContainer{
			padding: 10px 30px 30px 30px;
			background: rgba(160, 160, 160, 0.7);
			border-radius: 30px;
		}
	</style>
  </head>
  <body>
	
	<div class = "container">
		<div class = "row">
		
				<div id = "textContainer" class = "col-md-6 col-md-offset-3 center grey">
					<h1> Zip Code Locator </h1>
					<p class = "lead"> Enter any address to find its zip code. </p>
					<form>
						<div class = "form-group">
							<input type = "text" class = "form-control" name ="address" id = "address" placeholder = "Eg. 63 Fake Street, Faketown; Fake Company; Fake School ... "/>
						</div>
						<button id = "findMyZipCode" class = "btn btn-primary btn-lg"> Find My Zip Code </button>
					</form>
					<div id = "fail" class = "alert alert-danger"> We could not find the zip code for that address. Please try again. </div>
				<div id = "success" class = "alert alert-success"> Success!</div>
				<div id = "noConnection" class = "alert alert-danger"> Could not connect to server. Please try again later.</div>
				</div>
				
				
		</div>
		
			
	</div>
	
	
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	
	
	<script>
		$("#findMyZipCode").click(function(event){
		
		var result = 0; 
		$(".alert").hide();
		event.preventDefault(); 
			$.ajax({
				type: "GET", 
				url: "https://maps.googleapis.com/maps/api/geocode/xml?address="+encodeURIComponent($('#address').val())+"&key=AIzaSyAy5-W2dIqu3NLpMwSWS1FWXjqaWaWLRdc",
				dataType: "xml",
				success: processXML,
				error: error
				});
				function error(){
					$("#noConnection").fadeIn();
					
				}
				function processXML(xml){
					$(xml).find("address_component").each(function(){
						if ($(this).find("type").text() == "postal_code"){
							$("#success").html("The zip code you need  is " + $(this).find('long_name').text()).fadeIn();
							result = 1; 
						}				
					}); 
					if (result == 0 ){
						$("#fail").fadeIn(); 
					}
				}
			});
	</script>
	
	
	
 </body>
</html>
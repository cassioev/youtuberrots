<html>
<head>
	<!-- Latest compiled and minified CSS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
<script>


 $(document).ready(function(){

 	 $("#backToTheFuture").click(function(){

 	 	var firstDate = $( "#dateInsertion0").val();
 	 	
 	 	if (typeof firstDate == 'undefined'){
 	 		firstDate = '2010-01-11 00:00:00'; //pega os ultimos 5 do banco
 	 	}


 	 	
 	 	$.ajax({
 	 		url: "<?php echo base_url(); ?>Main/send_new_like_to_client_ajax/", 
 	 		type: 'post', 
 	 		data : {
			    firstDate 
			},
 	 		success: function(result){
        	
        		if(result != false){
        			$(".table-container").hide();
		     		$(".table-container").empty();
		     		$('.table-container').html(result);
		     		$('.table-container').fadeIn("fast");
		     	}

    	}});



 	       
     });   


 	






 	 $("#backInTime").click(function(){

 	 	//alert($( "#dateInsertion" ).val());
 	 	var rowCount = $('.table-container tr').length-1;
 	 	var lastDate = $( "#dateInsertion"+(rowCount) ).val();

 	 	//$('.bg').css("background-image", "url(<?php echo asset_url().'/images/';?>"+ Math.floor((Math.random() * 5) + 1)+".jpg)"); 

 	 	$.ajax({
 	 		url: "<?php echo base_url(); ?>Main/send_old_like_to_client_ajax/", 
 	 		type: 'post', 
 	 		data : {
			    lastDate 
			},
 	 		success: function(result){
        	
        	$(".table-container").hide();
     		$(".table-container").empty();
     		$('.table-container').html(result);
     		$('.table-container').fadeIn("fast");

    	}});
     		
     	
           
     });   



 // 	 $(document.body).on('hidden.bs.modal', function () {
	   
     		     		
 //     		$(".closeModal iframe").attr("src", $(".closeModal iframe").attr("src"));
     		     		
	// });
 	


 	$(".myModalYoutuber").on('shown.bs.modal', function(event){

 		$(idmModal+" .modal-body").empty();
 		var idmModal = "#"+$(this).attr("id"); 
     	var video =  idmModal.slice(8 , idmModal.length); 
     	     	
     	$(idmModal+" .modal-body").empty();
     	$(idmModal+" .modal-body").append('<iframe class="youtubeModal" width="100%" height="315" src="https://www.youtube.com/embed/'+video+'" frameborder="0" allowfullscreen></iframe>').fadeIn('slow');
 	 });

 	
    
     $(".closeModal").click(function(){
     		
     		var idmModal = "#"+$(this).attr("id");  		
     		     		
     		 $(idmModal).on('hidden.bs.modal', function (e) {
     			$(idmModal+" iframe").attr("src", $(idmModal+" iframe").attr("src"));
		 });
           
     });   





});



</script>



<style>



/*    --------------------------------------------------
	:: General
	-------------------------------------------------- */
body {
	font-family: 'Open Sans', sans-serif;
	color: #353535;
}
.bg {
    /* The image used */
    background-image: url("<?php echo asset_url().'images/'.random_bg().'.jpg';?>");
    
    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.content h1 {
	text-align: center;
}
.content .content-footer p {
	color: #6d6d6d;
    font-size: 12px;
    text-align: center;
}
.content .content-footer p a {
	color: inherit;
	font-weight: bold;
}

/*	--------------------------------------------------
	:: Table Filter
	-------------------------------------------------- */
.panel {
	border: 1px solid #ddd;
	background-color: #fcfcfc;
}
.panel .btn-group {
	margin: 0px 0 30px;
}
.panel .btn-group .btn {
	transition: background-color .3s ease;
}
.table-filter {
	background-color: #fff;
	border-bottom: 1px solid #eee;
}
.table-filter tbody tr:hover {
	
	background-color: #eee;
}
.table-filter tbody tr td {
	padding: 10px;
	vertical-align: middle;
	border-top-color: #eee;
}
.table-filter tbody tr.selected td {
	background-color: #eee;
}
.table-filter tr td:first-child {
	width: 38px;
}
.table-filter tr td:nth-child(2) {
	width: 35px;
}
.ckbox {
	position: relative;
}
.ckbox input[type="checkbox"] {
	opacity: 0;
}
.ckbox label {
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
.ckbox label:before {
	content: '';
	top: 1px;
	left: 0;
	width: 18px;
	height: 18px;
	display: block;
	position: absolute;
	border-radius: 2px;
	border: 1px solid #bbb;
	background-color: #fff;
}
.ckbox input[type="checkbox"]:checked + label:before {
	border-color: #2BBCDE;
	background-color: #2BBCDE;
}
.ckbox input[type="checkbox"]:checked + label:after {
	top: 3px;
	left: 3.5px;
	content: '\e013';
	color: #fff;
	font-size: 11px;
	font-family: 'Glyphicons Halflings';
	position: absolute;
}
.table-filter .star {
	color: #ccc;
	text-align: center;
	display: block;
}
.table-filter .star.star-checked {
	color: #F0AD4E;
}
.table-filter .star:hover {
	color: #ccc;
}
.table-filter .star.star-checked:hover {
	color: #F0AD4E;
}
.table-filter .media-photo {
	width: 45px;
}
.table-filter .media-body {
    
    /* Had to use this style to force the div to expand (wasn't necessary with my bootstrap version 3.3.6) */
}
.table-filter .media-meta {
	font-size: 11px;
	color: #999;
}
.table-filter .media .title {
	color: #ff1a1a;
	font-size: 14px;
	font-weight: bold;
	line-height: normal;
	font-family: 'Merriweather', serif;
	margin: 0;
}
.table-filter .media .title span {
	font-size: .8em;
	margin-right: 20px;
}
.table-filter .media .title span.pagado {
	color: #5cb85c;
}
.table-filter .media .title span.pendiente {
	color: #f0ad4e;
}
.table-filter .media .title span.cancelado {
	color: #d9534f;
}
.table-filter .media .summary {
	font-size: 14px;
	font-family: 'Merriweather', serif;
}
.img-circle {
    border-radius: 50%;
}
.panel{
	opacity: 0.80;
}
.panel:hover{
	opacity: 1;
}
.modal-backdrop {
  z-index: -1;
}




h1,h4{
	font-family: 'Merriweather', serif;
	color: #ff1a1a;
}
</style>

</head>

<title>YouTubeRoots</title>
<div class="bg">
<div class="container">
	<div class="row">

		<section class="content">
			<h1>YouTubeRoots</h1>
			<div class="col-md-8 ">
				<div  class="panel panel-default">
					<div class="panel-body">
						<div class="pull-right">
							
						</div>
						<div class="table-container">
							<table class="table table-filter">
								<tbody>
									 <?php $cont = 0;?>
									 <?php foreach ($userInfos as $user):?>

									<tr data-status="pagado">
										<td>
											<div class="media-body">
												
											<span  class="media-meta pull-right">(<?php echo $user['name_user'];?>)</span>

											</div>
										</td>
										<td>
												<img width="55" class="img-circle" src="<?php echo $user['user_photo'];?>" class="media-photo">
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
												
												</a>
												<div class="media-body">
													<span class="media-meta pull-right"><?php echo date("d-m-Y ", $user['time_reg']);?></span>
													
													<input type="hidden" id="dateInsertion<?php echo $cont++;?>" value="<?php echo date("d-m-Y H:i:s", $user['time_reg']);?>">
													<h4 class="title">
														<?php echo $user['title_video'];?>
														
													</h4>
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?php echo $user['video_url'];  ?>">
														  Assitir ao Vídeo
														</button>
													
</a>													
													
												</div>
											</div>
										</td>
									</tr> 

									<?php endforeach;?>
									


								</tbody>
							</table>

							
							<!-- Modal -->
							

						</div>
						<button  style="float:right;" id="backInTime" type="button" class="btn btn-primary">voltar no tempo</button>
						<button  style="float:left;" id="backToTheFuture" type="button" class="btn btn-primary">avançar no tempo</button>
					</div>
				</div>
				</div>
				<div class="content-footer">
					
				</div>
			</div>
		</section>
		
	</div>
</div>
 <?php foreach ($userInfos as $user):?>
<div class="modal fade myModalYoutuber" id="myModal<?php echo $user['video_url'];  ?>"  role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							       
							        <h4 class="modal-title title" id="myModalLabel">	<?php echo $user['title_video'];?></h4>
							      </div>
							      <div class="modal-body">
							      <!--  <iframe class="youtubeModal" width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $user['video_url'];  ?>" frameborder="0" allowfullscreen></iframe>
							      -->
							      </div>
							      <div class="modal-footer">
							        <button id="myModal<?php echo $user['video_url'];  ?>" type="button" class="btn btn-default closeModal" data-dismiss="modal">Fechar</button>
							    
							      </div>
							    </div>
							  </div>
							</div>

<?php endforeach;?>

</html>
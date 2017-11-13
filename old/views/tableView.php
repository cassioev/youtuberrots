
<script>


 $(document).ready(function(){

 	 	$(".myModalYoutuber").on('shown.bs.modal', function(event){

 		var idmModal = "#"+$(this).attr("id"); 
     	var video =  idmModal.slice(8 , idmModal.length); 
     	$(idmModal+" .modal-body").empty();  	
     	
     	$(idmModal+" .modal-body").append('<iframe class="youtubeModal" width="100%" height="315" src="https://www.youtube.com/embed/'+video+'" frameborder="0" allowfullscreen></iframe>');
 	 });






});




</script>

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
													<span class="media-meta pull-right"><?php echo date("d-m-Y", $user['time_reg']);?></span>
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

							<!--<button  style="float:right;" id="backInTime" type="button" class="btn btn-primary">voltar no tempo</button>
							<!-- Modal -->
							

						</div>
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
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
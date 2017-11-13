

    <?php foreach ($userInfos as $user):?>

        
          <div id="<?php echo $user['video_url'];  ?>" class="row">
                                
                <div class="panel panel-default">


                    <?php 

                        if($user === end($userInfos))
                        {
                            $item = 'last';
                        }
                        else
                        {
                            $item = '';
                        } 




                     ?>
                                
                    <div  id="<?php echo $user['video_url']; ?>pn">
               
                        <table class="table table-filter">
                                
                            <tbody>                             
                            <tr data-status="pagado">
                                
                          <td>
                               
                           <div class="media-body">
                               <span class="media-meta pull-right">(<?php echo $user['name_user'];?>)</span>
                                                        </div>
                                
                                                    </td>
                                
                                 <td>
                                    <img width="55" class="img-circle"  src="<?php echo $user['user_photo'];?>"  class="media-photo">
                                 </td>
                                                      
                                                        <td>
                                
                                                            <div class="media">
                                                                <a href="#" class="pull-left"></a>
                                                                <div class="media-body">
                                                                    <span class="media-meta pull-right">
                                                                        <?php echo date("d-m-Y ", $user['time_reg']);?>
                                                                    </span>
                                                                    <input class="<?php echo $item; ?>" type="hidden" id="dateInsertion" value="<?php echo date("d-m-Y H:i:s", $user['time_reg']);?>">
                                                                        <h4 class="title">
                                                                            <?php echo $user['title_video'];?>
                                                                        </h4>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                          <!--   <iframe class="youtubeModal" width="100%" height="315" src="https://www.youtube.com/embed/a4QQ7HYYdWw" frameborder="0" allowfullscreen></iframe>
                                        -->

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach;?>

    <a id="botaoAjax" class="btn btn-circle btn-danger">+</a>






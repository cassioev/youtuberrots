<!DOCTYPE html>
<html lang="en">

    <head>
        <title>YouTubeRoots</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="16x16" href="https://youtuberoots.000webhostapp.com/youtuberoots/assets/images/favicon-16x16.png">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



        <script type="text/javascript" src="<?php echo asset_url() . 'js/html5lightbox/html5lightbox.js'; ?>"></script>



        <script>
            
            var player;








            $(document).ready(function () {



                //####################################################################################################

                $(document).ajaxComplete(function (event, request, settings) {


                    var url = settings.url;

                    if (url.includes("send_old_like_to_client_ajax"))
                    {

                        $('.row').unbind('click');
                        $('#botaoAjax').unbind('click');

                        $('.row').click(function () {

                            var panelId = '#' + $(this).attr("id") + 'pn';
                            var urlVideo = $(this).attr("id");
                            var frameName = urlVideo + 'frame';

                            if ($('#' + frameName).length) {

                                $('#' + frameName).fadeOut(700, function () {
                                    $(this).remove();
                                });

                            } else {

                                $(panelId).append('<iframe id="' + frameName + '" class="youtubeModal" width="100%" height="315" src="https://www.youtube.com/embed/' + urlVideo + '" frameborder="0" allowfullscreen></iframe>');

                            }




                        });



                        $('#botaoAjax').click(function () {

                            ajaxFunction();
                            $('html, body').animate({
                                scrollTop: $('#botaoAjax').offset().top
                            }, 2000);

                        });
                    }
                });

                //####################################################################################################


                function ajaxFunction() {

                    var lastDate = $('.last').val();

                    $('.last').removeClass('last');

                    $.ajax({
                        url: '<?php echo base_url(); ?>Main/send_old_like_to_client_ajax/',
                        type: 'post',
                        data: {
                            lastDate
                        },
                        dataType: 'html',
                        success: function (result) {

                            $('#botaoAjax').remove()
                            $('.wrapper').append(result);

                        }
                    });

                }


                //####################################################################################################


                $('#botaoAjax').click(function () {

                    ajaxFunction();

                    $('html, body').animate({
                        scrollTop: $("#botaoAjax").offset().top
                    }, 2000);



                });




                //####################################################################################################

                $('.row').click(function (event) {




                    var panelId = '#' + $(this).attr('id') + 'pn';
                    var urlVideo = $(this).attr('id');
                    var idDiv = 'player'+$(this).attr('id');

                    if ($('#' + idDiv).length) {

                        $('#' + idDiv).fadeOut(700, function () {
                            $(this).remove();
                        });

                    } else {

                        //$(panelId).append('<iframe id="' + frameName + '" class="youtubeModal" width="100%" height="315" src="https://www.youtube.com/embed/' + urlVideo + '" frameborder="0" allowfullscreen></iframe>');
                        
                        $(panelId).append("<div id="+idDiv+"></div>");
                        
                        var tag = document.createElement('script');

                        tag.src = "https://www.youtube.com/iframe_api";
                        var firstScriptTag = document.getElementsByTagName('script')[0];
                        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                        // 3. This function creates an <iframe> (and YouTube player)
                        //    after the API code downloads.
                        

                        player = new YT.Player(idDiv, {
                            height: '315',
                            width: $('.row').width(),
                            videoId: urlVideo,
                            events: {
                                'onReady': function onPlayerReady(event) {
                                    event.target.playVideo();
                                }

                            }
                        });





                    }

                });


                //####################################################################################################

                $('#randomVideo').click(function () {
                
                
                    console.log(player.getPlayerState());
                    return;


                    $.ajax({
                        url: '<?php echo base_url(); ?>Main/send_random_video/',
                        dataType: 'json',
                        type: 'post',
                        success: function (urlVideo)
                        {
                            var url = 'https://www.youtube.com/embed/' + urlVideo;
                            $('#random_frame').attr('src', url);
                            $('#randomVideoModal').width(500);
                            $('#randomVideoModal').height(500);


                        }
                    });


                });


            });



        </script>




        <style>

            @media screen and (max-width: 600px) {
                #randomVideo {
                    display: none;
                }
            }

            html {
                height: 100%;
                width: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                padding: 10px;
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
            /*  --------------------------------------------------
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
            .table {
                margin-bottom: 0px;
            }
            .img-circle {
                border-radius: 50%;
            }
            .panel {
                cursor: pointer;
                opacity: 0.80;
            }
            .panel:hover {
                opacity: 1;
                -webkit-animation: jump 1s ease 0s 1 normal;
            }
            @-webkit-keyframes jump {
                0% {
                    -webkit-transform: translateY(0);
                    transform: translateY(0);
                }
                20% {
                    -webkit-transform: translateY(0);
                    transform: translateY(0);
                }
                40% {
                    -webkit-transform: translateY(-30px);
                    transform: translateY(-30px);
                }
                50% {
                    -webkit-transform: translateY(0);
                    transform: translateY(0);
                }
                60% {
                    -webkit-transform: translateY(-15px);
                    transform: translateY(-15px);
                }
                80% {
                    -webkit-transform: translateY(0);
                    transform: translateY(0);
                }
                100% {
                    -webkit-transform: translateY(0);
                    transform: translateY(0);
                }
            }
            @keyframes jump {
                0% {
                    transform: translateY(0);
                }
                20% {
                    transform: translateY(0);
                }
                40% {
                    transform: translateY(-30px);
                }
                50% {
                    transform: translateY(0);
                }
                60% {
                    transform: translateY(-15px);
                }
                80% {
                    transform: translateY(0);
                }
                100% {
                    transform: translateY(0);
                }
            }
            h1,
            h4 {
                font-family: 'Merriweather', serif;
                color: #ff1a1a;
            }
            .btn-circle:hover {
                -webkit-animation: jump 2s ease 0s infinite normal;
                animation: jump 2s ease 0s infinite normal;
            }
            .btn-circle {
                width: 49px;
                height: 49px;
                text-align: center;
                padding: 5px 0;
                font-size: 20px;
                line-height: 2.00;
                border-radius: 30px;
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 10px;
            }

            .lightboxcontainer {
                width:100%;
                text-align:left;
            }
            .lightboxleft {
                width: 40%;
                float:left;
            }
            .lightboxright {
                width: 60%;
                float:left;
            }
            .lightboxright iframe {
                min-height: 390px;
            }
            .divtext {
                margin: 36px;
            }
            @media (max-width: 800px) {
                .lightboxleft {
                    width: 100%;
                }
                .lightboxright {
                    width: 100%;
                }
                .divtext {
                    margin: 12px;
                }
            }

            #randomVideo{
                position: fixed;
            }

        </style>


    </head>



    <div class="container-fluid col-sm-1"></div>
    <div  class="container-fluid col-sm-1">
        <a  href="#randomVideoModal"  data-width=500 data-height=500  id="randomVideo" class="btn btn-circle btn-danger html5lightbox">R</a>
    </div>
    <div class="container-fluid col-sm-1"></div>






    <div class="container-fluid col-sm-6  wrapper">


        <?php foreach ($userInfos as $user): ?>


            <div id="<?php echo $user['video_url']; ?>" class="row">

                <div class="panel panel-default">


                    <?php
                    if ($user === end($userInfos)) {
                        $item = 'last';
                    } else {
                        $item = '';
                    }
                    ?>

                    <div  id="<?php echo $user['video_url']; ?>pn">

                        <table class="table table-filter">

                            <tbody>                             
                                <tr data-status="pagado">

                                    <td>

                                        <div class="media-body">
                                            <span class="media-meta pull-right">(<?php echo $user['name_user']; ?>)</span>
                                        </div>

                                    </td>

                                    <td>
                                        <img width="55" class="img-circle" src="<?php echo $user['user_photo']; ?>" class="media-photo">
                                    </td>

                                    <td>

                                        <div class="media">
                                            <a href="#" class="pull-left"></a>
                                            <div class="media-body">
                                                <span class="media-meta pull-right">
                                                    <?php echo date("d-m-Y ", $user['time_reg']); ?>
                                                </span>
                                                <input class="<?php echo $item; ?>" type="hidden" id="dateInsertion" value="<?php echo date("d-m-Y H:i:s", $user['time_reg']); ?>">
                                                <h4 class="title">
                                                    <?php echo $user['title_video']; ?>
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
        <?php endforeach; ?>

        <a id="botaoAjax" class="btn btn-circle btn-danger">+</a>




    </div>


    <div  id="randomVideoModal" style="display:none;">
        <div class="lightboxcontainer">


            <iframe id="random_frame" width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>

            <div style="clear:both;"></div>
        </div></div>





</html>
<!doctype html>
<html class="no-js" lang="ru">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> {name} | Kidris </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" href="../../dist/css/vendor.css">
  <link rel="stylesheet" id="theme-style" href="../../dist/css/app-seagreen.css">
  <style>
    input[type="file"] {
        display: none;
    }
    .camera {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }
</style>
</head>

<body>
  <div class="main-wrapper">
    <div class="app header-fixed sidebar-fixed" id="app" style="padding: 0px 20px 0px 20px;">
      <header class="header" style="left: 0;">
        <div class="header-block header-block-collapse hidden-lg-up">  </div>

        <div class="header-block header-block-buttons"> <a  href="https://vk.com/kidrisru" target="_blank" class="btn btn-sm header-btn">
         <i class="fa fa-vk"></i>
         <span>Мы в Вконтакте</span>
     </a> <a href="https://vk.com/topic-88986513_31841141" target="_blank" class="btn btn-sm header-btn">
     <i class="fa fa-star"></i>
     <span>Отзывы</span>
 </a> <a href="https://vk.com/topic-88986513_36229406" target="_blank" class="btn btn-sm header-btn">
 <i class="fa fa-cloud-download"></i>
 <span>Предложения</span>
</a> </div>

</header>

<div class="sidebar-overlay" id="sidebar-overlay"></div>
<article class="content dashboard-page" style="left: 0; padding: 20px 20px 0px 20px;">
   <section class="content">
     <h1 class="group-title">
      <a href="https://vk.com/{screen_name}" target="_blank" style="text-decoration: none"><img src="{photo}" class="img-circle"> {name}</a>
  </h1>

  <h2 class="lead"> <span class="label label-success">Рейтинг: {total_msg}</span></h2>

  <p class="group-description" align="justify" >{description} </p>
  <!-- <label class="control-label pull-right"><span id="limit">5</span> символов</label> -->
  <div class="form-group">
     <textarea rows="4" class="form-control underlined msg" placeholder="Сообщение" autofocus=""></textarea>
 </div>
 <input type="hidden" class="token" value="{token}"> 
 <form class="form-inline">
     <div class="btn-group btn-group-lg attachments">
        <button type="button" class="btn btn-secondary camera" ><i class="fa fa-fw fa-camera"></i></button>
        <button type="button" class="btn btn-secondary film" data-toggle="modal" data-target="#modal_video"><i class="fa fa-fw fa-film"></i></button>
        <!--<button type="button" class="btn btn-secondary music" data-toggle="modal" data-target="#modal_audio"><i class="fa fa-fw fa-music"></i></button>-->
        <button type="button" class="btn btn-secondary list" data-is-open="0" data-toggle="modal" data-target="#list-block"><i class="fa fa-fw fa-list"></i></button>
        <!-- <button type="button" class="btn btn-secondary zip" ><i class="fa fa-fw fa-file-zip-o"></i></button> -->
    </div>

    <input id="file-upload" type="file" style="display:none;" accept="image/*"/>
    
    <button type="button" class="btn btn-primary btn-lg btn-oval pull-right"><i id="spinner" class="fa fa-paper-plane" aria-hidden="true"></i></button>
    
</form>
{google}
<div class="form-group row ">
    <div class="images-container attachments-all">
       
            
        <div class="image-container poll-block" style="display:none;">
            <div class="controls">
                <a href="#" class="control-btn edit_options">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a href="#" class="control-btn remove remove-poll" data-toggle="modal" data-target="#confirm-modal">
                    <i class="fa fa-trash-o"></i>
                </a>
            </div>
            <div class="image" style="background-image:url('https://s3.amazonaws.com/uifaces/faces/twitter/eduardo_olv/128.jpg')"></div>
        </div>
        
    </div>

</div>

</section>

</article>
<footer class="footer" style="left: 0;">
  <div class="footer-block buttons"> 
  </div>
  <div class="footer-block author">
    <ul>
      <li> created by <a href="https://daniilak.ru">Daniilak</a> </li>
      
  </ul>
</div>
</footer>
<!-- /.modal -->
<div class="modal fade" id="list-block">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    Добавление опроса</h4>
                </div>
                <div class="modal-body">
                    <label for="" class="form-control-label">Тема опроса:</label>
                    <div class="form-group row ">
                        <div class="col-sm-6">
                            <input type="text" class="form-control underlined" id="create_poll_theme" > 
                        </div>
                        <div class="col-sm-6">
                            <label>
                                <input class="checkbox rounded is_anonymous" checked="checked" type="checkbox">
                                <span>Анонимное голосование</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-sm-8 col-sm-offset-2">
                            <label for="" class="form-control-label">Варианты ответа:</label>
                            <input type="text" class="form-control underlined" id="create_poll_question0" > 
                        </div>
                    </div>
                    <div class="options">
                        <div class="form-group row option-1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <a href="#" class="add_poll_question"><input type="text" readonly="readonly" class="form-control underlined" value="Добавить вариант"></a>
                        </div>
                    </div>
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary send_poll_question" >Прикрепить</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="modal_video">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-info">
                <div class="modal-header">
                    <button type="button" style="display:none;" class="btn btn-secondary  send_video_button pull-right" >Прикрепить<sup><span class="counter video_counter"></span></sup></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <h4 class="modal-title">Добавление видеозаписей</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row ">
                        <div class="col-sm-6">
                            <input type="text" class="form-control underlined video-input" placeholder="Начните вводить..."> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 result-video">
                        </div>
                    </div>
                    <input type="text" readonly="readonly" style="display: none" class="form-control underlined" value="Загрузить ещё">
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal_audio">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-info">
                <div class="modal-header">
                    <button type="button" class="btn btn-secondary  send_audio_button pull-right" >Прикрепить<sup><span class="counter audio_counter"></span></sup></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <h4 class="modal-title">Добавление музыки</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row ">
                        <div class="col-sm-6">
                            <input type="text" class="form-control underlined audio-input" placeholder="Начните вводить..."> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 result-audio">
                        </div>
                    </div>
                    <input type="text" readonly="readonly" style="display: none" class="form-control underlined audio-more" value="Загрузить ещё">
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->



    <!-- Reference block for JS -->
    <div class="ref" id="ref">
      <div class="color-primary"></div>
      <div class="chart">
        <div class="color-primary"></div>
        <div class="color-secondary"></div>
    </div>
</div>

<script src="../dist/js/vendor.js"></script>
<script src="../dist/js/app.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="../dist/js/pages/ask.js?v=53"></script>
{scripts}
</body>

</html>
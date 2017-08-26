<section class="section">
    <div class="row ">
        <div class="col-xl-12">
         <div class="card card-default">
            <div class="card-block">
                <p>Предлагайте свои идеи по улучшению сервиса. Отличную идею мы с удовольствием воплотим в жизнь.</p>
                <button type="button" class="btn btn-oval btn-success" data-toggle="modal" data-target="#confirm-modal">Предложить свою идею</button>
            </div>
        </div>
    </div>     
</div>

<div class="row">
    {block_ideas}
</div>
</section>
<!-- .modal -->
<div class="modal fade" id="confirm-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
           <h4 class="modal-title">Кратко опишите суть идеи</h4>
       </div>
       <div class="modal-body">
        <p>В течение 1-2 рабочих дней ваша идея будет промодерирована и выставлена на всеобщее голосование</p>
        <div class="form-group">
            <input type="text" class="form-control underlined theme" required placeholder="Тема"> 
        </div>
        <div class="form-group">
        <textarea rows="3" class="form-control underlined description" required placeholder="Описание"></textarea>
    </div>
    </div>

    <div class="modal-footer"> <button type="button" class="btn btn-primary send" data-dismiss="modal">Отправить</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button> </div>
</div>
</div>
</div>
<!-- .modal -->



<section class="section">
    <div class="row">
        <div class="col-xl-6">
            <div class="card card-success">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> {name} </p>
                    </div>
                </div>
                <div class="card-block block-on" style="display: {hideOne}">
                    <center><img src="{photo_100}" alt="">   
                        <h4>Рейтинг: {total_msg}</h4>
                    </center>
                    <br>
                    <label>Это ваша ссылка страницы отправки анонимных сообщений в сообщество:</label>
                    <div class="input-group">
                        <input type="text" onClick="$(this).select();" class="form-control" value="https://kidris.ru/{screen_name}">
                        <span class="input-group-addon"><i class="fa fa-chain" aria-hidden="true" ></i></span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>
                            <input class="checkbox rounded show_desc"  {show_desc} type="checkbox">
                            <span>Показывать описание сообщества</span>
                        </label>
                    </div>
                    <div class="form-group desc-block" style="display: {desc_block}">
                        <textarea placeholder="Здесь описание вашей группы" class="form-control description" rows="4" style="resize: none;">{description}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>
                            <input class="checkbox rounded show_count_msg"  {show_count_msg} type="checkbox">
                            <span>Показывать количество отправленных сообщений</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            <input class="checkbox rounded auto-add" {auto_add} type="checkbox">
                            <span>Автоподпись</span>
                        </label>
                    </div>
                    <div id="auto-add-block" style="display: {displayAutoAdd}">
                        <div class="form-group">
                            <textarea placeholder="Хештеги, ссылки и т.д." class="form-control auto_add_text" rows="3"  id="" style="resize: none;">{auto_add_text}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Подписывать</label>
                            <div>
                                <label>
                                    <input class="radio squared auto_add_down" name="squared-radios11" {auto_add_down} type="radio">
                                    <span>После сообщения</span>
                                </label>
                                <label>
                                    <input class="radio squared auto_add_up" name="squared-radios11" {auto_add_up} type="radio">
                                    <span>До</span>
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label>
                            <input class="checkbox rounded auto-add-photo" {auto_add_photo} type="checkbox">
                            <span>Фотоподпись</span>
                        </label>
                        

                    </div>
                    <div class="form-group" id="photo_group">
                      <div id="sub_block_file1" style="display:{sub_block_file1};">
                       <input type="file" name="file" id="file"  accept='image/*'>
                       <span class="help-block">форматы JPG,PNG</span>
                   </div>
                   <div id="sub_block_file2" style="display:{sub_block_file2};">
                    
                    <a class="btn btn-app" id="edit_ph">
                        <i class="fa fa-repeat"></i> Изменить фото
                    </a>
                    {auto_add_photo_url}
                </div>
                
                
            </div>
            <hr>
            <div class="form-group">
                <label>
                    <input class="checkbox rounded notifications"  {notifications} type="checkbox">
                    <span>Уведомления</span>
                </label>
            </div>
            <div id="notifications_block" style="display: {displayNotifications}">
                <div class="form-group">
                    <div>
                        <label>
                            <span>Через Вконтакте</span>
                        </label>
                        <label>
                            <span>Через Telegram</span>
                        </label>
                    </div>
                </div>
            </div>

            
        </div>
        <div class="card-block block-off" style="display: {hideTwo}">
            <center><img src="{photo_100}" alt=""></center>
            <p>{description_vk}</p>
        </div>
        <div class="card-footer footer-on" style="display: {hideOne}" > 
            <button type="button" class="btn btn-danger-outline delete">Отключить</button>
            <button type="button" class="btn btn-success pull-right update">Обновить</button>
        </div>
        <div class="card-footer footer-off" style="display: {hideTwo}"> 
            <button type="button" class="btn btn-success pull-right plug">Подключить</button>

        </div>
    </div>
</div>
<div class="col-xl-6">
	<div class="card card-success"  style="display: {hideOne}">
		<div class="card-header">
			<div class="header-block">
                <p class="title">Записи</p>
            </div>
            </div>
			<div class="card-block block-on">
				{posts}
            </div>
    </div>
</div>
</div>
</section>
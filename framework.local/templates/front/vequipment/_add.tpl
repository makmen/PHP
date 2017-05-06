<h3 class="register">{if $mode =='add'}Добавить вакуумную установку{else}Редактировать вакуумную установку{/if}</h3>
{if $errs['message']} 
	<div class="mess-top">
		<div class="error"><div class="msg">{$errs['message']}</div></div>
	</div>
{/if}
<div>
	<form id="register" method="post" action="{url $module $template}{if $mode =='edit'}/{$id}{/if}" enctype="multipart/form-data">
		<div class="fb">
			<div class="description">Название:</div>
			<div class="date">
				<input class="w100{if isset($errs['title'])} err{/if}" type="text" name="title" value="{$title}" />
				{if isset($errs['title'])}
					<div class="error">
						<div class="msg">{$errs['title']}</div>
					</div>
				{/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">Описание:</div>
			<div class="date">
				<textarea id="content" name="content" class="w100{if isset($errs['content'])} err{/if}" rows="10" cols="10">{$content}</textarea>
				{if isset($errs['content'])}
					<div class="error">
						<div class="msg">{$errs['content']}</div>
					</div>
				{/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">Состав установки:</div>
			<div class="date">
				<textarea id="composition" name="composition" class="w100{if isset($errs['composition'])} err{/if}" rows="20" cols="10">{$composition}</textarea>
				{if isset($errs['composition'])}
					<div class="error">
						<div class="msg">{$errs['composition']}</div>
					</div>
				{/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">Цена:</div>
			<div class="date">
				<input class="w30{if isset($errs['price'])} err{/if}" type="text" name="price" value="{$price}" />
				{if isset($errs['price'])}
					<div class="error">
						<div class="msg">{$errs['price']}</div>
					</div>
				{/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">Технические данные:</div>
			<div class="date">
				<textarea id="technical_data" name="technical_data" class="w100{if isset($errs['technical_data'])} err{/if}" rows="10" cols="10">{$technical_data}</textarea>
				{if isset($errs['technical_data'])}
					<div class="error">
						<div class="msg">{$errs['technical_data']}</div>
					</div>
				{/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">Источники питания:</div>
			<div class="date">
				<select class="w100" id="powers" name="powers[]" multiple="multiple" size = "5">
					{foreach $allpowers as $k=>$v}
						<option value="{$v['id']}" {if in_array($v['id'], $powers)} selected="selected"{/if}>{$v['title']}</option>
					{/foreach}
				</select>
				{if isset($errs['powers'])}
					<div class="error">
						<div class="msg">{$errs['powers']}</div>
					</div>
				{/if}
			</div>
			<div class="cb"></div>
		</div>
		<div class="fb">
			<div class="description">Изображение:</div>
			<div class="date">
			<div id="butUpload">
				<span>Выбрать файл</span>
			</div>
			<img src="{uri 'images/loading.gif'}" id="imgLoad" />
			<ul id="files">
				{if ($photo != "")}<li>{$photo}</li>{/if}
			</ul>
				{if isset($errs['photo'])}
					<div class="error">
						<div class="msg">{$errs['photo']}</div>
					</div>
				{/if}
			</div>
			<input id="photo" type="hidden" name = "photo" value="{$photo}">
			<div class="cb"></div>
		</div>
		<br>
		<div class="submit news">
			 <input class="btn" type="submit" value="Сохранить">
		</div> 
	</form>
</div>
<script type="text/javascript" src="{uri 'js/ajaxupload.js'}"></script>
	<script type="text/javascript">
	$(document).ready(function(){ 
		var button = $('#butUpload > span'), interval;
		var url = "{url $module loader}";
		new AjaxUpload(butUpload, { 
			action: url, 
			onSubmit : function(file, ext){ 
			if (ext && /^(gif|png|jpg|jpeg|bmp)$/i.test(ext)) { 
				button.text('Загрузка');
				this.disable();
				$("#imgLoad").show();
				interval = window.setInterval(function(){ 
					var text = button.text();
					if (text.length < 13) { 
						button.text(text + '.');
					} else { 
						button.text('Загрузка');
					}
				}, 200);
				} else { 
					$("#files").empty();
					$("<li></li>").appendTo("#files").text("такой тип файлов не поддерживается");
					return false;
				}
			},
			onComplete: function(file, response){ 
                            var arr = response.split(';;;;;');
                            $("#imgLoad").hide();
                            button.text('Загружено');
                            window.clearInterval(interval);
                            this.enable();
                            $("#files").empty();
                            $('<li></li>').appendTo('#files').text(arr[0]);
                            $('#photo').val(arr[0]);
			}
		});
	});
	</script>



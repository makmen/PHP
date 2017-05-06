<ul class="ambitios_menu">
  <li><a href="{SERVER_ROOT}" {if $module ==''}class="ambitios_active"{/if}><span><span>Главная</span></span></a></li>
  <li><a href="{url article technology}" {if $template =='technology'}class="ambitios_active"{/if}><span><span>Технологии</span></span></a></li>
  <li><a href="#"><span><span>Оборудование</span></span></a>
      <ul>
          <li><a href="{url vequipment}">Вакуумное оборудование</a>
              {if $_SESSION['group'] == 1}
                  <ul>
                      <li><a href="{url vequipment add}">Добавить оборудование</a></li>
                  </ul>
              {/if}
          </li>
          <li><a href="{url power}">Технологические источники</a>
              {if $_SESSION['group'] == 1}
                  <ul>
                      <li><a href="{url power add}">Добавить источник</a></li>
                  </ul>
              {/if}
          </li>
      </ul>
  </li>
  <li><a href="{url news}" {if $module =='news'}class="ambitios_active"{/if}><span><span>Новости</span></span></a>
  {if $_SESSION['group'] == 2}
      <ul>
          <li><a href="{url news add}">Добавить новость</a></li>
      </ul>
  {/if}
  </li>
  <li><a href="{url article contacts}" {if $template =='contacts'}class="ambitios_active"{/if}><span><span>Контакты</span></span></a></li>
  {if $_SESSION['group'] == 1}
          <li><a href="{url account register}" {if $operation =='register'}class="ambitios_active"{/if}><span><span>Добавить админа</span></span></a></li>
  {/if}
  {if isset($_SESSION['login'])}
      <li><a href="#" {if $operation =='edit' || $operation =='changepassword'}class="ambitios_active"{/if}><span><span>Мой профиль</span></span></a>
          <ul>
              <li><a href="{url account edit}">Изменить данные</a></li>
              <li><a href="{url account changepassword}">Изменить пароль</a></li>
          </ul>
      </li>
      <li><a href="{url account logout}"><span><span>Выход</span></span></a></li>
  {/if}
</ul>
@if ($menu)
    <div class="menu">
        <ul id="nav" class="sf-menu">
            @include( 'index.navigationItems', ['items' => $menu->roots() ])
        </ul>
    </div>
@endif
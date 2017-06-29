@if ($menu)
<div class="nav-container">
    <ul id="nav">
        @include( 'index.navigationItems', [ 'items' => $menu->roots(), 'index' => 0 ])
    </ul>
</div>
@endif
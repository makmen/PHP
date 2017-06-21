@foreach($items as $item)
    <li class="{{ $item->nickname }}" >
        <a href="{{ $item->url() }}">{{ $item->title }}</a>
        <div style="position:absolute; left: 50%;">
            <span class="triangle">&nbsp;</span>
        </div>
        @if($item->hasChildren())
            <ul class="sub-menu">
                @include('index.navigationItems', ['items'=>$item->children()])
            </ul>
        @endif
    </li>
@endforeach
@for($i = 0, $j = 0, $count = count($items); $i < $count; $i++  )
    <li class="level{{ $index }}{{ ($index > 0) ? '' : ' level-top nav-' . (++$j) }}{{ $items[$i]->hasChildren() ? ' parent' : '' }}{{ ($i) ? '' : ' first'  }}{{ ($i != ($count - 1) ) ? '' : ' last'  }}">
        <a href="{{ $items[$i]->url() }}" class="{{ ($index > 0) ? '' : 'level-top' }}" >{{ $items[$i]->title }}</a>
        @if($items[$i]->hasChildren())
            <ul class="level{{ $index }}">
                @include('index.navigationItems', ['items'=>$items[$i]->children(), 'index' => ($index + 1)])
            </ul>
        @endif
    </li>
@endfor
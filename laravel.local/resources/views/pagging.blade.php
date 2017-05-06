<div class="ambitios_pagination">
    @foreach($out['pagging'] as $k=>$v)
        <a href="{{ $out['urlpagging'] }}{{ $v }}" @if ($out['page'] == $v)class="currentpagging"@endif>{{ $v }}</a>&nbsp;
    @endforeach
</div>
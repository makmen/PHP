<div id="content-page" class="content group">
    <div class="container group">
        <h3 class="title_page">Привилегии</h3>
        <form action="{{ route('permissions.store') }}" method="POST">
            
            {{ csrf_field() }}

            <div class="short-table white">

                <table style="width:100%;">

                    <thead>
                        <th>Привилегии</th>
                        @if(!$roles->isEmpty())

                            @foreach($roles as $item)
                            <th>{{ $item->name}}</th>
                            @endforeach

                        @endif
                    </thead>
                    <tbody>

                        @if(!$priv->isEmpty())

                            @foreach($priv as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                @foreach($roles as $role)
                                <td>
                                    @if( $role->hasPermission( $item->name ) )
                                    <input checked name="{{ $role->id }}[]"  type="checkbox" value="{{ $item->id }}">
                                    @else
                                    <input name="{{ $role->id }}[]"  type="checkbox" value="{{ $item->id }}">
                                    @endif	
                                </td>
                                @endforeach
                            </tr>
                            @endforeach

                        @endif

                    </tbody>

                </table>

            </div>
            @if(!$denied)
                <input class="btn btn-the-salmon-dance-3" type="submit" value="Обновить" />
            @endif
        </form>

    </div>
</div>
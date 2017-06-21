@if($portfolios)
<div id="content-page" class="content group">
    <div class="container group">

        <h2>Добавленные портфолио</h2>
        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="align-left">ID</th>
                        <th>Проект</th>
                        <th>Текст</th>
                        <th>Заказчик</th>
                        <th>Изображение</th>
                        <th>Дата редактирования</th>
                        @if ( !$denies['delete'] )
                            <th>Дествие</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($portfolios as $portfolio)
                    <tr>
                        <td class="align-left">{{$portfolio->id}}</td>
                        <td class="align-left">
                            @if ( !$denies['update'] )
                            {!! Html::link(route('portfolios.edit',['portfolios'=>$portfolio->id]),$portfolio->project) !!}
                            @else
                            {!! $portfolio->project !!}
                            @endif
                        </td>
                        <td class="align-left">{{str_limit($portfolio->text,200)}}</td>
                        <td>{{ $portfolio->customer }}</td>
                        <td>
                            @if(isset($portfolio->img->mini))
                                {!! Html::image(asset( 'images/portfolios' ) .'/'. $portfolio->img->mini) !!}
                            @endif
                        </td>
                        <td>
                            {{ ($portfolio->updated_at) ? $portfolio->updated_at : 'Данные не редактировались' }}
                        </td>
                        
                        @if ( !$denies['delete'] )
                        <td>
                            {!! Form::open(['url' => route('portfolios.destroy',['id'=>$portfolio->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                            {{ method_field('DELETE') }}
                            {!! Form::button('Удалить', ['class' => 'btn btn-times-changing-5','type'=>'submit']) !!}
                            {!! Form::close() !!}
                        </td>
                        @endif
                    </tr>	
                    @endforeach	

                </tbody>
            </table>
        </div>
        @if ( !$denies['add'] )
        {!! HTML::link(route('portfolios.create'),'Добавить  материал',['class' => 'btn btn-the-salmon-dance-1']) !!}
        @endif

    </div>
    
    <div class='general-pagination group'>
        @if($portfolios->lastPage() > 1) 
            @if($portfolios->currentPage() !== 1)
            <a href="{{ $portfolios->url(($portfolios->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
            @endif

            @for($i = 1; $i <= $portfolios->lastPage(); $i++)
                @if($portfolios->currentPage() == $i)
                <a class="selected disabled">{{ $i }}</a>
                @else
                <a href="{{ $portfolios->url($i) }}">{{ $i }}</a>
                @endif		
            @endfor

            @if($portfolios->currentPage() !== $portfolios->lastPage())
            <a href="{{ $portfolios->url(($portfolios->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
            @endif
        @endif
    </div>
    
    <!-- START COMMENTS -->
    <div>&nbsp;</div>
    <!-- END COMMENTS -->
</div>
@endif
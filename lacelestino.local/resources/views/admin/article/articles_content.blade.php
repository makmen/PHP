@if($articles)
<div id="content-page" class="content group">
    <div class="container group">

        <h2>Добавленные статьи</h2>
        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="align-left">ID</th>
                        <th>Заголовок</th>
                        <th>Текст</th>
                        <th>Изображение</th>
                        <th>Категория</th>
                        <th>Дата добавления</th>
                        @if ( !$denies['delete'] )
                            <th>Дествие</th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                    @foreach($articles as $article)
                    <tr>
                        <td class="align-left">{{$article->id}}</td>
                        <td class="align-left">
                            @if ( !$denies['update'] )
                            {!! Html::link(route('articles.edit',['articles'=>$article->id]),$article->title) !!}
                            @else
                            {!! $article->title !!}
                            @endif
                        </td>
                        <td class="align-left">{{str_limit($article->text,200)}}</td>
                        <td>
                            @if(isset($article->img->mini))
                            {!! Html::image( asset( '/images/articles' ).'/'.$article->img->mini) !!}
                            @endif
                        </td>
                        <td>{{$article->category->title}}</td>
                        <td>{{$article->created_at}}</td>
                        @if ( !$denies['delete'] )
                        <td>
                            {!! Form::open(['url' => route('articles.destroy',['id'=>$article->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
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
        {!! HTML::link(route('articles.create'),'Добавить  материал',['class' => 'btn btn-the-salmon-dance-1']) !!}
        @endif

    </div>
    
    <div class='general-pagination group'>
        @if($articles->lastPage() > 1) 
            @if($articles->currentPage() !== 1)
            <a href="{{ $articles->url(($articles->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
            @endif

            @for($i = 1; $i <= $articles->lastPage(); $i++)
                @if($articles->currentPage() == $i)
                <a class="selected disabled">{{ $i }}</a>
                @else
                <a href="{{ $articles->url($i) }}">{{ $i }}</a>
                @endif		
            @endfor

            @if($articles->currentPage() !== $articles->lastPage())
            <a href="{{ $articles->url(($articles->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
            @endif
        @endif
    </div>
    
    <!-- START COMMENTS -->
    <div>&nbsp;</div>
    <!-- END COMMENTS -->
</div>
@endif
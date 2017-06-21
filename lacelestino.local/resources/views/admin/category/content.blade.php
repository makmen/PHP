@if($categories)
<div id="content-page" class="content group">
    <div class="container group">
        <h2>Добавленные категории</h2>
        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="align-left">ID</th>
                        <th>Заголовок</th>
                        <th>Родитель</th>
                        <th>Дата редактирования</th>
                        @if ( !$denies['delete'] )
                            <th>Дествие</th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                    @foreach($categories as $category)
                    <tr>
                        <td class="align-left">{{$category->id}}</td>
                        <td class="align-left">
                            @if ( !$denies['update'] )
                            {!! Html::link(route('categories.edit',['categories'=>$category->id]),$category->title) !!}
                            @else
                            {!! $category->title !!}
                            @endif
                        </td>
                        <td>{{ $category->parent }}</td>
                        <td>
                            {{ ($category->updated_at) ? $category->updated_at : 'Данные не редактировались' }}
                        </td>
                        @if ( !$denies['delete'] )
                        <td>
                            {!! Form::open(['url' => route('categories.destroy',['id'=>$category->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
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
        {!! Html::link(route('categories.create'),'Добавить новую категорию',['class' => 'btn btn-the-salmon-dance-1']) !!}
        @endif

    </div>
    
    <div class='general-pagination group'>
        @if($categories->lastPage() > 1) 
            @if($categories->currentPage() !== 1)
            <a href="{{ $categories->url(($categories->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
            @endif

            @for($i = 1; $i <= $categories->lastPage(); $i++)
                @if($categories->currentPage() == $i)
                <a class="selected disabled">{{ $i }}</a>
                @else
                <a href="{{ $categories->url($i) }}">{{ $i }}</a>
                @endif		
            @endfor

            @if($categories->currentPage() !== $categories->lastPage())
            <a href="{{ $categories->url(($categories->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
            @endif
        @endif
    </div>
    
    <!-- START COMMENTS -->
    <div>&nbsp;</div>
    <!-- END COMMENTS -->
</div>
@endif
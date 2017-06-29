<div style="margin:0px 50px 0px 50px;">   
    
    @if (session('status'))
        <div class="alertbox success-box">
            {{ session('status') }}
        </div>
    @endif
    
    @if($categories)
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>№ п/п</th>
                <th>Название</th>
                <th>Родитель</th>
                <th>Дата редактирования</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @set($i, ($categories->currentPage() - 1) * $categories->perPage())
            @foreach($categories as $category)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{!! Html::link(route('categories.edit',['categories'=>$category->id]), $category->title) !!}</td>
                <td>{{ $category->parent }}</td>
                <td>
                    {{ ($category->updated_at) ? $category->updated_at : 'Данные не редактировались' }}
                </td>
                <td>
                    {!! Form::open(['url'=>route('categories.destroy', ['category'=>$category->id]), 'class'=>'form-horizontal','method' => 'POST']) !!}

                    {{ method_field('DELETE') }}
                    {!! Form::button('Удалить',['class'=>'btn btn-danger','type'=>'submit']) !!}

                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
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

    @endif 
    {!! Html::link(route('categories.create'),'Добавить новую категорию') !!}
</div>





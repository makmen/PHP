<div style="margin:0px 50px 0px 50px;">   
    
    @if (session('status'))
        <div class="alertbox success-box">
            {{ session('status') }}
        </div>
    @endif

    @if($products)
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>№ п/п</th>
                <th>Название</th>
                <th>Цена </th>
                <th>Категория </th>
                <th>Изображение </th>
                <th>Дата редактирования</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @set($i, ($products->currentPage() - 1) * $products->perPage())
            @foreach($products as $product)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{!! Html::link(route('products.edit',['products'=>$product->id]), $product->title) !!}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->category->title }}</td>
                <td>
                    <img src="{{ asset('adm/images/products/' . $product->id . '/' . $product->img[0]['mini']) }}" alt="image">
                </td>
                <td>
                    {{ ($product->updated_at) ? $product->updated_at : 'Данные не редактировались' }}
                </td>
                <td>
                    {!! Form::open(['url'=>route('products.destroy', ['product'=>$product->id]), 'class'=>'form-horizontal','method' => 'POST']) !!}

                    {{ method_field('DELETE') }}
                    {!! Form::button('Удалить',['class'=>'btn btn-danger','type'=>'submit']) !!}

                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    

    @if($products->lastPage() > 1) 
    <div class='general-pagination group'>
        @if($products->currentPage() !== 1)
        <a href="{{ $products->url(($products->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
        @endif

        @for($i = 1; $i <= $products->lastPage(); $i++)
        @if($products->currentPage() == $i)
        <a class="selected disabled">{{ $i }}</a>
        @else
        <a href="{{ $products->url($i) }}">{{ $i }}</a>
        @endif		
        @endfor

        @if($products->currentPage() !== $products->lastPage())
        <a href="{{ $products->url(($products->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
        @endif
    </div>
    @endif

    @endif 
    {!! Html::link(route('products.create'),'Новый товар') !!}
</div>



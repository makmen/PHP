<div style="margin:0px 50px 0px 50px;">   
    
    @if (session('status'))
        <div class="alertbox success-box">
            {{ session('status') }}
        </div>
    @endif
    
    @if($orders)
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>№ п/п</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Количество</th>
                <th>Сумма</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @set($i, ($orders->currentPage() - 1) * $orders->perPage())
            @foreach($orders as $order)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{!! Html::link(route('orders.edit',['orders'=>$order->id]), $order->name) !!}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->summa }}</td>
                <td> {{ $order->status ? 'Закрытый' : 'Активный' }}</td>
                <td>
                    {!! Form::open(['url'=>route('orders.destroy', ['orders'=>$order->id]), 'class'=>'form-horizontal','method' => 'POST']) !!}

                    {{ method_field('DELETE') }}
                    {!! Form::button('Удалить',['class'=>'btn btn-danger','type'=>'submit']) !!}

                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class='general-pagination group'>
        @if($orders->lastPage() > 1) 
            @if($orders->currentPage() !== 1)
            <a href="{{ $orders->url(($orders->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
            @endif

            @for($i = 1; $i <= $orders->lastPage(); $i++)
                @if($orders->currentPage() == $i)
                <a class="selected disabled">{{ $i }}</a>
                @else
                <a href="{{ $orders->url($i) }}">{{ $i }}</a>
                @endif		
            @endfor

            @if($orders->currentPage() !== $orders->lastPage())
            <a href="{{ $orders->url(($orders->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
            @endif
        @endif
    </div>

    @endif 

</div>





<h1>Автор: {{ $data['name'] }}</h1>
<p>{{ $data['comment'] }}</p>
@if (isset( $data['telephone'] ))
<p>{{ $data['telephone'] }}</p>
@endif


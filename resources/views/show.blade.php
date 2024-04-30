<h1>{{ $pokemon->name }}</h1>
<ul>
    @foreach ($pokemon->fields as $field)
        <li>{{ $field->field_name }}: {{ $field->field_value }}</li>
    @endforeach
</ul>
<a href="{{ route('pokemons.index') }}">Вернуться к списку</a>

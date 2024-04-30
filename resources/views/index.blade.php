<h1>Список Покемонов</h1>
@if ($pokemons->isEmpty())
    <p>Покемонов нет.</p>
@else
    <ul>
        @foreach ($pokemons as $pokemon)
            <li><a href="{{ route('pokemons.show', $pokemon->id) }}">{{ $pokemon->name }}</a></li>
        @endforeach
    </ul>
    {{ $pokemons->links() }}
@endif
<a href="{{ route('pokemons.create') }}"><button>Создать</button></a>

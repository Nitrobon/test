<form action="{{ route('pokemon.store') }}" method="POST">
    @csrf
    <h3>Создание нового покемона</h3>

    <div>
        <label for="pokemon_name">Имя покемона:</label>
        <input type="text" id="pokemon_name" name="pokemon_name" required>
    </div>

    <div>
        <label for="weight">Вес:</label>
        <input type="text" id="weight" name="fields[weight][value]" pattern="^[0-9]*[.]?[0-9]+$" title="Введите числовое значение">
        <input type="hidden" name="fields[weight][type]" value="number">
    </div>

    <div>
        <label for="attack_type">Тип атаки:</label>
        <input type="text" id="attack_type" name="fields[attack_type][value]">
        <input type="hidden" name="fields[attack_type][type]" value="text">
    </div>

    <div>
        <label for="catch_date">Дата поимки:</label>
        <input type="date" id="catch_date" name="fields[catch_date][value]">
        <input type="hidden" name="fields[catch_date][type]" value="date">
    </div>

    <button type="submit" class="btn btn-primary">Создать Покемона</button>
</form>


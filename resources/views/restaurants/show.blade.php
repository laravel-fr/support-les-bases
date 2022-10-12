<x-layout>
    <x-slot:title>{{ $restaurant->name }}</x-slot:title>

    <h2>
        <a href="{{ route('restaurants.index') }}">Restaurants</a> / {{ $restaurant->name }}
    </h2>
    <div style="margin-bottom: 1rem">
        @can('update', $restaurant)
            <a href="{{ route('restaurants.edit', $restaurant) }}">Editer</a> |
        @endcan
        @can('delete', $restaurant)
            <form style="display: inline-block" action="{{ route('restaurants.destroy', $restaurant) }}" method="POST">
                @csrf
                @method('delete')
                <a href="{{ route('restaurants.destroy', $restaurant) }}" onclick="event.preventDefault(); this.closest('form').submit();">Supprimer</a>
            </form>
        @endcan
    </div>
    <ul>
        <li>Type : {{ $restaurant->type }}</li>
        <li>Adresse : {{ $restaurant->address }}</li>
    </ul>
</x-layout>

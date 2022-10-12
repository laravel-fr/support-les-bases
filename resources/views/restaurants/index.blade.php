<x-layout>
    <x-slot:title>Liste des restaurants</x-slot:title>

    <h2>Liste des restaurants</h2>
    @can('create', App\Models\Restaurant::class)
        <div style="margin-bottom: 1rem">
            <a href="{{ route('restaurants.create') }}">Créer un restaurant</a>
        </div>
    @endcan
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Restaurateur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($restaurants as $restaurant)
                <tr>
                    <td>
                        <a href="{{ route('restaurants.show', $restaurant) }}">{{ $restaurant->name }}</a>
                    </td>
                    <td>{{ $restaurant->type }}</td>
                    <td>{{ $restaurant->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>

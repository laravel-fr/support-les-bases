<x-layout>
    <x-slot:title>Edition du restaurant {{ $restaurant->name }}</x-slot:title>

    <h2 style="margin-bottom: 2rem">
        <a href="{{ route('restaurants.index') }}">Restaurants</a> /
        <a href="{{ route('restaurants.show', $restaurant) }}">{{ $restaurant->name }} </a> /
        Edition
    </h2>
    <form action="{{ route('restaurants.update', $restaurant) }}" method="POST">
        @csrf
        @method('put')
        <div style="margin-bottom: 1rem">
            <x-label for="name">Nom</x-label>
            <x-input id="name" name="name" type="text" :value="old('name', $restaurant->name)"/>
        </div>
        <div style="margin-bottom: 1rem">
            <x-label for="type">Type</x-label>
            <x-input id="type" name="type" type="text" :value="old('type', $restaurant->type)"/>
        </div>
        <div style="margin-bottom: 1rem">
            <x-label for="type">Adresse</x-label>
            <x-input id="address" name="address" type="text" :value="old('address', $restaurant->address)"/>
        </div>
        <button type="submit">Enregistrer</button>
    </form>
</x-layout>

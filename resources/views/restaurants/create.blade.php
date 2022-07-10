<x-layout>
    <x-slot:title>Créer un restaurant</x-slot:title>

    <h2 style="margin-bottom: 2rem">
        <a href="{{ route('restaurants.index') }}">Restaurants</a> / Créer un restaurant
    </h2>
    <form action="{{ route('restaurants.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 1rem">
            <x-label for="name">Nom</x-label>
            <x-input id="name" name="name" type="text" :value="old('name')"/>
        </div>
        <div style="margin-bottom: 1rem">
            <x-label for="type">Type</x-label>
            <x-input id="type" name="type" type="text" :value="old('type')"/>
        </div>
        <div style="margin-bottom: 1rem">
            <x-label for="type">Adresse</x-label>
            <x-input id="address" name="address" type="text" :value="old('address')"/>
        </div>
        <button type="submit">Enregistrer</button>
    </form>
</x-layout>

@props(['name'])

<input {{ $attributes }}/>
@error($name)
    <span style="color: red">{{ $message }}</span>
@enderror

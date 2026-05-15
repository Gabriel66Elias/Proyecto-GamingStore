<h1>Crear Nuevo Usuario</h1>
<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf
    <input type="text" name="nombre" placeholder="Nombre">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Contraseña">
    <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña">
    <select name="rol_id">
        @foreach($roles as $rol)
            <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
        @endforeach
    </select>
    <button type="submit">Guardar</button>
</form>
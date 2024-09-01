<h1>{{ Auth::User()->name }}</h1>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
    @csrf
    <button type="submit">logout</button>
</form>
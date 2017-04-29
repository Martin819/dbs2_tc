

<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/">HOME</a>
  <div class="collapse navbar-collapse" id="navbarCollapse">

    @if(Auth::check())

      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/branches">Pobočky</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/employees">Zaměstnanci</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/vehicles">Vozidla</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/timetables">Jízdní řády</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/customers">Zákazníci</a>
        </li>
      </ul>

      <div class="ml-auto">
        <a class="nav-link" style="color:white;" href="/logout">{{ Auth::user()->name }}</a>
      </div>

    @else

      <div class="ml-auto">
        <a class="nav-link" style="color:white;" href="/login">Přihlásit se</a>
      </div>
      
    @endif
  </div>
</nav>
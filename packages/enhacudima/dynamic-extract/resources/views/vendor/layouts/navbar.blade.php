<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{url('report/new')}}">
        <img src="{{asset('enhacudima/dynamic-extract/icons/database.png')}}" alt="" width="30" height="24" class="d-inline-block align-text-top">
        Dynamic Extract
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{url('report/index')}}"><i class="far fa-file-excel"></i> Files</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('report/new')}}"><i class="fas fa-database"></i> Generate</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('report/config')}}"><i class="fa  fa-cog"></i> Configuration</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

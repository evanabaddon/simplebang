<nav class="navbar navbar-expand-lg shadow-sm navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><img src="/dist/images/simplebang.png" width="150"/></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('profil') ? 'active' : '' }}" href="/profil">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('carbon-offsets') ? 'active' : '' }}" href="/carbon-offsets">Sadar Carbon Offset</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('peta-tambang') ? 'active' : '' }}" href="/peta-tambang">Peta Ex tambang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('mitra-bibit-pohon') ? 'active' : '' }}" href="/mitra-bibit-pohon">Mitra Bibit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('corp') ? 'active' : '' }}" href="/corp">Top donator</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('gallery') ? 'active' : '' }}" href="/gallery">Gallery</a>
        </li>
      </ul>
    </div>
    
  </div>
</nav>
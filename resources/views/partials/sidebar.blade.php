{{-- start sidebar --}}
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">App POS</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">POS</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="{{ Request::is('dashboard')? "active":"" }}"><a class="nav-link" href="/dashboard"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>

          <li class="menu-header">Master Data</li>
          <li class="nav-item dropdown {{ Request::is('kategori') ? "active":"" }}">
            <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master Data</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="">Data User</a></li>
              <li><a class="nav-link" href="">Data Produk</a></li>
              <li><a class="nav-link " href="/kategori">Data Kategori</a></li>     
            </ul>
          </li>

          <li class=""><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
          
        </ul>

        
    </aside>
  </div>
{{-- start sidebar --}}
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="/dashboard">App POS</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="/dashboard">POS</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="{{ Request::is('dashboard')? "active":"" }}"><a class="nav-link" href="/dashboard"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>

          <li class="menu-header">Master Data</li>
          <li class="nav-item dropdown {{ Request::is('kategori', 'produk') ? "active":"" }}">
            <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master Data</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="">Data User</a></li>
              <li><a class="nav-link" href="">Data Pegawai</a></li>
              <li><a class="nav-link" href="/produk">Data Produk</a></li>
              <li><a class="nav-link " href="/kategori">Data Kategori</a></li>     
            </ul>
          </li>

          <li class="menu-header">Transaksi</li>
          <li class="{{ Request::is('pos') ? "active":"" }}"><a class="nav-link " href="/pos"><i class="fas fa-money-bill-wave"></i> <span>Point Of Sale</span></a></li>
          
        </ul>

        
    </aside>
  </div>
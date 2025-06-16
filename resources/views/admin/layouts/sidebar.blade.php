<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="/books-list" class="nav-link {{ request()->is('books-list') || request()->is('books-page*') ? 'active' : '' }}">
                <i class="icon-book menu-icon"></i>
                <span class="menu-title">Books</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="/books-create" class="nav-link {{ request()->is('books-create') ? 'active' : '' }}">
                <i class="icon-file-add menu-icon"></i>
                <span class="menu-title">Book Creator</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="/genres-list" class="nav-link {{ request()->is('genres-list') ? 'active' : '' }}">
                <i class="icon-folder menu-icon"></i>
                <span class="menu-title"> Genres</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="/orders-list" class="nav-link">
                <i class="icon-clipboard menu-icon"></i>
                <span class="menu-title">Orders</span>
            </a>
        </li>


        <li class="nav-item">
            <a href="/users-list" class="nav-link {{ request()->is('users-list') || request()->is('users-page*') ? 'active' : '' }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="/admin/support-tickets" class="nav-link {{ request()->is('admin/support-tickets') ? 'active' : '' }}">
             <i class="icon-paper menu-icon"></i> 
                <span class="menu-title"> Tickets</span>
            </a>
        </li>


    </ul>
</nav>
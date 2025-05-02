@include('admin.layouts.header')

@include('sweetalert::alert')

<nav class="admin-sidebar d-flex flex-column flex-shrink-0 p-3 position-fixed h-100">
    <div class="mb-4">
        <span class="fs-4 fw-semibold text-black">BooksLoaf Admin</span>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
    <li>
            <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="/manage-books" class="nav-link {{ request()->is('manage-books') ? 'active' : '' }}">
                <i class="bi bi-bookshelf me-2"></i> Manage Books
            </a>
        </li>
        <li>
            <a href="/create-books" class="nav-link {{ request()->is('create-books') ? 'active' : '' }}">
                <i class="bi bi-book me-2"></i>Create Books
            </a>
        </li>
        <li>
            <a href="/manage-genres" class="nav-link {{ request()->is('manage-genres') ? 'active' : '' }}">
                <i class="bi bi-clipboard me-2"></i>Manage Genres
            </a>
        </li>
        <li>
            <a href="#" class="nav-link">
                <i class="bi bi-cart me-2"></i> Orders
            </a>
        </li>
        <li>
            <a href="#" class="nav-link">
                <i class="bi bi-people me-2"></i> Users
            </a>
        </li>
        <li>
            <a href="#" class="nav-link">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </li>
    </ul>
</nav>
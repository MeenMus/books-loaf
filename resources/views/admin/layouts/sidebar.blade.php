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
            <a href="/books-list" class="nav-link {{ request()->is('books-list') || request()->is('books-page*')  ? 'active' : '' }}">
                <i class="bi bi-bookshelf me-2"></i>Books
            </a>
        </li>
        <li>
            <a href="/books-create" class="nav-link {{ request()->is('books-create') ? 'active' : '' }}">
                <i class="bi bi-book me-2"></i>Book Creator
            </a>
        </li>
        <li>
            <a href="/genres-list" class="nav-link {{ request()->is('genres-list') ? 'active' : '' }}">
                <i class="bi bi-clipboard me-2"></i>Genres
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
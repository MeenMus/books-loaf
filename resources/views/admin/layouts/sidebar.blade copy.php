@include('admin.layouts.header')

@include('sweetalert::alert')

<nav class="admin-sidebar d-flex flex-column flex-shrink-0 p-3 position-fixed h-100">
    <div class="mb-0">
        <span class="fs-4 fw-semibold text-black">BooksLoaf Admin</span>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto" style="height: 100vh; display: flex; flex-direction: column; justify-content: space-between;">
        <li>
            <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="/books-list" class="nav-link {{ request()->is('books-list') || request()->is('books-page*') ? 'active' : '' }}">
                <i class="bi bi-bookshelf me-2"></i> Books
            </a>
        </li>
        <li>
            <a href="/books-create" class="nav-link {{ request()->is('books-create') ? 'active' : '' }}">
                <i class="bi bi-book me-2"></i> Book Creator
            </a>
        </li>
        <li>
            <a href="/genres-list" class="nav-link {{ request()->is('genres-list') ? 'active' : '' }}">
                <i class="bi bi-clipboard me-2"></i> Genres
            </a>
        </li>
        <li>
            <a href="#" class="nav-link">
                <i class="bi bi-cart me-2"></i> Orders
            </a>
        </li>
        <li>
            <a href="/users-list" class="nav-link {{ request()->is('users-list') || request()->is('users-page*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Users
            </a>
        </li>

        <li class="mt-auto">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
@props(['url'])
<tr>
<td class="header">
<a href="https://www.booksloaf.com" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://www.booksloaf.com/logo.png" alt="BooksLoaf" height="180">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>


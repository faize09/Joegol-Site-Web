$(document).ready(function () {
    // Navigation sidebar

    $('.sidebar a').on('click', function (e) {

        e.preventDefault();
        $('.sidebar a').removeClass('active');
        $(this).addClass('active');
        const page = $(this).data('page');
        $('#page-dashboard, #page-users, #page_blog').hide();
        $('#page-' + page).show();
        if (page === 'users') {
            $('#blog-table').DataTable().container().style.display = 'none';
            $('#users-table').DataTable().ajax.reload();

        } else
        if (page === 'blog') {

            $('#blog-table').DataTable().ajax.reload();

        }
    });
});
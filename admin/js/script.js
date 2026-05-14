 $(document).ready(function () {
     function showPage(page) {
         $('.sidebar a').removeClass('active');
         $(`.sidebar a[data-page="${page}"]`).addClass('active');
         $('#page-dashboard, #page-users, #page-blog').hide();
         $('#page-' + page).show();

         if (page === 'users') {
             if ($.fn.DataTable.isDataTable('#users-table')) {
                 $('#users-table').DataTable().ajax.reload();
             } else {
                 initUsersTable();
             }
         } else if (page === 'blog') {
             if ($.fn.DataTable.isDataTable('#blog-table')) {
                 $('#blog-table').DataTable().ajax.reload();
             } else {
                 initBlogTable();
             }
         }
     }

     // Navigation sidebar
     $('.sidebar a').on('click', function (e) {
         e.preventDefault();
         const page = $(this).data('page');
         showPage(page);
     });

     const params = new URLSearchParams(window.location.search);
     if (params.get('page')) {
         showPage(params.get('page'));
     }

     // --- Users DataTable ---
     function initUsersTable() {
         $('#users-table').DataTable({
             ajax: {
                 url: '',
                 type: 'POST',
                 data: {
                     action: 'read'
                 },
                 dataSrc: function (json) {
                     return json.data || [];
                 }
             },
             columns: [{
                     data: 'id'
                 },
                 {
                     data: 'nom'
                 },
                 {
                     data: 'prenom'
                 },
                 {
                     data: 'email'
                 },
                 {
                     data: null,
                     render: function (data) {
                         return `
                                <button class="btn btn-sm btn-warning btn-edit" data-id="${data.id}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                            `;
                     }
                 }
             ]
         });
     }

     // --- Blog DataTable ---
     function initBlogTable() {
         $('#blog-table').DataTable({
             ajax: {
                 url: '',
                 type: 'POST',
                 data: {
                     action: 'read_blog'
                 },
                 dataSrc: function (json) {
                     return json.data || [];
                 }
             },
             columns: [{
                     data: 'id'
                 },
                 {
                     data: 'titre'
                 },
                 {
                     data: 'contenu',
                     render: function (data) {
                         return data.length > 100 ? data.substr(0, 100) + '...' : data;
                     }
                 },
                 {
                     data: 'date'
                 },
                 {
                     data: null,
                     render: function (data) {
                         return `
                                <a class="btn btn-sm btn-warning" href="modifier_blog.php?id=${data.id}"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete-blog" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                            `;
                     }
                 }
             ]
         });
     }

     // --- Users CRUD handlers (existing) ---
     $('#btn-add').on('click', function () {
         $('#modalTitle').text('Ajouter un utilisateur');
         $('#userForm')[0].reset();
         $('#userId').val('');
         $('#password').prop('required', true);
         $('#userModal').modal('show');
     });

     $(document).on('click', '.btn-edit', function () {
         const id = $(this).data('id');
         $.post('', {
             action: 'get',
             id: id
         }, function (res) {
             if (res.success) {
                 $('#modalTitle').text('Modifier l\'utilisateur');
                 $('#userId').val(res.data.id);
                 $('#nom').val(res.data.nom);
                 $('#prenom').val(res.data.prenom);
                 $('#email').val(res.data.email);
                 $('#password').prop('required', false).val('');
                 $('#userModal').modal('show');
             }
         }, 'json');
     });

     $('#userForm').on('submit', function (e) {
         e.preventDefault();
         const id = $('#userId').val();
         const action = id ? 'update' : 'create';
         const formData = $(this).serialize() + '&action=' + action;
         $.post('', formData, function (res) {
             if (res.success) {
                 $('#userModal').modal('hide');
                 $('#users-table').DataTable().ajax.reload();
             } else {
                 alert('Erreur : ' + res.message);
             }
         }, 'json');
     });

     // --- Blog CRUD handlers ---
     $('#btn-add-blog').on('click', function () {
         $('#blogModalTitle').text('Ajouter un article');
         $('#blogForm')[0].reset();
         $('#blogId').val('');
         $('#blogModal').modal('show');
     });

     $(document).on('click', '.btn-edit-blog', function () {
         const id = $(this).data('id');
         $.post('', {
             action: 'get_blog',
             id: id
         }, function (res) {
             if (res.success) {
                 $('#blogModalTitle').text('Modifier l\'article');
                 $('#blogId').val(res.data.id);
                 $('#titre').val(res.data.titre);
                 $('#contenu').val(res.data.contenu);
                 $('#date').val(res.data.date);
                 $('#blogModal').modal('show');
             }
         }, 'json');
     });

     $('#blogForm').on('submit', function (e) {
         e.preventDefault();
         const id = $('#blogId').val();
         const action = id ? 'update_blog' : 'create_blog';
         const formData = $(this).serialize() + '&action=' + action;
         $.post('', formData, function (res) {
             if (res.success) {
                 $('#blogModal').modal('hide');
                 $('#blog-table').DataTable().ajax.reload();
             } else {
                 alert('Erreur : ' + res.message);
             }
         }, 'json');
     });

     // --- Delete handler (generic) ---
     let deleteId = null;
     let deleteType = null; // 'user' or 'blog'

     $(document).on('click', '.btn-delete', function () {
         deleteId = $(this).data('id');
         deleteType = 'user';
         $('#deleteModal').modal('show');
     });

     $(document).on('click', '.btn-delete-blog', function () {
         deleteId = $(this).data('id');
         deleteType = 'blog';
         $('#deleteModal').modal('show');
     });

     $('#confirmDelete').on('click', function () {
         if (deleteId && deleteType) {
             let action = (deleteType === 'user') ? 'delete' : 'delete_blog';
             $.post('', {
                 action: action,
                 id: deleteId
             }, function (res) {
                 if (res.success) {
                     $('#deleteModal').modal('hide');
                     if (deleteType === 'user') {
                         $('#users-table').DataTable().ajax.reload();
                     } else {
                         $('#blog-table').DataTable().ajax.reload();
                     }
                 }
             }, 'json');
         }
     });
 });

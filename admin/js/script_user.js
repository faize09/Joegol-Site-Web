$(document).ready(function () {
    $('#blog-table').DataTable().container().style.display = 'none';
    // Initialisation DataTable
    function initDataTable() {
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

    // Ajouter
    $('#btn-add').on('click', function () {
        $('#modalTitle').text('Ajouter un utilisateur');
        $('#userForm')[0].reset();
        $('#userId').val('');
        $('#password').prop('required', true);
        $('#userModal').modal('show');
    });

    // Éditer
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

    // Soumission formulaire
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

    // Supprimer
    let deleteId = null;
    $(document).on('click', '.btn-delete', function () {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
    });
    $('#confirmDelete').on('click', function () {
        if (deleteId) {
            $.post('', {
                action: 'delete',
                id: deleteId
            }, function (res) {
                if (res.success) {
                    $('#deleteModal').modal('hide');
                    $('#users-table').DataTable().ajax.reload();
                }
            }, 'json');
        }
    });
});
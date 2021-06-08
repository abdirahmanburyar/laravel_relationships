$(function () {
    let datatable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 15,
        ajax: '/roles',
        scrollX: true,
        "order": [[0, "desc"]],
        columns: [{
            data: 'DT_RowIndex',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name',
        },
        {
            data: 'action',
            orderable: false,
            searchable: false
        },
        ]
    });

    $(document).on('click', '#addRole', function () {

        $('small.text-error').text("");
        $('#create_role').modal('show');

        $('#createUserForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $(`small.text-error`).text("")
                    $('#fullNameInput').val('')
                },
                success: function (res) {
                    datatable.ajax.reload()
                    setTimeout(function () {
                        $('#create_role').modal('hide');
                    }, 1000)
                },
                error: function (err) {

                    let errors = err.responseJSON;
                    if (errors.message && !errors.errors) {
                        $(`small.name`).text(errors.message)
                    } else {
                        $.each(errors.errors, function (key, value) {
                            $(`small.${key}`).text(value)
                        })
                    }

                }
            })
        })
    })
})

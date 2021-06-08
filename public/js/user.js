$(function () {
    let datatable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 5,
        fixedHeader: true,
        ajax: '/users',
        scrollX: true,
        scrollY: '720px',
        "order": [[0, "desc"]],
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'print',
                footer: true,
                oreinted: 'potrait',
                pageSize: 'A4',
                text: '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                title: "hotel_name",
                key: {
                    shiftKey: true,
                    key: 'p'
                },
                exportOptions: {
                    columns: 'visible'
                    // columns: ':not(:last-child)'
                }
                // customize: function (win) {
                //     $(win.document.body)
                //         .css({
                //             'text-align': 'center'
                //         })
                //         .append('<span class="dt-footer">www.aaransoft.com</span>')
                // }
            }
        ],
        columns: [{
            data: 'DT_RowIndex',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name',
        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'roles',
            name: 'roles.name',
        },
        {
            data: 'address',
            name: 'address.job',
        },
        {
            data: 'action',
            orderable: false,
            searchable: false
        },
        ]
    });
    $(document).on('click', '#addUser', function () {

        $('small.text-error').text("");
        $('#create_user').modal('show');

        $('#createUserForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $(`small.text-error`).text("")
                },
                success: function (res) {
                    datatable.ajax.reload()
                    setTimeout(function () {
                        $('#create_user').modal('hide');
                    }, 1000)
                },
                error: function (err) {
                    let errors = err.responseJSON;
                    console.log(err)
                    $.each(errors.errors, function (key, value) {
                        $(`small.${key}`).text(value)
                    })

                }
            })
        })
    })

    $(document).on('click', '.delete', function () {
        $('#deleteModal').modal('show')
        let id = $(this).attr('id');
        $('#deleteUserForm').find('#userId').val(id);
        $('#deleteUserForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: `users/${id}`,
                type: "DELETE",
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.error) {
                        let errs = res.error;
                        $('small#delErr').text(errs).addClass('text-danger')
                        setTimeout(function () {
                            $('#deleteModal').modal('hide')
                        }, 2000)
                    } else {
                        datatable.ajax.reload();
                        setTimeout(function () {
                            $('#deleteModal').modal('hide')
                        }, 1000)
                    }
                },
                error: function (err) {
                    $('#delErr').append(`<li>${err.error}</li>`)
                }
            })
        })
    })
    $(document).on('click', '.view', function () {
        $('#view_user').modal('show')
        $('.modal-body p').text($(this).attr('id'))
    })
})

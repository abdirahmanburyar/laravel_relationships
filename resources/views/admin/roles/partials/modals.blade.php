  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="create_role" tabindex="-1" role="dialog"
      aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="container">
                  <h3 style="padding: 10px">New Role</h3>
                  <hr />
                  <div class="user_management">
                      <form id="createUserForm" action="{{ route('admin.roles.store') }}" method="POST">
                          @csrf
                          <div class="form-row">
                              <div class="form-group col-md-12">
                                  <label for="fullNameInput">Full Name</label>
                                  <input type="text" name="name" class="form-control" id="fullNameInput"
                                      placeholder="Enter Role Name" value="{{ old('name') }}" autocomplete="off">
                                  <small class="text-danger text-error name"></small>
                              </div>
                          </div>
                          <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

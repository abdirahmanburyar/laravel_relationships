  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="create_user" tabindex="-1" role="dialog"
      aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="container">
                  <h3 style="padding: 10px">New User :)</h3>
                  <hr />
                  <div class="user_management">
                      <form id="createUserForm" action="{{ route('admin.users.store') }}" method="POST">
                          @csrf
                          <h5 class="titles">User Credential</h5>
                          <hr />
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                  <label for="fullNameInput">Full Name</label>
                                  <input type="text" name="name" class="form-control" id="fullNameInput"
                                      placeholder="Enter Full Name" value="{{ old('name') }}" autocomplete="off">
                                  <small class="text-danger text-error name"></small>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="emailInput">Email</label>
                                  <input type="email" name="email" class="form-control" id="emailInput"
                                      placeholder="email" value="{{ old('email') }}" autocomplete="off">
                                  <small class="text-danger text-error email"></small>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                  <label for="passwordInput">Password</label>
                                  <input type="password" name="password" class="form-control" id="passwordInput"
                                      placeholder="Type Password" autocomplete="off">
                                  <small class="text-danger text-error password"></small>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="password_confirmation">Confirm Password</label>
                                  <input type="password" name="password_confirmation" class="form-control"
                                      id="password_confirmation" placeholder="Re-Type Password">
                                  <small class="text-danger text-error  password_confirmation"></small>
                              </div>
                          </div>
                          <h5 class="titles">User Role</h5>
                          <hr />
                          <div class="form-row">
                              <div class="form-group col-md-4">
                                  <label for="inputState">Role</label>
                                  <select id="inputState" name="role" class="form-control">
                                      <option value="">Choose...</option>
                                      @foreach (\Spatie\Permission\Models\Role::all() as $role)
                                          <option value="{{ old('role') ?? $role->id }}">{{ $role->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <h5 class="titles">User Information</h5>
                          <div class="form-row">
                              <div class="form-group col-md-4">
                                  <label for="phoneInput">Phone</label>
                                  <input type="text" name="phone" class="form-control" id="phoneInput"
                                      placeholder="Enter Phone" value="{{ old('phone') }}" autocomplete="off">
                                  <small class="text-danger text-error phone"></small>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="jobInput">Accupation</label>
                                  <input type="text" name="job" class="form-control" id="jobInput"
                                      placeholder="Enter User Accupation" value="{{ old('job') }}"
                                      autocomplete="off">
                                  <small class="text-danger text-error job"></small>
                              </div>
                          </div>
                          <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Delete User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <small id="delErr"></small>
                  <h3>Are You Sure To Delete?</h3>
                  <form id="deleteUserForm" method="post">
                      <div class="modal-body">
                          @csrf
                          @method('DELETE')
                          <input type="hidden" id="userId">
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-danger">Yes, Delete</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  {{-- view modal --}}
  <div class="modal fade bd-example-modal-lg" id="view_user" tabindex="-1" role="dialog"
      aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
              <div class="user_management">
                  @include('admin.users.pages.view')
              </div>
          </div>
      </div>
  </div>

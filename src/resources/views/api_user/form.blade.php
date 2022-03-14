
@extends('layout')
@section('content')
    <section id="form-page">
        <div class="container mt-3">
            <div class="row">
                <div class="col-4 mx-auto">
                    <div class="input-group mb-3">
                        <button class="btn btn-success" type="button" id="fetchUsersButton">Fetch users</button>
                        <select id="apiSelect" class="form-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                          <option selected value="-1" disabled>Choose...</option>
                          <option value="json-placeholder" data-type="json-placeholder">JSON Placeholder</option>
                            <option value="regres" data-type="regres">Regres Api</option>
                        </select>
                    </div>
                    <div class="card">
                        <div id="result">
                            Please select api and send request for fetching users
                        </div>
                    </div>         
                    
                </div>
            </div>
        </div>
    </section>
  
@endsection
@section('scripts')
    <script>
        var saveUserRoute = "{{route('api-users.store')}}"
        var localUsers = @json($local_users);
    </script>
    
    <script src="{{ mix('/js/form.js') }}"></script>
@endsection
   
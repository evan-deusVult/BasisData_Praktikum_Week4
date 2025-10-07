@extends('layouts.app')
@section('content')
<div class="row justify-content-center"><div class="col-md-5">
<h3 class="mb-3 text-dark">Register</h3>
<form method="post" action="{{ route('register.do') }}">@csrf
  <div class="mb-3">
    <label for="register_type" class="text-dark">Register Sebagai</label>
    <select class="form-select" id="register_type" name="register_type" required onchange="updateRegisterFields()">
      <option value="student">Mahasiswa</option>
      <option value="lecturer">Dosen</option>
      <option value="user">Umum</option>
    </select>
  </div>
  <div class="mb-3" id="nim_field">
    <label for="nim" class="text-dark">NIM</label>
    <input name="nim" id="nim" class="form-control">
  </div>
  <div class="mb-3 d-none" id="nip_field">
    <label for="nip" class="text-dark">NIP</label>
    <input name="nip" id="nip" class="form-control">
  </div>
  <div class="mb-3 d-none" id="email_field">
    <label for="email" class="text-dark">Email</label>
    <input type="email" name="email" id="email" class="form-control">
  </div>
  <div class="mb-3">
    <label for="name" class="text-dark">Nama</label>
    <input name="name" id="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label for="password" class="text-dark">Password</label>
    <input type="password" name="password" id="password" class="form-control" required>
  </div>
  <button class="btn btn-primary w-100">Register</button>
</form>
@if($errors->any())<div class="alert alert-danger mt-3">{{ $errors->first() }}</div>@endif
</div></div>
<script>
function updateRegisterFields() {
  var type = document.getElementById('register_type').value;
  document.getElementById('nim_field').classList.toggle('d-none', type !== 'student');
  document.getElementById('nip_field').classList.toggle('d-none', type !== 'lecturer');
  document.getElementById('email_field').classList.toggle('d-none', type !== 'user');
  document.getElementById('nim').required = (type === 'student');
  document.getElementById('nip').required = (type === 'lecturer');
  document.getElementById('email').required = (type === 'user');
}
  document.addEventListener('DOMContentLoaded', updateRegisterFields);
</script>
@endsection

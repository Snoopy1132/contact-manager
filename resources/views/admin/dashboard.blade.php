@extends(backpack_view('blank'))

@section('content')
  <div class="container-fluid py-4">
    <div id="vue-dashboard"
         data-user='@json(backpack_user())'
         data-contacts-count="{{ $contactsCount }}">
    </div>
  </div>
@endsection

@vite('resources/js/app.js')

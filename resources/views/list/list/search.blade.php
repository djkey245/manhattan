<form action="/list/search" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input id="search"  type="text" name="referal" placeholder="Пошук..."  class="form-control" >
    <button type="submit"  class="btn btn-primary btn-sm"  value="Пошук">Пошук</button>
</form>

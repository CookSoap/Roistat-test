<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body >
    
   <div class="p-5">
    <h1 class="h3 text-center mt-2 mb-2">Отправка заявок с сайта в AmoCRM</h1>
    @if (Session::has('success'))
    <div class="alert alert-success mx-auto">
        {{ Session::get('success') }}
    </div>
    @endif
    <div class="content">
        <form method="POST" action=" {{ route('form.send') }} " class="w-25 m-0 m-auto">
            @csrf
        
            <div class="form-group mb-2">
            <label for="name">Имя</label>
            <input name="name" class="form-control" id="name" placeholder="Название">
            </div>
            
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input name="email" class="form-control" id="email" placeholder="email">
            </div>
            
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="form-group mb-2">
                <label for="phone">Телефон</label>
                <input name="phone" class="form-control" id="phone" placeholder="Телефон">
            </div>
            
            @error('phone')
            <div class="error">{{ $message }}</div>
            @enderror
    

            <div class="form-group mb-2">
                <label for="price">Цена</label>
                <input name="price" class="form-control" id="price" placeholder="Цена">
            </div>

            <input type="hidden" name="moreThanThirty" class="form-control" id="moreThanThirty" value="false" >
            
            @error('price')
            <div class="error">{{ $message }}</div>
            @enderror
            
            @error('formError')
            <div class="error">{{ $message }}</div>
            @enderror
        
            <button type="submit" class="btn btn-primary my-3">Отправить</button>
        </form>
    </div>
   </div>

    </body>
    <script>
    function changeMoreThanThirty() {
        document.getElementById("moreThanThirty").value = "true";
      }
    
    setTimeout(changeMoreThanThirty, 30000);
    </script>
</html>

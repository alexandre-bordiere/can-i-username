<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Can I Username?</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body class="bg-gray-900 min-h-screen">
    <main id="app" class="flex flex-col items-center justify-center min-h-screen mx-auto space-y-12 w-2/3">
        <section class="w-full">
            <username-form></username-form>
        </section>
        <section class="w-full">
            <integrations-list></integrations-list>
        </section>
    </main>
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>

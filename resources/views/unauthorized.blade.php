<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>


</head>

<body>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">

            <div class="mx-auto max-w-screen-sm text-center lg:text-center">
            <img src="{{ asset('404.svg') }}" class="mx-auto" alt="404">
                <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-blue-700">
                    404</h1>
                <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl">Something's
                    missing.</p>
                <p class="mb-4 text-lg font-light text-gray-500">Sorry, we can't find you in our
                    system. Please try to login first and then you can access the requested page.</p>
                <a href="{{ route('home') }}"
                    class="inline-flex text-white bg-blue-700 hover:bg-blue-600 transition duration-150 focus:ring-4 focus:outline-none focus:ring-blue-700-300 font-medium rounded-lg text-sm px-5 py-3 text-center">Back
                    to Homepage</a>
            </div>
        </div>
    </section>
</body>

</html>

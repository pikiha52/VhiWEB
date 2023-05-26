<!DOCTYPE html>
<html class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="h-full">
    <div class="flex min-h-full">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <img class="h-10 w-auto"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQg0evZC83tfZpTgt7MV6OlzI7YxYDhmZeI7LDktqtAw&s"
                        alt="Your Company">
                    @if (\Request::route()->getName() == 'register')
                        <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900"> Create your accoun
                        </h2>
                    @else
                        <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900"> Sign in</h2>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Register?
                            <a href="{{ url('/signup') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Click me.</a>
                        </p>
                    @endif
                </div>

                <div class="mt-10">
                    <div>
                        @if (\Request::route()->getName() == 'register')
                            <form id="submitSignup" class="space-y-6">
                                <div>
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Full
                                        name</label>
                                    <div class="mt-2">
                                        <input id="fullname" name="fullname" type="text" autocomplete="fullname"
                                            required
                                            class="px-2 block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div class="rounded-md bg-red-50 p-4" id="divFullNameError" hidden>
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-red-800" id="messageFullNameError">
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium leading-6 text-gray-900">Email
                                        address</label>
                                    <div class="mt-2">
                                        <input id="email" name="email" type="email" autocomplete="email"
                                            required
                                            class="px-2 block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div class="rounded-md bg-red-50 p-4" id="divEmailError" hidden>
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-red-800" id="messageEmailError">
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div>
                                    <label for="password"
                                        class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                    <div class="mt-2">
                                        <input id="password" name="password" type="password"
                                            autocomplete="current-password" required
                                            class="px-2 block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div class="rounded-md bg-red-50 p-4" id="divPasswordError" hidden>
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-red-800" id="messagePasswordError">
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div>
                                    <button onclick="handleSubmitSignUp()" type="button"
                                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                                        in</button>
                                </div>
                            </form>
                        @else
                            <form id="submitSignin" class="space-y-6">
                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium leading-6 text-gray-900">Email
                                        address</label>
                                    <div class="mt-2">
                                        <input id="email" name="email" type="email" autocomplete="email"
                                            required
                                            class="px-2 block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div class="rounded-md bg-red-50 p-4" id="divEmailError" hidden>
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-red-800" id="messageEmailError">
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div>
                                    <label for="password"
                                        class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                    <div class="mt-2">
                                        <input id="password" name="password" type="password"
                                            autocomplete="current-password" required
                                            class="px-2 block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div class="rounded-md bg-red-50 p-4" id="divPasswordError" hidden>
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-red-800"
                                                    id="messagePasswordError"></h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div>
                                    <button onclick="handleSubmitSignin()" type="button"
                                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                                        in</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover"
                src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80"
                alt="">
        </div>

    </div>
</body>
<script>
    async function handleSubmitSignin() {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const showErrorEmail = document.getElementById('divEmailError')
        const messageErrorEmail = document.getElementById('messageEmailError')
        const showErrorPassword = document.getElementById('divPasswordError')
        const messageErrorPassword = document.getElementById('divPasswordError')
        if (email && password) {
            const request = await fetch('http://localhost/api/signin', {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    'email': email,
                    'password': password,
                })
            }).then((response) => {
                return response.json()
            }).catch((error) => {
                if (confirm('Failed signin, please try again!') == true) {
                    window.location.reload()
                } else {
                    window.location.reload()
                }
            })

            const response = await request
            if (response.success) {
                localStorage.setItem('user_login', JSON.stringify(response.user))
                localStorage.setItem('token', response.token)
                window.location.replace('http://localhost')
            }
        } else {
            if (email.length < 1) {
                showErrorEmail.removeAttribute('hidden')
                messageErrorEmail.innerHTML = 'Please enter your email address'
            }

            if (password.length < 1) {
                showErrorPassword.removeAttribute('hidden')
                messageErrorPassword.innerHTML = 'Please enter your password'
            }
        }
    }

    async function handleSubmitSignUp() {
        const fullname = document.getElementById('fullname').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const showErrorFullName = document.getElementById('divFullNameError')
        const messageErrorFullName = document.getElementById('messageFullNameError')
        const showErrorEmail = document.getElementById('divEmailError')
        const messageErrorEmail = document.getElementById('messageEmailError')
        const showErrorPassword = document.getElementById('divPasswordError')
        const messageErrorPassword = document.getElementById('divPasswordError')
        if (email && password && fullname) {
            const request = await fetch('http://localhost/api/signup', {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    'name': fullname,
                    'email': email,
                    'password': password,
                })
            }).then((response) => {
                return response.json()
            }).catch((error) => {
                alert('Failed to create acccount')
            })

            const response = await request
            if (response.code == 201) {
                window.location.replace('http://localhost/signin')
            }
        } else {
            if (fullname.length < 1) {
                showErrorFullName.removeAttribute('hidden')
                messageErrorFullName.innerHTML = 'Please enter your full name'
            }

            if (email.length < 1) {
                showErrorEmail.removeAttribute('hidden')
                messageErrorEmail.innerHTML = 'Please enter your email address'
            }

            if (password.length < 1) {
                showErrorPassword.removeAttribute('hidden')
                messageErrorPassword.innerHTML = 'Please enter your password'
            }
        }
    }
</script>

</html>

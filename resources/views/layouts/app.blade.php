<!DOCTYPE html>
<html class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body claas="h-full">
    <div class="bg-white">
        <div class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-black bg-opacity-25"></div>

            <div class="fixed inset-0 z-40 flex">
                <div class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl">
                    <div class="flex px-4 pb-2 pt-5">
                        <button type="button"
                            class="-m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Links -->
                    <div class="mt-2">
                        <div class="border-b border-gray-200">
                            <div class="-mb-px flex space-x-8 px-4" aria-orientation="horizontal" role="tablist">
                                <!-- Selected: "border-indigo-600 text-indigo-600", Not Selected: "border-transparent text-gray-900" -->
                                <button id="tabs-1-tab-1"
                                    class="border-transparent text-gray-900 flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-medium"
                                    aria-controls="tabs-1-panel-1" role="tab" type="button">Women</button>
                                <!-- Selected: "border-indigo-600 text-indigo-600", Not Selected: "border-transparent text-gray-900" -->
                                <button id="tabs-1-tab-2"
                                    class="border-transparent text-gray-900 flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-medium"
                                    aria-controls="tabs-1-panel-2" role="tab" type="button">Men</button>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                        <div class="flow-root">
                            <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Company</a>
                        </div>
                        <div class="flow-root">
                            <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Stores</a>
                        </div>
                    </div>

                    <div class="space-y-6 border-t border-gray-200 px-4 py-6" id="buttonSigninMobile">

                    </div>
                </div>
            </div>
        </div>

        <header class="relative overflow-hidden">
            <!-- Top navigation -->
            <nav aria-label="Top" class="relative z-20 bg-white bg-opacity-90 backdrop-blur-xl backdrop-filter">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center">
                        <!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
                        <button type="button" class="rounded-md bg-white p-2 text-gray-400 lg:hidden">
                            <span class="sr-only">Open menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>

                        <!-- Logo -->
                        <div class="ml-4 flex lg:ml-0">
                            <a href="{{ url('/') }}">
                                <img class="h-8 w-auto"
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQg0evZC83tfZpTgt7MV6OlzI7YxYDhmZeI7LDktqtAw&s"
                                    alt="">
                            </a>
                        </div>

                        <div class="ml-auto flex items-center">
                            <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6"
                                id="buttonSigninDesktop">

                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero section -->
            @yield('sectionHeader')
        </header>

        <main>
            @yield('content')
        </main>

    </div>

</body>
<script>
    async function getPhotos(limit) {
        const request = await fetch(`http://localhost/api/photos?limit=${limit}`)
        const response = await request.json()
        return response
    }

    async function headerImages() {
        const response = await getPhotos(1)
        let imageHeaders = document.getElementById('sectionHeaderImages')
        if (response.code == 200) {
            response.data.forEach(photo => {
                const image = photo.image
                const asset = `{{ asset('storage/posts/${image}') }}`
                imageHeaders.innerHTML += `<div class="h-64 w-44 overflow-hidden rounded-lg">`
                imageHeaders.innerHTML +=
                    `<img src=${asset} alt="" class="h-full w-full object-cover object-center">`
                imageHeaders.innerHTML += `</div>`
            });
        }
    }

    async function photosListGalleries() {
        const userSignin = JSON.parse(localStorage.getItem('user_login'))
        let userId
        if (userSignin) {
            userId = userSignin.id
        }

        const response = await getPhotos(10)
        let listPhotos = document.getElementById('listPhotos')
        if (response.code == 200) {
            response.data.forEach(photo => {
                const image = photo.image
                const asset = `{{ asset('storage/posts/${image}') }}`
                const tags = photo.tags.map(tagObj => tagObj.tag).join(',');
                const detail = `{{ url('/photos/detail/${photo.id}') }}`
                listPhotos.innerHTML +=
                    `
                <div">
                    <div class="relative">
                        <div class="relative h-72 w-full overflow-hidden rounded-lg">
                            <img src="${asset}"
                                alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls."
                                class="h-full w-full object-cover object-center">
                        </div>
                        <div class="relative mt-4">
                            <h3 class="text-sm font-medium text-gray-900">${photo.users.name}</h3>
                            <div class="flex items-start space-x-4">
                                <div class="min-w-0 flex-1">
                                    <form action="#" class="relative">
                                        <div
                                            class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                                            <label for="comment" class="sr-only">Add your comment</label>
                                            <textarea rows="6" name="caption" id="caption.${photo.id}" ${photo.users.id == userId ? `` : 'readonly'}
                                                class="px-2 block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                >${photo.users.id == userId ? `${photo.caption}` : `${photo.caption}&#13;&#10;&#13;&#10;${tags}`
                                                } </textarea>

                                            <div class="py-2" aria-hidden="true">
                                                <div class="py-px">
                                                    <div class="h-9"></div>
                                                </div>
                                            </div>
                                        </div>

                                        ${
                                            photo.users.id == userId ? `
                                             <input type="text" name="tags" id="tags.${photo.id}" value="${tags}" class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                             <div class="flex justify-between py-2 pr-2">
                                                 <div class="flex-shrink-0">
                                                    <button type="button" onclick="handleUpdatePost(${photo.id})" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Post</button>
                                                 </div>
                                             </div>
                                            ` : `

                                            `
                                        }
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                            <div aria-hidden="true"
                                class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50">
                            </div>
                            <p class="relative text-lg font-semibold text-white">
                                ${
                                    photo.user_likes.find(o => o.user_id === userId) ? `<button type="button" ${localStorage.getItem('token') ? `onclick="handleUnlike(${photo.id})"` : `onclick="alert('Silahkan login terlebih dahulu')"`} ><i class="fa-solid fa-thumbs-up"></i> ${photo.likes}</button>` : `<button type="button" ${localStorage.getItem('token') ? `onclick="handleLike(${photo.id})"` : `onclick="alert('Silahkan login terlebih dahulu')"`} ><i class="fa-regular fa-thumbs-up"></i> ${photo.likes}</button>`
                                }
                            </p>
                            <p class="px-4 relative text-lg font-semibold text-white">
                               <a href="${detail}">
                                    <i class="fa-sharp fa-solid fa-magnifying-glass-plus"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                `
            })
        }
    }

    async function handleLike(postId) {
        const request = await fetch(`http://localhost/api/photos/${postId}/like`, {
            method: 'post',
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        })

        const response = await request.json()
        if (response.code == 200) {
            window.location.reload()
        } else {
            if (confirm('Failed, please signin again!') == true) {
                handleSignout()
            } else {
                handleSignout()
            }
        }
    }

    async function handleUnlike(postId) {
        const request = await fetch(`http://localhost/api/photos/${postId}/unlike`, {
            method: 'post',
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        })
        const response = await request.json()
        if (response.code == 200) {
            window.location.reload()
        } else {
            if (confirm('Failed, please signin again!') == true) {
                handleSignout()
            } else {
                handleSignout()
            }
        }
    }

    async function handleUpdatePost(postId) {
        const caption = document.getElementById(`caption.${postId}`).value;
        const tags = document.getElementById(`tags.${postId}`).value;
        const request = await fetch(`http://localhost/api/photos/${postId}?_method=PUT`, {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            },
            body: JSON.stringify({
                'caption': caption,
                'tags': tags,
            })
        }).then((response) => {
            return response.json()
        }).catch((error) => {
            localStorage.removeItem('token');
            window.location.replace('http://localhost/signin')
            return error.response.json()
        })

        const response = await request
        if (response.code == 200) {
            window.location.reload()
        }
    }

    function buttonSignin() {
        let signinDesktop = document.getElementById('buttonSigninDesktop')
        let signinMobile = document.getElementById('buttonSigninMobile')
        if (!localStorage.getItem('token')) {
            signinDesktop.innerHTML += `
            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign
                in</a>
            <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
            <a href="{{ route('register') }}" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign
                up</a>
            <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
            `

            signinMobile.innerHTML += `
            <div class="flow-root">
                <a href="{{ route('login') }}" class="-m-2 block p-2 font-medium text-gray-900">Sign in</a>
            </div>
            <div class="flow-root">
                <a href="{{ route('register') }}" class="-m-2 block p-2 font-medium text-gray-900">Sign up</a>
            </div>
            `
        } else {
            signinDesktop.innerHTML += `
            <a href="#" onclick="handleSignout()" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign out</a>
            <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
            `

            signinMobile.innerHTML += `
            <div class="flow-root">
                <a href="#" onclick="handleSignout()" class="-m-2 block p-2 font-medium text-gray-900">Sign out</a>
            </div>
            `
        }
    }

    async function handleSignout() {
        localStorage.removeItem('user_login')
        localStorage.removeItem('token')
        window.location.replace('http://localhost/signin')
    }

    headerImages()
    photosListGalleries()
    buttonSignin()
</script>

</html>

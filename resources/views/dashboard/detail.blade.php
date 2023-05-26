@extends('layouts.app')
@section('title', 'Welcome to the Symfony')
@section('content')

    <main>
        <div class="bg-white">
            <div
                class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8">
                <div class="lg:max-w-lg lg:self-end">

                    <div class="mt-4">
                        <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl" id="titlePost">
                        </h1>
                    </div>

                    <section aria-labelledby="information-heading" class="mt-4">
                        <h2 id="information-heading" class="sr-only">Product information </h2>

                        <div class="flex items-center">
                            <div class="">
                                <div class="flex items-center">
                                    <p class="text-sm text-gray-500" id="likePost"></p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 space-y-6">
                            <p class="text-base text-gray-500" id="captionPost"></p>
                        </div>
                    </section>
                </div>

                <!-- Product image -->
                <div class="mt-10 lg:col-start-2 lg:row-span-2 lg:mt-0 lg:self-center">
                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg" id="postImage">

                    </div>
                </div>

                <div class="mt-10" id="buttonLike">

                </div>

            </div>
        </div>
    </main>

    <script>
        async function getDetailPhoto(postId) {
            const userSignin = JSON.parse(localStorage.getItem('user_login'))
            let userId
            if (userSignin) {
                userId = userSignin.id
            }
            const title = document.getElementById('titlePost')
            const caption = document.getElementById('captionPost')
            const image = document.getElementById('postImage')
            const like = document.getElementById('likePost')
            const buttonLike = document.getElementById('buttonLike')
            const request = await fetch(`http://localhost/api/photos/${postId}`).then((response) => {
                return response.json();
            }).catch((error) => {
                window.location.replace('http://localhost')
            })

            const response = await request
            if (response.code == 200) {
                const tags = response.data.tags.map(tagObj => tagObj.tag).join(', ');
                title.innerHTML += response.data.title
                caption.innerHTML += `${response.data.caption}<br><br>${tags}`
                image.innerHTML += `
                <img src="{{ asset('storage/posts/${response.data.image}') }}"
                    alt="Model wearing light green backpack with black canvas straps and front zipper pouch."
                class="h-full w-full object-cover object-center">
            `
                like.innerHTML += `${response.data.likes} Like`
                buttonLike.innerHTML += `
            <button type="button"
            ${
                response.data.user_likes.find(o => o.user_id === userId) ? localStorage.getItem('token') ? `onclick="handleUnlike(${response.data.id})"` : `onclick="alert('Silahkan login terlebih dahulu')"` : localStorage.getItem('token') ? `onclick="handleLike(${response.data.id})"` : `onclick="alert('Silahkan login terlebih dahulu')"`
            }
            class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                <i class="fa-regular fa-thumbs-up"></i><span class="px-2">${
                    response.data.user_likes.find(o => o.user_id === userId) ? `Unlike` : `Like`
                }</span>
            </button>
            `
            }
        }

        getDetailPhoto({{ $id }})
    </script>

@endsection

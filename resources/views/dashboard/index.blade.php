@extends('layouts.app')
@section('title', 'Welcome to the Symfony')

@section('sectionHeader')
    <!-- Hero section -->
    <div class="pb-80 pt-16 sm:pb-40 sm:pt-24 lg:pb-48 lg:pt-40">
        <div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
            <div class="sm:max-w-lg">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                    Lorem ipsum dolor
                </h1>
                <p class="mt-4 text-xl text-gray-500">Lorem ipsum is placeholder text commonly used in the
                    graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
            </div>
            <div>
                <div class="mt-10">
                    <!-- Decorative image grid -->
                    <div aria-hidden="true"
                        class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
                        <div
                            class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                            <div class="flex items-center space-x-6 lg:space-x-8">

                                <div id="sectionHeaderImages" class="">

                                </div>
                                <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8" id="sectionHeaderImages">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section aria-labelledby="cause-heading">
        <div class="relative bg-gray-800 px-6 py-32 sm:px-12 sm:py-40 lg:px-16">
            <div class="absolute inset-0 overflow-hidden">
                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-feature-section-full-width.jpg"
                    alt="" class="h-full w-full object-cover object-center">
            </div>
            <div aria-hidden="true" class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>
            <div class="relative mx-auto flex max-w-3xl flex-col items-center text-center" id="sectionButton">
                <h2 id="cause-heading" class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Lorem ipsum</h2>
                <p class="mt-3 text-xl text-white">Lorem ipsum is placeholder text commonly used in the
                    graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
            </div>
        </div>
    </section>

    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-xl font-bold text-gray-900">Photos galleries</h2>

            <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8" id="listPhotos">

            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modalUpload" hidden>
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Upload your photos
                            </h3>
                        </div>
                        <form>
                            <div>
                                <div class="col-span-full">
                                    <label for="titleUpload"
                                        class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                    <div class="mt-2">
                                        <input type="text" name="title" id="titleUpload"
                                            class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                    </div>
                                </div>
                                <div class="col-span-full">
                                    <label for="cover-photo"
                                        class="block text-sm font-medium leading-6 text-gray-900">Photos</label>
                                    <div
                                        class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                        <div class="text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                <label for="photosUpload"
                                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                    <span>Upload a file</span>
                                                    <input id="photosUpload" name="photosUpload" type="file"
                                                        class="sr-only">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-full">
                                    <label for="captionUpload"
                                        class="block text-sm font-medium leading-6 text-gray-900">Caption</label>
                                    <div class="mt-2">
                                        <textarea id="captionUpload" name="captionUpload" rows="3"
                                            class="px-2  block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                    <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about
                                        yourself.</p>
                                </div>
                                <div class="col-span-full">
                                    <label for="tagsUpload"
                                        class="block text-sm font-medium leading-6 text-gray-900">Tags</label>
                                    <div class="mt-2">
                                        <input type="text" name="tags" id="tagsUpload"
                                            class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <button type="button" onclick="handleUploadPhotos()"
                            class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Upload</button>
                        <button type="button" onclick="showModalUpload('hidden')"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}


    <script>
        function buttonSection() {
            let sectionButton = document.getElementById("sectionButton");
            const token = localStorage.getItem('token')
            if (token) {
                sectionButton.innerHTML += `
                <button type="button" onclick="showModalUpload('show')"
                    class="mt-8 block w-full rounded-md border border-transparent bg-white px-8 py-3 text-base font-medium text-gray-900 hover:bg-gray-100 sm:w-auto">
                    Upload your photos
                </button>
                `
            } else {
                sectionButton.innerHTML += `
                <a href="{{ route('login') }}"
                    class="mt-8 block w-full rounded-md border border-transparent bg-white px-8 py-3 text-base font-medium text-gray-900 hover:bg-gray-100 sm:w-auto">Sign
                in</a>
                `
            }
        }

        function showModalUpload(status) {
            const modalId = document.getElementById('modalUpload')
            if (status == 'show') {
                modalId.removeAttribute('hidden', true)
            } else {
                modalId.setAttribute('hidden', true)
            }
        }

        async function handleUploadPhotos() {
            const title = document.getElementById('titleUpload').value
            const photos = document.getElementById('photosUpload')
            const caption = document.getElementById('captionUpload').value
            const tags = document.getElementById('tagsUpload').value
            const selectedFile = photos.files[0];

            const formData = new FormData();
            formData.append('title', title);
            formData.append('image', selectedFile);
            formData.append('caption', caption);
            formData.append('tags', tags);

            if (title && selectedFile && caption) {
                fetch('http://localhost/api/photos', {
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('token')}`
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (confirm('Upload success!') == true) {
                            window.location.reload()
                        } else {
                            window.location.reload()
                        }
                    })
                    .catch(error => {
                        if (confirm('Failed upload, please try again!') == true) {
                            window.location.reload()
                        } else {
                            window.location.reload()
                        }
                    });
            } else {
                confirm('Failed upload photos, please check your form')
            }
        }

        buttonSection()
    </script>

@endsection

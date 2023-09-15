<script setup>
import {Modal} from 'flowbite'
import {ref} from "vue";
import {Link, router} from "@inertiajs/vue3";


let photoURL = ref(),
    inputPHOTO = ref(),
    nameEVENT = ref(),
    alert = ref(),
    events = ref()

function createModal() {
    const $targetEl = document.getElementById('modalEl');

    const options = {
        placement: 'center',
        backdrop: 'dynamic',
        backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
        closable: true,
    };

    const modal = new Modal($targetEl, options);
    modal.show()
}

function uploadFile(event) {
    const fileZ = event.target.files[0];
    const formData = new FormData();
    formData.append('file', fileZ);

    try {
        axios.post('/api/v1/event/upload', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        }).then(res => {
            console.log(res.data.url)
            photoURL.value = '/' + res.data.url
        });
    } catch (error) {
        console.error('Ошибка загрузки файла:', error);
    }
}

function createEvent() {
    axios.post('/api/v1/event/create', {
        name: nameEVENT.value,
        photo: photoURL.value
    }).then(res => {
        alert.value = res.data.message
    })

    getEvent()
}

function getEvent() {
    axios.get('/api/v1/event/')
        .then(res => {
            console.log(res.data)
            events.value = res.data
        })
}

getEvent()
</script>

<template>
    <button type="button" @click="createModal"
            class="text-end text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        Создать алан / смену
    </button>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Название смены / алана
                </th>
                <th scope="col" class="px-6 py-3">
                    Картинка
                </th>
                <th scope="col" class="px-6 py-3">
                    Действие
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="ev in events">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ ev.name }}
                </th>
                <td class="px-6 py-4">
                    <img :src="ev.photo" class="w-16 h-16 rounded-lg" alt="">
                </td>
                <td class="px-6 py-4">
                    <Link :href="route('admin.event.index', [ev.id])"
                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Создать
                        трек лист</Link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div id="modalEl" tabindex="-1" aria-hidden="true"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                        Создание алана / cмены
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название
                            смены / алана</label>
                        <input type="text" id="first_name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="John" required v-model="nameEVENT">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Фото
                            превью</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input"
                            type="file"
                            @input="uploadFile"
                        >
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button" @click="createEvent"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Создать
                    </button>
                </div>

                <div class="p-2">
                    <div v-if="alert"
                         class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                         role="alert">
                        <span class="font-medium">{{ alert }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

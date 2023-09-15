<script setup>


import VHeader from "@/Components/Navbar.vue";
import {Link} from "@inertiajs/vue3";

import {ref, defineProps, onMounted} from 'vue';
import {Modal} from 'flowbite';
import axios from "axios";


const selectID = ref(null);
const video = ref(null);
const dataModal = ref(null);
const searchInput = ref();
const musics = ref();

const {events, music_id_last, selected} = defineProps({
    events: {type: Object},
    music_id_last: {type: Number},
    selected: {type: Number},
});


const selectActive = (object) => {
    selectID.value = object.id;
    video.value = object.video;
};

const showText = (object) => {
    dataModal.value = object;
    const $targetEl = document.getElementById('modalEl');

    const modal = new Modal($targetEl, {
        placement: 'center',
        backdrop: 'dynamic',
        backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
        closable: true,
    });

    modal.show();
};

const search = () => {
    axios.post('/api/v1/music/search/', {
        text: searchInput.value
    }).then(res => {
        musics.value = res.data
    })
}

const selectedItems = ref([])
const storage = ref()

onMounted(() => {
    dataModal.value = music_id_last;
    selectID.value = music_id_last.id;
    video.value = music_id_last.video;

    if (JSON.parse(localStorage.getItem('favorite'))) {
        storage.value = JSON.parse(localStorage.getItem('favorite'))['_value']
        storage.value.forEach(object => {
            favorite(object)
        })
    }
});

const featchData = () => {
    axios.post('/api/v1/music/list/', {
        selected
    })
        .then(res => {
            musics.value = res.data
        })
}

featchData()

const favorite = (object) => {
    // console.log(selectedItems.value)
    if (selectedItems.value.find(item => item.id === object.id)) {
        selectedItems.value = selectedItems.value.filter(id => id !== object);
    } else {
        selectedItems.value.push(object);
    }

    localStorage.setItem('favorite', JSON.stringify(selectedItems));
}

</script>

<template>
    <v-header></v-header>

    <div>
        <div class="flex gap-4 relative">
            <div class="w-2/3 main_content">

                <div class="bg-gray-900 rounded-lg p-4 mt-14">
                    <video style="height: 680px;" class="rounded-lg mx-auto" controls ref="videoPlayer" :src="video"
                           autoplay></video>
                </div>

            </div>
            <div class="flex-1 main_content_text h-[640px]" style="border-radius: 10px">
                <h1 class="title mb-2">Музыка табарга</h1>

                <form class="mb-4">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="default-search"
                               class="block pizdec w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-950 dark:focus:border-fuchsia-950"
                               placeholder="Җырның исеме" @input="search" v-model="searchInput" required>
                    </div>
                </form>

                <div class="bg-gray-900 h-full w-full rounded-lg overflow-x-auto musics">
                    <div class="content_music gap-4" v-for="(music, index) in musics" :key="music.id"
                         @click="selectActive(music)"

                         :class="{
                            'active': (music.id === selectID)
                        }">
                        <img class="w-16 h-16 rounded-lg" :src="music.event.photo" alt="">
                        <div class="content_music_name">
                            <p>{{ music.name }}</p>
                            <Link :href="`/event/${music.events_id}`">{{ music.event.name }}</Link>
                        </div>

                        <div class="ml-auto mr-5 content_button flex items-center group">
                            <button @click="showText(music)">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="icon icon-tabler icon-tabler-letter-case-upper" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 19v-10.5a3.5 3.5 0 0 1 7 0v10.5"></path>
                                    <path d="M3 13h7"></path>
                                    <path d="M14 19v-10.5a3.5 3.5 0 0 1 7 0v10.5"></path>
                                    <path d="M14 13h7"></path>
                                </svg>
                            </button>
                            <button @click="favorite(music)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    v-if="!selectedItems.find(item => item.id === music.id)"
                                >
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                                </svg>

                                <svg v-else xmlns="http://www.w3.org/2000/svg" class="text-pink-700" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z" stroke-width="0" fill="currentColor"></path>
                                </svg>
                            </button>
                            <a :href="music.mp4" download="">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="icon icon-tabler icon-tabler-download" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                    <path d="M7 11l5 5l5 -5"></path>
                                    <path d="M12 4l0 12"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalEl" tabindex="-1" aria-hidden="true" v-if="dataModal"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class=" p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white text-center">
                        {{ dataModal.name }}
                    </h3>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6 text-center whitespace-pre-line">
                    {{ dataModal.text }}
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

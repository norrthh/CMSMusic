<script setup>
    import {Link} from "@inertiajs/vue3";

</script>

<template>
    <nav class="border-gray-200 bg-gray-900 rounded-xl">
        <div class="flex flex-wrap items-center justify-between mx-auto p-4">
            <Link :href="route('index')" class="flex items-center">
                <img src="https://selet.biz/bitrix/templates/.default/static/pic/icons/logo2.png" alt="">
            </Link>
            <div class="w-1/2" id="navbar-search">
<!--                <form>-->
<!--                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>-->
<!--                    <div class="relative">-->
<!--                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">-->
<!--                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"-->
<!--                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">-->
<!--                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"-->
<!--                                      stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                        <input type="search" id="default-search"-->
<!--                               class="block pizdec w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-950 dark:focus:border-fuchsia-950"-->
<!--                               placeholder="Җырның исеме" @input="search" v-model="searchInput" required>-->
<!--                    </div>-->
<!--                </form>-->
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                <Link :href="route('favorite')" class="hover:text-fuchsia-700 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart-filled" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z"
                            stroke-width="0" fill="currentColor"></path>
                    </svg>
                </Link>
            </div>
        </div>
    </nav>

</template>

<style scoped>

</style>

<script setup lang="ts">
import { onMounted, ref } from "vue";
import axios from "axios";
import Header from "@/Components/Header.vue";
import Footer from "@/Layouts/Footer.vue";

// Define the interface for therapist data
interface Therapist {
    id: number;
    name: string;
    surname: string;
    description: string;
    rating: number;
    schedule: string;
    image: string;
}

// Define therapists as an array of Therapist objects
const therapists = ref<Therapist[] | null>(null);

onMounted(async () => {
    try {
        const response = await axios.get(route('therapists.index'));
        therapists.value = response.data;
    } catch (error) {
        console.error('Ошибка загрузки терапевтов:', error);
    }
});
</script>

<template>
    <Header></Header>
    <ul class="grid grid-cols-1 xl:grid-cols-3 gap-y-10 gap-x-6 items-start p-8">
        <div v-for="therapist in therapists" :key="therapist.id">
            <li class="relative flex flex-col sm:flex-row xl:flex-col items-start">
                <div class="order-1 sm:ml-6 xl:ml-0">
                    <h3 class="mb-1 text-slate-900 font-semibold">
                    <span class="mb-1 block text-sm leading-6 text-indigo-500">
                        {{ therapist.name }} {{ therapist.surname }}
                    </span>
                    </h3>
                    <div class="prose prose-slate prose-sm text-slate-600">
                        <p>{{ therapist.description }}</p>
                    </div>
                    <div class="flex items-center mt-2">
                        <p class="mr-2 text-gray-500">Рейтинг:</p>
                        <div class="flex items-center">
                            <template v-for="n in 5" :key="n">
                                <svg
                                    :class="{'text-yellow-400 mt-3': n <= therapist.rating, 'text-gray-300 mt-3': n > therapist.rating}"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"
                                    class="w-6 h-6">
                                    <path
                                        d="M9.049 2.927C9.228 2.48 9.772 2.48 9.951 2.927l1.007 2.033 2.249.326c.313.045.437.428.21.654l-1.628 1.588.384 2.248c.053.309-.274.545-.548.4l-2.016-1.062-2.016 1.062c-.274.145-.6-.091-.548-.4l.384-2.248-1.628-1.588c-.227-.226-.103-.609.21-.654l2.249-.326 1.007-2.033z"/>
                                </svg>
                            </template>
                        </div>
                        <span class="ml-2 text-lg font-semibold text-neutral-600 mt-1.5">
                        {{ therapist.rating }}
                    </span>
                    </div>

                    <div class="flex items-center mt-2">
                        <p class="mr-2 text-gray-500">График работы: Пн-Пт</p>
                        <span class="text-neutral-600 font-medium">{{ therapist.schedule }}</span>
                    </div>
                    <a class="group inline-flex items-center h-9 rounded-full text-sm font-semibold whitespace-nowrap px-3 focus:outline-none focus:ring-2 bg-slate-100 text-slate-700 hover:bg-slate-200 hover:text-slate-900 focus:ring-slate-500 mt-6"
                       :href="route('therapists.show', therapist.id)">
                        Записаться
                        <span class="sr-only">, Completely unstyled, fully accessible UI components</span>
                        <svg class="overflow-visible ml-3 text-slate-300 group-hover:text-slate-400"
                             width="3" height="6" viewBox="0 0 3 6" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M0 0L3 3L0 6"></path>
                        </svg>
                    </a>
                </div>
                <img :src="therapist.image" alt=""
                     class="mb-6 shadow-md rounded-lg bg-slate-50 w-full sm:w-[17rem] sm:mb-0 xl:mb-6 xl:w-full"
                     width="1216" height="640">
            </li>
        </div>
    </ul>
    <Footer></Footer>
</template>

<style scoped>

</style>

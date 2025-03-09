<script setup lang="ts">
import {defineProps, ref, computed} from 'vue';
import Header from "@/Components/Header.vue";
import Footer from "@/Layouts/Footer.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    therapist: {
        type: Object as () => {
            id: number;
            name: string;
            surname: string;
            description: string;
            image: string;
            rating: number;
        } | undefined,
        required: false,
    },
});

const form = useForm({
    therapist_id: props.therapist?.id || null,
    duration: "",
    massage_type: "",
    date: "",
    time: "",
});

const submitForm = () => {
    form.post("/reservations", {
        onSuccess: () => {
            alert("Запись успешно создана!");
            form.duration = '';
            form.massage_type = '';
            form.date = '';
            form.time = '';
        },
        onError: (errors) => {
            console.error("Ошибка при записи:", errors);
        },
    });
};

const today = new Date();
const minDate = today.toISOString().split('T')[0];

const nextMonth = new Date();
nextMonth.setMonth(today.getMonth() + 1);
nextMonth.setDate(0);
const maxDate = nextMonth.toISOString().split('T')[0];

const isWeekend = ref(false);

const validateDate = () => {
    if (form.date) {
        const selectedDate = new Date(form.date);
        const day = selectedDate.getDay();
        if (day === 6 || day === 0) {
            isWeekend.value = true;
            form.date = '';
        } else {
            isWeekend.value = false;
        }
    }
};
</script>

<template>
    <Header></Header>
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-2">
        <div class="flex flex-col justify-start p-8">
            <div v-if="therapist" class="p-8">
                <h1 class="text-2xl font-bold">{{ therapist.name }} {{ therapist.surname }}</h1>
                <img :src="therapist.image" class="rounded-lg shadow-md mt-4" alt="">
                <p class="text-gray-600 pt-3">График работы: Пн-Пт</p>
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
                    <span class="ml-2 text-lg font-semibold text-neutral-600 mt-1.5">{{ therapist.rating }}</span>
                </div>
            </div>
            <div v-else class="p-8">
                <p>Информация о терапевте не доступна.</p>
            </div>
        </div>

        <div class="flex justify-center p-12">
            <div class="mx-auto w-full max-w-[550px] bg-white">
                <form @submit.prevent="submitForm">
                    <div class="mb-5">
                        <label for="duration" class="mb-3 block text-base font-medium text-[#07074D]">
                            Длительность (минуты)
                        </label>
                        <select id="duration" v-model="form.duration"
                                class="w-full rounded-md border border-[#e0e0e0] py-3 px-6">
                            <option value="45">45 минут</option>
                            <option value="60">60 минут</option>
                            <option value="90">90 минут</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="massage_type" class="mb-3 block text-base font-medium text-[#07074D]">
                            Тип массажа
                        </label>
                        <select id="massage_type" v-model="form.massage_type"
                                class="w-full rounded-md border border-[#e0e0e0] py-3 px-6">
                            <option value="Расслабляющий">Расслабляющий</option>
                            <option value="Спортивный">Спортивный</option>
                            <option value="Лечебный">Лечебный</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">Дата</label>
                        <input type="date" name="date" id="date" v-model="form.date" @input="validateDate"
                               class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                               :min="minDate"/>

                        <p v-if="isWeekend" class="mt-2 text-red-500 text-sm">Выбранная дата выпадает на выходной.
                            Пожалуйста, выберите другой день.</p>
                    </div>
                    <div class="mb-5">
                        <label for="time" class="mb-3 block text-base font-medium text-[#07074D]">Время</label>
                        <input type="time" name="time" id="time" v-model="form.time"
                               class="w-full rounded-md border border-[#e0e0e0] py-3 px-6"/>
                    </div>
                    <div>
                        <button type="submit"
                                class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-white">
                            Записаться
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <Footer></Footer>
</template>

<style scoped>
</style>

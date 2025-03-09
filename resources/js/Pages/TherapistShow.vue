<script setup lang="ts">
import {defineProps} from 'vue';
import Header from "@/Components/Header.vue";
import Footer from "@/Layouts/Footer.vue";

const props = defineProps({
    therapist: {
        type: Object as () => {
            name: string,
            surname: string,
            description: string,
            image: string,
            rating: number
        } | undefined,
        required: false
    }
});

// Получаем текущую дату
const today = new Date();
const minDate = today.toISOString().split('T')[0]; // Сегодняшняя дата в формате YYYY-MM-DD

// Для максимальной даты — устанавливаем ее на последний день следующего месяца
const nextMonth = new Date();
nextMonth.setMonth(today.getMonth() + 1); // Переходим к следующему месяцу
nextMonth.setMonth(nextMonth.getMonth() + 1); // Переходим еще на один месяц вперед
nextMonth.setDate(0); // Устанавливаем последний день следующего месяца
const maxDate = nextMonth.toISOString().split('T')[0];

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

        <!-- Блок с формой сдвинут вправо -->
        <div class="flex justify-center p-12">
            <div class="mx-auto w-full max-w-[550px] bg-white">
                <form>
                    <div class="mb-5">
                        <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                            Full Name
                        </label>
                        <input type="text" name="name" id="name" placeholder="Full Name"
                               class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    </div>
                    <div class="mb-5">
                        <label for="phone" class="mb-3 block text-base font-medium text-[#07074D]">
                            Phone Number
                        </label>
                        <input type="text" name="phone" id="phone" placeholder="Enter your phone number"
                               class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    </div>
                    <div class="mb-5">
                        <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                            Email Address
                        </label>
                        <input type="email" name="email" id="email" placeholder="Enter your email"
                               class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Date
                                </label>
                                <input type="date" name="date" id="date"
                                       class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                       :min="minDate" :max="maxDate"/>
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="time" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Time
                                </label>
                                <input type="time" name="time" id="time"
                                       class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button
                            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
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

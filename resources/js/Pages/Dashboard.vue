<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from "vue";
import axios from "axios";
import { Chart, registerables } from "chart.js";

Chart.register(...registerables);

const users = ref(0);
const usersToday = ref(0);
const chartCanvas = ref(null);
const chartInstance = ref<Chart | null>(null);

onMounted(async () => {
    try {
        const response = await axios.get(route('users.index'));
        users.value = response.data.count;

        const todayResponse = await axios.get(route('users.numberOfUsersRegisteredToday'));
        usersToday.value = todayResponse.data.count;

        if (chartCanvas.value) {
            chartInstance.value = new Chart(chartCanvas.value, {
                type: "bar",
                data: {
                    labels: ["Все пользователи", "Сегодня"],
                    datasets: [
                        {
                            label: "Количество пользователей",
                            data: [users.value, usersToday.value],
                            backgroundColor: [
                                "rgba(75, 192, 192, 0.2)",
                                "rgba(153, 102, 255, 0.2)",
                            ],
                            borderColor: [
                                "rgba(75, 192, 192, 1)",
                                "rgba(153, 102, 255, 1)",
                            ],
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        }
    } catch (error) {
        console.error('Ошибка загрузки данных:', error);
    }
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-2xl sm:px-6 lg:px-12">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p>Количество зарегистрированных пользователей: {{ users }}</p>
                        <p>Количество пользователей, зарегистрированных сегодня: {{ usersToday }}</p>
                        <canvas ref="chartCanvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

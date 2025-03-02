<script setup lang="ts">
import {ref, onMounted} from 'vue';
import axios from 'axios';
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
} from '@headlessui/vue'
import {
    ArrowPathIcon,
    Bars3Icon,
    ChartPieIcon,
    CursorArrowRaysIcon,
    FingerPrintIcon,
    SquaresPlusIcon,
    XMarkIcon,
} from '@heroicons/vue/24/outline'
import {ChevronDownIcon, PhoneIcon, PlayCircleIcon} from '@heroicons/vue/20/solid'

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

const products = [
    {name: 'Analytics', description: 'Get a better understanding of your traffic', href: '#', icon: ChartPieIcon},
    {name: 'Engagement', description: 'Speak directly to your customers', href: '#', icon: CursorArrowRaysIcon},
    {name: 'Security', description: 'Your customers’ data will be safe and secure', href: '#', icon: FingerPrintIcon},
    {name: 'Integrations', description: 'Connect with third-party tools', href: '#', icon: SquaresPlusIcon},
    {name: 'Automations', description: 'Build strategic funnels that will convert', href: '#', icon: ArrowPathIcon},
]
const callsToAction = [
    {name: 'Watch demo', href: '#', icon: PlayCircleIcon},
    {name: 'Contact sales', href: '#', icon: PhoneIcon},
]

const mobileMenuOpen = ref(false)

const therapists = ref(null);

onMounted(async () => {
    try {
        const response = await axios.get(route('therapists.index'));
        therapists.value = response.data;
    } catch (error) {
        console.error('Ошибка загрузки терапевтов:', error);
    }
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <header class="bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img class="h-8 w-auto"
                         src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                         alt=""/>
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = true">
                    <span class="sr-only">Open main menu</span>
                    <Bars3Icon class="size-6" aria-hidden="true"/>
                </button>
            </div>
            <PopoverGroup class="hidden lg:flex lg:gap-x-12">
                <Popover class="relative">
                    <PopoverButton class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900">
                        Product
                        <ChevronDownIcon class="size-5 flex-none text-gray-400" aria-hidden="true"/>
                    </PopoverButton>

                    <transition enter-active-class="transition ease-out duration-200"
                                enter-from-class="opacity-0 translate-y-1"
                                enter-to-class="opacity-100 translate-y-0"
                                leave-active-class="transition ease-in duration-150"
                                leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                        <PopoverPanel
                            class="absolute top-full -left-8 z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white ring-1 shadow-lg ring-gray-900/5">
                            <div class="p-4">
                                <div v-for="item in products" :key="item.name"
                                     class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                    <div
                                        class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                        <component :is="item.icon"
                                                   class="size-6 text-gray-600 group-hover:text-indigo-600"
                                                   aria-hidden="true"/>
                                    </div>
                                    <div class="flex-auto">
                                        <a :href="item.href" class="block font-semibold text-gray-900">
                                            {{ item.name }}
                                            <span class="absolute inset-0"/>
                                        </a>
                                        <p class="mt-1 text-gray-600">{{ item.description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
                                <a v-for="item in callsToAction" :key="item.name" :href="item.href"
                                   class="flex items-center justify-center gap-x-2.5 p-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-100">
                                    <component :is="item.icon" class="size-5 flex-none text-gray-400"
                                               aria-hidden="true"/>
                                    {{ item.name }}
                                </a>
                            </div>
                        </PopoverPanel>
                    </transition>
                </Popover>

                <a href="#" class="text-sm/6 font-semibold text-gray-900">Features</a>
                <a href="#" class="text-sm/6 font-semibold text-gray-900">Marketplace</a>
                <a href="#" class="text-sm/6 font-semibold text-gray-900">Company</a>
            </PopoverGroup>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a v-if="canLogin" :href="route('login')" class="text-sm/6 font-semibold text-gray-900 mr-3">
                    Log in <span aria-hidden="true"></span>
                </a>
                <a v-if="canRegister" :href="route('register')" class="text-sm/6 font-semibold text-gray-900">
                    Register
                </a>
            </div>
        </nav>
        <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
            <div class="fixed inset-0 z-10"/>
            <DialogPanel
                class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto"
                             src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                             alt=""/>
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                        <span class="sr-only">Close menu</span>
                        <XMarkIcon class="size-6" aria-hidden="true"/>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <Disclosure as="div" class="-mx-3" v-slot="{ open }">
                                <DisclosureButton
                                    class="flex w-full items-center justify-between rounded-lg py-2 pr-3.5 pl-3 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                                    Product
                                    <ChevronDownIcon :class="[open ? 'rotate-180' : '', 'size-5 flex-none']"
                                                     aria-hidden="true"/>
                                </DisclosureButton>
                                <DisclosurePanel class="mt-2 space-y-2">
                                    <DisclosureButton v-for="item in [...products, ...callsToAction]" :key="item.name"
                                                      as="a"
                                                      :href="item.href"
                                                      class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">
                                        {{ item.name }}
                                    </DisclosureButton>
                                </DisclosurePanel>
                            </Disclosure>
                            <a href="#"
                               class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Features</a>
                            <a href="#"
                               class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Marketplace</a>
                            <a href="#"
                               class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Company</a>
                        </div>
                        <div class="py-6">
                            <a :href="route('login')"
                               class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log
                                in</a>
                        </div>
                        <div class="py-6">
                            <a :href="route('register')"
                               class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Register</a>
                        </div>
                    </div>
                </div>
            </DialogPanel>
        </Dialog>
    </header>
    <div class="sm:flex items-center max-w-screen-xl">
        <div class="sm:w-1/2 p-10">
            <div class="image object-center text-center">
                <img
                    src="https://avatars.mds.yandex.net/get-altay/10637174/2a0000018acd71feed66bef3a8707b50aada/XXL_height"
                    class="rounded-lg">
            </div>
        </div>
        <div class="sm:w-1/2 p-5">
            <div class="text">
                <span class="text-gray-500 border-b-2 border-indigo-600 uppercase">О нас</span>
                <h2 class="my-4 font-bold text-3xl  sm:text-4xl ">About <span class="text-indigo-600">Our Company</span>
                </h2>
                <p class="text-gray-700">
                    Добро пожаловать в наш массажный центр! Мы — команда профессионалов, стремящихся дарить вам
                    незабываемые
                    моменты расслабления и восстановления. В нашем центре мы предлагаем широкий спектр массажных услуг,
                    которые
                    помогут вам снять напряжение, восстановить силы и улучшить общее самочувствие.

                    Каждый сеанс у нас — это не просто процедура, а настоящее путешествие в мир спокойствия и заботы о
                    вашем теле
                    и душе. Мы используем только лучшие техники и качественные материалы, чтобы каждый наш клиент
                    почувствовал
                    себя на высоте. В нашей команде работают опытные мастера, прошедшие обучение и имеющие глубокие
                    знания в
                    области массажа.

                    Мы уверены, что забота о себе — это залог здоровья и гармонии, поэтому делаем все, чтобы каждый
                    визит к нам
                    приносил максимальный результат и наслаждение.
                </p>
            </div>
        </div>
    </div>
    <section>
        <div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
            <h1 class="text-center text-neutral-700 lg:text-5xl">Наши лучшие работники</h1>
            <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-3">
                <div v-for="therapist in therapists?.data" :key="therapist.id">
                    <div class="p-6 flex flex-col h-full">
                        <img class="object-cover object-center w-full mb-8 lg:h-64 md:h-36 rounded-xl"
                             :src="therapist.image" alt="blog">
                        <h1 class="mx-auto mb-4 text-2xl font-semibold leading-none tracking-tighter text-neutral-600 lg:text-3xl">
                            {{ therapist.name }} {{ therapist.surname }}
                        </h1>
                        <p class="mx-auto text-base leading-relaxed text-gray-500 flex-1">
                            {{ therapist.description }}
                        </p>
                        <div class="flex items-center mt-2">
                            <p class="mr-2 text-gray-500">Рейтинг:</p>
                            <div class="flex items-center">
                                <template v-for="n in 5" :key="n">
                                    <svg
                                        :class="{'text-yellow-400 mt-3': n <= therapist.rating, 'text-gray-300 mt-3': n > therapist.rating}"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"
                                        class="w-8 h-8">
                                        <path
                                            d="M9.049 2.927C9.228 2.48 9.772 2.48 9.951 2.927l1.007 2.033 2.249.326c.313.045.437.428.21.654l-1.628 1.588.384 2.248c.053.309-.274.545-.548.4l-2.016-1.062-2.016 1.062c-.274.145-.6-.091-.548-.4l.384-2.248-1.628-1.588c-.227-.226-.103-.609.21-.654l2.249-.326 1.007-2.033z"/>
                                    </svg>
                                </template>
                            </div>
                            <span class="ml-2 text-lg font-semibold text-neutral-600 mt-1.5">{{
                                    therapist.rating
                                }}</span>
                        </div>
                        <div class="mt-4">
                            <a href="#"
                               class="inline-flex items-center font-semibold text-blue-600 hover:text-neutral-600"
                               title="read more">Записаться</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

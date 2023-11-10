<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head, Link, useForm  } from '@inertiajs/vue3';

    const form = useForm({
        emp_id: '',
        deductionType: '',
        deductionAmount: '',
        deductionDate: ''
    })

    const props = defineProps({
        deductions: Array,
        employee: Object,
        user: Object
    })

    function submit() {
        form.post('/deductions/')
    }
</script>

<template>
    <Head title="Create Deduction"/>

    <SideBarLayout>
        <template #header>
                <div class="flex">
                    <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">Create Deduction</h2>
                    <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded" as="button" href="/deductions">Back</Link>
                </div>
        </template>

        <div class="py-6">
            <div class="flex flex-col justify-center items-center">
                <div class="relative flex flex-col items-center rounded-[20px] w-[500px] max-w-[95%] mx-auto bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none p-3">
                    <div class="mt-2 mb-8 w-full">
                        <form @submit.prevent="submit" class="flex">
                            <div class="flex-1 pr-4">
                                <h4 class="px-2 text-xl font-bold text-navy-700 dark:text-black">
                                    Deduction Details
                                </h4>
                                <div class="px-5 py-5">
                                    <label for="emp_id" class="block text-sm font-medium leading-6 text-gray-900">Employee</label>
                                        <div class="mt-2">
                                            <select id="emp_id" v-model="form.emp_id" name="services" autocomplete="services"
                                                class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 ring-1 ring-gray-300 shadow-sm ring-inset focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option selected disabled>Select Employee</option>
                                                <option v-for="emp in employee" :key="emp.id" :value="emp.id">{{ emp.user.firstName }} {{ emp.user.lastName }}</option>
                                            </select>
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.emp_id">{{ form.errors.emp_id }}</div>
                                        </div>

                                    <label class="font-semibold text-sm text-gray-600  block" for="deductionType">Deduction Type</label>
                                    <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.deductionType"/>
                                    <div class="text-red-600" v-if="form.errors.deductionType">{{ form.errors.deductionType }}</div>

                                    <label class="font-semibold text-sm text-gray-600  block" for="deductionAmount">Deduction Amount</label>
                                    <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.deductionAmount" />
                                    <div class="text-red-600" v-if="form.errors.deductionAmount">{{ form.errors.deductionAmount }}</div>

                                    <label class="font-semibold text-sm text-gray-600  block" for="deductionDate" >Deduction Date</label>
                                    <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.deductionDate" />
                                    <div class="text-red-600" v-if="form.errors.deductionDate">{{ form.errors.deductionDate }}</div>

                                    <button class="px-4 py-2 mt-2 bg-blue-400 w-full rounded border border-blue-600 shadow hover:bg-blue-500">
                                        Create Deduction
                                    </button>
                                  </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </SideBarLayout>
</template>

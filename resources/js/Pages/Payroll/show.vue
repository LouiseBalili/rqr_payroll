<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue'
    import { Head, Link, router, useForm } from '@inertiajs/vue3';
    import moment from 'moment'

    const props = defineProps({
        employees : Object,
        user: Object,
        position: Object,
        cashAdvance:Object,
        deduction:Object,
        payroll:Object
    })

    function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
    }

</script>

<template>
    <Head title="View Payroll" />

    <SideBarLayout>
        <template #header >
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Payroll</h2>
                <div style="position:relative">
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-9 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Payroll here" @keydown.enter="search($event)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#444  " width="20px" height="20px" viewBox="0 0 16 16"
                    style="position:absolute; top:10px; right:10px">
                    <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"/>
                    </svg>
                </div>
                <div class="flex">
                    <a href="/payrolls/pdf" class="flex  mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded mr-3 " target="blank">
                        <svg viewBox="0 0 512 512" version="1.1" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#6666"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>pdf-document</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="add" fill="#000000" transform="translate(85.333333, 42.666667)"> <path d="M75.9466667,285.653333 C63.8764997,278.292415 49.6246897,275.351565 35.6266667,277.333333 L1.42108547e-14,277.333333 L1.42108547e-14,405.333333 L28.3733333,405.333333 L28.3733333,356.48 L40.5333333,356.48 C53.1304778,357.774244 65.7885986,354.68506 76.3733333,347.733333 C85.3576891,340.027178 90.3112817,328.626053 89.8133333,316.8 C90.4784904,304.790173 85.3164923,293.195531 75.9466667,285.653333 L75.9466667,285.653333 Z M53.12,332.373333 C47.7608867,334.732281 41.8687051,335.616108 36.0533333,334.933333 L27.7333333,334.933333 L27.7333333,298.666667 L36.0533333,298.666667 C42.094796,298.02451 48.1897668,299.213772 53.5466667,302.08 C58.5355805,305.554646 61.3626692,311.370371 61.0133333,317.44 C61.6596233,323.558965 58.5400493,329.460862 53.12,332.373333 L53.12,332.373333 Z M150.826667,277.333333 L115.413333,277.333333 L115.413333,405.333333 L149.333333,405.333333 C166.620091,407.02483 184.027709,403.691457 199.466667,395.733333 C216.454713,383.072462 225.530463,362.408923 223.36,341.333333 C224.631644,323.277677 218.198313,305.527884 205.653333,292.48 C190.157107,280.265923 170.395302,274.806436 150.826667,277.333333 L150.826667,277.333333 Z M178.986667,376.32 C170.098963,381.315719 159.922142,383.54422 149.76,382.72 L144.213333,382.72 L144.213333,299.946667 L149.333333,299.946667 C167.253333,299.946667 174.293333,301.653333 181.333333,308.053333 C189.877212,316.948755 194.28973,329.025119 193.493333,341.333333 C194.590843,354.653818 189.18793,367.684372 178.986667,376.32 L178.986667,376.32 Z M254.506667,405.333333 L283.306667,405.333333 L283.306667,351.786667 L341.333333,351.786667 L341.333333,329.173333 L283.306667,329.173333 L283.306667,299.946667 L341.333333,299.946667 L341.333333,277.333333 L254.506667,277.333333 L254.506667,405.333333 L254.506667,405.333333 Z M234.666667,7.10542736e-15 L9.52127266e-13,7.10542736e-15 L9.52127266e-13,234.666667 L42.6666667,234.666667 L42.6666667,192 L42.6666667,169.6 L42.6666667,42.6666667 L216.96,42.6666667 L298.666667,124.373333 L298.666667,169.6 L298.666667,192 L298.666667,234.666667 L341.333333,234.666667 L341.333333,106.666667 L234.666667,7.10542736e-15 L234.666667,7.10542736e-15 Z" id="document-pdf"> </path> </g> </g> </g></svg>
                            Export
                    </a>
                    <Link class="button1 mb-2 py-2 px-3 bg-blue-300 shadow border-gray-300 border hover:bg-blue-400 rounded mr-3" as="button" href="/payrolls">Back</Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-[#1f1f1f] overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center">
                            {{ payroll.employees.user.firstName }} {{ payroll.employees.user.middleName }} {{ payroll.employees.user.lastName }} {{ payroll.employees.user.suffix }}
                        </h5>

                        <div class="flex items-start">
                            <div class="max-w-md flex justify-between">
                                <div class="mr-10">
                                    <div class="mb-2">
                                        <p class="font-semibold text-gray-700 text-sm">Position</p>
                                        <p class="text-sm text-gray-700 font-light">{{ payroll.employees.position.position}}</p>
                                    </div>
                                    <div class="mb-2">
                                        <p class="font-semibold text-gray-700 text-sm">Daily Rate</p>
                                        <p class="text-sm text-gray-700 font-light">₱{{ payroll.employees.position.amount}}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-700 text-sm">Payroll Period</p>
                                        <p class="text-sm text-gray-700 font-light">{{ payroll.payrollStart}} - {{ payroll.payrollEnd }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-700 text-sm">Days Worked</p>
                                        <p class="text-sm text-gray-700 font-light">{{ payroll.daysWorked }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-700 text-sm">Overtime Hours</p>
                                        <p class="text-sm text-gray-700 font-light">{{ payroll.overtimeHours}}</p>
                                    </div>
                                </div>
                                <div class="mr-10">
                                    <div>
                                        <p class="font-semibold text-gray-700 text-sm">Overtime Pay</p>
                                        <p class="text-sm text-gray-700 font-light">₱{{ payroll.overtimeAmount}}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-700 text-sm">Cash Advance</p>
                                        <p class="text-sm text-gray-700 font-light">₱{{ payroll.cashAdvance }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-700 text-sm">Deductions</p>
                                        <p class="text-sm text-gray-700 font-light">₱{{ payroll.deductions }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-700 text-sm">Total Deductions</p>
                                        <p class="text-sm text-gray-700 font-light">₱{{ payroll.totalDeductions }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-1 ml-4 -mt-10">
                                <div>
                                    <h4 class="text-md font-semibold tracking-tight text-gray-700">Cash Advance</h4>
                                    <table class="table-fixed w-full mt-3">
                                        <thead class="bg-gray-200 dark:bg-blue-600">
                                            <th class="text-center px-4 py-2">Request Date</th>
                                            <th class="text-center px-4 py-2">Amount</th>
                                            <th class="text-center px-4 py-2">Remarks/Reason</th>
                                        </thead>
                                        <tbody>
                                            <tr class="border-b border-gray-200" v-for="cash in payroll.employees.cashAdvance" :key="cash.id">
                                                <td class="text-center py-2">
                                                    {{ formattedDate(cash.requestDate) }}
                                                </td>
                                                <td class="text-center py-2">
                                                    ₱{{ cash.amount }}
                                                </td>
                                                <td class="text-center py-2">
                                                    {{ cash.status }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-10">
                                    <h4 class="text-md font-semibold tracking-tight text-gray-700">Deductions</h4>
                                    <table class="table-fixed w-full mt-3">
                                        <thead class="bg-gray-200 dark:bg-blue-600">
                                            <th class="text-center px-4 py-2">Deduction Date</th>
                                            <th class="text-center px-4 py-2">Amount</th>
                                            <th class="text-center px-4 py-2">Deduction Type</th>
                                        </thead>
                                        <tbody>
                                            <tr class="border-b border-gray-200" v-for="deduct in payroll.employees.deduction" :key="deduct.id">
                                                <td class="text-center py-2">
                                                    {{ formattedDate(deduct.deductionDate) }}
                                                </td>
                                                <td class="text-center py-2">
                                                    ₱{{ deduct.deductionAmount }}
                                                </td>
                                                <td class="text-center py-2">
                                                    {{ deduct.deductionType }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div class="container mx-auto px-4">
                            <div>
                                <p class="font-semibold text-gray-700 text-base mt-2.5 ml-16">Net Amount ₱{{ payroll.netAmount }}</p>
                            </div>
                            <div>
                                <button class="px-6 py-2 text-sm rounded-md bg-blue-500 hover:bg-blue-700 text-white ml-12">Update</button>
                                <button class="px-6 py-2 text-sm rounded-md bg-red-500 hover:bg-red-700 text-white ml-2">Delete</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </SideBarLayout>
</template>

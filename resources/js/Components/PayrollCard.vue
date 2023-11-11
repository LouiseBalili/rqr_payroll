<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    payroll: Object,
    employees : Object,
    user: Object,
    position:Object,
    cashAdvance:Object
})

function viewPayroll() {
    router.visit('/payrolls/view/' + props.payroll.id);
}
</script>

<template>
   <div class="min-w-[350px] mb-4 mx-2 p-4 bg-gray-100 hover:bg-blue-200 focus:outline-none focus:ring focus:ring-blue-600 rounded shadow flex-1 cursor-pointer border-gray-900" @click="viewPayroll">
        <div class="flex justify-between items-center">
            <div>
                <h5 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 flex items-center">
                    {{ payroll.employees.user.firstName }} {{ payroll.employees.user.middleName }} {{ payroll.employees.user.lastName }} {{ payroll.employees.user.suffix }}
                </h5>
                <div class="flex justify-between">
                    <div class="mr-10">
                        <div class="mb-2">
                            <p class="font-semibold text-gray-700 text-sm">Position</p>
                            <p class="text-sm text-gray-700 font-light">{{ payroll.employees.position.position}}</p>
                        </div>
                        <div class="mb-2">
                            <p class="font-semibold text-gray-700 text-sm">Days Worked</p>
                            <p class="text-sm text-gray-700 font-light">{{ payroll.daysWorked }}</p>
                        </div>
                    </div>
                    <div class="mr-10">
                        <div class="mb-2">
                            <p class="font-semibold text-gray-700 text-sm">Daily Rate</p>
                            <p class="text-sm text-gray-700 font-light">₱{{ payroll.employees.position.amount}}</p>
                        </div>
                        <div class="mb-2">
                            <p class="font-semibold text-gray-700 text-sm">Overtime Pay</p>
                            <p class="text-sm text-gray-700 font-light">₱{{ payroll.overtimeAmount}}</p>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2">
                            <p class="font-semibold text-gray-700 text-sm">Payroll Period</p>
                            <p class="text-sm text-gray-700 font-light">{{ payroll.payrollStart}} - {{ payroll.payrollEnd }}</p>
                        </div>
                        <div class="mb-2">
                            <p class="font-semibold text-gray-700 text-sm">Total Deductions</p>
                            <p class="text-sm text-gray-700 font-light">₱{{ payroll.totalDeductions}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right mr-10">
                <h5 class="mb-2 text-base font-bold tracking-tight text-gray-600 flex items-center ">Net Amount</h5>
                <h5 class="mb-2 text-base font-bold tracking-tight text-green-600 flex items-center ml-2.5 -mt-2.5">₱{{ payroll.netAmount}}</h5>
            </div>
        </div>
    </div>
</template>

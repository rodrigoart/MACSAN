<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'datatables.net-vue3';
import Select from 'datatables.net-select';
import { Head, Link } from '@inertiajs/inertia-vue3';

const options = {
    columnDefs: [
        { orderable: false, targets: 2 },
    ],
    "language": {
        "info": "Pagina _PAGE_ de _PAGES_",
        "decimal":        "",
        "emptyTable":     "No hay datos",
        "infoEmpty":      "Showing 0 to 0 of 0 registros",
        "infoFiltered":   "(filtrado de _MAX_ total registros)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     " _MENU_  registros",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No se encontro ningun dato",
        "paginate": {
            "first":      "Primero",
            "last":       "Ultimo",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
    },
};

defineProps({
    minutas: Array,
    user: Object,
});
</script>
<style>
@import 'datatables.net-dt';
</style>

<template>
<AppLayout title="Minutas">
    <template #header>
        <div>
            <h2 class="font-semibold text-m text-gray-800 leading-tight">
              Minutas
            </h2>
        </div>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="mb-4">
                    <Link v-if="user.role !== 'Visitante'" :href="route('minuta.create')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                      Agregar nueva minuta
                    </Link>
                </div>




                <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-6">
                    <DataTable class="w-full text-sm text-left text-gray-500 pt-4" :options="options">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Codigo
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Distrito
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Supervisor
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Fecha Inicio
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Fecha Final
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="minuta of minutas" class="bg-white border-b hover:bg-gray-50">
                                <td class="py-4 px-6">
                                    {{ minuta.id }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ minuta.distrito }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ minuta.supervisor }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ minuta.fecha_inicio }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ minuta.fecha_final }}
                                </td>
                                <td class="py-4 px-6">
                                    <Link :href="route('minuta.show', minuta.id)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                        Administrar
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </DataTable>
                </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>
<script >
export default {
  props: {
    user: Object,
    errors: Object,
    hoja: Object
  },

  data () {
    return {
      form: {
       hoja_monitoreo_id: this.hoja,
       lote: '',
      }
    }
  },

  methods: {
    submit () {
        this.$inertia.post(this.route('insumo.store'), this.form)
    },
  }

}
</script>

<template>
<AppLayout title="Dashboard">
    <template #header>
        <h2 class="font-semibold text-m text-gray-800 leading-tight">
           Agregar nuevo insumo
        </h2>
    </template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <form @submit.prevent="submit" >

                    <label for="supervisor">Lote</label>
                    <input type="text" v-model="form.lote" :class="{'border-red-500' : errors.lote}"/>
                    <button>Agregar Insumo</button>
                </form>

            </div>
        </div>
    </div>
</AppLayout>
</template>

            <!-- $table->string('supervisor')->nullable(); -->
            <!-- $table->unsignedBigInteger('id_supervisor')->nullable(); -->
            <!-- $table->unsignedBigInteger('id_usuario'); -->
            <!-- $table->string('aprovado')->default('no'); -->
            <!-- $table->string('municipio'); -->
            <!-- $table->string('territorio'); -->
            <!-- $table->string('c/s')->nullable(); -->
            <!-- $table->string('p/s')->nullable(); -->
            <!-- $table->string('personal_supervisado')->nullable(); -->
            <!-- $table->string('cargo')->nullable(); -->
            <!-- $table->text('observaciones')->nullable(); -->

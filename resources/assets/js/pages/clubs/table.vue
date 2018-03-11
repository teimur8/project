<template>
  <div class="row">
    <div class="col-md-12">
       <v-server-table 
          url="/api/clubs" 
          :columns="columns" 
          :options="options"
       >
            <router-link 
              slot="edit" 
              slot-scope="props" 
              :to="{ name: 'clubs.edit', params:{ id: props.row.id }}" 
            >
             {{ $t('edit')}}

            </router-link>

       </v-server-table>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  data() {
    return {
      columns: ["name", "city", "address","edit"],
      options: {

        
        // see the options API
      }
    };
  },

  computed: {},

  methods: {}
};
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>

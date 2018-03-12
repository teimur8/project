<template>
  <div class="row">
    <div class="col-md-12">
       <v-server-table 
          url="/api/tables" 
          :columns="columns" 
          :options="options"
       >
            <router-link 
              slot="edit" 
              slot-scope="props" 
              :to="{ name: 'tables.edit', params:{ id: props.row.id }}" 
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
      columns: ["name", "room", "club_name","edit"],
      options: {
        templates: {
            club_name: function (h, row, index) {
                return row.club.name;
            }
        }
        
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

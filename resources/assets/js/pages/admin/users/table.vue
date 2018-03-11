<template>
  <div class="row">
    <div class="col-md-12">
       <v-server-table 
        url="/api/users" 
        :columns="columns" 
        :options="options"
       ></v-server-table>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  data() {
    return {
      columns: ['id', 'name', 'email', 'role'],
      options: {
        // see the options API
      }
    };
  },

  computed: {
    tabs() {
      return [
        {
          icon: "user",
          name: this.$t("profile"),
          route: "users.create"
        },
        {
          icon: "lock",
          name: this.$t("password"),
          route: "settings.password"
        },
        {
          icon: "lock",
          name: this.$t("password"),
          route: "settings.password"
        }
      ];
    }
  },

  methods: {
    function(resp) {
      var data = this.getResponseData(resp);
      return { data: data.data, count: data.count };
    }
  }
};
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>

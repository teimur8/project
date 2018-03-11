<template>
  <card :title="$t('your_info')">
    <form @submit.prevent="updateOrCreate" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('success')"/>

      <!-- Name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
        <div class="col-md-7">
          <input v-model="form.name" type="text" name="name" class="form-control"
            :class="{ 'is-invalid': form.errors.has('name') }">
          <has-error :form="form" field="name"/>
        </div>
      </div>


    <div class="form-group row">
     <label class="col-md-3 col-form-label text-md-right">{{ $t('city') }}</label>
      <div class="col-md-7">
        <select v-model="form.city" name="city" class="form-control"
          :class="{ 'is-invalid': form.errors.has('city') }">
          <option>Алматы</option>
        </select>
        <has-error :form="form" field="city" />
      </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('address') }}</label>
        <div class="col-md-7">
          <input v-model="form.address" type="text" name="address" class="form-control"
            :class="{ 'is-invalid': form.errors.has('address') }">
          <has-error :form="form" field="address"/>
        </div>
    </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button type="success" :loading="form.busy">{{ id ? $t('update') : $t('create') }}</v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import Form from "vform";
import { mapGetters } from "vuex";

export default {
  scrollToTop: false,

  metaInfo() {
    return { title: this.$t("settings") };
  },

  data: () => ({
    form: new Form({
      id: "",
      name: "",
      city: "",
      address: ""
    }),
    id: null
  }),

  created() {
    if (this.$route.params.id) {
      this.id = this.$route.params.id;
      this.getItem(this.id);
    }
  },

  methods: {
    async updateOrCreate() {
      if (this.id) {
        const { data } = await this.form.put("/api/clubs/" + this.id);
      } else {
        const { data } = await this.form.post("/api/clubs");
      }
    },
    async getItem(id) {
      axios
        .get("/api/clubs/" + id)
        .then(res => {
          this.form = new Form(res.data.data);
        })
        .catch(err => {
          this.$router.push("/clubs/");
        });
    }
  }
};
</script>

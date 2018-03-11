<template>
  <card :title="$t('your_info')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('user.create')"/>

      <!-- Name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
        <div class="col-md-7">
          <input v-model="form.name" type="text" name="name" class="form-control"
            :class="{ 'is-invalid': form.errors.has('name') }">
          <has-error :form="form" field="name"/>
        </div>
      </div>

      <!-- Email -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
        <div class="col-md-7">
          <input v-model="form.email" type="email" name="email" class="form-control"
            :class="{ 'is-invalid': form.errors.has('email') }">
          <has-error :form="form" field="email" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('password') }}</label>
        <div class="col-md-7">
          <input v-model="form.password" type="password" name="password" class="form-control"
            :class="{ 'is-invalid': form.errors.has('password') }">
          <has-error :form="form" field="password" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button type="success" :loading="form.busy">{{ $t('update') }}</v-button>
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
      name: "",
      email: "",
      password: ""
    })
  }),

  created() {
  },

  methods: {
    async update() {
      const { data } = await this.form.patch("/api/users");

      // this.$store.dispatch('auth/updateUser', { user: data })
    }
  }
};
</script>

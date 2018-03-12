<template>
  <card :title="$t('tables.create')">
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
     <label class="col-md-3 col-form-label text-md-right">{{ $t('club_id') }}</label>
      <div class="col-md-7">
       <multiselect
        v-model="form.club_id"
        :options="clubs"
        :custom-label="customLabel"
        :name="'club_id'"
        :class="{ 'is-invalid': form.errors.has('club_id')}"
        >
      </multiselect>
        <has-error :form="form" field="club_id" />
      </div>
    </div>

      <div class="form-group row">
     <label class="col-md-3 col-form-label text-md-right">{{ $t('room') }}</label>
      <div class="col-md-7">
       <multiselect
        v-model="form.room"
        :options="rooms"
        :name="'club_id'"
        :class="{ 'is-invalid': form.errors.has('room')}"
        :taggable="true"
        @tag="addTag"
        tag-placeholder="Add this as new tag"
        >
      </multiselect>
        <has-error :form="form" field="room" />
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
import Multiselect from "vue-multiselect";

export default {
  components: {
    Multiselect
  },

  scrollToTop: false,

  metaInfo() {
    return { title: this.$t("settings") };
  },

  data: () => ({
    form: new Form({
      name: "",
      room: "",
      club_id: ""
    }),
    rooms: [],
    clubs: [],
    city: ["Алматы"],
    id: null
  }),

  created() {
    this.getData();

    if (this.$route.params.id) {
      this.id = this.$route.params.id;
      this.getItem(this.id);
    }
  },

  methods: {
    async updateOrCreate() {
      if (this.id) {
        const { data } = await this.form.put("/api/tables/" + this.id);
      } else {
        const { data } = await this.form.post("/api/tables");
      }
    },
    async getItem(id) {
      axios
        .get("/api/tables/" + id)
        .then(res => {
          this.form = new Form(res.data.data);
        })
        .catch(err => {
          this.$router.push("/tables/");
        });
    },
    async getData(id) {
      axios
        .get("/api/tables/getData")
        .then(res => {
          this.rooms = res.data.data.rooms;
          this.clubs = res.data.data.clubs;
        })
        .catch(err => {
          // this.$router.push("/tables/");
        });
    },
    customLabel(option) {
      return `${option.name}`;
    },
    addTag(newTag) {
      this.rooms.push(newTag);
      this.form.room = newTag;
    }
  }
};
</script>

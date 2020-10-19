<template>
  <form>
    <h1>Add Group</h1>
    <input placeholder="Name" type="text" required="" v-model="name" />

    <div class="container-select">
      <select v-model="selected">
        <option v-for="(option, index) in items" v-bind:value="option.id">
          {{ option.email }}
        </option>
      </select>

      <button v-on:click.prevent="addClient" class="addButton">
        add selected user
      </button>
    </div>
    <button v-on:click.prevent="save">Add</button>
  </form>
</template>
<script>
import instance from "../config/axios";
import mixin from "../Mixins/mixin";
export default {
  mixins: [mixin],
  data() {
    return {
      name: "",
      selected: "",
      items: [],
      user_ids: [],
      id_group: "",
    };
  },
  mounted() {
    this.showClients();
  },
  methods: {
    // show all clients in select options
    showClients() {
      let that = this;
      instance
        .get(this.url + "admin/clients")
        .then(({ data }) => {
          // console.log(data);
          that.items = data.data;
          that.items.forEach((element) => {
            if (element.role === "admin") {
              console.log(element.role);
              that.items.splice(that.items.indexOf(element), 1);
            }
          });
          console.log(that.items);
        })
        .catch((err) => console.error(err));
    },

    // create a group
    save() {
      let that = this;
      instance
        .post(this.url + "admin/group/create", {
          name: that.name,
        })
        .then((response) => {
          that.id_group = response.data.data.id;
          console.log(that.id_group);
          that.user_ids.forEach((element) => {
            addCG(element);
          });
        });
      that.$router.push({
        path: "/admin/groups",
      });
    },

    // add clients to group
    addCG(element) {
      axios
        .post(this.url + "admin/usergroup/create", {
          id_group: that.id_group,
          id_user: element,
        })
        .then((response) => {
          console.log("added ids");
        });
    },

    // add id client to array
    addClient() {
      this.user_ids.push(this.selected);
      console.log(this.user_ids);
      this.items.forEach((element) => {
        if (element.id === this.selected) {
          console.log(element.id);
          this.items.splice(this.items.indexOf(element), 1);
        }
      });
      console.log(this.items);
    },
  },
};
</script>
<style lang="scss">
@import "../style/Standarstyle.css";

.container-select {
  text-align: center;
}

.addButton {
  width: 100px !important;
  margin: 10px !important;
}
</style>
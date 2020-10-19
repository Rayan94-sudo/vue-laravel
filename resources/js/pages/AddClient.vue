<template>
  <form>
    <h1>Add client</h1>
    <input placeholder="Name" type="text" required="" v-model="name" />
    <input placeholder="Email" type="text" required="" v-model="email" />
    <input
      placeholder="Password"
      type="password"
      required=""
      v-model="password"
    />
    <div style="text-align: center">
      <p>if you want to enable user please check it</p>
      <input type="checkbox" id="checkbox" v-model="active" required="" />
    </div>
    <button v-on:click="addClient">Add</button>
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
      email: "",
      password: "",
      role: "client",
      active: 0,
    };
  },
  methods: {
    addClient() {
      instance
        .post(this.url + "admin/client/create", {
          name: this.name,
          email: this.email,
          password: this.password,
          role: this.role,
          active: this.active,
        })
        .then((response) => {
          console.log("added");
          that.$router.push({
            path: "/admin/Clients",
          });
        });
    },
  },
};
</script>
<style lang="scss" >
@import "../style/Standarstyle.css";
</style>
<template>
  <form>
    <h1>Admin Login</h1>
    <input placeholder="email" type="text" required="" v-model="email" />
    <input
      placeholder="Password"
      type="password"
      required=""
      v-model="password"
    />
    <button v-on:click.prevent="login">Submit</button>
  </form>
</template>
<script>
export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    login() {
      axios
        .post("http://127.0.0.1:8000/api/auth/login", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          console.log(response);
          console.log(response.data.access_token);
          localStorage.setItem("token", response.data.access_token);
          window.location.href = "/admin";
        });
    },
  },
};
</script>
<style lang="scss">
@import "../style/Standarstyle.css";
</style>
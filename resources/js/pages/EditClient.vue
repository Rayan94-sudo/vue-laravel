<template>
  <form>
    <h1>Edit client</h1>
    <input placeholder="Name" type="text" required="" v-model="items.name" />
    <input placeholder="Email" type="text" required="" v-model="items.email" />

    <div class="container-check">
      <p>Check it, if you want the client active</p>
      <input type="checkbox" id="checkbox" v-model="checked" required="" />
    </div>
    <button v-on:click="save">Edit</button>
  </form>
</template>
<script>
import instance from "../config/axios";
export default {
  data() {
    return {
      items: [],
      checked: false,
    };
  },
  mounted() {
    this.viewC();
  },

  methods: {
    // view client to be edit
    viewC() {
      // console.log(this.$route.params.id);
      let that = this;
      instance
        .get("http://127.0.0.1:8000/api/admin/client/" + this.$route.params.id)
        .then(({ data }) => {
          console.log(data);
          that.items = data.data;
          console.log(that.items);
        })
        .catch((err) => console.error(err));
    },

    //save updated fields
    save() {
      let that = this;
      instance
        .post(
          "http://127.0.0.1:8000/api/admin/client/update/" + that.items.id,
          {
            name: that.items.name,
            email: that.items.email,
            password: that.items.password,
            role: that.items.role,
            active: that.items.active,
          }
        )
        .then((response) => {
          console.log("edit");
        });
      this.$router.push({
        path: "/admin/clients",
      });
    },
  },
};
</script>
<style lang="scss">
@import url("//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css");

h1,
input::-webkit-input-placeholder,
button {
  font-family: "roboto", sans-serif;
  transition: all 0.3s ease-in-out;
}
.container-check {
  text-align: center;
}
h1 {
  height: 70px;
  width: 100%;
  font-size: 28px;
  background: darken(black, 4%);
  color: white;
  line-height: 120%;
  border-radius: 3px 3px 0 0;
  box-shadow: 0 2px 5px 1px rgba(0, 0, 0, 0.2);
}

form {
  box-sizing: border-box;
  width: 400px;
  margin: 40px auto 0;
  box-shadow: 2px 2px 5px 1px rgba(0, 0, 0, 0.2);
  padding-bottom: 40px;
  border-radius: 3px;
}
h1 {
  box-sizing: border-box;
  padding: 20px;
}
input {
  margin: 60px 25px;
  width: 350px;
  display: block;
  border: none;
  padding: 10px 0;
  border-bottom: solid 1px black;
  transition: all 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
  background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 96%, black 4%);
  background-position: -200px 0;
  background-size: 200px 100%;
  background-repeat: no-repeat;
  color: darken(black, 20%);
}

input:focus,
input:valid {
  box-shadow: none;
  outline: none;
  background-position: 0 0;
}
input::-webkit-input-placeholder {
  color: black;
  font-size: 11px;
  visibility: visible !important;
}

button {
  border: none;
  background: black;
  cursor: pointer;
  border-radius: 3px;
  padding: 6px;
  width: 350px;
  height: 38px;
  color: white;
  margin-left: 25px;
  box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.2);
}
button:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 6px 0 rgba(0, 0, 0, 0.2);
}

.follow {
  width: 42px;
  height: 42px;
  border-radius: 50px;
  background: #03a9f4;
  display: inline-block;
  margin: 50px calc(50% - 21px);
  white-space: nowrap;
  padding: 13px;
  box-sizing: border-box;
  color: white;
  transition: all 0.2s ease;
  font-family: Roboto, sans-serif;
  text-decoration: none;
  box-shadow: 0 5px 6px 0 rgba(0, 0, 0, 0.2);
}
.follow:hover {
  width: 134px;
  transform: translateX(-50px);
}
</style>
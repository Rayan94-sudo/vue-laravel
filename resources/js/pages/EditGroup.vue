<template>
  <form>
    <h1>Edit Group</h1>
    <input placeholder="Name" type="text" required="" v-model="group.name" />
    <div style="text-align: center" v-for="(elt, index) in Users_of_group">
      <p>{{ elt.email }}</p>
    </div>
    <div class="container-select">
      <select v-model="selected">
        <option v-for="(option, index) in items" v-bind:value="option.id">
          {{ option.email }}
        </option>
      </select>

      <button v-on:click.prevent="addClient" style="width: 100px; margin: 10px">
        add selected user
      </button>
    </div>
    <button v-on:click.prevent="save">Save</button>
  </form>
</template>
<script>
import instance from "../config/axios";
export default {
  data() {
    return {
      selected: "",
      items: [],
      user_ids: [],
      group: [],
      usergroup_id: [],
      Users_of_group: [],
    };
  },
  mounted() {
    //console.log(this.$route.params.id);
    let that = this;

    instance
      .get("http://127.0.0.1:8000/api/admin/group/" + this.$route.params.id)
      .then(({ data }) => {
        that.group = data.data;
        instance
          .get("http://127.0.0.1:8000/api/admin/usergroup")
          .then((response) => {
            that.usergroup_id = response.data.data;
            that.usergroup_id.forEach((element) => {
              instance
                .get(
                  "http://127.0.0.1:8000/api/admin/client/" + element.id_user
                )
                .then(({ data }) => {
                  that.Users_of_group.push(data.data);
                });
            });
          });
      })
      .catch((err) => console.error(err));
    console.log("hello");
    instance
      .get("http://127.0.0.1:8000/api/admin/clients")
      .then(({ data }) => {
        console.log(data);
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
  methods: {
    save() {
      let that = this;
      console.log(that.$route.params.id);
      instance
        .post(
          "http://127.0.0.1:8000/api/admin/group/update/" +
            that.$route.params.id,
          {
            name: that.group.name,
          }
        )
        .then((response) => {
          console.log("added");
        });

      that.user_ids.forEach((element) => {
        instance
          .post("http://127.0.0.1:8000/api/admin/usergroup/create", {
            id_group: element,
            id_user: that.group.id,
          })
          .then((response) => {
            console.log("added ids");
          });
      });
      that.$router.push({
        path: "/admin/groups",
      });
    },
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
@import url("//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css");

h1,
input::-webkit-input-placeholder,
button {
  font-family: "roboto", sans-serif;
  transition: all 0.3s ease-in-out;
}
.container-select {
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
<template>
  <div class="container">
    <div class="container">
      <div class="table">
        <div class="table-header">
          <div class="header__item">
            <a id="name" class="filter__link" href="#">Name</a>
          </div>
          <div class="header__item">
            <a id="email" class="filter__link filter__link--number" href="#"
              >Email</a
            >
          </div>

          <div class="header__item">
            <a id="action" class="filter__link filter__link--number" href="#"
              >Action</a
            >
          </div>
          <div class="header__item">
            <a id="crud" class="filter__link filter__link--number" href="#"
              >Delete & Edit
            </a>
          </div>
        </div>
        <div class="table-content" v-for="(item, index) in items">
          <div class="table-row">
            <div class="table-data">{{ item.name }}</div>
            <div class="table-data">{{ item.email }}</div>
            <div class="table-data">{{ item.active }}</div>
            <div class="table-data">
              <button v-on:click="editC(item.id)">Edit</button>
            </div>
            <div class="table-data">
              <button v-on:click="deleteC(item.id, index)">Delete</button>
            </div>
          </div>
        </div>
        <div class="table-row">
          <div class="table-data">
            <button v-on:click="addC_()" style="width: 200px !important">
              Add Client
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import instance from "../config/axios";
export default {
  data() {
    return {
      items: [],
    };
  },
  mounted() {
    this.showC();
  },
  methods: {
    // show clients
    showC() {
      let that = this;
      instance
        .get("http://127.0.0.1:8000/api/admin/clients")
        .then(({ data }) => {
          // console.log(data);
          that.items = data.data;
          that.items.forEach((element) => {
            if (element.role === "admin") {
              //console.log(element.role);
              that.items.splice(that.items.indexOf(element), 1);
            }
          });
          console.log(that.items);
        })
        .catch((err) => console.error(err));
      //console.log(localStorage.getItem("token"));
    },

    // delete client
    deleteC(id, indexid) {
      let that = this;
      //console.log(indexid);
      instance
        .delete("http://127.0.0.1:8000/api/admin/client/delete/" + id)
        .then((response) => {
          that.items.splice(indexid, 1);
          // console.log(that.items);
        });
    },

    //navigation to edit client page
    editC(id) {
      console.log(id);
      this.$router.push({
        path: "/admin/editclient/" + id,
        params: { pid: id },
      });
    },

    //navigation to add client page
    addC_() {
      this.$router.push({
        path: "/admin/addclient/",
      });
    },
  },
};
</script>

<style scoped lang="scss">
@import url("https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700");

$base-spacing-unit: 24px;
$half-spacing-unit: $base-spacing-unit / 2;

$color-alpha: #1772ff;
$color-form-highlight: #eeeeee;

*,
*:before,
*:after {
  box-sizing: border-box;
}

body {
  padding: $base-spacing-unit;
  font-family: "Source Sans Pro", sans-serif;
  margin: 0;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  margin: 0;
}
button {
  width: 50px !important;
}
.container {
  max-width: 1000px;
  margin-right: auto;
  margin-left: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.table {
  width: 100%;
  border: 1px solid $color-form-highlight;
}

.table-header {
  display: flex;
  width: 100%;
  background: #000;
  padding: ($half-spacing-unit * 1.5) 0;
}

.table-row {
  display: flex;
  width: 100%;
  padding: ($half-spacing-unit * 1.5) 0;

  &:nth-of-type(odd) {
    background: $color-form-highlight;
  }
}

.table-data,
.header__item {
  flex: 1 1 20%;
  text-align: center;
}

.header__item {
  text-transform: uppercase;
}

.filter__link {
  color: white;
  text-decoration: none;
  position: relative;
  display: inline-block;
  padding-left: $base-spacing-unit;
  padding-right: $base-spacing-unit;

  &::after {
    content: "";
    position: absolute;
    right: -($half-spacing-unit * 1.5);
    color: white;
    font-size: $half-spacing-unit;
    top: 50%;
    transform: translateY(-50%);
  }

  &.desc::after {
    content: "(desc)";
  }

  &.asc::after {
    content: "(asc)";
  }
}
</style>
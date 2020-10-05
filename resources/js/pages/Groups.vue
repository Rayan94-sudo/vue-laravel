<template>
  <div class="container">
    <div class="container">
      <div class="table" style="width: 500px !important">
        <div class="table-header">
          <div class="header__item">
            <a id="name" class="filter__link" href="#">Name</a>
          </div>
          <div class="header__item">
            <a id="crud" class="filter__link filter__link--number" href="#">
            </a>
          </div>
          <div class="header__item">
            <a id="crud" class="filter__link filter__link--number" href="#">
            </a>
          </div>
        </div>
        <div class="table-content">
          <div class="table-row" v-for="(item, index) in items">
            <div class="table-data">{{ item.name }}</div>
            <div class="table-data">
              <button v-on:click="editG(item.id)">view & edit</button>
            </div>
            <div class="table-data">
              <button v-on:click="deleteG(item.id, index)">Delete</button>
            </div>
          </div>
          <div class="table-row">
            <div class="table-data">
              <button v-on:click="addG" style="width: 200px !important">
                Add Group
              </button>
            </div>
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
      user_group: [],
    };
  },
  mounted() {
    this.showG();
  },
  methods: {
    // show groups
    showG() {
      let that = this;
      instance
        .get("http://127.0.0.1:8000/api/admin/groups")
        .then(({ data }) => {
          console.log(data);
          that.items = data.data;
          // console.log(that.items);
        })
        .catch((err) => console.error(err));
    },

    // delete group
    deleteG(id, indexi) {
      let that = this;
      instance
        .delete("http://127.0.0.1:8000/api/admin/group/delete/" + id)
        .then((response) => {
          that.items.splice(indexi, 1);
          // console.log(that.items);
        });
    },

    //navigation to edit group page
    editG(id) {
      console.log(id);
      this.$router.push({
        path: "/admin/editgroup/" + id,
        params: { pid: id },
      });
    },

    //navigation to add group page
    addG() {
      this.$router.push({
        path: "/admin/addgroup",
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
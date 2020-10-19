 <template>
  <div class="hello">
    <input type="text" v-model="potato.name" placeholder="Name" />
    <button @click="add_potato()">Add potato ^_^</button>

    <h2>My potatos</h2>
    <ul>
      <li style="display: block" v-for="(potato, index) in potatos">
        Name: {{ potato.name }}
        <button
          @click="delete_potato(index)"
          style="width: 40px; height: 20px"
        />
      </li>
    </ul>
  </div>
</template>
    
    <script>
export default {
  data() {
    return {
      potato: {
        name: "",
      },
    };
  },
  methods: {
    add_potato: function () {
      this.$store.dispatch("ADD_POTATO", this.potato);
      this.potato = {
        name: "",
      };
    },
    delete_potato: function (index) {
      this.$store.dispatch("DELETE_POTATO", index);
    },
  },
  computed: {
    potatos: function () {
      return this.$store.getters.potatos;
    },
  },
};
</script>
    
    <!-- Add "scoped" attribute to limit CSS to this component only -->
    <style scoped>
.hello {
  margin-left: 40%;
}
h1,
h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 4px 10px;
}

a {
  color: #42b983;
}
button {
  color: white;
}
</style>
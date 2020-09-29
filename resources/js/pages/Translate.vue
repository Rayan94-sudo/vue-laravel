<template>
  <div class="container">
    <h1>Translate</h1>
    <input
      type="text"
      placeholder="text to translate"
      v-model="translationFrom"
    />
    <button>Translate</button>
    <p v-model="translation">{{ this.translationTo }}</p>
  </div>
</template>
<script>
export default {
  data() {
    return {
      translationFrom: "",
      translationTo: "hello",
    };
  },
};
</script>
<style scoped>
.container {
  width: 500px;
  margin-left: 450px;
  text-align: center;
}
h1 {
  text-align: center;
}
input {
  width: 450px;
  text-align: center;
}
p {
  margin-top: 30px;
  color: crimson;
}
</style>
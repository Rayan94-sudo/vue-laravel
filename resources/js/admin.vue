<template>
  <div>
    <sidebar></sidebar>
    <router-view></router-view>
  </div>
</template>
<script>
import sidebar from "./components/Sidebar";
export default {
  components: {
    sidebar: sidebar,
  },
};
</script>
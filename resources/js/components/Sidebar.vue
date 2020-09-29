<template>
  <div>
    <sidebar-menu :menu="menu" />
  </div>
</template>
 
<script>
export default {
  data() {
    return {
      menu: [
        {
          header: true,
          title: "Admin Dashbord",
          hiddenOnCollapse: true,
        },

        {
          href: "/admin/clients",
          title: "Clients",
          icon: "fa fa-user",
        },
        {
          href: "/admin/groups",
          title: "Groups",
          icon: "fa fa-user",
        },
        {
          href: "/admin/translate",
          title: "Translate",
          icon: "fa fa-user",
        },
      ],
    };
  },
};
</script> 
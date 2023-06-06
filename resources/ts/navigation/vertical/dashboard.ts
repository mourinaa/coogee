export default [
  {
    title: "Dashboards",
    icon: { icon: "tabler-smart-home" },
    children: [
      {
        title: "Analytics",
        to: "dashboards-analytics",
      },
      {
        title: "eCommerce",
        to: "dashboards-ecommerce",
      },
      {
        title: "CRM",
        to: "dashboards-crm",
      },
      {
        title: "EVENTS",
        to: "dashboards-events-list",

        // children: [
        //   { title: 'List', to: 'dashboards-events-list' },
        // ],
      },
      // {
      //   title: "TEST",
      //   to: "dashboards-tests",
      // },
    ],
    badgeContent: "2",
    badgeClass: "bg-light-primary text-primary",
  },
]

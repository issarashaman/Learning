const chats = [
  {
    path: "/console/chat/:id",
    name: "chat",
    component: () => import("../views/consoles/chats/ChatView.vue"),
  },
];

export default chats;

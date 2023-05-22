import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore({
  id: "authStore",
  state: () => ({
    loggedIn: localStorage.getItem("isLoggedin"),
    userCredential: [],
  }),
  getters: {
    currentUser: (state) => state.userCredential,
  },
  actions: {
    async createUserWithEmailAndPassword(name, email, password, password_confirmation) {
      // Make a request
      await axios
        .post("/register", {
          name: name,
          email: email,
          password: password,
          password_confirmation: password_confirmation,
        })
        .then(function (response) {
          localStorage.setItem("isLoggedin", true);
          return Promise.resolve(response.data);
        })
        .catch(function (error) {
          // handle error
          return Promise.reject(error);
        });
    },
    async signInWithEmailAndPassword(email, password) {
      // Make a request
      await axios
        .post("/login", {
          email: email,
          password: password,
        })
        .then(function (response) {
          localStorage.setItem("isLoggedin", true);
          return Promise.resolve(response.data);
        })
        .catch(function (error) {
          // handle error
          return Promise.reject(error);
        });
    },
    async signOut() {
      // Make a request
      await axios
        .post("/logout")
        .then(function (response) {
          localStorage.removeItem("isLoggedin");
          return Promise.resolve(response.data);
        })
        .catch(function (error) {
          // handle error
          return Promise.reject(error);
        })
        .then(function () {
          // always executed
        });
    },

    async ftechUser() {
      // Make a request
      const response = (await axios.get("/api/user"));
      if(response)
      this.userCredential = response.data;
      this.loggedIn = true;
      return Promise.resolve(response.data);
    },
  },
});

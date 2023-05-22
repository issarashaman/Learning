<template>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Chat - Chanel 101</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/console">Console</a></li>
            <li class="breadcrumb-item active">Chat</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid pb-5">
      <!-- DIRECT CHAT PRIMARY -->
      <div class="card card-primary card-outline direct-chat direct-chat-primary">
        <div class="card-header">
          <h3 class="card-title">Chanel 101</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
              <i class="fas fa-comments"></i>
            </button>
            <span title="3 New Messages" class="badge bg-primary">3</span>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <!-- Conversations are loaded here -->
          <div class="direct-chat-messages" ref="hasScrolledToBottom">
            <div v-for="message in messages" :todo="message" :key="message.created_at">
              <template v-if="user.id != message.user.id">
                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                  <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">{{ message.user.name }}</span>
                    <span class="direct-chat-timestamp float-right"><i class="far fa-clock"></i> {{ formatDate(message.created_at) }}</span>
                  </div>
                  <!-- /.direct-chat-infos -->
                  <img class="direct-chat-img" src="@/scripts/assets/img/avatar/Author-Clyde-Webflow.png" alt="Message User Image" />
                  <!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    {{ message.message }}
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
              </template>

              <template v-else>
                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                  <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-right">{{ message.user.name }}</span>
                    <span class="direct-chat-timestamp float-left"><i class="far fa-clock"></i> {{ formatDate(message.created_at) }}</span>
                  </div>
                  <!-- /.direct-chat-infos -->
                  <img class="direct-chat-img" src="@/scripts/assets/img/avatar/Author-Wumpus-Webflow.png" alt="Message User Image" />
                  <!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    {{ message.message }}
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
              </template>
            </div>
          </div>
          <!--/.direct-chat-messages-->

          <!-- Contacts are loaded here -->
          <div class="direct-chat-contacts">
            <ul class="contacts-list">
              <li>
                <a href="#">
                  <img class="contacts-list-img" src="@/scripts/assets/img/avatar/Author-Clyde-Webflow.png" alt="User Avatar" />

                  <div class="contacts-list-info">
                    <span class="contacts-list-name">
                      Count Dracula
                      <small class="contacts-list-date float-right">2/28/2015</small>
                    </span>
                    <span class="contacts-list-msg">How have you been? I was...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <!-- End Contact Item -->
            </ul>
            <!-- /.contatcts-list -->
          </div>
          <!-- /.direct-chat-pane -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div>
            <div class="input-group">
              <input v-model="new_message" type="text" name="message" placeholder="Type Message ..." class="form-control" @keyup.enter="useSendMessage" />
              <span class="input-group-append">
                <button type="submit" class="btn btn-primary" @click="useSendMessage"><i class="fas fa-paper-plane"></i> Send</button>
              </span>
            </div>
          </div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!--/.direct-chat -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</template>

<script setup>
import axios from "axios";
import { reactive, inject, ref, onMounted, onUpdated } from "vue";
import moment from "moment";

const user = ref(window.currentUser);
const messages = ref();
const new_message = ref();
const hasScrolledToBottom = ref();

const errorMessage = ref();
const errors = ref();

onMounted(() => {
  fetchMessages();
});

onUpdated(() => {
  scrollBottom();
});

const fetchMessages = async () => {
  // Make a request for a user with a given ID
  axios
    .get("/api/messages")
    .then(function (response) {
      // handle success
      console.log(response);
      messages.value = response.data;
    })
    .catch(function (error) {
      // handle error
      console.log(error);
    })
    .then(function () {
      // always executed
    });
};

function useSendMessage() {
  // Make a request for a user with a given ID
  axios
    .post("/api/messages", {
      user: user.value,
      message: new_message.value,
    })
    .then(function (response) {
      // handle success
      console.log(response);
      console.log(response.data);
    })
    .catch(function (error) {
      // handle error
      console.log(error.response.data);
      errorMessage.value = error.response.data.message;
      errors.value = error.response.data.errors;
    })
    .then(function () {
      // always executed
      new_message.value = "";
      fetchMessages();
    });
}

Echo.private("channel-name").listen("SendMessage", (e) => {
  messages.value.push({
    message: e.message.message,
    user: e.user,
  });
  fetchMessages();
});

const scrollBottom = () => {
  if (messages.value.length > 1) {
    let el = hasScrolledToBottom.value;
    el.scrollTop = el.scrollHeight;
  }
};

function formatDate(value) {
  return moment(String(value)).format("MM-DD-YYYY hh:mm:ss");
}
</script>

<style lang="scss" scoped>
.direct-chat-messages {
  overflow: hidden;
  overflow-y: scroll;
  height: 320px;
}
.direct-chat-contacts {
  height: 320px;
}
</style>

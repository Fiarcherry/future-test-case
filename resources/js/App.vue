<template>
  <v-app :style="{ background: $vuetify.theme.themes[theme].background }">
    <v-app-bar app color="primary" min-height="200">
      <v-container fill-height fluid>
        <v-layout mx-12>
          <v-flex xs6>
            <v-layout wrap>
              <v-flex xs12>
                <p class="font-weight-bold" v-text="futurePhone"></p>
              </v-flex>
              <v-flex xs12>
                <p class="font-weight-bold">
                  Email:
                  <span
                    class="text-decoration-underline"
                    v-text="futureEmail"
                  ></span>
                </p>
              </v-flex>
              <v-flex xs12 mt-6>
                <p class="text-h2">Комментарии</p>
              </v-flex>
            </v-layout>
          </v-flex>
          <v-flex xs6 mt-1 class="d-flex justify-end">
            <v-img
              :src="futureLogoSrc"
              contain
              min-width="160"
              min-height="160"
              max-width="160"
              max-height="160"
            >
            </v-img>
          </v-flex>
        </v-layout>
      </v-container>
    </v-app-bar>

    <v-main style="padding-top: 200px">
      <v-container fluid>
        <v-layout mx-16 column>
          <v-row d-flex v-for="comment in comments" :key="comment.id">
            <v-card color="secondary" flat>
              <v-layout>
                <v-card-title
                  class="headline font-weight-bold"
                  v-text="comment.author"
                ></v-card-title>
                <v-card-subtitle
                  class="ma-0 pt-6"
                  v-text="comment.time"
                ></v-card-subtitle>
                <v-card-subtitle
                  class="ma-0 pt-6"
                  v-text="comment.date"
                ></v-card-subtitle>
              </v-layout>
              <v-card-text
                class=" pt-0 text--primary"
                v-text="comment.text"
              ></v-card-text>
            </v-card>
          </v-row>
          <v-divider class="mx-1 mt-3 mb-4"></v-divider>
          <v-row>
            <v-col cols="12" md="6" sm="6">
                <p class="headline">Оставить комментарий</p>
                <p>Ваше имя</p>
                <v-text-field
                  v-model="author"
                  solo
                  flat
                ></v-text-field>
                <p>Ваш комментарий</p>
                <v-textarea
                  v-model="text"
                  color="black"
                  outlined
                  auto-grow
                >
                </v-textarea>
                <v-flex class="d-flex justify-end">
                  <v-btn outlined :disabled="!valid" @click="commentCreate"
                    >Отправить</v-btn
                  >
                </v-flex>
              </v-form>
            </v-col>
          </v-row>
        </v-layout>
      </v-container>
    </v-main>

    <v-footer app color="primary" min-height="120">
      <v-container fill-height fluid>
        <v-layout mx-12>
          <v-flex xs2>
            <v-img
              :src="futureLogoSrc"
              contain
              min-width="120"
              min-height="120"
              max-width="120"
              max-height="120"
            >
            </v-img>
          </v-flex>
          <v-flex xs10>
            <v-layout wrap>
              <v-flex xs12>
                <p class="ma-0 font-weight-bold" v-text="futurePhone"></p>
              </v-flex>
              <v-flex xs12>
                <p class="ma-0 font-weight-bold">
                  Email:
                  <span
                    class="text-decoration-underline"
                    v-text="futureEmail"
                  ></span>
                </p>
              </v-flex>
              <v-flex xs12>
                <p class="font-weight-bold">
                  Адрес:
                  <span
                    class="text-decoration-underline"
                    v-text="futureAddress"
                  ></span>
                </p>
              </v-flex>
              <v-flex xs12>
                <p class="ma-0">
                  &copy; 2010 - 2014 Future. Все права защищены
                </p>
              </v-flex>
            </v-layout>
          </v-flex>
        </v-layout>
      </v-container>
    </v-footer>
  </v-app>
</template>

<script>
import axios from 'axios'

function Comment({ id, author, text, time, date }) {
  this.id = id
  this.author = author
  this.text = text
  this.time = time
  this.date = date
}

export default {
  name: 'App',

  data: () => ({
    comments: [],

    futurePhone: 'Телефон:(499)340-94-71',
    futureEmail: 'info@future-group.ru',
    futureAddress: '115088 Москва, ул. 2-я Машиностроения, д. 7 стрю 1',
    futureLogoSrc: '/images/logo.png',

    author: '',
    text: '',
    valid: false,
  }),

  methods: {
    async commentCreate() {
      console.log('method commentCreate')
      axios
        .get(`/comments/create?author=${this.author}&text=${this.text}`)
        .then((res) => {
          console.log(res.data)
          this.comments.unshift(res.data)
        })
        .catch((error) => {
          console.log(error)
        })
    },
  },

  computed: {
    theme() {
      return 'light'
    },
  },

  created() {
    console.log('created')
    axios
      .get('/comments')
      .then((res) => {
        console.log(res.data)
        this.comments = res.data
      })
      .catch((error) => {
        console.log(error)
      })
  },
}
</script>

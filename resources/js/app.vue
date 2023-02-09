<template>
  <v-app>
    <!-- サイドメニュー -->
    <v-navigation-drawer app clipped v-model="drawer" dark color="info">

      <v-list nav dense>
        <v-list-item-group>
          <v-list-item router :to="{ name: 'contents' }">
            <v-list-item-title>word</v-list-item-title>
          </v-list-item>

          <v-list-item router :to="{ name: 'cal' }">
            <v-list-item-title>cal</v-list-item-title>

          </v-list-item>

        </v-list-item-group>
      </v-list>

    </v-navigation-drawer>

    <!-- ヘッダー -->
    <v-app-bar app clippedLeft flat dark color="indigo darken-3">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-spacer></v-spacer>

      <v-text-field label="" single-line width="400px" class="shrink" v-model="cond" hide-details
        @keypress.enter="onKeypressEnter"></v-text-field>

      <v-btn icon @click="onKeypressEnter">
        <v-icon>mdi-magnify</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-app-bar>
    <!-- メイン -->
    <v-main>
      <v-container fluid>
        <RouterView ref="view"></RouterView>
      </v-container>
      <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="400">
      <v-card >
        <v-toolbar dark color="primary">
          <v-toolbar-title>ログイン</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-form ref="loginFormRef" :model="loginForm" :rules="loginFormRules">
            <v-text-field prepend-icon="mdi-account" v-model="loginForm.name" :rules="loginFormRules.name" label="ネーム"></v-text-field>
            <v-text-field prepend-icon="mdi-lock" v-model="loginForm.password" :rules="loginFormRules.password" label="パスワード"></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn color="primary" @click="login">ログイン</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </v-row>
    </v-main>

    <!-- フッター -->
    <v-footer app color="primary">
    </v-footer>


  </v-app>
</template>

<script>

import header1 from "./components/HeaderComponent";
export default {
  name: 'app2',

  components: {
    // ここで子コンポーネント＆HTMLタグ名を登録
    header1: header1,
  },

  data() {
    return {
      drawer: false,
      cond: this.$route.query.type,
      dialog: true,
      loginForm: {
        name: "",
        password: "",
      },
      loginFormRules: {
        name: [
          v => !!v || 'name is required',
        ],
        password: [
          v => !!v || 'パスワード is required',
          //v => (v && v.length <= 10) || 'パスワード must be less than 10 characters',
        ]
      }
    }
  },

  watch: {
    $route(to, from) {
      //location.reload()
    }
  },

  mounted() {
    //  alert(123);
  },

  methods: {
    onKeypressEnter() {

      var p = {
        params: {
          "q": this.cond
        }
      }

      this.$refs.view.myMethod(p);
      // 同じページのへの遷移の場合、再描画されない

      //console.log(this.$route.name );
      //this.$router.push({ name: this.$route.name, params:{id:this.cond},query: { type: this.cond } })
    }
    ,

    login() {

      if (this.$refs.loginFormRef.validate()) {
        
        var _this = this;
        axios.post('/api/login', this.loginForm).then(function (res) {
            _this.dialog = false;
            console.log(res);
          // window.sessionStorage.setItem('token', res.data.token);
          // window.location.href = '/'
          // //this.$router.push('/')

        }).catch(function (error) {
          console.log(error);

          if (error.response) {
            alert(error.response.data.message);
            // 请求成功发出且服务器也响应了状态码，但状态代码超出了 2xx 的范围
            console.log(error.response.data);
            console.log(error.response.status);
            console.log(error.response.headers);
          } else if (error.request) {
            alert('ログインにエラーが発生しました。');
            // 请求已经成功发起，但没有收到响应
            // `error.request` 在浏览器中是 XMLHttpRequest 的实例，
            // 而在node.js中是 http.ClientRequest 的实例
            console.log(error.request);
          } else {
            alert('ログインにエラーが発生しました。');
            // 发送请求时出了点问题
            console.log('Error', error.message);
          }
          console.log(error.config);
        });
      }

    }
  }

}
</script>
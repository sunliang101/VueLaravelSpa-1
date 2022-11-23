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
      <input search single v-model="cond" @keypress.enter="onKeypressEnter"/>
      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>



      <router-link v-bind:to="{ name: 'contents', params: { cond: cond } }">

        <v-btn icon>
          <v-icon>mdi-heart</v-icon>
        </v-btn>


      </router-link>


      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-app-bar>

    <!-- メイン -->
    <v-main>
      <v-container fluid>
        <RouterView />
      </v-container>
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
      cond: "1",
    }
  },

  watch: {
    $route(to, from) {
      location.reload()
    }
  },

  methods: {
      onKeypressEnter() {
        // 同じページのへの遷移の場合、再描画されない
        this.$router.push({ name: 'contents2', params:{n:this.cond} })
      }
    }
}
</script>
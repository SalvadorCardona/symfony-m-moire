<template>
  <div v-if="!userService.token">
    <input type="text" class="app-input" v-model="loginRequest.email" />
    <input type="text" class="app-input" v-model="loginRequest.password" />
    <button class="app-btn" @click="() => userService.connection(loginRequest)">Se connecter</button>
  </div>
  <div v-else>Vous êtes connecté</div>
</template>

<script lang="ts" setup>
import UserService, { LoginRequest } from '@/modules/user/services/UserService'
import { useStore } from '@/store'

const userService: UserService = useStore().state.userService
const loginRequest: LoginRequest = { email: '', password: '' }
</script>
